# Feature 2 Revision 2 Plan — Fix Remaining Livewire Permission Sync and Test Count Output

## PART A — OVERVIEW

### Error report understood
The latest local run in `error-20260626-153744.txt` still fails two tests:

1. `Tests\Feature\BusinessRoleResourceTest::test_system_business_role_create_page_can_create_role_with_permission_selection`
   - Failure: no `permissions` row exists for `ViewAny:Enquiry` / `web`.

2. `Tests\Feature\BusinessRoleResourceTest::test_business_role_edit_filters_shield_permission_state_before_database_update`
   - Failure: edited role does not have the expected permission.

The same report also shows a count mismatch:
- PHPUnit summary: `Tests: 118`.
- `tests/test.sh` terminal summary: `Passed : 232 | Failed : 4`.

### Root cause
Revision 1 captured permission names during `mutateFormDataBeforeCreate()` / `mutateFormDataBeforeSave()`, but the Livewire test still shows no permissions created. That means the permission selection state is not reaching the page in the expected `$data` shape during the Livewire test lifecycle.

The original production error proves Shield permission keys can reach role persistence in a real browser request. The Livewire test, however, is likely not setting the exact Shield component state path/shape, so the captured list remains empty. The fix must support both:
- real submitted Shield state from mutation data, and
- Filament/Livewire page state stored on the page property used by the form.

Filament form examples commonly store form state under a Livewire page/component data property and then read it with form state accessors [2](https://github.com/filamentphp/filament/discussions/9890). Shield role resources also rely on role-resource form save lifecycle methods rather than persisting raw permission UI state directly [4](https://filamentphp.com/plugins/agmedia-shield-enhanced).

The test count mismatch is separate: `tests/test.sh` parses more than one PHPUnit output style (`✓/⨯` and `✔/✘`) and counts duplicate representations of the same tests.

### Required revision fix
1. Make permission extraction resilient:
   - Keep capture from mutation `$data`.
   - Add a safe fallback in create/edit pages that extracts permission names from current form/page state when captured permissions are empty.
   - Never return raw permission state for model persistence.

2. Make Livewire tests realistic and strict:
   - Keep backend sanitizer tests.
   - Keep malformed permission extraction tests.
   - Ensure create/edit UI tests place permission state where the page fallback can read it.
   - Confirm permission rows exist and role permissions sync.

3. Fix `tests/test.sh` duplicate counting:
   - Ensure each test is emitted once.
   - Prefer one output style or deduplicate normalized test names.
   - Keep terminal output in ✅ / ❌ format only.

### What will not change
- No migration changes.
- No changes to route registration, panels, API endpoints, business models, invoice/member/lead/subscription/payment features.
- No deletion of tests.
- No weakening of strict tests.
- No rollback script.

## PART B — FILES INVOLVED

### Files to modify

1. `app/Filament/Resources/BusinessRoleResource.php`
   - Add a helper to extract permission names from multiple possible page/form state sources if needed.
   - Keep `sanitizeRolePersistenceData()` unchanged.
   - Keep unsafe persistence protection unchanged.
   - Preserve navigation, authorization, schema, table, and query behavior.

2. `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Keep captured permission names from mutation data.
   - Add fallback extraction from page/form state when the captured list is empty.
   - Sync permissions from the final resolved permission list.
   - Preserve create persistence whitelist.

3. `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Keep captured permission names from mutation data.
   - Add fallback extraction from page/form state when the captured list is empty.
   - Sync permissions from the final resolved permission list.
   - Preserve edit persistence whitelist.

4. `tests/Feature/BusinessRoleResourceTest.php`
   - Keep all current strict tests.
   - Adjust UI tests so permission state is written to the page/form state in a way that matches Filament Livewire lifecycle.
   - Add or keep assertions that permission rows exist before role `hasPermissionTo()` checks.
   - Do not remove any existing test method.

5. `tests/Regression/RegressionTest.php`
   - Extend regression assertions to verify fallback permission-state extraction exists.
   - Keep all previous regression entries.

6. `tests/test.sh`
   - Fix duplicate terminal/result counting.
   - Ensure every test line is emitted once.
   - Preserve unique timestamped result files.
   - Preserve all suite paths: `tests/Unit tests/Feature tests/Regression tests/Security`.

### Files read/analyzed
- `uploads/error-20260626-153744.txt`
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`
- `zero/security.md`
- `zero/flow.md`
- `zero/snapshot.md`
- `zero/feature-2/plan-v1.md`
- `zero/feature-2/security-plan-v1.md`
- `zero/feature-2/test-plan-v1.md`

## PART C — DEPENDENCY AND IMPACT ANALYSIS

### Filament form state dependency
- Create/edit pages use Filament resource page lifecycle methods.
- Permission UI fields are not safe model columns.
- Submitted permission state can appear either in mutation `$data` or in a page form-state property depending on lifecycle/testing path.

### Spatie permission dependency
- Permissions must be created with `guard_name = web`.
- Roles must remain `guard_name = web` and `gym_id = null`.
- `syncPermissions()` must receive permission models that exist for the correct guard.

### Test runner dependency
- `tests/test.sh` currently reads PHPUnit output and emits ✅/❌ lines.
- Counting both normal PHPUnit rows and testdox rows causes inflated pass/fail numbers.
- The fix must keep one stable error file per run and concise terminal output.

### Guaranteed untouched
- No API behavior changes.
- No existing regression entries removed.
- No system admin/business user separation changes.
- No tenant isolation changes.
- No database schema changes.

## PART D — PRESERVATION GUARANTEE

Phase 2 must preserve:

1. Original bug fix:
   - Shield field names must never be inserted as `roles` table columns.

2. Security fixes:
   - Only safe role columns persist.
   - Malformed non-permission strings are rejected.
   - Permissions sync through Spatie relationship tables only.

3. Business role invariants:
   - `guard_name = web`.
   - `gym_id = null`.
   - duplicate validation for global web role names.

4. Test system requirements:
   - `tests/test.sh` uses relative paths only.
   - Every run creates a unique error file.
   - Terminal output remains ✅/❌ format.
   - Full suite paths remain included.

## PART E — ATOMIC EXECUTION STEPS

1. File: `app/Filament/Resources/BusinessRoleResource.php`
   - Action: Add a shared helper that can extract permission names from raw form state, nested page `data` state, or other array state without accepting malformed strings.
   - Expected outcome: Permission extraction supports both browser and Livewire test state shapes.
   - Preserve: `sanitizeRolePersistenceData()` behavior and existing form/table/resource behavior.

2. File: `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Action: Add a method that resolves permission names by using captured mutation permissions first, then falling back to page/form state extraction if captured permissions are empty.
   - Expected outcome: Create page can sync permissions even when Livewire test state is not present in mutation `$data`.
   - Preserve: sanitized create persistence data.

3. File: `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
   - Action: Update `afterCreate()` to sync from the resolved permission names.
   - Expected outcome: `ViewAny:Enquiry`, `Create:Enquiry`, and `ViewAny:Expense` are created and synced during UI create test.
   - Preserve: `Permission::firstOrCreate()` and `syncPermissions()`.

4. File: `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Action: Add a method that resolves permission names by using captured mutation permissions first, then falling back to page/form state extraction if captured permissions are empty.
   - Expected outcome: Edit page can sync permissions even when Livewire test state is not present in mutation `$data`.
   - Preserve: sanitized save persistence data.

5. File: `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
   - Action: Update `afterSave()` to sync from the resolved permission names.
   - Expected outcome: edited role has expected permissions.
   - Preserve: `Permission::firstOrCreate()` and `syncPermissions()`.

6. File: `tests/Feature/BusinessRoleResourceTest.php`
   - Action: Update create/edit UI tests to submit permission state through the correct Livewire/Filament page state path while keeping current assertions.
   - Expected outcome: UI tests exercise real page permission sync instead of only backend extraction helper.
   - Preserve: all existing test methods and strict assertions.

7. File: `tests/Regression/RegressionTest.php`
   - Action: Add assertions for the new fallback permission resolver and ensure old captured-permission assertions remain.
   - Expected outcome: future changes cannot remove fallback support.
   - Preserve: every previous regression assertion.

8. File: `tests/test.sh`
   - Action: Change `emit_results()` so it does not count duplicate PHPUnit output representations of the same test.
   - Expected outcome: terminal summary aligns with PHPUnit test count instead of inflated duplicate count.
   - Preserve: relative paths, unique error files, suite list, and ✅/❌ output format.
