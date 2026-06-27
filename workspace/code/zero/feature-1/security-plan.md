# Feature 1 Security Plan — Test Runner Seeding and Facility User Test Stabilization

## Scope
This feature affects test infrastructure and one feature test assertion. No production application logic is planned for modification.

## Existing security constraints from `zero/security.md`
- Maintain strict separation between `system_admins` and business `users`.
- Preserve tenant isolation through `active_gym_id`, Filament tenant context, Spatie teams `gym_id`, and gym/user pivot constraints.
- Preserve login throttling for business slug and API authentication routes.
- Ensure `tests/test.sh` only targets the testing environment and never production data.

## Risk Analysis and Mitigations

### Risk 1 — Accidental destructive database commands outside testing
- Attack/failure surface: `php artisan migrate:fresh` is destructive if run against the wrong environment.
- Mitigation:
  - `tests/test.sh` must pass `--env=testing` to both `migrate:fresh --seed` and `db:seed`.
  - The script must export `APP_ENV=testing`.
  - The script must validate it is being run from a Laravel project root resolved relative to the script.
  - The script must not contain absolute paths or hard-coded local machine directories.

### Risk 2 — Test runner leaking credentials or sensitive logs
- Attack/failure surface: test output and stack traces may include secrets or local paths.
- Mitigation:
  - Detailed output goes to `tests/results/error-[timestamp].txt` and related timestamped result files.
  - Terminal output remains concise.
  - No credentials beyond intentional test fixture credentials from `MandatoryTemporaryTestDataSeeder` are added.

### Risk 3 — Weakening system admin vs facility user separation
- Attack/failure surface: changing production `User::facilityUsers()` could accidentally expose system admins in business user lists.
- Mitigation:
  - Do not modify production scope unless review proves it is defective.
  - Modify only the brittle test assertion so seeded facility users do not cause false failures.
  - Preserve assertions that usernames colliding with `system_admins.username` and Spatie `super_admin` users are excluded.

### Risk 4 — Reintroducing tenant isolation weakness
- Attack/failure surface: seeding users across gyms can pollute tests if tenant context is not explicit.
- Mitigation:
  - Preserve existing `TestCase` tenant bootstrap and Spatie team ID setup.
  - Do not change `gym_user` pivot behavior or tenant checks.
  - Regression coverage must preserve tenant isolation tests.

### Risk 5 — Shell injection through command-line flags
- Attack/failure surface: `--super=[ID]` and `--business=[ID]` values could be interpolated into commands unsafely.
- Mitigation:
  - Treat flags as environment variable values only.
  - Quote all variable expansions.
  - Do not eval user input.

## Code-Level Enforcement Required in Phase 2
- `tests/test.sh` uses `set -euo pipefail`.
- All paths are derived from `SCRIPT_DIR` and `PROJECT_DIR` with relative navigation.
- All variable expansions are quoted.
- Artisan commands include `--env=testing`.
- No `rm -rf` against project, home, root, or arbitrary user paths.
- Existing tests for `TenantIsolationTest`, `RolePermissionTest`, and `SecurityTest` remain present.

## Confirmation of preserved security measures
- Business slug login throttling remains untouched.
- API auth middleware remains untouched.
- Filament panel auth remains untouched.
- `system_admins` table remains separate from business `users`.
- Spatie role/team behavior remains untouched.
