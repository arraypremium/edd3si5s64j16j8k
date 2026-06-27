# Feature 2 Plan — Fix `/system/shield/roles/create` Unknown Column Error

## PART A — OVERVIEW

### Task understood
The reported production error in `main_code/uploads/error.txt` happens when a System Admin creates a business role from:

`/system/shield/roles/create`

Laravel attempts this invalid insert:

`insert into roles (name, guard_name, App\Filament\Resources\Enquiries\EnquiryResource, ..., pages_tab, widgets_tab, gym_id, ...) values (...)`

Those resource class names, `pages_tab`, and `widgets_tab` are Filament Shield form state keys, not columns on the Spatie `roles` table.

### Root cause
`App\Filament\Resources\BusinessRoleResource` uses Shield permission UI fields through `HasShieldFormComponents::getShieldFormComponents()`. Those fields are intentionally present in the form so the user can select permissions.

However, `CreateBusinessRole::mutateFormDataBeforeCreate()` and `EditBusinessRole::mutateFormDataBeforeSave()` currently return the complete form data plus `guard_name` and `gym_id`. Filament's `CreateRecord` then passes that complete form state directly to `Role::create($data)` before `afterCreate()` syncs permissions. Because the returned `$data` still contains permission group keys, Eloquent tries to insert them as database columns, causing MySQL `SQLSTATE[42S22] Unknown column`.

### External technical reference
Filament Shield provides a role resource and permission form UI for Spatie roles, while role assignment/permission management is based on Spatie's role and permission models [1](https://github.com/bezhanSalleh/filament-shield). Filament Shield also allows permission identifiers to be generated from resources, which explains why class names such as `App\Filament\Resources\Enquiries\EnquiryResource` appear in the role form state [3](https://laravel-news.com/package/bezhansalleh-filament-shield).

### Required fix
Sanitize role persistence data before create/save so only actual `roles` table attributes are persisted:

- `name`
- `guard_name`
- `gym_id`

Permission-selection state must remain available for `afterCreate()` / `afterSave()` so permissions continue to sync correctly.

### What will not change
- No migration will add fake columns for resource names.
- No Shield permission UI will be removed.
- No existing passing tests will be removed.
- No rollback script will be created.
- No unrelated business, invoice, member, subscription, API, or tenant-isolation logic will be changed.

## PART B — FILES TO CHANGE

### 1. `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
Atomic steps:
1. Keep the class extending `CreateRecord`.
2. Add a small persistence-data sanitizer for role creation, either directly in `mutateFormDataBeforeCreate()` or through a shared helper.
3. Ensure returned data contains only `name`, `guard_name`, and `gym_id`.
4. Force `guard_name` to `web` and `gym_id` to `null` for global business roles.
5. Keep `afterCreate()` permission sync behavior intact.
6. Ensure no Shield form state keys can reach `Role::create()`.

### 2. `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
Atomic steps:
1. Apply the same persistence-data sanitizer for save/update.
2. Ensure returned data contains only `name`, `guard_name`, and `gym_id`.
3. Force `guard_name` to `web` and `gym_id` to `null`.
4. Keep `afterSave()` permission sync behavior intact.
5. Ensure no Shield form state keys can reach `$record->update()`.

### 3. `app/Filament/Resources/BusinessRoleResource.php` if shared helper is preferable
Atomic steps:
1. Add a shared public/static helper only if it improves testability and avoids duplicated filtering.
2. The helper must return only database-safe role attributes.
3. The helper must not mutate permission state or perform database writes.
4. Existing navigation, authorization, query scoping, form schema, and table behavior must remain unchanged.

### 4. `tests/Feature/BusinessRoleResourceTest.php` or `tests/Feature/BusinessRoleCreateTest.php`
Atomic steps:
1. Add strict backend coverage proving Shield permission keys are stripped before persistence.
2. Add strict Livewire/Filament UI coverage for creating a role from the create page with permission-style state keys.
3. Assert the role is created successfully in `roles` with `name`, `guard_name = web`, and `gym_id = null`.
4. Assert the database does not require or receive columns named after Filament resource classes.
5. Assert selected permissions are synced to the role after creation.
6. Assert duplicate role validation still works for `guard_name = web` and `gym_id = null`.
7. Assert edit/save also strips permission keys and syncs permissions.

### 5. `tests/Regression/RegressionTest.php`
Atomic steps:
1. Append a regression assertion documenting this bug.
2. Assert `CreateBusinessRole` and `EditBusinessRole` filter role persistence data before model create/update.
3. Do not remove any existing regression entries.

### 6. `tests/test.sh`
Atomic steps:
1. Confirm the test runner already runs `tests/Feature`, `tests/Regression`, and `tests/Security`.
2. If needed, update it so the new backend/UI tests are included automatically.
3. Preserve unique `tests/results/error-[timestamp].txt` generation.
4. Preserve concise ✅ / ❌ terminal output.

## PART C — TESTING APPROACH

### Backend strict test coverage
The backend test must fail on the current bug by passing data containing keys like:

- `App\Filament\Resources\Enquiries\EnquiryResource`
- `App\Filament\Resources\Expenses\ExpenseResource`
- `pages_tab`
- `widgets_tab`
- `select_all`

Expected result after fix:
- only `name`, `guard_name`, and `gym_id` are persisted to the `roles` table.
- no SQL query attempts to insert resource-class-name columns.

### UI strict test coverage
The UI test must simulate the real create-page flow as closely as possible:
1. Authenticate as a `SystemAdmin` on the `system_admin` guard.
2. Open or Livewire-test `App\Filament\Resources\BusinessRoleResource\Pages\CreateBusinessRole`.
3. Fill the role name and permission-form state.
4. Call the create action.
5. Assert no exception occurs.
6. Assert redirect/success state if supported by Filament test helpers.
7. Assert the role and permissions exist in the database.

### Edit strict test coverage
The edit test must simulate saving an existing role with Shield form state and assert:
- role attributes update safely.
- permission selections sync correctly.
- Shield UI keys are not persisted as role columns.

## PART D — SECURITY AND DATA INTEGRITY IMPACT

### Security impact
This fix reduces mass-assignment and unsafe form-state persistence risk by whitelisting role model attributes. It prevents attacker-controlled or UI-only form keys from being sent to `Role::create()` / `update()`.

### Data integrity impact
- Business roles remain global templates with `gym_id = null`.
- Role guard remains `web`.
- Permission relationships remain stored through Spatie's `permissions` and `role_has_permissions` tables.
- No permission selections are lost because permission sync continues after create/save.

## PART E — COMPLETION CRITERIA

Phase 2 is complete only when:
1. Creating `/system/shield/roles/create` no longer inserts Shield permission keys as columns.
2. Editing `/system/shield/roles/{record}/edit` has the same protection.
3. Backend strict tests exist.
4. UI/Livewire strict tests exist.
5. Regression coverage exists.
6. `tests/test.sh` includes the new tests through the full suite paths.
7. No existing tests are removed or weakened.
