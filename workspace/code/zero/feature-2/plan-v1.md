# Feature 2 Revision 1 Plan — Fix Permission Sync Test Failures

## PART A — OVERVIEW

### Error report understood
The user reported failures from `error-20260626-151744.txt` and `raw-20260626-151744.txt` after applying `zero/feature-2/change.sh`.

Failed tests:

1. `Tests\Feature\BusinessRoleResourceTest::test_system_business_role_create_page_can_create_role_with_permission_selection`
   - Error: `Spatie\Permission\Exceptions\PermissionDoesNotExist: There is no permission named ViewAny:Enquiry for guard web`.

2. `Tests\Feature\BusinessRoleResourceTest::test_business_role_edit_filters_shield_permission_state_before_database_update`
   - Failure: `Failed asserting that false is true` while asserting the role has a synced permission.

### Root cause
The Phase 2 sanitizer correctly prevents Shield form-state keys from being inserted into the `roles` table, but permission sync now reads from `$this->form->getState()` in `afterCreate()` / `afterSave()`.

Filament's create/save lifecycle can provide the full submitted form state to `mutateFormDataBeforeCreate()` / `mutateFormDataBeforeSave()`, then persist only the returned sanitized data. After that point, relying on `$this->form->getState()` is unsafe because the permission selection state may not still be available in the same shape the tests expect.

Therefore:
- The role is created/updated safely.
- But selected permissions are not captured reliably before the sanitized data is returned.
- Spatie then cannot find/verify `ViewAny:Enquiry` on the role.

### Technical context
Spatie's `hasPermissionTo()` throws `PermissionDoesNotExist` when a requested permission is not registered for the guard being checked. The local error confirms `ViewAny:Enquiry` was not created/synced for guard `web` before the assertion.

### Required revision fix
Capture permission names before returning sanitized persistence data:

- In `CreateBusinessRole::mutateFormDataBeforeCreate(array $data)`:
  - Extract permission names from the original full `$data`.
  - Store them in a page property.
  - Return only sanitized role persistence fields.

- In `CreateBusinessRole::afterCreate()`:
  - Sync permissions from the captured property, not from `$this->form->getState()`.

- In `EditBusinessRole::mutateFormDataBeforeSave(array $data)`:
  - Extract permission names from the original full `$data`.
  - Store them in a page property.
  - Return only sanitized role persistence fields.

- In `EditBusinessRole::afterSave()`:
  - Sync permissions from the captured property, not from `$this->form->getState()`.

### What will not change
- No changes to database migrations.
- No changes to the role table whitelist behavior.
- No changes to role routes, navigation, or authorization.
- No deletion of existing tests.
- No weakening of backend sanitizer tests.
- No rollback script.

## PART B — FILES INVOLVED

### Files to modify

1. `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Add a page property for captured permission names.
   - Capture permission names inside `mutateFormDataBeforeCreate()` before sanitizing persistence data.
   - Change `afterCreate()` to sync from the captured property.
   - Preserve permission creation via `Permission::firstOrCreate()` and `syncPermissions()`.

2. `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Add a page property for captured permission names.
   - Capture permission names inside `mutateFormDataBeforeSave()` before sanitizing persistence data.
   - Change `afterSave()` to sync from the captured property.
   - Preserve permission creation via `Permission::firstOrCreate()` and `syncPermissions()`.

3. `app/Filament/Resources/BusinessRoleResource.php`
   - Keep `sanitizeRolePersistenceData()` unchanged.
   - Keep `extractPermissionNamesFromFormState()` unchanged unless Phase 2 finds a strict reason to adjust its accepted permission-name format.

4. `tests/Feature/BusinessRoleResourceTest.php`
   - Keep all existing tests.
   - Update only if needed so UI/Livewire tests submit permission state in the same shape as the page lifecycle captures it.
   - Add assertions that the permission records exist before calling `hasPermissionTo()` if needed for clearer failure messages.
   - Do not remove backend sanitizer, extraction, duplicate validation, create, or edit tests.

5. `tests/Regression/RegressionTest.php`
   - Extend regression assertions to verify create/edit page classes capture permission names before sanitizing and sync from captured state.
   - Do not remove existing regression entries.

6. `tests/test.sh`
   - Verify no change is needed because it already runs `tests/Feature`, `tests/Regression`, and `tests/Security`.
   - Preserve all existing behavior unless a direct issue is found.

### Files read/analyzed
- `main_code/prompt.md`
- `uploads/error-20260626-151744.txt`
- `uploads/raw-20260626-151744.txt`
- `zero/feature-2/plan.md`
- `zero/security.md`
- `zero/flow.md`
- `zero/snapshot.md`
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

## PART C — DEPENDENCY AND IMPACT ANALYSIS

### Filament lifecycle dependency
- `mutateFormDataBeforeCreate()` and `mutateFormDataBeforeSave()` receive the submitted form data before persistence.
- Returning sanitized data is required to prevent unknown-column SQL errors.
- Permission selection state must be extracted before sanitized data replaces persistence data.

### Spatie permission dependency
- `Permission::firstOrCreate(['name' => ..., 'guard_name' => 'web'])` must run before the role is expected to have that permission.
- `syncPermissions()` must receive permission models or valid permission identifiers that exist for the correct guard.
- The role guard remains `web`.

### Test dependency
- `BusinessRoleResourceTest` validates both backend helpers and Livewire page behavior.
- The failing create/edit tests are valuable and must remain strict.
- The revision must make the real page lifecycle pass those tests rather than deleting or weakening them.

### Guaranteed untouched
- API controllers, API routes, API resources, invoice/member/lead/subscription/payment features remain untouched.
- System admin auth model and panel provider remain untouched.
- Database migrations remain untouched.
- Existing regression entries remain untouched.

## PART D — PRESERVATION GUARANTEE

Phase 2 must preserve:

1. Unknown-column fix:
   - No Shield form-state keys can reach `Role::create()` or role update persistence.

2. Business role invariants:
   - `guard_name` is always forced to `web`.
   - `gym_id` is always forced to `null`.
   - Duplicate validation remains scoped to global web roles.

3. Security improvements:
   - UI-only keys are never persisted as model attributes.
   - Arbitrary malformed strings are not synced as permissions.

4. Test suite persistence:
   - Existing tests remain.
   - Regression entries remain.
   - `tests/test.sh` continues to run all suites.

## PART E — ATOMIC EXECUTION STEPS

1. File: `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Action: Add a typed property to hold captured permission names for the current create submission.
   - Expected outcome: The page can preserve permission selections separately from sanitized role persistence data.
   - Preserve: Class namespace, imports, `CreateRecord` inheritance, and `$resource` value.

2. File: `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Action: In `mutateFormDataBeforeCreate(array $data)`, assign the captured permission property from `BusinessRoleResource::extractPermissionNamesFromFormState($data)` before returning `BusinessRoleResource::sanitizeRolePersistenceData($data)`.
   - Expected outcome: Full submitted permission state is captured before persistence data is reduced to role columns.
   - Preserve: Sanitized persistence return behavior.

3. File: `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Action: In `afterCreate()`, use the captured permission property instead of `$this->form->getState()`.
   - Expected outcome: Created role receives selected permissions even after persistence data is sanitized.
   - Preserve: `Permission::firstOrCreate()` and `$this->record->syncPermissions($permissions)` behavior.

4. File: `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Action: Add a typed property to hold captured permission names for the current save submission.
   - Expected outcome: The page can preserve permission selections separately from sanitized update data.
   - Preserve: Class namespace, imports, `EditRecord` inheritance, and `$resource` value.

5. File: `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Action: In `mutateFormDataBeforeSave(array $data)`, assign the captured permission property from `BusinessRoleResource::extractPermissionNamesFromFormState($data)` before returning `BusinessRoleResource::sanitizeRolePersistenceData($data)`.
   - Expected outcome: Full submitted permission state is captured before update data is reduced to role columns.
   - Preserve: Sanitized persistence return behavior.

6. File: `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Action: In `afterSave()`, use the captured permission property instead of `$this->form->getState()`.
   - Expected outcome: Edited role receives selected permissions even after update data is sanitized.
   - Preserve: `Permission::firstOrCreate()` and `$this->record->syncPermissions($permissions)` behavior.

7. File: `tests/Feature/BusinessRoleResourceTest.php`
   - Action: Keep all existing strict tests and update assertions only if needed to make the failure message clearer around missing permission records.
   - Expected outcome: Tests continue to prove backend sanitizer, permission extraction, Livewire create, Livewire edit, forced guard/scope, and duplicate validation.
   - Preserve: No passing test is removed or weakened.

8. File: `tests/Regression/RegressionTest.php`
   - Action: Add regression assertions that create/edit pages capture permissions during mutate and sync from captured state after create/save.
   - Expected outcome: Future changes cannot return to reading unreliable post-sanitization form state.
   - Preserve: All existing regression assertions.

9. File: `tests/test.sh`
   - Action: Verify it still includes `tests/Feature`, `tests/Regression`, and `tests/Security`; change only if this is not true.
   - Expected outcome: Revision tests run automatically in the full local suite.
   - Preserve: Unique error file handling and concise terminal output.
