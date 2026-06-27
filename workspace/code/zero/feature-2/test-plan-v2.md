# Feature 2 Revision 2 Test Plan — Remaining Permission Sync Failures and Test Count Fix

## SECTION A — DATA CREATION TESTS

Existing test data remains:
- `SystemAdmin` for `system_admin` guard authentication.
- Spatie global business role with `guard_name = web`, `gym_id = null`.
- Spatie permissions with `guard_name = web`.

## SECTION B — BACKEND ACTION TESTS

Existing backend tests remain:
1. Sanitizer strips Shield resource keys and unsafe columns.
2. Permission extraction rejects malformed strings.
3. Guard and gym scope are forced.

## SECTION C — VALIDATION TESTS

Existing duplicate validation test remains:
- Duplicate global web role name must fail validation.

## SECTION D — API ENDPOINT TESTS

No API changes in this revision.
Existing API tests remain regression coverage.

## SECTION E — ROLE AND PERMISSION TESTS

1. Create UI/Livewire role permission sync
   - Authenticate as `SystemAdmin`.
   - Submit create page with permission state.
   - Expected: permission rows exist and role has selected permissions.

2. Edit UI/Livewire role permission sync
   - Authenticate as `SystemAdmin`.
   - Submit edit page with permission state.
   - Expected: role has selected permissions after save.

3. Fallback permission state resolution
   - Verify page can resolve permission names even when captured mutation data is empty but page/form state contains permission selections.

## SECTION F — SECURITY TESTS

Existing and revised tests must confirm:
- Raw Shield keys are not role columns.
- Malformed strings are not permissions.
- Fallback sync also uses filtered extraction.
- No direct raw state is persisted.

## SECTION G — REGRESSION TESTS

Update `tests/Regression/RegressionTest.php` to assert:
- captured permission state still exists.
- fallback permission resolver exists.
- create/edit use the resolver in after-create/save.
- `tests/test.sh` contains deduplication or single-style counting logic.
- all prior regression entries remain.

## SECTION H — TEST EXECUTION RULES

Update `tests/test.sh` behavior:
- Terminal output remains ✅/❌ only.
- Every test is counted once.
- Summary count should not be inflated by duplicate PHPUnit output styles.
- Error file remains unique per run.
- Full suite paths remain: `tests/Unit tests/Feature tests/Regression tests/Security`.
