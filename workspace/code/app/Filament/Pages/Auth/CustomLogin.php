<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Schema;

class CustomLogin extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username or Email')
            ->placeholder('Enter username or email address...')
            ->required()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1])
            ->autocomplete();
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $loginValue = $data['username'];

        if (filament()->getCurrentPanel()?->getId() === 'admin') {
            $loginColumn = Schema::hasTable('users') && Schema::hasColumn('users', 'username') ? 'username' : 'email';

            return [
                $loginColumn => '__business_slug_login_required__',
                'password' => $data['password'],
            ];
        }

        // Self-healing fallback: If database does not have username column yet, map back to email
        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'username')) {
            if (filter_var($loginValue, FILTER_VALIDATE_EMAIL)) {
                return [
                    'email' => $loginValue,
                    'password' => $data['password'],
                ];
            }

            $email = match ($loginValue) {
                'admin' => 'admin' . '@' . 'example.com',
                'test' => 'test' . '@' . 'example.com',
                default => $loginValue,
            };

            return [
                'email' => $email,
                'password' => $data['password'],
            ];
        }

        // If database HAS username column, we MUST query by username.
        // If they entered an email (e.g. from browser autofill), we split it to get the username prefix.
        $username = $loginValue;
        if (filter_var($loginValue, FILTER_VALIDATE_EMAIL)) {
            $username = explode('@', $loginValue)[0];
        }

        return [
            'username' => $username,
            'password' => $data['password'],
        ];
    }
}
