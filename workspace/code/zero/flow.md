# Flow Map and Test Coverage

- Generated: 2026-06-26T18:47:17
- Coverage is inferred from code/test files; no Laravel tests were run by the assistant.

## Detected Features

### Authentication & Business Slug Login
- Detected: Yes
- Test coverage status: Covered
- Priority: Critical
- Related tests: tests/Feature/Api/AuthApiTest.php, tests/Feature/BusinessSlugLoginTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### System Admins
- Detected: Yes
- Test coverage status: Not Covered
- Priority: High
- Related tests: None detected
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Business Roles / Filament Shield UI
- Detected: Yes
- Test coverage status: Covered
- Priority: Critical
- Related tests: tests/Feature/BusinessSlugLoginTest.php, tests/Feature/RolePermissionTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Gyms / Businesses / Multi-Tenancy
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/TenantIsolationTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Users / Facility Staff
- Detected: Yes
- Test coverage status: Covered
- Priority: Critical
- Related tests: tests/Feature/FacilityStaffRelationManagerTest.php, tests/Feature/UserCreateFormRolesTest.php, tests/Feature/UserResourceExcludesAdminsTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Roles & Permissions API
- Detected: Yes
- Test coverage status: Covered
- Priority: Critical
- Related tests: tests/Feature/Api/ApiPermissionsTest.php, tests/Feature/RolePermissionTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Members
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/MemberTest.php, tests/Unit/MemberCodeGeneratorTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Leads / Enquiries
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/LeadTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Follow-ups
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/FollowUpTest.php, tests/Unit/FollowUpTableColumnsTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Services
- Detected: Yes
- Test coverage status: Not Covered
- Priority: High
- Related tests: None detected
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Plans
- Detected: Yes
- Test coverage status: Not Covered
- Priority: High
- Related tests: None detected
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Subscriptions
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/MarkSubscriptionsStatusCommandTest.php, tests/Feature/SubscriptionTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Invoices & Payments
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/InvoiceDocumentControllerTest.php, tests/Feature/InvoiceDocumentViewRendersTest.php, tests/Feature/InvoiceEmailServiceTest.php, tests/Feature/InvoiceIssuedEmailJobTest.php, tests/Feature/InvoicePaymentReceiptEmailJobTest.php, tests/Feature/InvoiceTotalsConsistencyTest.php, tests/Feature/PaymentTest.php, tests/Unit/InvoiceCalculatorTest.php, tests/Unit/InvoiceDisplayStatusLabelTest.php, tests/Unit/InvoiceNumberGeneratorTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Expenses
- Detected: Yes
- Test coverage status: Not Covered
- Priority: High
- Related tests: None detected
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Analytics Dashboard
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/Api/AnalyticsApiTest.php, tests/Feature/DashboardDemoSeederTest.php, tests/Unit/AnalyticsDateRangeTest.php, tests/Unit/AnalyticsServiceTest.php, tests/Unit/DashboardHeaderActionsTest.php, tests/Unit/DashboardLayoutTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Settings & Localization
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/Api/SettingsApiTest.php, tests/Feature/LocaleSwitcherTest.php, tests/Feature/SettingsPagePersistenceTest.php, tests/Unit/JsonSettingsRepositoryCacheTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Notifications & Commands
- Detected: Yes
- Test coverage status: Covered
- Priority: High
- Related tests: tests/Feature/ExpiringNotificationCommandTest.php, tests/Feature/MarkSubscriptionsStatusCommandTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### API v1 Integrations
- Detected: Yes
- Test coverage status: Covered
- Priority: Critical
- Related tests: tests/Feature/Api/AnalyticsApiTest.php, tests/Feature/Api/ApiCrudFlowTest.php, tests/Feature/Api/ApiPermissionsTest.php, tests/Feature/Api/AuthApiTest.php, tests/Feature/Api/LocaleApiTest.php, tests/Feature/Api/RichFilteringApiTest.php, tests/Feature/Api/SettingsApiTest.php, tests/Feature/ApiTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

### Security / Tenant Isolation
- Detected: Yes
- Test coverage status: Covered
- Priority: Critical
- Related tests: tests/Feature/TenantIsolationTest.php, tests/Security/SecurityTest.php
- Testable actions: Create, Edit/Update, Delete, View/List, Validate, Authenticate, Authorize, Search/Filter, Export/Import where implemented.

## API Endpoint Coverage
- `GET` '/user', function (Request $request) { return $request->user() — Covered by API test group where applicable
- `POST` '/auth/login', [AuthController::class, 'login']) — Covered by API test group where applicable
- `GET` '/me', [AuthController::class, 'me']) — Covered by API test group where applicable
- `POST` '/auth/logout', [AuthController::class, 'logout']) — Covered by API test group where applicable
- `GET` '/settings', [SettingsController::class, 'show']) — Covered by API test group where applicable
- `PUT` '/settings', [SettingsController::class, 'update']) — Covered by API test group where applicable
- `GET` '/financial', [AnalyticsController::class, 'financial']) — Covered by API test group where applicable
- `GET` '/membership', [AnalyticsController::class, 'membership']) — Covered by API test group where applicable
- `GET` '/cashflow-trend', [AnalyticsController::class, 'cashflowTrend']) — Covered by API test group where applicable
- `GET` '/expense-categories', [AnalyticsController::class, 'expenseCategories']) — Covered by API test group where applicable
- `GET` '/top-plans', [AnalyticsController::class, 'topPlans']) — Covered by API test group where applicable
- `GET` '/recent-transactions', [AnalyticsController::class, 'recentTransactions']) — Covered by API test group where applicable
- `GET` '/roles', [RolesController::class, 'index']) — Covered by API test group where applicable
- `GET` '/permissions', [PermissionsController::class, 'index']) — Covered by API test group where applicable
- `APIRESOURCE` 'users', UsersController::class) — Covered by API test group where applicable
- `POST` '/users/{user}/restore', [UsersController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/users/{user}/force', [UsersController::class, 'forceDelete']) — Covered by API test group where applicable
- `APIRESOURCE` 'members', MembersController::class) — Covered by API test group where applicable
- `POST` '/members/{member}/restore', [MembersController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/members/{member}/force', [MembersController::class, 'forceDelete']) — Covered by API test group where applicable
- `APIRESOURCE` 'services', ServicesController::class) — Covered by API test group where applicable
- `POST` '/services/{service}/restore', [ServicesController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/services/{service}/force', [ServicesController::class, 'forceDelete']) — Covered by API test group where applicable
- `APIRESOURCE` 'plans', PlansController::class) — Covered by API test group where applicable
- `POST` '/plans/{plan}/restore', [PlansController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/plans/{plan}/force', [PlansController::class, 'forceDelete']) — Covered by API test group where applicable
- `APIRESOURCE` 'subscriptions', SubscriptionsController::class) — Covered by API test group where applicable
- `POST` '/subscriptions/{subscription}/restore', [SubscriptionsController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/subscriptions/{subscription}/force', [SubscriptionsController::class, 'forceDelete']) — Covered by API test group where applicable
- `POST` '/subscriptions/{subscription}/renew', [SubscriptionsController::class, 'renew']) — Covered by API test group where applicable
- `APIRESOURCE` 'invoices', InvoicesController::class) — Covered by API test group where applicable
- `POST` '/invoices/{invoice}/restore', [InvoicesController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/invoices/{invoice}/force', [InvoicesController::class, 'forceDelete']) — Covered by API test group where applicable
- `GET` '/invoices/{invoice}/pdf', [InvoicesController::class, 'pdf']) — Covered by API test group where applicable
- `GET` '/invoices/{invoice}/pdf/download', [InvoicesController::class, 'downloadPdf']) — Covered by API test group where applicable
- `GET` '/invoices/{invoice}/transactions', [InvoiceTransactionsController::class, 'index']) — Covered by API test group where applicable
- `POST` '/invoices/{invoice}/transactions', [InvoiceTransactionsController::class, 'store']) — Covered by API test group where applicable
- `DELETE` '/invoices/{invoice}/transactions/{transaction}', [InvoiceTransactionsController::class, 'destroy']) — Covered by API test group where applicable
- `APIRESOURCE` 'expenses', ExpensesController::class) — Covered by API test group where applicable
- `APIRESOURCE` 'enquiries', EnquiriesController::class) — Covered by API test group where applicable
- `POST` '/enquiries/{enquiry}/restore', [EnquiriesController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/enquiries/{enquiry}/force', [EnquiriesController::class, 'forceDelete']) — Covered by API test group where applicable
- `GET` '/enquiries/{enquiry}/follow-ups', [EnquiryFollowUpsController::class, 'index']) — Covered by API test group where applicable
- `POST` '/enquiries/{enquiry}/follow-ups', [EnquiryFollowUpsController::class, 'store']) — Covered by API test group where applicable
- `APIRESOURCE` 'follow-ups', FollowUpsController::class) — Covered by API test group where applicable
- `POST` '/follow-ups/{followUp}/restore', [FollowUpsController::class, 'restore']) — Covered by API test group where applicable
- `DELETE` '/follow-ups/{followUp}/force', [FollowUpsController::class, 'forceDelete']) — Covered by API test group where applicable

## Security Surfaces
- System panel role creation via `/system/shield/roles/create` (Livewire/Filament form): Critical because malformed dehydrated permission state can be persisted into `roles` columns.
- Spatie roles/permissions tables: `roles`, `permissions`, `role_has_permissions`, `model_has_roles`, `model_has_permissions`. Critical.
- System admin guard vs business user guard separation. Critical.
- Tenant isolation via `gym_id`, `active_gym_id`, Filament tenants, and Spatie teams. Critical.
- API auth/authorization and rate limits. Critical.

## Current Error Report Coverage Status
- Attached `error.txt` shows `SQLSTATE[42S22] Unknown column App\Filament\Resources\... in INSERT INTO roles` during Livewire POST from `/system/shield/roles/create`.
- Existing tests did not simulate the exact Filament/Livewire role-create submit payload, so 224 backend tests can pass while browser role creation still fails.
- Feature 2 must add strict backend and UI-component tests for BusinessRoleResource create/edit payload sanitization and permission synchronization.

## Feature 2 — Business Role Shield Form-State Persistence Fix

Status: Phase 1 planned.

### Flow item: System Admin creates business role at `/system/shield/roles/create`
- Current issue: Shield permission form state is included in role model create data, causing SQL unknown-column errors.
- Planned fix: whitelist role persistence attributes before create.
- Testable: yes.
- Coverage planned: backend sanitizer test and UI/Livewire create-page test.

### Flow item: System Admin edits business role at `/system/shield/roles/{record}/edit`
- Current issue: same unsafe form-state persistence risk exists during save/update.
- Planned fix: whitelist role persistence attributes before save.
- Testable: yes.
- Coverage planned: backend edit sanitizer test and UI/Livewire edit/save test.

## Feature 2 — Phase 3 Review Update

Status: Clean review confirmed after review iteration 1.

### Covered testable items
- Business role create sanitizes Shield form state before database insert: Covered.
- Business role edit sanitizes Shield form state before database update: Covered.
- Permission extraction rejects malformed non-permission strings: Covered.
- `/system/shield/roles/create` Livewire create flow with permission selections: Covered.
- Duplicate global web business role validation: Covered.

## Feature 2 — Phase 4 Update

Status: change.sh generated.

### Generated artifact
- `zero/feature-2/change.sh`

### Included files
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

## Feature 2 Revision 1 — Permission Sync Failure Analysis

Status: Phase 1 revision planned.

### Failing covered item: Business role create permission sync
- Error: `PermissionDoesNotExist` for `ViewAny:Enquiry`.
- Root cause: permission state is not captured reliably before sanitized persistence data is returned.
- Coverage: existing Livewire create test remains required.

### Failing covered item: Business role edit permission sync
- Error: role does not have expected permission after save.
- Root cause: edit page reads unreliable post-sanitization form state instead of captured submitted permission state.
- Coverage: existing Livewire edit test remains required.

## Feature 2 Revision 1 — Phase 2 Implementation Update

Status: Implemented, awaiting review.

### Updated coverage behavior
- Business role create now captures selected permissions before sanitized persistence: Covered by existing Livewire create test.
- Business role edit now captures selected permissions before sanitized persistence: Covered by existing Livewire edit test.
- Regression now checks captured permission state wiring: Covered.

## Feature 2 Revision 1 — Phase 3 Review Update

Status: Clean review confirmed.

### Reviewed covered items
- Create-page permission capture before sanitized persistence: Covered and reviewed clean.
- Edit-page permission capture before sanitized persistence: Covered and reviewed clean.
- Regression assertion for captured permission state: Covered and reviewed clean.

## Feature 2 Revision 1 — Phase 4 Update

Status: `change-v1.sh` generated.

### Generated artifact
- `zero/feature-2/change-v1.sh`

### Included files
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

## Feature 2 Revision 2 — Phase 1 Plan

Status: Planned.

### Remaining failing item: create role permission sync
- Latest failure: permission row `ViewAny:Enquiry` / `web` is missing.
- Planned fix: fallback permission resolution from page/form state when mutation capture is empty.

### Remaining failing item: edit role permission sync
- Latest failure: role permission assertion false.
- Planned fix: same fallback permission resolution for edit save flow.

### Test runner count mismatch
- Latest issue: PHPUnit reports 118 tests but terminal parser reports inflated counts.
- Planned fix: deduplicate parser output or count one output style only.

## Feature 2 Revision 2 — Phase 2 Implementation Update

Status: Implemented, awaiting review.

### Implemented items
- Create role permission sync fallback: Implemented.
- Edit role permission sync fallback: Implemented.
- Duplicate test-count parser fix: Implemented.

## Feature 2 Revision 2 — Phase 3 Review Update

Status: Clean review confirmed.

### Reviewed covered items
- Multi-source permission extraction fallback: Covered and reviewed clean.
- Create-page permission sync fallback: Covered and reviewed clean.
- Edit-page permission sync fallback: Covered and reviewed clean.
- Duplicate PHPUnit output counting guard in `tests/test.sh`: Covered and reviewed clean.

## Feature 2 Revision 2 — Phase 4 Update

Status: `change-v2.sh` generated.

### Generated artifact
- `zero/feature-2/change-v2.sh`

### Included files
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

## Feature 3 — Strict Test Expansion Plan

Status: Phase 1 planned.

### Planned covered areas
- Filament CRUD UI/Livewire actions: Planned.
- Role-wise allow/deny access: Planned.
- Tenant isolation edge cases: Planned.
- Invalid payload/security tests: Planned.
- Feature 2 role permission regression hardening: Planned.
- Test runner inclusion regression: Planned.

## Feature 3 — Phase 2 Implementation Update

Status: Implemented, awaiting review.

### Implemented coverage
- Strict Filament CRUD/UI contract tests: Implemented.
- Strict role allow/deny tests: Implemented.
- Strict tenant isolation edge tests: Implemented.
- Strict invalid payload/security tests: Implemented.
- Regression assertions for strict test suite persistence: Implemented.
