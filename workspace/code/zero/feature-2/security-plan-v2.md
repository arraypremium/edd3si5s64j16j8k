# Feature 2 Revision 2 Security Plan — Robust Permission Sync and Accurate Test Output

## Security objective
Fix remaining permission sync failures without reintroducing unsafe role-table persistence or allowing malformed permission strings to be synced.

## Existing mitigations that must remain

1. Role persistence whitelist
   - Only `name`, `guard_name`, and `gym_id` may be returned to model persistence.

2. Forced business role scope
   - `guard_name` remains `web`.
   - `gym_id` remains `null`.

3. Permission string filtering
   - Only permission-shaped strings may be synced.
   - Arbitrary strings from UI-only fields must not become permissions.

## New/revised risk analysis

### Risk 1 — fallback reads unsafe raw state
A fallback extractor could accidentally sync malformed strings from unrelated Livewire state.

Mitigation:
- Fallback must pass every source through `BusinessRoleResource::extractPermissionNamesFromFormState()`.
- Do not sync raw strings directly.

### Risk 2 — reintroducing unknown-column SQL error
Trying to preserve permission state by returning full form state would reintroduce the original SQL error.

Mitigation:
- Keep `sanitizeRolePersistenceData()` unchanged.
- Create/save mutation methods must still return only safe columns.

### Risk 3 — test-only behavior masking production behavior
The Livewire test path must not use a fake sync method that production never uses.

Mitigation:
- Put fallback resolution in production create/edit page classes.
- Tests must call normal `create` and `save` page actions.

### Risk 4 — misleading test counts hide failures
Inflated test counts make it harder to know the true test status.

Mitigation:
- Update `tests/test.sh` result parser to emit/count each test once.
- Continue writing full PHPUnit diagnostics to the error file.

## Security log action
If Phase 2 discovers a new trust-boundary issue, append it to `zero/security.md` immediately.
