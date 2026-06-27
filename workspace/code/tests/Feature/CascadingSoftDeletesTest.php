<?php

use App\Models\Enquiry;
use App\Models\FollowUp;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('soft deleting an enquiry cascades to follow ups and restore reverses it', function (): void {
    $enquiry = Enquiry::factory()->create();
    $followUp = FollowUp::factory()->create([
        'enquiry_id' => $enquiry->id,
    ]);

    $enquiry->delete();

    expect(FollowUp::withTrashed()->find($followUp->id))
        ->not->toBeNull()
        ->and(FollowUp::withTrashed()->find($followUp->id)?->trashed())->toBeTrue();

    $enquiry->restore();

    expect(FollowUp::find($followUp->id))
        ->not->toBeNull()
        ->and(FollowUp::find($followUp->id)?->trashed())->toBeFalse();
});


test('soft deleting a member cascades to subscriptions and invoices', function (): void {
    $member = \App\Models\Member::factory()->create();
    $subscription = \App\Models\Subscription::factory()->create([
        'member_id' => $member->id,
    ]);
    $invoice = \App\Models\Invoice::factory()->create([
        'subscription_id' => $subscription->id,
    ]);

    $member->delete();

    expect(\App\Models\Member::withTrashed()->find($member->id)?->trashed())->toBeTrue()
        ->and(\App\Models\Subscription::withTrashed()->find($subscription->id)?->trashed())->toBeTrue()
        ->and(\App\Models\Invoice::withTrashed()->find($invoice->id)?->trashed())->toBeTrue();

    $member->restore();

    expect(\App\Models\Member::find($member->id)?->trashed())->toBeFalse()
        ->and(\App\Models\Subscription::find($subscription->id)?->trashed())->toBeFalse()
        ->and(\App\Models\Invoice::find($invoice->id)?->trashed())->toBeFalse();
});
