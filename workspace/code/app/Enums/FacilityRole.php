<?php

namespace App\Enums;

enum FacilityRole: string
{
    case OWNER = 'owner';
    case MANAGER = 'manager';
    case STAFF = 'staff';
    case RECEPTIONIST = 'receptionist';
    case TRAINER = 'trainer';

    public function label(): string
    {
        return match ($this) {
            self::OWNER => 'Owner',
            self::MANAGER => 'Manager',
            self::STAFF => 'Staff',
            self::RECEPTIONIST => 'Receptionist',
            self::TRAINER => 'Trainer',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::OWNER->value => self::OWNER->label(),
            self::MANAGER->value => self::MANAGER->label(),
            self::STAFF->value => self::STAFF->label(),
            self::RECEPTIONIST->value => self::RECEPTIONIST->label(),
            self::TRAINER->value => self::TRAINER->label(),
        ];
    }

    public function spatieRole(): string
    {
        return $this === self::OWNER ? 'super_admin' : 'panel_user';
    }
}
