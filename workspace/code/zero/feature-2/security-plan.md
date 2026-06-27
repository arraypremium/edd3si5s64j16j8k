# Feature 2 Security Plan — Business Role Form-State Sanitization

## Security objective
Prevent non-column Shield/Filament form state and attacker-controlled extra keys from being mass-persisted into the Spatie `roles` model during business role create/edit.

## Risks identified

### Risk 1 — Unsafe mass persistence of UI-only form state
Current create/save mutation returns Shield permission form keys in the model data. This causes SQL errors and indicates the model persistence boundary is too permissive.

Mitigation:
- Whitelist only `name`, `guard_name`, and `gym_id` before model create/update.
- Force `guard_name = web` and `gym_id = null` server-side.

### Risk 2 — Permission tampering through malformed keys
A malicious request could include unexpected extra keys in the Livewire payload.

Mitigation:
- Extra keys must never be passed to `Role::create()` or `$role->update()`.
- Permission syncing should only use string permission names extracted from Shield form state and should still create/sync permissions through Spatie models.

### Risk 3 — Cross-tenant role contamination
Business roles are intended as global role templates and should not become tenant-scoped accidentally.

Mitigation:
- Always force `gym_id = null` in create and edit persistence data.
- Tests must assert created/edited roles have `gym_id = null`.

### Risk 4 — Guard contamination
Business roles for facility users must remain on the `web` guard.

Mitigation:
- Always force `guard_name = web` in create and edit persistence data.
- Tests must assert `guard_name = web` even if form input attempts another guard.

## Security tests required
1. Create role with malicious/unknown form keys and assert only safe columns persist.
2. Edit role with malicious/unknown form keys and assert only safe columns persist.
3. UI create flow with Shield resource keys must not throw SQL errors.
4. Permission sync must remain explicit through `syncPermissions()` and not through role table columns.

## `zero/security.md` update rule
If Phase 2 or Phase 3 discovers any new vulnerability beyond this unsafe form-state persistence issue, append it immediately to `zero/security.md` with status and mitigation.
