<?php

namespace App\Http\Controllers;

use App\Filament\Pages\Dashboard;
use App\Models\Gym;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\PermissionRegistrar;
use Symfony\Component\HttpFoundation\Response;

class BusinessSlugLoginController extends Controller
{
    public function show(Request $request, Gym $business): Response
    {
        if (! $business->url_slug) {
            abort(404);
        }

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            if ($user && $this->userBelongsToBusiness($user, $business)) {
                $this->setBusinessContext($business, $request);

                return redirect()->to(Dashboard::getUrl(tenant: $business));
            }
        }

        return response($this->loginHtml($business));
    }

    public function store(Request $request, Gym $business): RedirectResponse
    {
        if (! $business->url_slug) {
            abort(404);
        }

        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $this->credentials($request->input('username'), $request->input('password'));

        if (! Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        $user = Auth::guard('web')->user();

        if (! $user || ! $this->userBelongsToBusiness($user, $business)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
        $this->setBusinessContext($business, $request);

        return redirect()->to(Dashboard::getUrl(tenant: $business));
    }

    private function credentials(mixed $username, mixed $password): array
    {
        $loginValue = trim((string) $username);

        if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'username')) {
            if (! filter_var($loginValue, FILTER_VALIDATE_EMAIL)) {
                $loginValue = match ($loginValue) {
                    'admin' => 'admin@example.com',
                    'test' => 'test@example.com',
                    default => $loginValue,
                };
            }

            return [
                'email' => $loginValue,
                'password' => (string) $password,
            ];
        }

        if (filter_var($loginValue, FILTER_VALIDATE_EMAIL)) {
            $loginValue = explode('@', $loginValue)[0];
        }

        return [
            'username' => $loginValue,
            'password' => (string) $password,
        ];
    }

    private function userBelongsToBusiness(mixed $user, Gym $business): bool
    {
        return method_exists($user, 'gyms')
            && $user->gyms()->whereKey($business->id)->exists();
    }

    private function setBusinessContext(Gym $business, Request $request): void
    {
        $request->session()->put('active_gym_id', $business->id);
        $request->session()->put('business_login_gym_id', $business->id);
        $request->session()->put('business_login_slug', $business->url_slug);

        if (function_exists('setPermissionsTeamId')) {
            setPermissionsTeamId($business->id);
        }

        app(PermissionRegistrar::class)->setPermissionsTeamId($business->id);

        $user = Auth::guard('web')->user();

        if ($user && method_exists($user, 'unsetRelation')) {
            $user->unsetRelation('roles');
            $user->unsetRelation('permissions');
        }
    }

    private function loginHtml(Gym $business): HtmlString
    {
        $action = url('/'.$business->url_slug.'/login');
        $csrf = csrf_field();
        $title = e($business->name.' Business Login');
        $slug = e($business->url_slug);

        return new HtmlString(<<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$title}</title>
    <style>
        body{font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:#f8fafc;margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;color:#0f172a}.card{width:100%;max-width:420px;background:#fff;border:1px solid #e2e8f0;border-radius:18px;box-shadow:0 20px 45px rgba(15,23,42,.08);padding:32px}.slug{font-family:ui-monospace,SFMono-Regular,Menlo,monospace;background:#f1f5f9;border-radius:999px;padding:6px 10px;display:inline-block;color:#334155}.field{margin-top:18px}.field label{display:block;font-size:14px;font-weight:600;margin-bottom:6px}.field input{width:100%;box-sizing:border-box;border:1px solid #cbd5e1;border-radius:10px;padding:11px 12px;font-size:15px}.btn{width:100%;border:0;border-radius:10px;background:#0f766e;color:#fff;font-weight:700;padding:12px;margin-top:22px;cursor:pointer}.hint{font-size:13px;color:#64748b;margin-top:14px;line-height:1.5}
    </style>
</head>
<body>
    <main class="card">
        <h1>{$title}</h1>
        <p class="slug">/{$slug}/login</p>
        <form method="POST" action="{$action}">
            {$csrf}
            <div class="field">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" autocomplete="username" required autofocus>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
            </div>
            <button class="btn" type="submit">Login</button>
        </form>
        <p class="hint">Use only the business login URL assigned by system administration. Generic login URLs are not enabled for business users.</p>
    </main>
</body>
</html>
HTML);
    }
}
