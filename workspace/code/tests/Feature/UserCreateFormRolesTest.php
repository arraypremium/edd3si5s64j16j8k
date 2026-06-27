<?php

use App\Enums\FacilityRole;

it('exposes exactly 5 facility role options via enum', function () {
    $options = FacilityRole::options();

    expect($options)->toHaveCount(5);
    expect($options)->toHaveKeys([
        'owner',
        'manager',
        'staff',
        'receptionist',
        'trainer',
    ]);
});

it('does NOT expose Spatie role names in facility options', function () {
    $options = FacilityRole::options();

    expect($options)
        ->not->toHaveKey('super_admin')
        ->not->toHaveKey('panel_user')
        ->not->toHaveKey('billing_admin')
        ->not->toHaveKey('support_admin');
});

it('maps facility OWNER to Spatie super_admin role', function () {
    expect(FacilityRole::OWNER->spatieRole())->toBe('super_admin');
});

it('maps non-owner facility roles to Spatie panel_user role', function () {
    expect(FacilityRole::MANAGER->spatieRole())->toBe('panel_user');
    expect(FacilityRole::STAFF->spatieRole())->toBe('panel_user');
    expect(FacilityRole::RECEPTIONIST->spatieRole())->toBe('panel_user');
    expect(FacilityRole::TRAINER->spatieRole())->toBe('panel_user');
});

it('rejects unknown role values via tryFrom', function () {
    expect(FacilityRole::tryFrom('super_admin'))->toBeNull();
    expect(FacilityRole::tryFrom('panel_user'))->toBeNull();
    expect(FacilityRole::tryFrom('hacker'))->toBeNull();

    // Valid values still work
    expect(FacilityRole::tryFrom('owner'))->toBe(FacilityRole::OWNER);
    expect(FacilityRole::tryFrom('staff'))->toBe(FacilityRole::STAFF);
});

it('returns human-readable labels', function () {
    expect(FacilityRole::OWNER->label())->toBe('Owner');
    expect(FacilityRole::MANAGER->label())->toBe('Manager');
    expect(FacilityRole::STAFF->label())->toBe('Staff');
    expect(FacilityRole::RECEPTIONIST->label())->toBe('Receptionist');
    expect(FacilityRole::TRAINER->label())->toBe('Trainer');
});
