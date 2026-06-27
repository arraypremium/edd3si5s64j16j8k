# Feature 1 Plan — Stabilize Local Test Failures from `pass-20260626-135006.txt`

## PART A — OVERVIEW

### Task understood
The attached local test report shows 110 tests executed with 108 passing and 2 failing:

1. `Tests\Feature\BusinessSlugLoginTest::test_feature_four_mandatory_temp_data_contains_business_slugs`
   - Failure: `tests/test.sh` does not contain the required command string `db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing`.
   - The same test also requires `migrate:fresh --seed --env=testing` to appear before the mandatory temporary seeder command.

2. `Tests\Feature\UserResourceExcludesAdminsTest::it excludes system admins from facility users list`
   - Failure: the test expected exactly 2 facility users but received 3.
   - The production `User::scopeFacilityUsers()` already excludes username `admin`, usernames colliding with `system_admins.username`, and users holding the Spatie `super_admin` role.
   - The failure is caused by a brittle exact-count assertion that is unsafe when seeded or pre-existing testing users are present.

### What will change
- Create or update `tests/test.sh` so it deterministically prepares the testing database and explicitly runs `MandatoryTemporaryTestDataSeeder` after `migrate:fresh --seed --env=testing`.
- Update `tests/Feature/UserResourceExcludesAdminsTest.php` so the failing assertion validates the relevant usernames and system-admin exclusion behavior without failing because unrelated seeded facility users exist.
- Preserve the existing `User::facilityUsers()` production scope because it already implements the intended exclusion logic.

### What will not change
- No business model, controller, Filament resource, API endpoint, migration, or seeder logic will be changed in this feature unless later Phase 3 review finds a direct issue.
- No existing passing tests will be removed.
- No regression entries will be removed.
- No rollback script will be created.

### Technical context
Laravel's refreshed test database flow commonly uses `migrate:fresh` and can optionally seed the test database before transactions begin; this is consistent with the test-runner expectation that the database be rebuilt deterministically before the suite starts [1](https://github.com/laravel/framework/pull/30500).

## PART B — FILES INVOLVED

### Files to be modified or created

1. `tests/test.sh`
   - Current workspace state: file is absent.
   - Required action: create a complete shell test runner.
   - Required content characteristics:
     - Uses relative path resolution from the script location.
     - Accepts `--super=[ID]` and `--business=[ID]` flags.
     - Exports stable test-run timestamp and actor IDs.
     - Ensures `tests/results/` exists.
     - Runs `php artisan migrate:fresh --seed --env=testing`.
     - Then runs `php artisan db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing`.
     - Runs the full PHPUnit/Pest test suite silently.
     - Writes diagnostic output to a unique timestamped `tests/results/error-[timestamp].txt` file.
     - Terminal output follows the required concise pass/fail summary format as closely as shell-only orchestration allows without changing the PHPUnit printer.

2. `tests/Feature/UserResourceExcludesAdminsTest.php`
   - Current workspace state: present and failing in user's local report due exact count assertion.
   - Required action: update only the first test's assertion section.
   - Required content characteristics:
     - Keep all existing test cases.
     - Preserve the assertions that `facility_user_1` and `facility_user_2` are included.
     - Preserve the assertion that `test_admin_1` is not included.
     - Remove or replace only the brittle `expect($facilityUsers->count())->toBe(2)` assumption.
     - Optionally restrict the query to fixture usernames created by that test if needed to avoid seeded-user interference.

3. `tests/Regression/RegressionTest.php`
   - Current workspace state: present.
   - Required action: read in Phase 2 and append a regression assertion only if the current regression file does not already cover test runner seeding and facility user filtering. Existing entries must remain untouched.

4. `zero/feature-1/*`
   - Current workflow planning files created in Phase 1.
   - These are planning artifacts and are not application implementation files.

### Files read for analysis
- `tests/Feature/BusinessSlugLoginTest.php`
- `tests/Feature/UserResourceExcludesAdminsTest.php`
- `tests/Feature/FacilityStaffRelationManagerTest.php`
- `tests/BaseGymieTest.php`
- `tests/TestCase.php`
- `tests/Pest.php`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php`
- `database/seeders/DatabaseSeeder.php`
- `database/seeders/UserSeeder.php`
- `app/Models/User.php`
- `app/Models/Gym.php`
- `routes/web.php`
- `routes/api.php`
- `phpunit.xml`
- `zero/snapshot.md`
- `zero/flow.md`
- `zero/security.md`

## PART C — DEPENDENCY AND IMPACT ANALYSIS

### Test runner dependencies
- `tests/test.sh` depends on:
  - PHP CLI being installed.
  - Laravel `artisan` existing at project root.
  - Composer dependencies being installed by the user locally.
  - Testing environment configured through `phpunit.xml` and `.env.testing` if present.
  - `Database\Seeders\MandatoryTemporaryTestDataSeeder` existing and importable by Laravel autoloading.

### Test data dependencies
- `BusinessSlugLoginTest` statically reads `tests/test.sh` and `MandatoryTemporaryTestDataSeeder.php`.
- `MandatoryTemporaryTestDataSeeder` creates:
  - system admin `admin / Admin@12345`.
  - business users `a / a`, `b / b`, `c / c`.
  - business slugs `business-one` and `business-two`.
  - dashboard data for members, enquiries, subscriptions, invoices, expenses, services, plans.
- `DatabaseSeeder` creates a default `gym_staff` user through `UserSeeder`; tests must not assume this user is absent if the database was seeded.

### Facility user filtering dependencies
- `User::scopeFacilityUsers()` currently depends on:
  - `users.username`.
  - `system_admins.username`.
  - Spatie roles relationship and role name `super_admin`.
- Filament resources and relation managers depend on `facilityUsers()` returning business users while excluding system admins and super admins.
- The failing test should verify those guarantees without imposing a global row count.

### Guaranteed untouched
- `app/Models/User.php` remains untouched unless Phase 3 reveals the production scope is actually defective.
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` remains untouched because it already contains required business slugs and users.
- Business slug login routes/controller/resource files remain untouched because their wiring test already passes.
- API controllers and routes remain untouched.
- Migrations remain untouched.

## PART D — PRESERVATION GUARANTEE

Cross-referenced against `zero/snapshot.md`, the following must not be altered in this feature:

- All API endpoint paths and HTTP methods in `routes/api.php`.
- Web routes in `routes/web.php` except no changes are planned.
- `BusinessSlugLoginController` behavior for slug login, session `active_gym_id`, and dashboard redirect.
- `ReservedBusinessSlug` reserved-slug validation.
- `Gym` URL slug immutability and business fields.
- `User::scopeFacilityUsers()` production logic unless a later review proves it is the direct defect.
- `Gym::facilityStaff()` relationship behavior.
- `MandatoryTemporaryTestDataSeeder` data creation for `business-one`, `business-two`, users `a`, `b`, `c`, and dashboard fixtures.
- All existing tests outside `tests/test.sh`, the one assertion block in `UserResourceExcludesAdminsTest.php`, and any strictly additive regression entry.
- All existing security measures listed in `zero/security.md`.

## PART E — ATOMIC EXECUTION STEPS FOR PHASE 2

1. **File: `tests/test.sh`**
   - Technical action: create the full shell script if absent, or replace it with complete final content if present.
   - Expected outcome: file exists, is executable-ready, uses relative path resolution, accepts `--super=[ID]` and `--business=[ID]`, creates a unique error log path, and runs the test suite.
   - Must preserve: no absolute paths, no production environment commands, no rollback logic.
   - Required pattern: include literal substring `migrate:fresh --seed --env=testing`.

2. **File: `tests/test.sh`**
   - Technical action: after the migrate/seed line, add the exact mandatory seeder command line containing `db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing`.
   - Expected outcome: `BusinessSlugLoginTest` static substring assertion passes and the mandatory temporary business slug/users data is seeded after base seeders.
   - Must preserve: the mandatory seeder command must appear after `migrate:fresh --seed --env=testing` in file order.
   - Required pattern: exact substring `db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing`.

3. **File: `tests/test.sh`**
   - Technical action: ensure error/pass logs are timestamped and written below `tests/results/` with no overwrite of older files.
   - Expected outcome: every run has unique `error-[YYYYMMDD-HHMMSS].txt` and supporting output files.
   - Must preserve: all verbose artisan/PHPUnit output redirected away from normal terminal output except summary lines.

4. **File: `tests/Feature/UserResourceExcludesAdminsTest.php`**
   - Technical action: read the entire file and modify only the first test's assertion/query block to avoid exact global count dependency.
   - Expected outcome: the test verifies relevant fixture users are included and `test_admin_1` is excluded even when seeded users exist.
   - Must preserve: all other tests and imports, including the collision username test and Spatie `super_admin` exclusion test.
   - Required pattern: keep assertions involving `facility_user_1`, `facility_user_2`, and `test_admin_1`.

5. **File: `tests/Regression/RegressionTest.php`**
   - Technical action: read the file. If no regression entry exists for mandatory test-runner seeding/facility user filtering, append a new additive regression test method or Pest case.
   - Expected outcome: regression coverage grows and no existing regression entry is removed.
   - Must preserve: all prior regression tests exactly.

6. **File: all modified files**
   - Technical action: write complete file contents from first to last line.
   - Expected outcome: no placeholders, ellipses, or partial snippets.
   - Must preserve: file style, namespaces, imports, and test framework conventions.

7. **File: `zero/feature-1/test-plan.md` and `zero/feature-1/security-plan.md`**
   - Technical action: use these plans as constraints while writing code/tests.
   - Expected outcome: Phase 2 implementation follows planned security and test coverage.
   - Must preserve: no implementation work outside this feature scope.
