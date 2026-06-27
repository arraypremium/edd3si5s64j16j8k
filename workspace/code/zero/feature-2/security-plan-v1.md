# Feature 2 Revision 1 Security Plan — Permission Capture Before Sanitized Persistence

## Security objective
Preserve the Phase 2 protection against unsafe role-table persistence while restoring reliable permission syncing for business role create/edit.

## Existing vulnerabilities to preserve as mitigated

### 1. Shield role form-state mass persistence
- Logged in `zero/security.md`.
- Must remain mitigated by returning only `name`, `guard_name`, and `gym_id` from create/save mutation methods.

### 2. Arbitrary string permission creation
- Logged in `zero/security.md`.
- Must remain mitigated by `BusinessRoleResource::extractPermissionNamesFromFormState()` filtering permission-shaped strings only.

## Revision risk analysis

### Risk 1 — Reintroducing unknown-column SQL error
If permission state is preserved by returning the full form data again, the original SQL error returns.

Mitigation:
- Never return raw form data from create/save mutation methods.
- Capture permission names in a separate page property before returning sanitized persistence data.

### Risk 2 — Syncing malformed permission strings
If capture accepts arbitrary strings, unexpected form state can become permissions.

Mitigation:
- Continue using `extractPermissionNamesFromFormState()` for capture.
- Do not directly flatten/sync raw form state in page classes.

### Risk 3 — Wrong guard or tenant scope
If role or permission guard changes unexpectedly, Spatie may fail authorization or create permissions for the wrong guard.

Mitigation:
- Keep role `guard_name = web`.
- Create permissions using the record guard, expected `web`.
- Keep business roles global with `gym_id = null`.

### Risk 4 — Permission loss during edit
If edit captures empty permission state, saving a role may clear permissions unexpectedly.

Mitigation:
- Capture submitted permission state during `mutateFormDataBeforeSave()`.
- Tests must verify edit syncs selected permissions.

## Security tests required
- Existing sanitizer test must remain.
- Existing malformed permission extraction test must remain.
- Livewire create test must prove selected permissions are synced.
- Livewire edit test must prove selected permissions are synced after save.
- Regression test must verify create/edit pages use captured permission state and do not read raw post-sanitization state.

## Security log action
If Phase 2 discovers any additional trust-boundary issue beyond permission capture timing, append it to `zero/security.md` immediately.
