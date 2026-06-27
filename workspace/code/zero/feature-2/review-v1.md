# Feature 2 Phase 3 Review V1

## Issue found

### 1. Permission extraction still accepted any string from remaining form state
Create/edit persistence data was correctly sanitized, but the duplicated permission sync logic still flattened all remaining form state and accepted any filled string. A malformed non-permission string in unexpected form state could be created as a permission.

## Required fix
- Add a shared `BusinessRoleResource::extractPermissionNamesFromFormState()` helper.
- Exclude persistence-only keys including `name`, `guard_name`, `gym_id`, and `select_all`.
- Accept only permission-name-shaped strings containing a valid `Prefix:Subject` shape.
- Use the helper in both `CreateBusinessRole::afterCreate()` and `EditBusinessRole::afterSave()`.
- Extend strict tests to assert malformed strings are not synced as permissions.
