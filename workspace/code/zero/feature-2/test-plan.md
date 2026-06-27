# Feature 2 Test Plan — Strict Backend and UI Coverage

## New/updated test files

### `tests/Feature/BusinessRoleResourceTest.php`
Required tests:

1. `test_business_role_create_filters_shield_permission_state_before_database_insert`
   - Build form data containing valid role attributes plus Shield resource keys, `pages_tab`, `widgets_tab`, and unknown keys.
   - Execute the create-page persistence path or a shared sanitizer helper.
   - Assert persisted attributes are exactly safe role attributes.

2. `test_system_business_role_create_page_can_create_role_with_permission_selection`
   - Authenticate as `SystemAdmin` using the `system_admin` guard.
   - Use Livewire/Filament page testing for `CreateBusinessRole`.
   - Fill role name and permission state for at least one resource permission.
   - Call create.
   - Assert no SQL exception.
   - Assert role exists with `guard_name = web` and `gym_id = null`.
   - Assert selected permission is attached to the role.

3. `test_business_role_edit_filters_shield_permission_state_before_database_update`
   - Create a Spatie role.
   - Save through the edit-page path with Shield form keys and unknown keys.
   - Assert role updates safely and no extra keys are treated as columns.

4. `test_business_role_create_forces_web_guard_and_global_gym_scope`
   - Attempt to provide a non-web guard and non-null `gym_id` in form data.
   - Assert persisted role still has `guard_name = web` and `gym_id = null`.

5. `test_business_role_duplicate_name_validation_remains_scoped_to_web_global_roles`
   - Create an existing global web role.
   - Attempt duplicate creation through the create page or validator path.
   - Assert validation error on `name` remains enforced.

### `tests/Regression/RegressionTest.php`
Required new regression:
- Assert business role create/edit filtering exists so Shield permission state can never be inserted as `roles` table columns again.

### `tests/test.sh`
Required verification:
- Must run `tests/Feature`, `tests/Regression`, and `tests/Security`, so the new strict tests run automatically.

## Expected failing behavior before fix
At least one new strict create/UI test must fail before the fix because the current code passes resource-class-name keys into role persistence data, reproducing the `Unknown column` SQL error.

## Expected passing behavior after fix
- All existing 224 tests should remain passing.
- New backend tests should pass.
- New UI/Livewire tests should pass.
- No test should be removed or weakened.
