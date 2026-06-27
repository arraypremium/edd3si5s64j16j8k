# Cumulative Security Vulnerability Log

No pre-existing zero/security.md was present when Phase 1 began. This file was initialized for the current workflow.

## Active Considerations

- Maintain strict separation between `system_admins` and business `users`.
- Preserve tenant isolation through `active_gym_id`, Filament tenant context, Spatie teams `gym_id`, and gym/user pivot constraints.
- Preserve login throttling for both business slug and API authentication routes.
- Ensure tests/test.sh only targets the testing environment and never production data.

## Feature 2 Security Finding — Shield Role Form-State Mass Persistence

- Status: Mitigated in Phase 2 implementation.
- Finding: Business role create/edit accepted Filament Shield permission UI state in the same data array used for Spatie `roles` model persistence. Resource class-name keys and tab keys could reach `Role::create()` / `update()` as non-column attributes, causing SQL errors and exposing an unsafe persistence boundary.
- Mitigation: `BusinessRoleResource::sanitizeRolePersistenceData()` now whitelists role persistence to `name`, forced `guard_name = web`, and forced `gym_id = null`. Permission state remains separate and is synced after create/save through Spatie permission relationships.
- Tests: `tests/Feature/BusinessRoleResourceTest.php` covers backend sanitization plus Livewire create/edit flows with Shield permission state.

## Feature 2 Security Review Addendum — Permission Name Extraction

- Status: Mitigated during Phase 3 review iteration 1.
- Finding: Although role table persistence was sanitized, duplicated permission-sync code still accepted any filled string from non-persistence form state as a permission name.
- Mitigation: `BusinessRoleResource::extractPermissionNamesFromFormState()` now centralizes permission extraction and accepts only permission-shaped strings while excluding persistence-only keys.
- Tests: `test_business_role_permission_extraction_rejects_non_permission_strings` covers malformed string rejection.

## Feature 2 Revision 1 Security Note — Permission Capture Timing

- Status: Mitigated in revision Phase 2.
- Finding: Permission names were read from page form state after sanitized role persistence data was returned, which could drop selected permissions from the sync path while keeping the role row valid.
- Mitigation: Create and edit pages now capture filtered permission names during the mutate step before returning sanitized persistence data, then sync from that captured list after create/save.
- Tests: Existing Livewire create/edit tests remain strict and regression assertions now verify captured permission state is used.

## Feature 2 Revision 2 Security Note — Fallback Permission State Resolution

- Status: Mitigated in revision 2 Phase 2.
- Finding: The Livewire page path could have selected permission state outside the mutation data used for sanitized persistence, leaving roles created safely but without permissions.
- Mitigation: Create/edit pages now resolve permission names from captured mutation data first and from filtered page/form fallback sources only when captured data is empty. Every source still passes through the strict permission-name extractor.
- Tests: BusinessRoleResourceTest keeps create/edit UI permission assertions, and RegressionTest verifies fallback resolver wiring.

## Feature 3 Security Note — Strict Test Expansion

- Status: Test coverage expanded in Phase 2.
- Finding: No new production vulnerability was introduced; Feature 3 changes are test-only.
- Mitigation added: Strict tests now cover role allow/deny behavior, tenant isolation edge cases, unauthorized API access, invalid payload rejection, SQL-like search behavior, and Feature 2 role-permission regression paths.
