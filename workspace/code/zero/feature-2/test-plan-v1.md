# Feature 2 Revision 1 Test Plan — Permission Sync Regression Fix

## SECTION A — DATA CREATION TESTS

The revision uses existing `tests/Feature/BusinessRoleResourceTest.php` and creates:

1. System admin
   - Table/model: `system_admins` / `SystemAdmin`
   - Purpose: authenticate against the `system_admin` guard for system panel role pages.

2. Business role
   - Table/model: `roles` / Spatie `Role`
   - Required state: `name`, `guard_name = web`, `gym_id = null`.

3. Permissions
   - Table/model: `permissions` / Spatie `Permission`
   - Names: `ViewAny:Enquiry`, `Create:Enquiry`, `ViewAny:Expense`, and dashboard permission names from valid form state.

## SECTION B — BACKEND ACTION TESTS

Existing backend tests remain:

1. Sanitizer backend test
   - Input: role form state containing resource class keys, tab keys, unknown keys, fake guard, fake gym.
   - Expected: sanitized persistence data includes only `name`, `guard_name = web`, `gym_id = null`.

2. Permission extraction backend test
   - Input: valid permission strings plus malformed strings.
   - Expected: valid permission names are retained; malformed strings are rejected.

## SECTION C — VALIDATION TESTS

Existing duplicate validation test remains:
- Attempt duplicate global web business role name.
- Expected: form error on `name`; only one matching global web role remains.

## SECTION D — API ENDPOINT TESTS

No API endpoint changes in this revision.
Existing API tests in the suite remain regression coverage.

## SECTION E — ROLE AND PERMISSION TESTS

1. Livewire create permission sync
   - Authenticate as SystemAdmin.
   - Submit role create form with permission state.
   - Expected: role is created safely and selected permissions exist/sync to the role.

2. Livewire edit permission sync
   - Authenticate as SystemAdmin.
   - Save existing role with permission state.
   - Expected: role updates safely and selected permissions exist/sync to the role.

3. Guard and tenant scope
   - Attempt fake guard and fake gym id.
   - Expected: role still has `guard_name = web` and `gym_id = null`.

## SECTION F — SECURITY TESTS

Covered by existing feature tests and regression assertions:
- Unknown Shield keys cannot become role columns.
- Malformed strings cannot become permissions.
- Permission sync uses captured filtered permission names, not raw post-sanitization form state.

## SECTION G — REGRESSION TESTS

Update `tests/Regression/RegressionTest.php` to assert:
- `sanitizeRolePersistenceData()` remains present.
- `extractPermissionNamesFromFormState()` remains present.
- `CreateBusinessRole` captures permissions during mutate.
- `CreateBusinessRole` syncs from captured state after create.
- `EditBusinessRole` captures permissions during mutate.
- `EditBusinessRole` syncs from captured state after save.
- All previous regression entries remain.

## SECTION H — TEST EXECUTION RULES

No `tests/test.sh` behavior change is planned unless Phase 2 finds the file no longer includes the required suites.

The runner must continue to:
- Accept `--super=[ID]` and `--business=[ID]`.
- Create unique timestamped result files.
- Run `tests/Unit`, `tests/Feature`, `tests/Regression`, and `tests/Security`.
- Keep terminal output concise.
