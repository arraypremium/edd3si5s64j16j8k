# Feature 1 Test Plan — Stabilize Local Test Failures

## SECTION A — DATA CREATION TESTS

The suite must be able to auto-create or seed these records through existing factories/seeders:

- System Admin:
  - Username: `admin`
  - Password: `Admin@12345`
  - Source: `MandatoryTemporaryTestDataSeeder`
- Business/Gym records:
  - `Business One Gym` with slug `business-one`
  - `Business Two Gym` with slug `business-two`
- Business Users:
  - `a / a`, attached to Business One
  - `b / b`, attached to Business Two
  - `c / c`, shared across both businesses
- Member records:
  - Created by `MandatoryTemporaryTestDataSeeder::createMemberBundle()` and existing member tests/factories.
- Lead/Enquiry records:
  - Created by `MandatoryTemporaryTestDataSeeder::createEnquiryWithFollowUp()` and existing enquiry tests/factories.
- Follow-up records:
  - Created for seeded enquiries and existing follow-up tests.
- Subscription records:
  - Created for members and gym subscriptions.
- Payment/Invoice transaction records:
  - Created for invoice payments/refunds.
- Staff/Trainer/Facility users:
  - Created by existing user tests/factories and mandatory business users.
- Custom modules detected in `zero/flow.md`:
  - Services, Plans, Expenses, Settings, Analytics, Roles, Permissions, Business Slug Login, Invoice documents.

## SECTION B — BACKEND ACTION TESTS

No browser is opened. Existing backend HTTP/API/feature tests cover these actions:

- Business slug login:
  - `GET /{business:url_slug}/login`
  - `POST /{business:url_slug}/login`
  - Expected behavior: reserved slugs blocked, valid business slug can route to login flow.
- API auth:
  - `POST /api/v1/auth/login`
  - `POST /api/v1/auth/logout`
- CRUD resources:
  - API resources for users, members, services, plans, subscriptions, invoices, expenses, enquiries, follow-ups.
- Invoice documents:
  - Preview/download endpoints require authorization.
- Test runner setup:
  - `tests/test.sh` executes `migrate:fresh --seed --env=testing`.
  - `tests/test.sh` executes `db:seed --class=MandatoryTemporaryTestDataSeeder --env=testing` after base seeding.

## SECTION C — VALIDATION TESTS

Existing validation and feature tests must remain:

- Empty required fields.
- Duplicate records.
- Invalid email/phone formats.
- Negative amounts.
- Date violations.
- Source option validation for members and enquiries.
- Reserved business slug validation.

For this feature specifically:
- Static test validates required seeder command strings exist in `tests/test.sh`.
- Facility user test validates system-admin exclusion without relying on unrelated global row count.

## SECTION D — API ENDPOINT TESTS

Existing API test coverage remains:

- Valid token requests.
- Missing/invalid token requests.
- Permission-gated access.
- API locale behavior.
- Rich filtering allowlist behavior.
- Settings read/update.
- Core CRUD flow.
- Analytics payloads.

No API endpoint implementation is changed in this feature.

## SECTION E — ROLE AND PERMISSION TESTS

Existing role/permission tests must continue to cover:

- Super/system admin separation.
- Business/facility users.
- Spatie `super_admin` exclusion from facility users.
- Facility role enum mapping.
- Cross-gym tenant isolation.

This feature specifically preserves:
- `User::facilityUsers()` behavior.
- `UserResourceExcludesAdminsTest` semantic checks.
- `TenantIsolationTest` and `RolePermissionTest` files.

## SECTION F — SECURITY TESTS

Existing security coverage must remain present for:

- SQL injection attempts.
- XSS injection attempts.
- CSRF-sensitive flows.
- Brute force/throttled login behavior.
- Unauthorized direct URL access.
- Tenant isolation violation attempts.
- Malicious file upload attempts where applicable.
- Expired/invalid token rejection.
- API rate limit enforcement where implemented.

This feature adds no new public attack surface. The primary security check is ensuring `tests/test.sh` only targets `--env=testing`.

## SECTION G — REGRESSION TESTS

Regression coverage must continue for all features listed in `zero/flow.md`, including:

- Authentication & Business Slug Login.
- System Admins.
- Gyms / Businesses / Multi-Tenancy.
- Users / Facility Staff.
- Roles & Permissions.
- Members.
- Leads / Enquiries.
- Follow-ups.
- Services.
- Plans.
- Subscriptions.
- Invoices & Payments.
- Expenses.
- Analytics Dashboard.
- Settings & Localization.
- Notifications & Commands.
- API v1 Integrations.
- Security / Tenant Isolation.

For this feature, append regression coverage if not already present for:
- mandatory temporary seeder command in `tests/test.sh`.
- facility user filtering remaining seed-independent.

## SECTION H — TEST EXECUTION RULES

- User runs tests locally; assistant does not run tests.
- `tests/test.sh` accepts:
  - `--super=[ID]`
  - `--business=[ID]`
- Test database is wiped and reseeded before every script run using testing environment only.
- `MandatoryTemporaryTestDataSeeder` runs after base `DatabaseSeeder`.
- Terminal output should be concise and avoid verbose stack traces.
- Errors and stack traces go to `tests/results/error-[YYYYMMDD-HHMMSS].txt`.
- Every run produces a new uniquely timestamped error file.
- No two runs share the same error file.
- Existing old tests remain; old regression entries are never removed.
