# Gymie Deep Bug Report

Date: 2026-06-17  
Scope: static analysis of `/home/user/gymie-main` for the two flagged issues:

1. Member deletion fails unless invoices/subscriptions are deleted first.
2. The "add new member" flow, especially the subscription/invoice section, is not responsive on mobile.

> Note: I could not execute the Laravel test suite in this sandbox because PHP/Composer are not available here. This report is based on code inspection.

---

## Executive summary

### Bug 1 — Member deletion blocked before cascade can run

**Likely root cause:** the project has two conflicting deletion systems:

- Model-level cascade soft delete is already implemented:
  - `Member` cascades to `subscriptions`.
  - `Subscription` cascades to `invoices`.
- But a global Filament deletion-prevention layer blocks deletes whenever related records exist.

So from the admin UI, a member with subscriptions cannot reach `$member->delete()` at all. The cascade logic is therefore never triggered. That matches the reported behavior: the user must delete invoices/subscriptions first.

**Primary files:**

- `config/prevent-deletion.php`
- `app/Providers/AppServiceProvider.php`
- `app/Models/Member.php`
- `app/Models/Subscription.php`
- `app/Models/Concerns/CascadesSoftDeletes.php`

**Recommended fix:** remove cascade-owned relations from `config/prevent-deletion.php`, at minimum:

```php
\App\Models\Member::class => ['subscriptions'],
\App\Models\Subscription::class => ['invoices'],
```

or make the deletion-prevention layer relation-specific and allow deletes for relationships that are intentionally cascaded.

### Bug 2 — Mobile responsiveness issue in create-member invoice section

**Likely root cause:** the create-member form embeds the subscription form, which embeds invoice details, and several nested layout components use fixed numeric columns/column spans instead of breakpoint-aware layouts.

Examples:

- Member form main section: `->columns(4)` plus inner grid `->columns(3)->columnSpan(3)`.
- Subscription repeater: `->columns(3)`.
- Subscription form header: `->columns(6)` with fixed `->columnSpan(2)` / `->columnSpan(4)`.
- Invoice repeater: `->columns(4)` with a 3-column form group and 1-column summary fieldset.
- Invoice standalone form has the same pattern: `->columns(4)`, inner `->columns(3)`, `->columnSpan(3)`.

On small screens, these nested grids can squeeze fields or overflow horizontally. The invoice summary fieldset is especially likely to sit beside the form instead of stacking below it.

**Recommended fix:** replace fixed columns/spans with responsive arrays, e.g. `['default' => 1, 'md' => 2, 'xl' => 4]`, and set mobile column spans to full width.

---

## Detailed findings

## 1. Member deletion / cascade analysis

### Current cascade design

`Member` uses both `SoftDeletes` and the custom `CascadesSoftDeletes` trait:

```php
use CascadesSoftDeletes, HasFactory, SoftDeletes;
```

It defines this cascade target:

```php
protected static function relationsToCascade(): array
{
    return ['subscriptions'];
}
```

Location: `app/Models/Member.php`, around lines 36-37 and 108-110.

`Subscription` also uses the cascade trait and defines:

```php
protected static function relationsToCascade(): array
{
    return ['invoices'];
}
```

Location: `app/Models/Subscription.php`, around lines 30 and 113-115.

The trait does this on model delete:

```php
static::deleting(function (Model $model): void {
    foreach (static::relationsToCascade() as $relation) {
        $model->{$relation}()->get()->each->delete();
    }
});
```

Location: `app/Models/Concerns/CascadesSoftDeletes.php`, around lines 28-33.

So the intended model behavior is:

```text
Member delete
  -> Subscription delete
       -> Invoice delete
```

The database migrations also declare hard-delete cascade constraints:

- `subscriptions.member_id` cascades on delete.
- `invoices.subscription_id` cascades on delete.
- `invoice_transactions.invoice_id` cascades on delete.

This is good for hard deletes, but soft deletes still need the Eloquent cascade trait because database constraints do not fire when only `deleted_at` is updated.

### Where deletion is blocked

The global Filament deletion-prevention map contains:

```php
\App\Models\Member::class => ['subscriptions'],
\App\Models\Subscription::class => ['invoices'],
```

Location: `config/prevent-deletion.php`, lines 8 and 12.

The global Filament delete action checks this map. If the record has any configured relationship, it removes the submit action from the delete modal:

```php
if ($record->$relation()->exists()) {
    $action
        ->modalIcon('heroicon-o-x-mark')
        ->modalHeading(...)
        ->modalDescription(...)
        ->modalCancelAction(false)
        ->modalSubmitAction(false);
}
```

Location: `app/Providers/AppServiceProvider.php`, around lines 213-240.

Bulk delete has the same logic:

```php
if ($record->$relation()->exists()) {
    $action
        ->modalIcon('heroicon-o-x-mark')
        ->modalHeading(...)
        ->modalDescription(...)
        ->modalCancelAction(false)
        ->modalSubmitAction(false);
}
```

Location: `app/Providers/AppServiceProvider.php`, around lines 243-273.

### Why this causes the reported bug

The application wants member deletion to cascade. But the Filament delete action prevents deleting members that have subscriptions. Since the action blocks the delete before calling `$member->delete()`, this code never runs:

```php
$model->{$relation}()->get()->each->delete();
```

That means the cascade behavior exists but is unreachable from the admin UI for the exact case where it is needed.

### API behavior may differ from admin UI

The API delete helper directly calls:

```php
$record->delete();
```

Location: `app/Http/Controllers/Api/V1/ApiController.php`.

Therefore the API likely cascades correctly, while Filament UI blocks deletion. This difference can produce confusing behavior:

- API member delete: likely succeeds and cascades.
- Admin UI member delete: blocked when subscriptions exist.

### Recommended fix options

#### Option A — simplest fix

Remove cascade-owned relationships from `config/prevent-deletion.php`:

```php
return [
    \App\Models\Enquiry::class => ['followUps'],
    \App\Models\Service::class => ['plans'],

    // Remove this because Member intentionally cascades subscriptions:
    // \App\Models\Member::class => ['subscriptions'],

    \App\Models\Plan::class => ['subscriptions'],

    // Remove this because Subscription intentionally cascades invoices:
    // \App\Models\Subscription::class => ['invoices'],

    \App\Models\User::class => ['followUps', 'enquiries'],
];
```

This aligns UI behavior with the model cascade rules.

#### Option B — better long-term design

Change `prevent-deletion.php` to only list relationships that should block deletion, not relationships that are safe to cascade.

For example:

```php
return [
    'prevent' => [
        \App\Models\Service::class => ['plans'],
        \App\Models\Plan::class => ['subscriptions'],
        \App\Models\User::class => ['followUps', 'enquiries'],
    ],

    'cascade' => [
        \App\Models\Member::class => ['subscriptions'],
        \App\Models\Subscription::class => ['invoices'],
    ],
];
```

Then the Filament delete modal can show a stronger confirmation message for cascade deletes instead of blocking them:

```text
Deleting this member will also delete 2 subscriptions and their invoices. Continue?
```

#### Option C — domain-level delete service

Create a `MemberDeletionService` that controls all related deletion behavior in one place. Then call it from:

- Filament actions
- API controllers
- console commands, if any

This avoids having UI, API, and model events disagree.

### Recommended tests

Add or extend a feature test. Current cascade coverage only tests `Enquiry -> FollowUp`. There is no equivalent test for `Member -> Subscription -> Invoice`.

Suggested test:

```php
use App\Models\Invoice;
use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('soft deleting a member cascades to subscriptions and invoices', function (): void {
    $member = Member::factory()->create();
    $subscription = Subscription::factory()->create([
        'member_id' => $member->id,
    ]);
    $invoice = Invoice::factory()->create([
        'subscription_id' => $subscription->id,
    ]);

    $member->delete();

    expect(Member::withTrashed()->find($member->id)?->trashed())->toBeTrue();
    expect(Subscription::withTrashed()->find($subscription->id)?->trashed())->toBeTrue();
    expect(Invoice::withTrashed()->find($invoice->id)?->trashed())->toBeTrue();
});
```

Also add a UI/Filament test or integration-level test to ensure the delete action is not blocked for members with subscriptions after config changes.

### Secondary cascade concerns

These are not necessarily the reported bug, but they are worth noting.

#### Restore may restore children that were deleted before the parent

The current trait restores all trashed related children:

```php
$model->{$relation}()->withTrashed()->get()->each->restore();
```

If a subscription was intentionally soft-deleted before the member was deleted, restoring the member will also restore that old subscription. That may be unexpected.

A safer design tracks cascade-deleted records, or only restores child records whose `deleted_at` is greater than or equal to the parent deletion timestamp.

#### Invoice transactions are not soft-deleted when an invoice is soft-deleted

`Invoice` uses `SoftDeletes` but does not use `CascadesSoftDeletes`. `invoice_transactions` are hard-related by DB cascade only. Since soft deleting an invoice does not trigger DB cascade, invoice transactions remain active.

This may be fine if transactions should remain for audit history, but it should be an explicit decision.

---

## 2. Add-new-member mobile/invoice responsiveness analysis

### Form nesting structure

The create-member form includes:

```text
MemberForm
  -> main member details section
  -> location section
  -> subscription_and_invoice section, visible on create
       -> subscriptions repeater
            -> SubscriptionForm
                 -> subscription fields
                 -> invoice_details section
                      -> invoices repeater
                           -> invoice fields group
                           -> summary fieldset
```

This is a deep nested grid structure. Deep nesting is not automatically bad, but fixed column counts at each level make mobile layout fragile.

### Specific layout hotspots

#### Member details section

`MemberForm` uses:

```php
Grid::make()
    ->schema([...])
    ->columns(3)
    ->columnSpan(3),
```

inside:

```php
Section::make()
    ->schema([...])
    ->columns(4),
```

Location: `app/Filament/Resources/Members/Schemas/MemberForm.php`, around lines 49-130.

Risk:

- On mobile, the image upload and 3-column grid may remain side-by-side or compress if Filament interprets the fixed values as default columns.
- `name` uses `->columnSpan(2)`, which is desktop-friendly but should be full-width on mobile.

#### Location section

The location section uses:

```php
Section::make(__('app.ui.location'))
    ->columns(2)
```

and the nested group also uses:

```php
Group::make()
    ->columns(2)
```

Location: `app/Filament/Resources/Members/Schemas/MemberForm.php`, around lines 131-165.

Risk:

- Two-column address/country/state/city layout is too tight on mobile.

#### Create-member subscription repeater

The create-member subscription/invoice section has:

```php
Repeater::make('subscriptions')
    ->columns(3)
```

Location: `app/Filament/Resources/Members/Schemas/MemberForm.php`, around lines 166-179.

Risk:

- The repeater wrapper itself imposes another grid context before `SubscriptionForm` adds its own grids.

#### Subscription header fields

`SubscriptionForm` starts with:

```php
Group::make()
    ->columns(6)
```

Then:

```php
Select::make('member_id')->columnSpan(2)
Select::make('plan_id')->columnSpan(fn (...) => ... ? 4 : 2)
```

Location: `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php`, around lines 51-151.

Risk:

- Six columns is a desktop layout. On mobile, fields should be one per row.
- The dynamic `plan_id` span can take four columns in create-member context, which is logical on desktop but bad on mobile if no default span override exists.

#### Invoice repeater and summary fieldset

The invoice details section uses:

```php
Repeater::make('invoices')
    ->columns(4)
```

Inside it:

```php
Group::make()
    ->columns(2)
    ->columnSpan(3)

Fieldset::make(__('app.titles.summary'))
    ->columns(1)
    ->columnSpan(1)
```

Location: `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php`, around lines 152-280.

Risk:

- Desktop layout: invoice fields occupy 3/4 width, summary occupies 1/4 width.
- Mobile desired layout: invoice fields full width, summary full width below.
- Current fixed spans make the summary panel likely to remain squeezed beside the invoice fields or cause horizontal overflow.

#### Standalone invoice form has similar risk

`InvoiceForm` uses:

```php
Section::make('')
    ->columns(4)

Group::make()
    ->columns(3)
    ->columnSpan(3)

Fieldset::make(__('app.titles.summary'))
    ->columnSpan(1)
```

Location: `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php`, around lines 34-183.

Risk:

- The same 3/4 + 1/4 desktop layout is likely not mobile-safe.

### CSS review

Custom CSS currently only removes repeater spacing/shadows:

```css
.new_enquiry_follow_up li,
.rmv_rept-space li {
    box-shadow: none;
}
.new_enquiry_follow_up .fi-fo-repeater-item-content,
.rmv_rept-space .fi-fo-repeater-item-content {
    padding: 0px;
}
```

Location: `resources/css/custom.css`.

There are no mobile-specific overrides for the create-member subscription/invoice layout.

### Recommended responsive layout strategy

Use explicit responsive breakpoint arrays everywhere nested forms currently use fixed columns/spans.

#### MemberForm recommended changes

Use mobile-first layout:

```php
Section::make()
    ->columns([
        'default' => 1,
        'lg' => 4,
    ])
```

For the member details grid:

```php
Grid::make()
    ->columns([
        'default' => 1,
        'md' => 2,
        'xl' => 3,
    ])
    ->columnSpan([
        'default' => 1,
        'lg' => 3,
    ])
```

For the `name` field:

```php
->columnSpan([
    'default' => 1,
    'xl' => 2,
])
```

For location:

```php
Section::make(__('app.ui.location'))
    ->columns([
        'default' => 1,
        'md' => 2,
    ])
```

and:

```php
Group::make()
    ->columns([
        'default' => 1,
        'md' => 2,
    ])
```

For subscription repeater:

```php
Repeater::make('subscriptions')
    ->columns([
        'default' => 1,
        'xl' => 3,
    ])
```

#### SubscriptionForm recommended changes

For subscription fields:

```php
Group::make()
    ->columns([
        'default' => 1,
        'md' => 2,
        'xl' => 6,
    ])
```

For `member_id`:

```php
->columnSpan([
    'default' => 1,
    'xl' => 2,
])
```

For `plan_id`, avoid returning a plain integer for all screen sizes. Return breakpoint-aware spans:

```php
->columnSpan(fn ($livewire): array => ($livewire instanceof SubscriptionsRelationManager || $livewire instanceof CreateMember)
    ? ['default' => 1, 'md' => 2, 'xl' => 4]
    : ['default' => 1, 'xl' => 2])
```

For the invoice repeater:

```php
Repeater::make('invoices')
    ->columns([
        'default' => 1,
        'xl' => 4,
    ])
```

For invoice fields group:

```php
Group::make()
    ->columns([
        'default' => 1,
        'md' => 2,
    ])
    ->columnSpan([
        'default' => 1,
        'xl' => 3,
    ])
```

For summary:

```php
Fieldset::make(__('app.titles.summary'))
    ->columns(1)
    ->columnSpan([
        'default' => 1,
        'xl' => 1,
    ])
```

This forces the invoice summary to stack below invoice fields on mobile and only sit beside them on desktop.

#### InvoiceForm recommended changes

Apply the same pattern:

```php
Section::make('')
    ->columns([
        'default' => 1,
        'xl' => 4,
    ])
```

```php
Group::make()
    ->columns([
        'default' => 1,
        'md' => 2,
        'xl' => 3,
    ])
    ->columnSpan([
        'default' => 1,
        'xl' => 3,
    ])
```

```php
Fieldset::make(__('app.titles.summary'))
    ->columnSpan([
        'default' => 1,
        'xl' => 1,
    ])
```

### Optional CSS hardening

After the PHP layout changes, CSS should be minimal. If there is still horizontal overflow, add a narrow override for repeater content:

```css
.rmv_rept-space .fi-fo-repeater-item-content {
    min-width: 0;
}

.rmv_rept-space .fi-section,
.rmv_rept-space .fi-fo-field-wrp {
    min-width: 0;
}
```

Avoid broad CSS that changes all Filament grids globally.

### Manual QA checklist for mobile

Test at widths:

- 320px
- 375px
- 430px
- 768px
- desktop width

Flows:

1. Create member page.
2. Upload/no-upload photo state.
3. Fill member details.
4. Fill location fields.
5. Open subscription/invoice section.
6. Select plan and verify invoice totals update.
7. Change discount and paid amount.
8. Check payment method radio wrapping.
9. Submit the form.
10. Confirm no horizontal scroll appears anywhere.

Expected mobile behavior:

- One field per row on very small screens.
- Invoice summary appears below invoice input fields.
- Radio buttons wrap naturally.
- Date pickers/select overlays are usable.
- No content requires sideways scrolling.

---

## Prioritized action plan

### P0 — unblock member deletion cascade

1. Edit `config/prevent-deletion.php`.
2. Remove:

```php
\App\Models\Member::class => ['subscriptions'],
\App\Models\Subscription::class => ['invoices'],
```

3. Add tests for `Member -> Subscription -> Invoice` soft delete cascade.
4. Manually verify deleting a member with subscriptions from Filament UI.

### P1 — make create-member invoice form responsive

1. Update `MemberForm` responsive columns/spans.
2. Update `SubscriptionForm` responsive columns/spans.
3. Update standalone `InvoiceForm` responsive columns/spans for consistency.
4. Test at mobile widths.

### P2 — cascade semantics cleanup

1. Decide whether invoice transactions should remain active when invoice is soft-deleted.
2. Decide whether restoring a member should restore every trashed child, or only children deleted during the parent cascade.
3. Consider centralizing delete logic in a domain service.

---

## Final recommendation

The deletion bug is not a missing cascade; the cascade already exists. The real problem is the global Filament deletion-prevention system blocking the delete action before the cascade can execute.

The responsiveness issue is a layout design problem caused by deeply nested fixed grids. The safest fix is to convert all affected grid columns and column spans to explicit mobile-first breakpoint arrays, especially in `MemberForm`, `SubscriptionForm`, and `InvoiceForm`.
