# Codebase Snapshot

- Generated: 2026-06-26T18:47:01
- Files indexed: 554
- Scope: workspace project files excluding dependency/cache/runtime folders.

## File Catalog
| File | Size | Purpose |
|---|---:|---|
| `.editorconfig` | 258 | Project file/static asset/documentation. |
| `.env.example` | 1071 | Project file/static asset/documentation. |
| `.gitattributes` | 186 | Project file/static asset/documentation. |
| `.gitignore` | 290 | Project file/static asset/documentation. |
| `SECURITY.md` | 312 | Project file/static asset/documentation. |
| `app/Console/Commands/CleanupTemporaryBackups.php` | 1852 | Artisan command. |
| `app/Console/Commands/MarkInvoiceOverdue.php` | 2804 | Artisan command. |
| `app/Console/Commands/MarkSubscriptionsStatus.php` | 7035 | Artisan command. |
| `app/Console/Commands/NotifyExpiringGymSubscriptions.php` | 2504 | Artisan command. |
| `app/Console/Commands/SyncGymSubscriptionStatus.php` | 666 | Artisan command. |
| `app/Contracts/SequenceRepository.php` | 753 | Project file/static asset/documentation. |
| `app/Contracts/SettingsRepository.php` | 453 | Project file/static asset/documentation. |
| `app/Enums/FacilityRole.php` | 1067 | Project file/static asset/documentation. |
| `app/Enums/Status.php` | 1895 | Project file/static asset/documentation. |
| `app/Exceptions/CrossTenantException.php` | 248 | Project file/static asset/documentation. |
| `app/Filament/Concerns/HasResourceExcelActions.php` | 4348 | Project file/static asset/documentation. |
| `app/Filament/Livewire/LocaleSwitcher.php` | 2140 | Project file/static asset/documentation. |
| `app/Filament/Pages/Auth/CustomLogin.php` | 2279 | Filament custom panel page. |
| `app/Filament/Pages/Billing.php` | 1443 | Filament custom panel page. |
| `app/Filament/Pages/Dashboard.php` | 8324 | Filament custom panel page. |
| `app/Filament/Pages/Settings.php` | 22455 | Filament custom panel page. |
| `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php` | 1161 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php` | 1151 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/BusinessRoleResource/Pages/ListBusinessRoles.php` | 437 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/BusinessRoleResource.php` | 5997 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/EnquiryResource.php` | 3748 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Pages/CreateEnquiry.php` | 624 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` | 1092 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` | 1923 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` | 1604 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` | 5312 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php.bak` | 5341 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` | 11147 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` | 5283 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` | 8688 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Expenses/ExpenseResource.php` | 2102 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Expenses/Pages/ListExpenses.php` | 2767 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Expenses/Pages/ViewExpense.php` | 665 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` | 7085 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` | 2803 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` | 4857 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/FollowUps/FollowUpResource.php` | 3083 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` | 1793 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/FollowUps/Schemas/FollowUpForm.php` | 1609 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` | 2951 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` | 12573 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymResource/Pages/CreateGym.php` | 4227 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymResource/Pages/EditGym.php` | 580 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymResource/Pages/ListGyms.php` | 483 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` | 7967 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymResource.php` | 12608 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymSubscriptionResource/Pages/CreateGymSubscription.php` | 806 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymSubscriptionResource/Pages/EditGymSubscription.php` | 1034 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymSubscriptionResource/Pages/ListGymSubscriptions.php` | 491 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/GymSubscriptionResource.php` | 9829 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/InvoiceResource.php` | 3759 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Pages/CreateInvoice.php` | 624 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Pages/EditInvoice.php` | 1104 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Pages/ListInvoices.php` | 2843 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Pages/ViewInvoice.php` | 964 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` | 2508 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` | 14009 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` | 6999 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` | 28929 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/MemberResource.php` | 3476 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Pages/CreateMember.php` | 2185 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Pages/EditMember.php` | 1086 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Pages/ListMembers.php` | 4947 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Pages/ViewMember.php` | 1233 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` | 1629 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Schemas/MemberForm.php` | 11319 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Schemas/MemberInfolist.php` | 4299 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Members/Tables/MemberTable.php` | 10064 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Plans/Pages/ListPlans.php` | 1990 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Plans/PlanResource.php` | 2695 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Plans/Schemas/PlanForm.php` | 4385 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` | 2297 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Plans/Tables/PlanTable.php` | 9876 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Services/Pages/ListServices.php` | 1145 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Services/Schemas/ServiceForm.php` | 826 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Services/Schemas/ServiceInfolist.php` | 765 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Services/ServiceResource.php` | 1949 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Services/Tables/ServiceTable.php` | 2447 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Pages/CreateSubscription.php` | 722 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` | 1248 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` | 2851 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` | 1355 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php` | 909 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` | 38858 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` | 2349 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/SubscriptionResource.php` | 4030 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` | 13123 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemAdminResource/Pages/CreateSystemAdmin.php` | 868 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemAdminResource/Pages/EditSystemAdmin.php` | 1092 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemAdminResource/Pages/ListSystemAdmins.php` | 475 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemAdminResource.php` | 5857 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemPlanResource/Pages/CreateSystemPlan.php` | 388 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemPlanResource/Pages/EditSystemPlan.php` | 615 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemPlanResource/Pages/ListSystemPlans.php` | 471 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemPlanResource.php` | 6979 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemRoleResource/Pages/CreateSystemRole.php` | 273 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemRoleResource/Pages/EditSystemRole.php` | 267 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemRoleResource/Pages/ListSystemRoles.php` | 429 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/SystemRoleResource.php` | 5754 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Pages/CreateUser.php` | 1758 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Pages/EditUser.php` | 2288 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Pages/ListUsers.php` | 1586 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Pages/ViewUser.php` | 986 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Schemas/UserForm.php` | 4401 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Schemas/UserInfolist.php` | 3835 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/Tables/UserTable.php` | 8607 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Resources/Users/UserResource.php` | 3628 | Filament admin resource/page/schema/table for panel UI. |
| `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` | 7504 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` | 5690 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` | 5211 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` | 8869 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` | 3838 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` | 4466 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` | 3448 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` | 5760 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` | 8359 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` | 10001 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` | 4092 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php` | 1602 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` | 3593 | Filament dashboard/analytics widget. |
| `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` | 6619 | Filament dashboard/analytics widget. |
| `app/Helpers/Helpers.php` | 12912 | Project file/static asset/documentation. |
| `app/Http/Controllers/Api/V1/AnalyticsController.php` | 7051 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/ApiController.php` | 3243 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/AuthController.php` | 2339 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/EnquiriesController.php` | 3289 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` | 1588 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/ExpensesController.php` | 2059 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/FollowUpsController.php` | 2843 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` | 2329 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/InvoicesController.php` | 5483 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/MembersController.php` | 3006 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/PermissionsController.php` | 693 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/PlansController.php` | 2706 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/RolesController.php` | 694 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/ServicesController.php` | 2721 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/SettingsController.php` | 1005 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/SubscriptionsController.php` | 7437 | Versioned API controller. |
| `app/Http/Controllers/Api/V1/UsersController.php` | 4312 | Versioned API controller. |
| `app/Http/Controllers/BusinessSlugLoginController.php` | 6307 | HTTP controller. |
| `app/Http/Controllers/Controller.php` | 359 | HTTP controller. |
| `app/Http/Controllers/InvoiceDocumentController.php` | 1868 | HTTP controller. |
| `app/Http/Middleware/CheckGymStatus.php` | 2506 | Project file/static asset/documentation. |
| `app/Http/Middleware/ForceJsonResponse.php` | 930 | Project file/static asset/documentation. |
| `app/Http/Middleware/SetAppLocale.php` | 1627 | Project file/static asset/documentation. |
| `app/Http/Requests/Api/V1/Auth/LoginRequest.php` | 1317 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/EnquiryFollowUpStoreRequest.php` | 669 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/EnquiryStoreRequest.php` | 642 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/EnquiryUpdateRequest.php` | 780 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/ExpenseStoreRequest.php` | 642 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/ExpenseUpdateRequest.php` | 644 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/FollowUpStoreRequest.php` | 647 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/FollowUpUpdateRequest.php` | 649 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/InvoiceStoreRequest.php` | 642 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/InvoiceTransactionStoreRequest.php` | 687 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/InvoiceUpdateRequest.php` | 780 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/MemberStoreRequest.php` | 638 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/MemberUpdateRequest.php` | 773 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/PlanStoreRequest.php` | 630 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/PlanUpdateRequest.php` | 759 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/ServiceStoreRequest.php` | 642 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/ServiceUpdateRequest.php` | 644 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/SettingsUpdateRequest.php` | 1186 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/SubscriptionRenewRequest.php` | 661 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/SubscriptionStoreRequest.php` | 725 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/SubscriptionUpdateRequest.php` | 664 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/UserStoreRequest.php` | 630 | Form/API request validation rules. |
| `app/Http/Requests/Api/V1/UserUpdateRequest.php` | 759 | Form/API request validation rules. |
| `app/Http/Requests/Concerns/ResolvesRouteKey.php` | 616 | Form/API request validation rules. |
| `app/Http/Resources/V1/EnquiryResource.php` | 554 | API JSON resource serializer. |
| `app/Http/Resources/V1/ExpenseResource.php` | 554 | API JSON resource serializer. |
| `app/Http/Resources/V1/FollowUpResource.php` | 562 | API JSON resource serializer. |
| `app/Http/Resources/V1/InvoiceResource.php` | 554 | API JSON resource serializer. |
| `app/Http/Resources/V1/InvoiceTransactionResource.php` | 621 | API JSON resource serializer. |
| `app/Http/Resources/V1/MemberResource.php` | 546 | API JSON resource serializer. |
| `app/Http/Resources/V1/PermissionResource.php` | 595 | API JSON resource serializer. |
| `app/Http/Resources/V1/PlanResource.php` | 530 | API JSON resource serializer. |
| `app/Http/Resources/V1/RoleResource.php` | 541 | API JSON resource serializer. |
| `app/Http/Resources/V1/ServiceResource.php` | 554 | API JSON resource serializer. |
| `app/Http/Resources/V1/SubscriptionResource.php` | 594 | API JSON resource serializer. |
| `app/Http/Resources/V1/UserResource.php` | 666 | API JSON resource serializer. |
| `app/Jobs/SendInvoiceIssuedEmail.php` | 1502 | Project file/static asset/documentation. |
| `app/Jobs/SendInvoicePaymentReceiptEmail.php` | 1713 | Project file/static asset/documentation. |
| `app/Mail/InvoiceIssuedMail.php` | 1977 | Project file/static asset/documentation. |
| `app/Mail/InvoicePaymentReceiptMail.php` | 2164 | Project file/static asset/documentation. |
| `app/Models/Concerns/BelongsToGym.php` | 2902 | Eloquent model/domain entity. |
| `app/Models/Concerns/CascadesSoftDeletes.php` | 2785 | Eloquent model/domain entity. |
| `app/Models/Enquiry.php` | 2654 | Eloquent model/domain entity. |
| `app/Models/Expense.php` | 831 | Eloquent model/domain entity. |
| `app/Models/FollowUp.php` | 1675 | Eloquent model/domain entity. |
| `app/Models/Gym.php` | 6111 | Eloquent model/domain entity. |
| `app/Models/GymSubscription.php` | 1720 | Eloquent model/domain entity. |
| `app/Models/Invoice.php` | 6645 | Eloquent model/domain entity. |
| `app/Models/InvoiceTransaction.php` | 1874 | Eloquent model/domain entity. |
| `app/Models/Member.php` | 2933 | Eloquent model/domain entity. |
| `app/Models/Plan.php` | 2055 | Eloquent model/domain entity. |
| `app/Models/Service.php` | 1145 | Eloquent model/domain entity. |
| `app/Models/Subscription.php` | 3097 | Eloquent model/domain entity. |
| `app/Models/SystemAdmin.php` | 2970 | Eloquent model/domain entity. |
| `app/Models/SystemPlan.php` | 924 | Eloquent model/domain entity. |
| `app/Models/SystemRole.php` | 1154 | Eloquent model/domain entity. |
| `app/Models/User.php` | 7401 | Eloquent model/domain entity. |
| `app/Notifications/ExpiringGymSubscriptionNotification.php` | 2692 | Project file/static asset/documentation. |
| `app/Observers/GymSubscriptionObserver.php` | 498 | Project file/static asset/documentation. |
| `app/Observers/InvoiceObserver.php` | 1527 | Project file/static asset/documentation. |
| `app/Observers/InvoiceTransactionObserver.php` | 2064 | Project file/static asset/documentation. |
| `app/Policies/EnquiryPolicy.php` | 1654 | Authorization policy. |
| `app/Policies/ExpensePolicy.php` | 1654 | Authorization policy. |
| `app/Policies/FollowUpPolicy.php` | 1679 | Authorization policy. |
| `app/Policies/GymPolicy.php` | 1554 | Authorization policy. |
| `app/Policies/GymSubscriptionPolicy.php` | 1854 | Authorization policy. |
| `app/Policies/InvoicePolicy.php` | 1654 | Authorization policy. |
| `app/Policies/MemberPolicy.php` | 1629 | Authorization policy. |
| `app/Policies/PlanPolicy.php` | 1579 | Authorization policy. |
| `app/Policies/RolePolicy.php` | 1593 | Authorization policy. |
| `app/Policies/ServicePolicy.php` | 1654 | Authorization policy. |
| `app/Policies/SubscriptionPolicy.php` | 1779 | Authorization policy. |
| `app/Policies/SystemAdminPolicy.php` | 1544 | Authorization policy. |
| `app/Policies/SystemPlanPolicy.php` | 1729 | Authorization policy. |
| `app/Policies/UserPolicy.php` | 1460 | Authorization policy. |
| `app/Providers/AppServiceProvider.php` | 12903 | Laravel service/provider bootstrapping. |
| `app/Providers/Filament/AdminPanelProvider.php` | 7049 | Laravel service/provider bootstrapping. |
| `app/Providers/Filament/SystemPanelProvider.php` | 5744 | Laravel service/provider bootstrapping. |
| `app/Rules/ModelExists.php` | 1114 | Project file/static asset/documentation. |
| `app/Rules/ModelUnique.php` | 1284 | Project file/static asset/documentation. |
| `app/Rules/ReservedBusinessSlug.php` | 1805 | Project file/static asset/documentation. |
| `app/Services/Analytics/AnalyticsService.php` | 19362 | Application service class/business logic. |
| `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` | 5034 | Application service class/business logic. |
| `app/Services/Api/QueryFilters.php` | 10059 | Application service class/business logic. |
| `app/Services/Api/ResourceQueryRules.php` | 3775 | Application service class/business logic. |
| `app/Services/Api/Schemas/EnquirySchema.php` | 5918 | Application service class/business logic. |
| `app/Services/Api/Schemas/ExpenseSchema.php` | 3540 | Application service class/business logic. |
| `app/Services/Api/Schemas/FollowUpSchema.php` | 4093 | Application service class/business logic. |
| `app/Services/Api/Schemas/InvoiceSchema.php` | 6118 | Application service class/business logic. |
| `app/Services/Api/Schemas/InvoiceTransactionSchema.php` | 1834 | Application service class/business logic. |
| `app/Services/Api/Schemas/MemberSchema.php` | 6170 | Application service class/business logic. |
| `app/Services/Api/Schemas/PermissionSchema.php` | 540 | Application service class/business logic. |
| `app/Services/Api/Schemas/PlanSchema.php` | 3641 | Application service class/business logic. |
| `app/Services/Api/Schemas/RoleSchema.php` | 573 | Application service class/business logic. |
| `app/Services/Api/Schemas/ServiceSchema.php` | 2103 | Application service class/business logic. |
| `app/Services/Api/Schemas/SubscriptionSchema.php` | 5760 | Application service class/business logic. |
| `app/Services/Api/Schemas/UserSchema.php` | 5790 | Application service class/business logic. |
| `app/Services/Backup/ApplicationBackupService.php` | 10728 | Application service class/business logic. |
| `app/Services/Email/InvoiceEmailService.php` | 9681 | Application service class/business logic. |
| `app/Services/Excel/ExcelImportResult.php` | 1181 | Application service class/business logic. |
| `app/Services/Excel/ResourceExcelService.php` | 25775 | Application service class/business logic. |
| `app/Services/JsonSequenceRepository.php` | 5520 | Application service class/business logic. |
| `app/Services/JsonSettingsRepository.php` | 5599 | Application service class/business logic. |
| `app/Services/Members/MemberExcelService.php` | 15406 | Application service class/business logic. |
| `app/Services/Members/MemberImportResult.php` | 1294 | Application service class/business logic. |
| `app/Services/Subscriptions/SubscriptionRenewalService.php` | 4505 | Application service class/business logic. |
| `app/Support/Analytics/AnalyticsDateRange.php` | 2353 | Shared support utility/concern. |
| `app/Support/AppConfig.php` | 1033 | Shared support utility/concern. |
| `app/Support/Billing/Currency.php` | 1119 | Shared support utility/concern. |
| `app/Support/Billing/Discounts.php` | 1300 | Shared support utility/concern. |
| `app/Support/Billing/InvoiceCalculator.php` | 1657 | Shared support utility/concern. |
| `app/Support/Billing/PaymentMethod.php` | 1624 | Shared support utility/concern. |
| `app/Support/Billing/TaxRate.php` | 407 | Shared support utility/concern. |
| `app/Support/Dashboard/DashboardAccess.php` | 10842 | Shared support utility/concern. |
| `app/Support/Data.php` | 1370 | Shared support utility/concern. |
| `app/Support/Dates/FiscalYear.php` | 2075 | Shared support utility/concern. |
| `app/Support/Filament/GlobalSearchBadge.php` | 863 | Shared support utility/concern. |
| `app/Support/Invoices/InvoiceDocument.php` | 5065 | Shared support utility/concern. |
| `app/Support/Invoices/InvoiceDocumentNotRenderable.php` | 886 | Shared support utility/concern. |
| `app/Support/Invoices/InvoicePdfRenderer.php` | 1150 | Shared support utility/concern. |
| `app/Support/Members/MemberCodeGenerator.php` | 2225 | Shared support utility/concern. |
| `app/Support/Roles/BusinessRoleManager.php` | 2318 | Shared support utility/concern. |
| `app/Support/Roles/BusinessRoleManager.php.bak` | 2318 | Shared support utility/concern. |
| `artisan` | 425 | Project file/static asset/documentation. |
| `bootstrap/app.php` | 1762 | Project file/static asset/documentation. |
| `bootstrap/cache/.gitignore` | 14 | Project file/static asset/documentation. |
| `bootstrap/providers.php` | 173 | Project file/static asset/documentation. |
| `composer.json` | 3346 | Project file/static asset/documentation. |
| `composer.lock` | 478480 | Project file/static asset/documentation. |
| `config/app.php` | 4636 | Configuration file. |
| `config/auth.php` | 4163 | Configuration file. |
| `config/cache.php` | 3476 | Configuration file. |
| `config/database.php` | 6381 | Configuration file. |
| `config/filament-shield.php` | 10482 | Configuration file. |
| `config/filament.php` | 3298 | Configuration file. |
| `config/filesystems.php` | 2500 | Configuration file. |
| `config/logging.php` | 4318 | Configuration file. |
| `config/mail.php` | 3605 | Configuration file. |
| `config/permission.php` | 7049 | Configuration file. |
| `config/prevent-deletion.php` | 760 | Configuration file. |
| `config/queue.php` | 3824 | Configuration file. |
| `config/sanctum.php` | 3046 | Configuration file. |
| `config/scramble.php` | 2218 | Configuration file. |
| `config/services.php` | 1035 | Configuration file. |
| `config/session.php` | 7851 | Configuration file. |
| `config/world.php` | 4659 | Configuration file. |
| `database/.gitignore` | 10 | Project file/static asset/documentation. |
| `database/factories/EnquiryFactory.php` | 1546 | Model factory for tests/seeding. |
| `database/factories/ExpenseFactory.php` | 1728 | Model factory for tests/seeding. |
| `database/factories/FollowUpFactory.php` | 850 | Model factory for tests/seeding. |
| `database/factories/InvoiceFactory.php` | 1663 | Model factory for tests/seeding. |
| `database/factories/MemberFactory.php` | 1361 | Model factory for tests/seeding. |
| `database/factories/PlanFactory.php` | 880 | Model factory for tests/seeding. |
| `database/factories/ServiceFactory.php` | 502 | Model factory for tests/seeding. |
| `database/factories/SubscriptionFactory.php` | 2180 | Model factory for tests/seeding. |
| `database/factories/UserFactory.php` | 964 | Model factory for tests/seeding. |
| `database/migrations/0001_01_01_000000_create_users_table.php` | 2113 | Database migration/schema change. |
| `database/migrations/0001_01_01_000001_create_cache_table.php` | 849 | Database migration/schema change. |
| `database/migrations/0001_01_01_000002_create_jobs_table.php` | 1812 | Database migration/schema change. |
| `database/migrations/2025_05_26_020228_create_enquiries_table.php` | 1485 | Database migration/schema change. |
| `database/migrations/2025_05_27_065258_create_follow_ups_table.php` | 1056 | Database migration/schema change. |
| `database/migrations/2025_06_02_113254_create_services_table.php` | 671 | Database migration/schema change. |
| `database/migrations/2025_06_04_100009_create_plans_table.php` | 1003 | Database migration/schema change. |
| `database/migrations/2025_06_09_100252_create_permission_tables.php` | 7114 | Database migration/schema change. |
| `database/migrations/2025_06_10_101915_create_members_table.php` | 1504 | Database migration/schema change. |
| `database/migrations/2025_06_11_134644_create_subscriptions_table.php` | 1202 | Database migration/schema change. |
| `database/migrations/2025_06_13_005807_create_invoices_table.php` | 1444 | Database migration/schema change. |
| `database/migrations/2025_06_15_102321_create_notifications_table.php` | 726 | Database migration/schema change. |
| `database/migrations/2025_09_15_025013_create_personal_access_tokens_table.php` | 863 | Database migration/schema change. |
| `database/migrations/2026_02_10_000001_create_expenses_table.php` | 1057 | Database migration/schema change. |
| `database/migrations/2026_02_12_000001_create_invoice_transactions_table.php` | 1090 | Database migration/schema change. |
| `database/migrations/2026_03_14_060518_normalize_invoice_subscription_fee_to_gross.php` | 1208 | Database migration/schema change. |
| `database/migrations/2026_06_19_000001_create_gyms_table.php` | 1249 | Database migration/schema change. |
| `database/migrations/2026_06_19_000002_create_gym_user_table.php` | 833 | Database migration/schema change. |
| `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php` | 4223 | Database migration/schema change. |
| `database/migrations/2026_06_19_000004_add_gym_id_to_spatie_roles_table.php` | 3000 | Database migration/schema change. |
| `database/migrations/2026_06_20_000001_add_owner_fields_to_gyms_table.php` | 1130 | Database migration/schema change. |
| `database/migrations/2026_06_20_000002_add_assigned_id_to_gyms_table.php` | 852 | Database migration/schema change. |
| `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php` | 668 | Database migration/schema change. |
| `database/migrations/2026_06_20_000004_convert_users_email_to_username.php` | 885 | Database migration/schema change. |
| `database/migrations/2026_06_20_000005_remove_contact_details_from_gyms_table.php` | 870 | Database migration/schema change. |
| `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php` | 1586 | Database migration/schema change. |
| `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php` | 1222 | Database migration/schema change. |
| `database/migrations/2026_06_20_000008_create_system_admins_table.php` | 1450 | Database migration/schema change. |
| `database/migrations/2026_06_20_000009_purge_administrator_roles.php` | 813 | Database migration/schema change. |
| `database/migrations/2026_06_20_000010_strip_cluttered_fields_from_users_table.php` | 1324 | Database migration/schema change. |
| `database/migrations/2026_06_20_000011_database_segregation_audit.php` | 1033 | Database migration/schema change. |
| `database/migrations/2026_06_21_000001_create_system_plans_table.php` | 964 | Database migration/schema change. |
| `database/migrations/2026_06_21_000002_create_gym_subscriptions_table.php` | 1244 | Database migration/schema change. |
| `database/migrations/2026_06_21_000003_add_expiry_columns_to_gyms.php` | 1405 | Database migration/schema change. |
| `database/migrations/2026_06_21_000004_add_map_link_to_gyms.php` | 617 | Database migration/schema change. |
| `database/migrations/2026_06_21_000005_cleanup_duplicate_roles.php` | 3434 | Database migration/schema change. |
| `database/migrations/2026_06_22_000001_create_system_roles_table.php` | 669 | Database migration/schema change. |
| `database/migrations/2026_06_22_000002_create_system_role_assignment_table.php` | 816 | Database migration/schema change. |
| `database/migrations/2026_06_22_000003_cleanup_duplicate_roles.php` | 3329 | Database migration/schema change. |
| `database/migrations/2026_06_22_999999_add_business_details_to_gyms_table.php` | 1181 | Database migration/schema change. |
| `database/migrations/2026_06_23_000001_align_gym_subscriptions_schema.php` | 1875 | Database migration/schema change. |
| `database/migrations/2026_06_23_000002_drop_gym_subscription_payment_columns.php` | 2619 | Database migration/schema change. |
| `database/migrations/2026_06_24_000100_remove_predefined_business_roles.php` | 1693 | Database migration/schema change. |
| `database/migrations/2026_06_24_000200_separate_system_and_business_access.php` | 2240 | Database migration/schema change. |
| `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php` | 2659 | Database migration/schema change. |
| `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php` | 4832 | Database migration/schema change. |
| `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php` | 6654 | Database migration/schema change. |
| `database/seeders/DashboardDemoSeeder.php` | 14046 | Database seeder. |
| `database/seeders/DatabaseSeeder.php` | 1927 | Database seeder. |
| `database/seeders/EnquirySeeder.php` | 329 | Database seeder. |
| `database/seeders/ExpenseSeeder.php` | 273 | Database seeder. |
| `database/seeders/ExpiringGymSubscriptionNotification.php` | 2691 | Database seeder. |
| `database/seeders/FeatureOneTemporaryTestDataSeeder.php` | 17152 | Database seeder. |
| `database/seeders/FollowUpSeeder.php` | 332 | Database seeder. |
| `database/seeders/GymTenancySeeder.php` | 2255 | Database seeder. |
| `database/seeders/InvoiceSeeder.php` | 329 | Database seeder. |
| `database/seeders/MandatoryTemporaryTestDataSeeder.php` | 21575 | Database seeder. |
| `database/seeders/MemberSeeder.php` | 260 | Database seeder. |
| `database/seeders/PlanSeeder.php` | 262 | Database seeder. |
| `database/seeders/ServiceSeeder.php` | 353 | Database seeder. |
| `database/seeders/SubscriptionSeeder.php` | 345 | Database seeder. |
| `database/seeders/SystemRolesSeeder.php` | 1063 | Database seeder. |
| `database/seeders/UserSeeder.php` | 503 | Database seeder. |
| `database/seeders/WorldSeeder.php` | 216 | Database seeder. |
| `package-lock.json` | 90594 | Project file/static asset/documentation. |
| `package.json` | 356 | Project file/static asset/documentation. |
| `phpunit.xml` | 1246 | Project file/static asset/documentation. |
| `public/.htaccess` | 740 | Project file/static asset/documentation. |
| `public/css/app/gymie-styles.css` | 511 | Project file/static asset/documentation. |
| `public/css/filament/filament/app.css` | 605048 | Project file/static asset/documentation. |
| `public/css/filament/forms/forms.css` | 83366 | Project file/static asset/documentation. |
| `public/css/filament/support/support.css` | 3147 | Project file/static asset/documentation. |
| `public/favicon.ico` | 0 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/index.css` | 2002 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-cyrillic-ext-wght-normal-IYF56FF6.woff2` | 25960 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-cyrillic-wght-normal-JEOLYBOO.woff2` | 18748 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-greek-ext-wght-normal-EOVOK2B5.woff2` | 11232 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-greek-wght-normal-IRE366VL.woff2` | 18996 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-latin-ext-wght-normal-HA22NDSG.woff2` | 85068 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-latin-wght-normal-NRMW37G5.woff2` | 48256 | Project file/static asset/documentation. |
| `public/fonts/filament/filament/inter/inter-vietnamese-wght-normal-CE5GGD3W.woff2` | 10252 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Black.ttf` | 344820 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-BlackItalic.ttf` | 348712 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Bold.ttf` | 344152 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-BoldItalic.ttf` | 348184 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-ExtraBold.ttf` | 345008 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-ExtraBoldItalic.ttf` | 349064 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-ExtraLight.ttf` | 343532 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-ExtraLightItalic.ttf` | 347452 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Italic-VariableFont_opsz,wght.ttf` | 904532 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Italic.ttf` | 346480 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Light.ttf` | 343704 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-LightItalic.ttf` | 347316 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Medium.ttf` | 343200 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-MediumItalic.ttf` | 346884 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Regular.ttf` | 342680 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-SemiBold.ttf` | 343828 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-SemiBoldItalic.ttf` | 347760 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-Thin.ttf` | 343088 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-ThinItalic.ttf` | 346916 | Project file/static asset/documentation. |
| `public/fonts/inter/Inter-VariableFont_opsz,wght.ttf` | 874708 | Project file/static asset/documentation. |
| `public/fonts/inter/OFL.txt` | 4377 | Project file/static asset/documentation. |
| `public/fonts/inter/README.txt` | 3894 | Project file/static asset/documentation. |
| `public/index.php` | 543 | Project file/static asset/documentation. |
| `public/js/filament/actions/actions.js` | 1704 | Project file/static asset/documentation. |
| `public/js/filament/filament/app.js` | 11812 | Project file/static asset/documentation. |
| `public/js/filament/filament/echo.js` | 91906 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/checkbox-list.js` | 1754 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/code-editor.js` | 985427 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/color-picker.js` | 9870 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/date-time-picker.js` | 123542 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/file-upload.js` | 372835 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/key-value.js` | 1023 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/markdown-editor.js` | 522136 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/rich-editor.js` | 499604 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/select.js` | 85165 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/slider.js` | 28931 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/tags-input.js` | 814 | Project file/static asset/documentation. |
| `public/js/filament/forms/components/textarea.js` | 769 | Project file/static asset/documentation. |
| `public/js/filament/notifications/notifications.js` | 5907 | Project file/static asset/documentation. |
| `public/js/filament/schemas/components/actions.js` | 876 | Project file/static asset/documentation. |
| `public/js/filament/schemas/components/tabs.js` | 4075 | Project file/static asset/documentation. |
| `public/js/filament/schemas/components/wizard.js` | 2134 | Project file/static asset/documentation. |
| `public/js/filament/schemas/schemas.js` | 2672 | Project file/static asset/documentation. |
| `public/js/filament/support/support.js` | 140749 | Project file/static asset/documentation. |
| `public/js/filament/tables/components/columns/checkbox.js` | 910 | Project file/static asset/documentation. |
| `public/js/filament/tables/components/columns/select.js` | 85811 | Project file/static asset/documentation. |
| `public/js/filament/tables/components/columns/text-input.js` | 1071 | Project file/static asset/documentation. |
| `public/js/filament/tables/components/columns/toggle.js` | 910 | Project file/static asset/documentation. |
| `public/js/filament/tables/components/table.js` | 3327 | Project file/static asset/documentation. |
| `public/js/filament/tables/tables.js` | 22743 | Project file/static asset/documentation. |
| `public/js/filament/widgets/components/chart.js` | 283292 | Project file/static asset/documentation. |
| `public/js/filament/widgets/components/stats-overview/stat/chart.js` | 206491 | Project file/static asset/documentation. |
| `public/robots.txt` | 24 | Project file/static asset/documentation. |
| `reports/bugfix_implementation_summary.md` | 2219 | Project file/static asset/documentation. |
| `reports/deep_bug_report.md` | 19142 | Project file/static asset/documentation. |
| `resources/css/app.css` | 414 | Project file/static asset/documentation. |
| `resources/css/custom.css` | 511 | Project file/static asset/documentation. |
| `resources/css/filament/admin/theme.css` | 190 | Project file/static asset/documentation. |
| `resources/js/app.js` | 22 | Project file/static asset/documentation. |
| `resources/js/bootstrap.js` | 127 | Project file/static asset/documentation. |
| `resources/lang/ar/app.php` | 25861 | Localization file. |
| `resources/lang/en/app.php` | 22130 | Localization file. |
| `resources/lang/fa/app.php` | 28593 | Localization file. |
| `resources/lang/fr/app.php` | 22984 | Localization file. |
| `resources/views/components/train-stepper.blade.php` | 1882 | Blade view/template. |
| `resources/views/emails/invoices/issued.blade.php` | 2823 | Blade view/template. |
| `resources/views/emails/invoices/layout.blade.php` | 1721 | Blade view/template. |
| `resources/views/emails/invoices/payment-received.blade.php` | 2305 | Blade view/template. |
| `resources/views/errors/gym-suspended.blade.php` | 3018 | Blade view/template. |
| `resources/views/filament/components/locale-switcher.blade.php` | 1622 | Blade view/template. |
| `resources/views/filament/pages/billing.blade.php` | 4818 | Blade view/template. |
| `resources/views/filament/pages/dashboard-header.blade.php` | 1538 | Blade view/template. |
| `resources/views/filament/pages/dashboard-locked.blade.php` | 1259 | Blade view/template. |
| `resources/views/filament/pages/settings.blade.php` | 400 | Blade view/template. |
| `resources/views/filament/widgets/analytics/expense-spending-overview.blade.php` | 4714 | Blade view/template. |
| `resources/views/invoices/document.blade.php` | 15805 | Blade view/template. |
| `resources/views/invoices/error.blade.php` | 2924 | Blade view/template. |
| `resources/views/welcome.blade.php` | 82540 | Blade view/template. |
| `routes/api.php` | 5716 | Route registration. |
| `routes/console.php` | 1070 | Route registration. |
| `routes/web.php` | 1007 | Route registration. |
| `storage/app/.gitignore` | 33 | Project file/static asset/documentation. |
| `storage/app/private/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/app/public/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/data/.gitignore` | 29 | Project file/static asset/documentation. |
| `storage/data/settingsData.json.example` | 698 | Project file/static asset/documentation. |
| `storage/fonts/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/framework/.gitignore` | 119 | Project file/static asset/documentation. |
| `storage/framework/cache/.gitignore` | 21 | Project file/static asset/documentation. |
| `storage/framework/cache/data/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/framework/sessions/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/framework/testing/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/framework/views/.gitignore` | 14 | Project file/static asset/documentation. |
| `storage/logs/.gitignore` | 14 | Project file/static asset/documentation. |
| `tests/BaseGymieTest.php` | 1262 | Project file/static asset/documentation. |
| `tests/Feature/Api/AnalyticsApiTest.php` | 1179 | Feature/integration/UI backend test. |
| `tests/Feature/Api/ApiCrudFlowTest.php` | 3839 | Feature/integration/UI backend test. |
| `tests/Feature/Api/ApiPermissionsTest.php` | 1052 | Feature/integration/UI backend test. |
| `tests/Feature/Api/AuthApiTest.php` | 1537 | Feature/integration/UI backend test. |
| `tests/Feature/Api/LocaleApiTest.php` | 992 | Feature/integration/UI backend test. |
| `tests/Feature/Api/RichFilteringApiTest.php` | 2390 | Feature/integration/UI backend test. |
| `tests/Feature/Api/SettingsApiTest.php` | 729 | Feature/integration/UI backend test. |
| `tests/Feature/ApiTest.php` | 898 | Feature/integration/UI backend test. |
| `tests/Feature/BusinessSlugLoginTest.php` | 3515 | Feature/integration/UI backend test. |
| `tests/Feature/CascadingSoftDeletesTest.php` | 1698 | Feature/integration/UI backend test. |
| `tests/Feature/DashboardDemoSeederTest.php` | 2882 | Feature/integration/UI backend test. |
| `tests/Feature/ExampleTest.php` | 146 | Feature/integration/UI backend test. |
| `tests/Feature/ExpiringNotificationCommandTest.php` | 3968 | Feature/integration/UI backend test. |
| `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` | 5810 | Feature/integration/UI backend test. |
| `tests/Feature/FacilityStaffRelationManagerTest.php` | 3289 | Feature/integration/UI backend test. |
| `tests/Feature/FinancialMetricsWidgetTest.php` | 1136 | Feature/integration/UI backend test. |
| `tests/Feature/FollowUpTest.php` | 489 | Feature/integration/UI backend test. |
| `tests/Feature/InvoiceDocumentControllerTest.php` | 4018 | Feature/integration/UI backend test. |
| `tests/Feature/InvoiceDocumentViewRendersTest.php` | 603 | Feature/integration/UI backend test. |
| `tests/Feature/InvoiceEmailServiceTest.php` | 1963 | Feature/integration/UI backend test. |
| `tests/Feature/InvoiceIssuedEmailJobTest.php` | 1922 | Feature/integration/UI backend test. |
| `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` | 2417 | Feature/integration/UI backend test. |
| `tests/Feature/InvoiceTotalsConsistencyTest.php` | 1992 | Feature/integration/UI backend test. |
| `tests/Feature/LeadTest.php` | 2342 | Feature/integration/UI backend test. |
| `tests/Feature/LocaleSwitcherTest.php` | 2753 | Feature/integration/UI backend test. |
| `tests/Feature/MarkSubscriptionsStatusCommandTest.php` | 2645 | Feature/integration/UI backend test. |
| `tests/Feature/MemberTest.php` | 2036 | Feature/integration/UI backend test. |
| `tests/Feature/MembershipMetricsWidgetTest.php` | 1583 | Feature/integration/UI backend test. |
| `tests/Feature/PaymentTest.php` | 461 | Feature/integration/UI backend test. |
| `tests/Feature/RecentTransactionsTableWidgetTest.php` | 2575 | Feature/integration/UI backend test. |
| `tests/Feature/RolePermissionTest.php` | 428 | Feature/integration/UI backend test. |
| `tests/Feature/SettingsPagePersistenceTest.php` | 1845 | Feature/integration/UI backend test. |
| `tests/Feature/SubscriptionTest.php` | 483 | Feature/integration/UI backend test. |
| `tests/Feature/TenantIsolationTest.php` | 1496 | Feature/integration/UI backend test. |
| `tests/Feature/UserCreateFormRolesTest.php` | 1913 | Feature/integration/UI backend test. |
| `tests/Feature/UserResourceExcludesAdminsTest.php` | 3143 | Feature/integration/UI backend test. |
| `tests/Feature/ValidationTest.php` | 1465 | Feature/integration/UI backend test. |
| `tests/Helpers/TestLogger.php` | 1619 | Test helper. |
| `tests/Pest.php` | 1528 | Project file/static asset/documentation. |
| `tests/Regression/RegressionTest.php` | 7756 | Regression test. |
| `tests/Security/SecurityTest.php` | 1152 | Security test. |
| `tests/TestCase.php` | 4175 | Project file/static asset/documentation. |
| `tests/Unit/AdminPanelProviderMiddlewareTest.php` | 367 | Unit test. |
| `tests/Unit/AnalyticsDateRangeTest.php` | 1346 | Unit test. |
| `tests/Unit/AnalyticsServiceTest.php` | 4422 | Unit test. |
| `tests/Unit/DashboardHeaderActionsTest.php` | 598 | Unit test. |
| `tests/Unit/DashboardLayoutTest.php` | 3069 | Unit test. |
| `tests/Unit/DiscountsTest.php` | 507 | Unit test. |
| `tests/Unit/ExampleTest.php` | 81 | Unit test. |
| `tests/Unit/FilamentLocalizationTest.php` | 2334 | Unit test. |
| `tests/Unit/FiscalYearTest.php` | 905 | Unit test. |
| `tests/Unit/FollowUpTableColumnsTest.php` | 549 | Unit test. |
| `tests/Unit/GlobalSearchConfigurationTest.php` | 5799 | Unit test. |
| `tests/Unit/InvoiceCalculatorTest.php` | 922 | Unit test. |
| `tests/Unit/InvoiceDisplayStatusLabelTest.php` | 455 | Unit test. |
| `tests/Unit/InvoiceNumberGeneratorTest.php` | 2602 | Unit test. |
| `tests/Unit/JsonSettingsRepositoryCacheTest.php` | 780 | Unit test. |
| `tests/Unit/MemberCodeGeneratorTest.php` | 1568 | Unit test. |
| `tests/Unit/PaymentMethodTest.php` | 850 | Unit test. |
| `tests/Unit/SetAppLocaleMiddlewareTest.php` | 1171 | Unit test. |
| `tests/results/error-20260626-135006.txt` | 2149 | Project file/static asset/documentation. |
| `tests/results/pass-20260626-135006.txt` | 34951 | Project file/static asset/documentation. |
| `tests/test.sh` | 7020 | Project file/static asset/documentation. |
| `vite.config.js` | 373 | Project file/static asset/documentation. |
| `zero/feature-1/change.sh` | 20193 | AI workflow planning/review/change artifact. |
| `zero/feature-1/plan.md` | 10873 | AI workflow planning/review/change artifact. |
| `zero/feature-1/review-v1.md` | 3751 | AI workflow planning/review/change artifact. |
| `zero/feature-1/security-plan.md` | 3559 | AI workflow planning/review/change artifact. |
| `zero/feature-1/test-plan.md` | 5331 | AI workflow planning/review/change artifact. |
| `zero/flow.md` | 13195 | AI workflow planning/review/change artifact. |
| `zero/security.md` | 562 | AI workflow planning/review/change artifact. |
| `zero/snapshot.md` | 378210 | AI workflow planning/review/change artifact. |

## PHP Symbols
### `app/Console/Commands/CleanupTemporaryBackups.php`
- Namespace: `App\Console\Commands`
- Classes/traits/interfaces/enums: `CleanupTemporaryBackups`
- Methods/functions: `handle()`
### `app/Console/Commands/MarkInvoiceOverdue.php`
- Namespace: `App\Console\Commands`
- Classes/traits/interfaces/enums: `MarkInvoiceOverdue`
- Methods/functions: `handle()`
### `app/Console/Commands/MarkSubscriptionsStatus.php`
- Namespace: `App\Console\Commands`
- Classes/traits/interfaces/enums: `MarkSubscriptionsStatus`
- Methods/functions: `handle()`
### `app/Console/Commands/NotifyExpiringGymSubscriptions.php`
- Namespace: `App\Console\Commands`
- Classes/traits/interfaces/enums: `NotifyExpiringGymSubscriptions`
- Methods/functions: `handle()`
### `app/Console/Commands/SyncGymSubscriptionStatus.php`
- Namespace: `App\Console\Commands`
- Classes/traits/interfaces/enums: `SyncGymSubscriptionStatus`
- Methods/functions: `handle()`
### `app/Contracts/SequenceRepository.php`
- Namespace: `App\Contracts`
- Classes/traits/interfaces/enums: `SequenceRepository`
- Methods/functions: `generate()`, `update()`
### `app/Contracts/SettingsRepository.php`
- Namespace: `App\Contracts`
- Classes/traits/interfaces/enums: `SettingsRepository`
- Methods/functions: `get()`, `put()`
### `app/Enums/FacilityRole.php`
- Namespace: `App\Enums`
- Classes/traits/interfaces/enums: `FacilityRole`
- Methods/functions: `label()`, `options()`, `spatieRole()`
### `app/Enums/Status.php`
- Namespace: `App\Enums`
- Classes/traits/interfaces/enums: `Status`
- Methods/functions: `getLabel()`, `getColor()`, `valueOf()`
### `app/Exceptions/CrossTenantException.php`
- Namespace: `App\Exceptions`
- Classes/traits/interfaces/enums: `CrossTenantException`
### `app/Filament/Concerns/HasResourceExcelActions.php`
- Namespace: `App\Filament\Concerns`
- Classes/traits/interfaces/enums: `HasResourceExcelActions`
- Methods/functions: `excelHeaderActions()`
### `app/Filament/Livewire/LocaleSwitcher.php`
- Namespace: `App\Filament\Livewire`
- Classes/traits/interfaces/enums: `LocaleSwitcher`
- Methods/functions: `mount()`, `getOptionsProperty()`, `getCurrentFlagProperty()`, `setLocale()`, `render()`
### `app/Filament/Pages/Auth/CustomLogin.php`
- Namespace: `App\Filament\Pages\Auth`
- Classes/traits/interfaces/enums: `CustomLogin`
- Methods/functions: `getEmailFormComponent()`, `getCredentialsFromFormData()`
### `app/Filament/Pages/Billing.php`
- Namespace: `App\Filament\Pages`
- Classes/traits/interfaces/enums: `Billing`
- Methods/functions: `getNavigationLabel()`, `getNavigationGroup()`, `getTitle()`, `getHeading()`, `getHeaderData()`, `getPlansProperty()`
### `app/Filament/Pages/Dashboard.php`
- Namespace: `App\Filament\Pages`
- Classes/traits/interfaces/enums: `Dashboard`
- Methods/functions: `queryString()`, `getTitle()`, `getNavigationLabel()`, `getHeader()`, `form()`, `getColumns()`, `getWidgetsContentComponent()`, `ensureDefaultFilters()`, `setPeriod()`, `applyCustomRangeFromFilters()`, `applyPresetRange()`, `applyCustomRange()`
### `app/Filament/Pages/Settings.php`
- Namespace: `App\Filament\Pages`
- Classes/traits/interfaces/enums: `Settings`
- Methods/functions: `mount()`, `getTitle()`, `getNavigationLabel()`, `getHeaderActions()`, `getFormSchema()`, `generalTab()`, `invoiceTab()`, `memberTab()`, `chargesTab()`, `expensesTab()`, `subscriptionsTab()`, `form()`, `save()`, `handleFileUpload()`
### `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- Namespace: `App\Filament\Resources\BusinessRoleResource\Pages`
- Classes/traits/interfaces/enums: `CreateBusinessRole`
- Methods/functions: `mutateFormDataBeforeCreate()`, `afterCreate()`
### `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- Namespace: `App\Filament\Resources\BusinessRoleResource\Pages`
- Classes/traits/interfaces/enums: `EditBusinessRole`
- Methods/functions: `mutateFormDataBeforeSave()`, `afterSave()`
### `app/Filament/Resources/BusinessRoleResource/Pages/ListBusinessRoles.php`
- Namespace: `App\Filament\Resources\BusinessRoleResource\Pages`
- Classes/traits/interfaces/enums: `ListBusinessRoles`
- Methods/functions: `getHeaderActions()`
### `app/Filament/Resources/BusinessRoleResource.php`
- Namespace: `App\Filament\Resources`
- Classes/traits/interfaces/enums: `BusinessRoleResource`
- Methods/functions: `shouldRegisterNavigation()`, `canAccess()`, `canViewAny()`, `canCreate()`, `canEdit()`, `canDelete()`, `getNavigationIcon()`, `form()`, `table()`, `getEloquentQuery()`, `getPages()`, `canManage()`
### `app/Filament/Resources/Enquiries/EnquiryResource.php`
- Namespace: `App\Filament\Resources\Enquiries`
- Classes/traits/interfaces/enums: `EnquiryResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `modifyGlobalSearchQuery()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getRelations()`, `getPages()`, `getRecordRouteBindingEloquentQuery()`
### `app/Filament/Resources/Enquiries/Pages/CreateEnquiry.php`
- Namespace: `App\Filament\Resources\Enquiries\Pages`
- Classes/traits/interfaces/enums: `CreateEnquiry`
- Methods/functions: `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php`
- Namespace: `App\Filament\Resources\Enquiries\Pages`
- Classes/traits/interfaces/enums: `EditEnquiry`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php`
- Namespace: `App\Filament\Resources\Enquiries\Pages`
- Classes/traits/interfaces/enums: `ListEnquiries`
- Methods/functions: `getHeaderActions()`, `getBreadcrumbs()`, `getTabs()`
### `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php`
- Namespace: `App\Filament\Resources\Enquiries\Pages`
- Classes/traits/interfaces/enums: `ViewEnquiry`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php`
- Namespace: `App\Filament\Resources\Enquiries\RelationManagers`
- Classes/traits/interfaces/enums: `FollowUpsRelationManager`
- Methods/functions: `form()`, `table()`, `getLiveRoleOptions()`
### `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php`
- Namespace: `App\Filament\Resources\Enquiries\Schemas`
- Classes/traits/interfaces/enums: `EnquiryForm`
- Methods/functions: `configure()`
### `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php`
- Namespace: `App\Filament\Resources\Enquiries\Schemas`
- Classes/traits/interfaces/enums: `EnquiryInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php`
- Namespace: `App\Filament\Resources\Enquiries\Tables`
- Classes/traits/interfaces/enums: `EnquiryTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/Expenses/ExpenseResource.php`
- Namespace: `App\Filament\Resources\Expenses`
- Classes/traits/interfaces/enums: `ExpenseResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getPages()`
### `app/Filament/Resources/Expenses/Pages/ListExpenses.php`
- Namespace: `App\Filament\Resources\Expenses\Pages`
- Classes/traits/interfaces/enums: `ListExpenses`
- Methods/functions: `getHeaderActions()`, `getBreadcrumbs()`, `getTabs()`
### `app/Filament/Resources/Expenses/Pages/ViewExpense.php`
- Namespace: `App\Filament\Resources\Expenses\Pages`
- Classes/traits/interfaces/enums: `ViewExpense`
- Methods/functions: `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php`
- Namespace: `App\Filament\Resources\Expenses\Schemas`
- Classes/traits/interfaces/enums: `ExpenseForm`
- Methods/functions: `getStatusOptions()`, `configure()`
### `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php`
- Namespace: `App\Filament\Resources\Expenses\Schemas`
- Classes/traits/interfaces/enums: `ExpenseInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Expenses/Tables/ExpenseTable.php`
- Namespace: `App\Filament\Resources\Expenses\Tables`
- Classes/traits/interfaces/enums: `ExpenseTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/FollowUps/FollowUpResource.php`
- Namespace: `App\Filament\Resources\FollowUps`
- Classes/traits/interfaces/enums: `FollowUpResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `modifyGlobalSearchQuery()`, `getGlobalSearchResultTitle()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getPages()`
### `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php`
- Namespace: `App\Filament\Resources\FollowUps\Pages`
- Classes/traits/interfaces/enums: `ListFollowUps`
- Methods/functions: `getHeaderActions()`, `getBreadcrumbs()`, `getTabs()`
### `app/Filament/Resources/FollowUps/Schemas/FollowUpForm.php`
- Namespace: `App\Filament\Resources\FollowUps\Schemas`
- Classes/traits/interfaces/enums: `FollowUpForm`
- Methods/functions: `configure()`
### `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php`
- Namespace: `App\Filament\Resources\FollowUps\Schemas`
- Classes/traits/interfaces/enums: `FollowUpInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php`
- Namespace: `App\Filament\Resources\FollowUps\Tables`
- Classes/traits/interfaces/enums: `FollowUpTable`
- Methods/functions: `getColumns()`, `configure()`, `getTableFilters()`, `getTableActions()`
### `app/Filament/Resources/GymResource/Pages/CreateGym.php`
- Namespace: `App\Filament\Resources\GymResource\Pages`
- Classes/traits/interfaces/enums: `CreateGym`
- Methods/functions: `getRedirectUrl()`, `mutateFormDataBeforeCreate()`, `afterCreate()`
### `app/Filament/Resources/GymResource/Pages/EditGym.php`
- Namespace: `App\Filament\Resources\GymResource\Pages`
- Classes/traits/interfaces/enums: `EditGym`
- Methods/functions: `getHeaderActions()`, `getRedirectUrl()`
### `app/Filament/Resources/GymResource/Pages/ListGyms.php`
- Namespace: `App\Filament\Resources\GymResource\Pages`
- Classes/traits/interfaces/enums: `ListGyms`
- Methods/functions: `getHeaderActions()`
### `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php`
- Namespace: `App\Filament\Resources\GymResource\RelationManagers`
- Classes/traits/interfaces/enums: `UsersRelationManager`
- Methods/functions: `table()`
### `app/Filament/Resources/GymResource.php`
- Namespace: `App\Filament\Resources`
- Classes/traits/interfaces/enums: `GymResource`
- Methods/functions: `getNavigationIcon()`, `getGloballySearchableAttributes()`, `getGlobalSearchResultDetails()`, `shouldRegisterNavigation()`, `canAccess()`, `form()`, `table()`, `getRelations()`, `getPages()`
### `app/Filament/Resources/GymSubscriptionResource/Pages/CreateGymSubscription.php`
- Namespace: `App\Filament\Resources\GymSubscriptionResource\Pages`
- Classes/traits/interfaces/enums: `CreateGymSubscription`
- Methods/functions: `mutateFormDataBeforeCreate()`, `getRedirectUrl()`, `afterCreate()`
### `app/Filament/Resources/GymSubscriptionResource/Pages/EditGymSubscription.php`
- Namespace: `App\Filament\Resources\GymSubscriptionResource\Pages`
- Classes/traits/interfaces/enums: `EditGymSubscription`
- Methods/functions: `mutateFormDataBeforeSave()`, `getHeaderActions()`, `getRedirectUrl()`, `afterSave()`
### `app/Filament/Resources/GymSubscriptionResource/Pages/ListGymSubscriptions.php`
- Namespace: `App\Filament\Resources\GymSubscriptionResource\Pages`
- Classes/traits/interfaces/enums: `ListGymSubscriptions`
- Methods/functions: `getHeaderActions()`
### `app/Filament/Resources/GymSubscriptionResource.php`
- Namespace: `App\Filament\Resources`
- Classes/traits/interfaces/enums: `GymSubscriptionResource`
- Methods/functions: `getNavigationIcon()`, `shouldRegisterNavigation()`, `canAccess()`, `getNavigationBadge()`, `getNavigationBadgeColor()`, `form()`, `table()`, `getPages()`
### `app/Filament/Resources/Invoices/InvoiceResource.php`
- Namespace: `App\Filament\Resources\Invoices`
- Classes/traits/interfaces/enums: `InvoiceResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `modifyGlobalSearchQuery()`, `getGlobalSearchResultDetails()`, `canCreate()`, `form()`, `table()`, `infolist()`, `getRelations()`, `getPages()`
### `app/Filament/Resources/Invoices/Pages/CreateInvoice.php`
- Namespace: `App\Filament\Resources\Invoices\Pages`
- Classes/traits/interfaces/enums: `CreateInvoice`
- Methods/functions: `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Invoices/Pages/EditInvoice.php`
- Namespace: `App\Filament\Resources\Invoices\Pages`
- Classes/traits/interfaces/enums: `EditInvoice`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Invoices/Pages/ListInvoices.php`
- Namespace: `App\Filament\Resources\Invoices\Pages`
- Classes/traits/interfaces/enums: `ListInvoices`
- Methods/functions: `getHeaderActions()`, `getTabs()`, `getBreadcrumbs()`
### `app/Filament/Resources/Invoices/Pages/ViewInvoice.php`
- Namespace: `App\Filament\Resources\Invoices\Pages`
- Classes/traits/interfaces/enums: `ViewInvoice`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php`
- Namespace: `App\Filament\Resources\Invoices\RelationManagers`
- Classes/traits/interfaces/enums: `InvoiceTransactionsRelationManager`
- Methods/functions: `getTitle()`, `isReadOnly()`, `table()`
### `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php`
- Namespace: `App\Filament\Resources\Invoices\Schemas`
- Classes/traits/interfaces/enums: `InvoiceForm`
- Methods/functions: `configure()`, `formatSubscriptionOptionLabel()`, `stringState()`, `intState()`, `floatState()`
### `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php`
- Namespace: `App\Filament\Resources\Invoices\Schemas`
- Classes/traits/interfaces/enums: `InvoiceInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Invoices/Tables/InvoiceTable.php`
- Namespace: `App\Filament\Resources\Invoices\Tables`
- Classes/traits/interfaces/enums: `InvoiceTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/Members/MemberResource.php`
- Namespace: `App\Filament\Resources\Members`
- Classes/traits/interfaces/enums: `MemberResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getRelations()`, `getPages()`, `getEloquentQuery()`
### `app/Filament/Resources/Members/Pages/CreateMember.php`
- Namespace: `App\Filament\Resources\Members\Pages`
- Classes/traits/interfaces/enums: `CreateMember`
- Methods/functions: `mount()`, `afterCreate()`, `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Members/Pages/EditMember.php`
- Namespace: `App\Filament\Resources\Members\Pages`
- Classes/traits/interfaces/enums: `EditMember`
- Methods/functions: `getHeaderActions()`, `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Members/Pages/ListMembers.php`
- Namespace: `App\Filament\Resources\Members\Pages`
- Classes/traits/interfaces/enums: `ListMembers`
- Methods/functions: `getHeaderActions()`, `getTabs()`, `getBreadcrumbs()`
### `app/Filament/Resources/Members/Pages/ViewMember.php`
- Namespace: `App\Filament\Resources\Members\Pages`
- Classes/traits/interfaces/enums: `ViewMember`
- Methods/functions: `mount()`, `getHeaderActions()`, `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php`
- Namespace: `App\Filament\Resources\Members\RelationManagers`
- Classes/traits/interfaces/enums: `SubscriptionsRelationManager`
- Methods/functions: `getTitle()`, `isReadOnly()`, `form()`, `table()`
### `app/Filament/Resources/Members/Schemas/MemberForm.php`
- Namespace: `App\Filament\Resources\Members\Schemas`
- Classes/traits/interfaces/enums: `MemberForm`
- Methods/functions: `configure()`
### `app/Filament/Resources/Members/Schemas/MemberInfolist.php`
- Namespace: `App\Filament\Resources\Members\Schemas`
- Classes/traits/interfaces/enums: `MemberInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Members/Tables/MemberTable.php`
- Namespace: `App\Filament\Resources\Members\Tables`
- Classes/traits/interfaces/enums: `MemberTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/Plans/Pages/ListPlans.php`
- Namespace: `App\Filament\Resources\Plans\Pages`
- Classes/traits/interfaces/enums: `ListPlans`
- Methods/functions: `getHeaderActions()`, `getBreadcrumbs()`, `getTabs()`
### `app/Filament/Resources/Plans/PlanResource.php`
- Namespace: `App\Filament\Resources\Plans`
- Classes/traits/interfaces/enums: `PlanResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `modifyGlobalSearchQuery()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getPages()`
### `app/Filament/Resources/Plans/Schemas/PlanForm.php`
- Namespace: `App\Filament\Resources\Plans\Schemas`
- Classes/traits/interfaces/enums: `PlanForm`
- Methods/functions: `configure()`
### `app/Filament/Resources/Plans/Schemas/PlanInfolist.php`
- Namespace: `App\Filament\Resources\Plans\Schemas`
- Classes/traits/interfaces/enums: `PlanInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Plans/Tables/PlanTable.php`
- Namespace: `App\Filament\Resources\Plans\Tables`
- Classes/traits/interfaces/enums: `PlanTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/Services/Pages/ListServices.php`
- Namespace: `App\Filament\Resources\Services\Pages`
- Classes/traits/interfaces/enums: `ListServices`
- Methods/functions: `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Services/Schemas/ServiceForm.php`
- Namespace: `App\Filament\Resources\Services\Schemas`
- Classes/traits/interfaces/enums: `ServiceForm`
- Methods/functions: `configure()`
### `app/Filament/Resources/Services/Schemas/ServiceInfolist.php`
- Namespace: `App\Filament\Resources\Services\Schemas`
- Classes/traits/interfaces/enums: `ServiceInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Services/ServiceResource.php`
- Namespace: `App\Filament\Resources\Services`
- Classes/traits/interfaces/enums: `ServiceResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getPages()`
### `app/Filament/Resources/Services/Tables/ServiceTable.php`
- Namespace: `App\Filament\Resources\Services\Tables`
- Classes/traits/interfaces/enums: `ServiceTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/Subscriptions/Pages/CreateSubscription.php`
- Namespace: `App\Filament\Resources\Subscriptions\Pages`
- Classes/traits/interfaces/enums: `CreateSubscription`
- Methods/functions: `getTitle()`, `getBreadcrumbs()`
### `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php`
- Namespace: `App\Filament\Resources\Subscriptions\Pages`
- Classes/traits/interfaces/enums: `EditSubscription`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php`
- Namespace: `App\Filament\Resources\Subscriptions\Pages`
- Classes/traits/interfaces/enums: `ListSubscriptions`
- Methods/functions: `getHeaderActions()`, `getTabs()`, `getBreadcrumbs()`
### `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php`
- Namespace: `App\Filament\Resources\Subscriptions\Pages`
- Classes/traits/interfaces/enums: `ViewSubscription`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php`
- Namespace: `App\Filament\Resources\Subscriptions\RelationManagers`
- Classes/traits/interfaces/enums: `InvoicesRelationManager`
- Methods/functions: `getTitle()`, `isReadOnly()`, `form()`, `table()`
### `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php`
- Namespace: `App\Filament\Resources\Subscriptions\Schemas`
- Classes/traits/interfaces/enums: `SubscriptionForm`
- Methods/functions: `paymentMethodOptions()`, `configure()`, `renewSchema()`, `handleRenew()`, `recalculateRenewInvoiceSummary()`, `recalculateInvoiceSummary()`, `formatPlanOptionLabel()`, `invoiceItems()`, `stringState()`, `intState()`, `floatState()`, `planFromState()`
### `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php`
- Namespace: `App\Filament\Resources\Subscriptions\Schemas`
- Classes/traits/interfaces/enums: `SubscriptionInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Subscriptions/SubscriptionResource.php`
- Namespace: `App\Filament\Resources\Subscriptions`
- Classes/traits/interfaces/enums: `SubscriptionResource`
- Methods/functions: `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `modifyGlobalSearchQuery()`, `getGlobalSearchResultTitle()`, `getGlobalSearchResultDetails()`, `form()`, `table()`, `infolist()`, `getRelations()`, `getPages()`
### `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php`
- Namespace: `App\Filament\Resources\Subscriptions\Tables`
- Classes/traits/interfaces/enums: `SubscriptionTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/SystemAdminResource/Pages/CreateSystemAdmin.php`
- Namespace: `App\Filament\Resources\SystemAdminResource\Pages`
- Classes/traits/interfaces/enums: `CreateSystemAdmin`
- Methods/functions: `getRedirectUrl()`, `afterCreate()`
### `app/Filament/Resources/SystemAdminResource/Pages/EditSystemAdmin.php`
- Namespace: `App\Filament\Resources\SystemAdminResource\Pages`
- Classes/traits/interfaces/enums: `EditSystemAdmin`
- Methods/functions: `getHeaderActions()`, `getRedirectUrl()`, `afterSave()`
### `app/Filament/Resources/SystemAdminResource/Pages/ListSystemAdmins.php`
- Namespace: `App\Filament\Resources\SystemAdminResource\Pages`
- Classes/traits/interfaces/enums: `ListSystemAdmins`
- Methods/functions: `getHeaderActions()`
### `app/Filament/Resources/SystemAdminResource.php`
- Namespace: `App\Filament\Resources`
- Classes/traits/interfaces/enums: `SystemAdminResource`
- Methods/functions: `getNavigationIcon()`, `shouldRegisterNavigation()`, `canAccess()`, `form()`, `table()`, `getPages()`
### `app/Filament/Resources/SystemPlanResource/Pages/CreateSystemPlan.php`
- Namespace: `App\Filament\Resources\SystemPlanResource\Pages`
- Classes/traits/interfaces/enums: `CreateSystemPlan`
- Methods/functions: `getRedirectUrl()`
### `app/Filament/Resources/SystemPlanResource/Pages/EditSystemPlan.php`
- Namespace: `App\Filament\Resources\SystemPlanResource\Pages`
- Classes/traits/interfaces/enums: `EditSystemPlan`
- Methods/functions: `getHeaderActions()`, `getRedirectUrl()`
### `app/Filament/Resources/SystemPlanResource/Pages/ListSystemPlans.php`
- Namespace: `App\Filament\Resources\SystemPlanResource\Pages`
- Classes/traits/interfaces/enums: `ListSystemPlans`
- Methods/functions: `getHeaderActions()`
### `app/Filament/Resources/SystemPlanResource.php`
- Namespace: `App\Filament\Resources`
- Classes/traits/interfaces/enums: `SystemPlanResource`
- Methods/functions: `getNavigationIcon()`, `shouldRegisterNavigation()`, `canAccess()`, `form()`, `table()`, `getPages()`
### `app/Filament/Resources/SystemRoleResource/Pages/CreateSystemRole.php`
- Namespace: `App\Filament\Resources\SystemRoleResource\Pages`
- Classes/traits/interfaces/enums: `CreateSystemRole`
### `app/Filament/Resources/SystemRoleResource/Pages/EditSystemRole.php`
- Namespace: `App\Filament\Resources\SystemRoleResource\Pages`
- Classes/traits/interfaces/enums: `EditSystemRole`
### `app/Filament/Resources/SystemRoleResource/Pages/ListSystemRoles.php`
- Namespace: `App\Filament\Resources\SystemRoleResource\Pages`
- Classes/traits/interfaces/enums: `ListSystemRoles`
- Methods/functions: `getHeaderActions()`
### `app/Filament/Resources/SystemRoleResource.php`
- Namespace: `App\Filament\Resources`
- Classes/traits/interfaces/enums: `SystemRoleResource`
- Methods/functions: `shouldRegisterNavigation()`, `canAccess()`, `canViewAny()`, `canCreate()`, `canEdit()`, `canDelete()`, `getNavigationIcon()`, `form()`, `table()`, `getPages()`, `canManage()`
### `app/Filament/Resources/Users/Pages/CreateUser.php`
- Namespace: `App\Filament\Resources\Users\Pages`
- Classes/traits/interfaces/enums: `CreateUser`
- Methods/functions: `getTitle()`, `getBreadcrumbs()`, `mutateFormDataBeforeCreate()`, `afterCreate()`, `resolveGym()`
### `app/Filament/Resources/Users/Pages/EditUser.php`
- Namespace: `App\Filament\Resources\Users\Pages`
- Classes/traits/interfaces/enums: `EditUser`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`, `mutateFormDataBeforeSave()`, `afterSave()`, `resolveGym()`
### `app/Filament/Resources/Users/Pages/ListUsers.php`
- Namespace: `App\Filament\Resources\Users\Pages`
- Classes/traits/interfaces/enums: `ListUsers`
- Methods/functions: `getHeaderActions()`, `getBreadcrumbs()`, `getTabs()`
### `app/Filament/Resources/Users/Pages/ViewUser.php`
- Namespace: `App\Filament\Resources\Users\Pages`
- Classes/traits/interfaces/enums: `ViewUser`
- Methods/functions: `getTitle()`, `getHeaderActions()`, `getBreadcrumbs()`
### `app/Filament/Resources/Users/Schemas/UserForm.php`
- Namespace: `App\Filament\Resources\Users\Schemas`
- Classes/traits/interfaces/enums: `UserForm`
- Methods/functions: `configure()`
### `app/Filament/Resources/Users/Schemas/UserInfolist.php`
- Namespace: `App\Filament\Resources\Users\Schemas`
- Classes/traits/interfaces/enums: `UserInfolist`
- Methods/functions: `configure()`
### `app/Filament/Resources/Users/Tables/UserTable.php`
- Namespace: `App\Filament\Resources\Users\Tables`
- Classes/traits/interfaces/enums: `UserTable`
- Methods/functions: `configure()`
### `app/Filament/Resources/Users/UserResource.php`
- Namespace: `App\Filament\Resources\Users`
- Classes/traits/interfaces/enums: `UserResource`
- Methods/functions: `shouldRegisterNavigation()`, `canAccess()`, `getModelLabel()`, `getPluralModelLabel()`, `getNavigationLabel()`, `getGloballySearchableAttributes()`, `getGlobalSearchResultTitle()`, `getGlobalSearchResultDetails()`, `getEloquentQuery()`, `form()`, `table()`, `infolist()`, `getPages()`
### `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `CashflowTrendChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `resolveRange()`, `getOptions()`, `getData()`
### `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `ExpenseCategoriesDoughnutChartWidget`
- Methods/functions: `getFilters()`, `resolveRange()`, `colorShade()`, `segmentPalette()`, `otherSegmentColor()`, `buildSegments()`, `getViewData()`
### `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `ExpiringSoonSubscriptionsTableWidget`
- Methods/functions: `getExpiringSoonQuery()`, `formatDayCount()`, `table()`
### `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `FinancialMetricsWidget`
- Methods/functions: `deltaInline()`, `valueWithDelta()`, `lockedValue()`, `primaryStatIconClasses()`, `lockedStat()`, `getStats()`
### `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `FinancialSummaryPieChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `getOptions()`, `getData()`
### `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `MemberSourceChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `resolveRange()`, `getOptions()`, `getData()`
### `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `MemberStatusPieChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `getOptions()`, `getData()`
### `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `MemberTrendChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `resolveRange()`, `getOptions()`, `getData()`
### `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `MembershipMetricsWidget`
- Methods/functions: `deltaInline()`, `valueWithDelta()`, `lockedValue()`, `primaryStatIconClasses()`, `lockedStat()`, `getStats()`
### `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `MembershipOverviewSubscriptionsTableWidget`
- Methods/functions: `updatedActiveTab()`, `tableHeader()`, `getActiveTabQuery()`, `getExpiringSoonQuery()`, `getExpiredQuery()`, `table()`
### `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `RecentTransactionsTableWidget`
- Methods/functions: `table()`
### `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `TopPlansByCollectedBarChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getData()`
### `app/Filament/Widgets/Analytics/TopPlansChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `TopPlansChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `resolveRange()`, `getOptions()`, `getData()`
### `app/Filament/Widgets/Analytics/TopServicesChartWidget.php`
- Namespace: `App\Filament\Widgets\Analytics`
- Classes/traits/interfaces/enums: `TopServicesChartWidget`
- Methods/functions: `getType()`, `getHeading()`, `getFilters()`, `resolveRange()`, `getOptions()`, `getData()`
### `app/Helpers/Helpers.php`
- Namespace: `App\Helpers`
- Classes/traits/interfaces/enums: `Helpers`
- Methods/functions: `setTestSettingsOverride()`, `getSettings()`, `appTimezone()`, `getCountries()`, `getStates()`, `getCities()`, `getCurrencies()`, `getCurrencyCode()`, `getSubscriptionExpiringDays()`, `getExpenseCategories()`, `getExpenseCategoryOptions()`, `getExpenseCategoryLabel()`, `getDiscounts()`, `getDiscountAmount()`, `getTaxRate()`, `formatCurrency()`, `getCurrencySymbol()`, `parseDate()`, `getFiscalSpan()`, `generateLastNumber()`, `updateLastNumber()`, `worldResponse()`, `calculateSubscriptionEndDate()`
### `app/Http/Controllers/Api/V1/AnalyticsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `AnalyticsController`
- Methods/functions: `financial()`, `membership()`, `cashflowTrend()`, `expenseCategories()`, `topPlans()`, `recentTransactions()`
### `app/Http/Controllers/Api/V1/ApiController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `ApiController`
- Methods/functions: `requirePermission()`, `noContent()`, `deleteModel()`, `currentUser()`, `restoreSoftDeleted()`, `forceDeleteSoftDeleted()`, `softDeletedQuery()`
### `app/Http/Controllers/Api/V1/AuthController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `AuthController`
- Methods/functions: `login()`, `me()`, `logout()`
### `app/Http/Controllers/Api/V1/EnquiriesController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `EnquiriesController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`
### `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `EnquiryFollowUpsController`
- Methods/functions: `index()`, `store()`
### `app/Http/Controllers/Api/V1/ExpensesController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `ExpensesController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`
### `app/Http/Controllers/Api/V1/FollowUpsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `FollowUpsController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`
### `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `InvoiceTransactionsController`
- Methods/functions: `index()`, `store()`, `destroy()`
### `app/Http/Controllers/Api/V1/InvoicesController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `InvoicesController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`, `pdf()`, `downloadPdf()`
### `app/Http/Controllers/Api/V1/MembersController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `MembersController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`
### `app/Http/Controllers/Api/V1/PermissionsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `PermissionsController`
- Methods/functions: `index()`
### `app/Http/Controllers/Api/V1/PlansController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `PlansController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`
### `app/Http/Controllers/Api/V1/RolesController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `RolesController`
- Methods/functions: `index()`
### `app/Http/Controllers/Api/V1/ServicesController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `ServicesController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`
### `app/Http/Controllers/Api/V1/SettingsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `SettingsController`
- Methods/functions: `show()`, `update()`
### `app/Http/Controllers/Api/V1/SubscriptionsController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `SubscriptionsController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`, `renew()`
### `app/Http/Controllers/Api/V1/UsersController.php`
- Namespace: `App\Http\Controllers\Api\V1`
- Classes/traits/interfaces/enums: `UsersController`
- Methods/functions: `index()`, `store()`, `show()`, `update()`, `destroy()`, `restore()`, `forceDelete()`, `prepareUserData()`
### `app/Http/Controllers/BusinessSlugLoginController.php`
- Namespace: `App\Http\Controllers`
- Classes/traits/interfaces/enums: `BusinessSlugLoginController`
- Methods/functions: `show()`, `store()`, `credentials()`, `userBelongsToBusiness()`, `setBusinessContext()`, `loginHtml()`
### `app/Http/Controllers/Controller.php`
- Namespace: `App\Http\Controllers`
- Classes/traits/interfaces/enums: `Controller`
### `app/Http/Controllers/InvoiceDocumentController.php`
- Namespace: `App\Http\Controllers`
- Classes/traits/interfaces/enums: `InvoiceDocumentController`
- Methods/functions: `preview()`, `download()`
### `app/Http/Middleware/CheckGymStatus.php`
- Namespace: `App\Http\Middleware`
- Classes/traits/interfaces/enums: `CheckGymStatus`
- Methods/functions: `handle()`
### `app/Http/Middleware/ForceJsonResponse.php`
- Namespace: `App\Http\Middleware`
- Classes/traits/interfaces/enums: `ForceJsonResponse`
- Methods/functions: `handle()`
### `app/Http/Middleware/SetAppLocale.php`
- Namespace: `App\Http\Middleware`
- Classes/traits/interfaces/enums: `SetAppLocale`
- Methods/functions: `handle()`
### `app/Http/Requests/Api/V1/Auth/LoginRequest.php`
- Namespace: `App\Http\Requests\Api\V1\Auth`
- Classes/traits/interfaces/enums: `LoginRequest`
- Methods/functions: `authorize()`, `rules()`, `withValidator()`
### `app/Http/Requests/Api/V1/EnquiryFollowUpStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `EnquiryFollowUpStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/EnquiryStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `EnquiryStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/EnquiryUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `EnquiryUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/ExpenseStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `ExpenseStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/ExpenseUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `ExpenseUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/FollowUpStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `FollowUpStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/FollowUpUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `FollowUpUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/InvoiceStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `InvoiceStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/InvoiceTransactionStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `InvoiceTransactionStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/InvoiceUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `InvoiceUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/MemberStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `MemberStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/MemberUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `MemberUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/PlanStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `PlanStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/PlanUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `PlanUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/ServiceStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `ServiceStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/ServiceUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `ServiceUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/SettingsUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `SettingsUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/SubscriptionRenewRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `SubscriptionRenewRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/SubscriptionStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `SubscriptionStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/SubscriptionUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `SubscriptionUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/UserStoreRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `UserStoreRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Api/V1/UserUpdateRequest.php`
- Namespace: `App\Http\Requests\Api\V1`
- Classes/traits/interfaces/enums: `UserUpdateRequest`
- Methods/functions: `authorize()`, `rules()`
### `app/Http/Requests/Concerns/ResolvesRouteKey.php`
- Namespace: `App\Http\Requests\Concerns`
- Classes/traits/interfaces/enums: `ResolvesRouteKey`
- Methods/functions: `routeKey()`
### `app/Http/Resources/V1/EnquiryResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `EnquiryResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/ExpenseResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `ExpenseResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/FollowUpResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `FollowUpResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/InvoiceResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `InvoiceResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/InvoiceTransactionResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `InvoiceTransactionResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/MemberResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `MemberResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/PermissionResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `PermissionResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/PlanResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `PlanResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/RoleResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `RoleResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/ServiceResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `ServiceResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/SubscriptionResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `SubscriptionResource`
- Methods/functions: `toArray()`
### `app/Http/Resources/V1/UserResource.php`
- Namespace: `App\Http\Resources\V1`
- Classes/traits/interfaces/enums: `UserResource`
- Methods/functions: `toArray()`
### `app/Jobs/SendInvoiceIssuedEmail.php`
- Namespace: `App\Jobs`
- Classes/traits/interfaces/enums: `SendInvoiceIssuedEmail`
- Methods/functions: `__construct()`, `handle()`
### `app/Jobs/SendInvoicePaymentReceiptEmail.php`
- Namespace: `App\Jobs`
- Classes/traits/interfaces/enums: `SendInvoicePaymentReceiptEmail`
- Methods/functions: `__construct()`, `handle()`
### `app/Mail/InvoiceIssuedMail.php`
- Namespace: `App\Mail`
- Classes/traits/interfaces/enums: `InvoiceIssuedMail`
- Methods/functions: `__construct()`, `envelope()`, `content()`, `attachments()`
### `app/Mail/InvoicePaymentReceiptMail.php`
- Namespace: `App\Mail`
- Classes/traits/interfaces/enums: `InvoicePaymentReceiptMail`
- Methods/functions: `__construct()`, `envelope()`, `content()`, `attachments()`
### `app/Models/Concerns/BelongsToGym.php`
- Namespace: `App\Models\Concerns`
- Classes/traits/interfaces/enums: `BelongsToGym`
- Methods/functions: `bootBelongsToGym()`, `gym()`
### `app/Models/Concerns/CascadesSoftDeletes.php`
- Namespace: `App\Models\Concerns`
- Classes/traits/interfaces/enums: `CascadesSoftDeletes`
- Methods/functions: `relationsToCascade()`, `cascadesRelationOnDelete()`, `bootCascadesSoftDeletes()`
### `app/Models/Enquiry.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Enquiry`
- Methods/functions: `followUps()`, `user()`, `relationsToCascade()`
### `app/Models/Expense.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Expense`
### `app/Models/FollowUp.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `FollowUp`
- Methods/functions: `enquiry()`, `user()`
### `app/Models/Gym.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Gym`
- Methods/functions: `casts()`, `booted()`, `isActive()`, `isSuspended()`, `members()`, `users()`, `facilityStaff()`, `invoices()`, `subscriptions()`, `enquiries()`, `plans()`, `services()`, `expenses()`, `gymSubscriptions()`, `systemPlan()`, `latestSubscription()`, `isExpired()`, `getExpiryDate()`, `getPlanName()`, `syncSubscriptionStatus()`, `scopeExpired()`, `scopeExpiringSoon()`
### `app/Models/GymSubscription.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `GymSubscription`
- Methods/functions: `casts()`, `deriveStatus()`, `gym()`, `systemPlan()`, `scopeActive()`, `scopeExpired()`, `scopeExpiringSoon()`
### `app/Models/Invoice.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Invoice`
- Methods/functions: `subscription()`, `getDisplayStatusLabel()`, `transactions()`, `syncFromTransactions()`, `boot()`
### `app/Models/InvoiceTransaction.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `InvoiceTransaction`
- Methods/functions: `invoice()`, `booted()`
### `app/Models/Member.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Member`
- Methods/functions: `subscriptions()`, `boot()`, `relationsToCascade()`
### `app/Models/Plan.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Plan`
- Methods/functions: `service()`, `subscriptions()`, `relationsToCascade()`
### `app/Models/Service.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Service`
- Methods/functions: `plans()`, `relationsToCascade()`
### `app/Models/Subscription.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `Subscription`
- Methods/functions: `invoices()`, `renewedFrom()`, `renewals()`, `member()`, `plan()`, `relationsToCascade()`
### `app/Models/SystemAdmin.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `SystemAdmin`
- Methods/functions: `casts()`, `systemRoles()`, `hasSystemRole()`, `isSuperAdmin()`, `hasRole()`, `hasPermissionTo()`, `hasAnyRole()`, `hasAllRoles()`, `hasAnyPermission()`, `canAccessPanel()`, `getFilamentAvatarUrl()`
### `app/Models/SystemPlan.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `SystemPlan`
- Methods/functions: `casts()`, `gymSubscriptions()`, `scopeActive()`, `scopeByCode()`
### `app/Models/SystemRole.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `SystemRole`
- Methods/functions: `systemAdmins()`
### `app/Models/User.php`
- Namespace: `App\Models`
- Classes/traits/interfaces/enums: `User`
- Methods/functions: `casts()`, `getEmailAttribute()`, `setEmailAttribute()`, `getDefaultGuardName()`, `scopeFacilityUsers()`, `isGymOwner()`, `isSuperAdmin()`, `gyms()`, `getTenants()`, `canAccessTenant()`, `followUps()`, `enquiries()`, `getFilamentAvatarUrl()`, `canAccessPanel()`
### `app/Notifications/ExpiringGymSubscriptionNotification.php`
- Namespace: `App\Notifications`
- Classes/traits/interfaces/enums: `ExpiringGymSubscriptionNotification`
- Methods/functions: `__construct()`, `via()`, `toArray()`, `sendToSystemAdmins()`, `sendToGymOwners()`
### `app/Observers/GymSubscriptionObserver.php`
- Namespace: `App\Observers`
- Classes/traits/interfaces/enums: `GymSubscriptionObserver`
- Methods/functions: `created()`, `updated()`, `deleted()`
### `app/Observers/InvoiceObserver.php`
- Namespace: `App\Observers`
- Classes/traits/interfaces/enums: `InvoiceObserver`
- Methods/functions: `__construct()`, `created()`
### `app/Observers/InvoiceTransactionObserver.php`
- Namespace: `App\Observers`
- Classes/traits/interfaces/enums: `InvoiceTransactionObserver`
- Methods/functions: `__construct()`, `created()`
### `app/Policies/EnquiryPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `EnquiryPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/ExpensePolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `ExpensePolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/FollowUpPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `FollowUpPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/GymPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `GymPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/GymSubscriptionPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `GymSubscriptionPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/InvoicePolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `InvoicePolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/MemberPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `MemberPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/PlanPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `PlanPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/RolePolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `RolePolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/ServicePolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `ServicePolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/SubscriptionPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `SubscriptionPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/SystemAdminPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `SystemAdminPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/SystemPlanPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `SystemPlanPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Policies/UserPolicy.php`
- Namespace: `App\Policies`
- Classes/traits/interfaces/enums: `UserPolicy`
- Methods/functions: `viewAny()`, `view()`, `create()`, `update()`, `delete()`, `restore()`, `forceDelete()`, `forceDeleteAny()`, `restoreAny()`, `replicate()`, `reorder()`
### `app/Providers/AppServiceProvider.php`
- Namespace: `App\Providers`
- Classes/traits/interfaces/enums: `AppServiceProvider`
- Methods/functions: `register()`, `boot()`, `configureSuperAdminGate()`, `configureScrambleApiDocs()`, `configureApiRateLimiting()`, `registerModelObservers()`, `configureDeletionPrevention()`
### `app/Providers/Filament/AdminPanelProvider.php`
- Namespace: `App\Providers\Filament`
- Classes/traits/interfaces/enums: `AdminPanelProvider`
- Methods/functions: `panel()`, `basePanel()`, `buildNavigation()`, `colors()`
### `app/Providers/Filament/SystemPanelProvider.php`
- Namespace: `App\Providers\Filament`
- Classes/traits/interfaces/enums: `SystemPanelProvider`
- Methods/functions: `panel()`
### `app/Rules/ModelExists.php`
- Namespace: `App\Rules`
- Classes/traits/interfaces/enums: `ModelExists`
- Methods/functions: `__construct()`, `validate()`
### `app/Rules/ModelUnique.php`
- Namespace: `App\Rules`
- Classes/traits/interfaces/enums: `ModelUnique`
- Methods/functions: `__construct()`, `validate()`
### `app/Rules/ReservedBusinessSlug.php`
- Namespace: `App\Rules`
- Classes/traits/interfaces/enums: `ReservedBusinessSlug`
- Methods/functions: `validate()`, `normalize()`, `isReserved()`, `routePattern()`
### `app/Services/Analytics/AnalyticsService.php`
- Namespace: `App\Services\Analytics`
- Classes/traits/interfaces/enums: `AnalyticsService`
- Methods/functions: `monthGroupExpression()`, `financialMetrics()`, `revenueTrendByDate()`, `membershipMetrics()`, `newMemberTrendByDate()`, `newMemberTrendByMonth()`, `renewalTrendByDate()`, `renewalTrendByMonth()`, `expiredTrendByDate()`, `expiredTrendByMonth()`, `expiringSubscriptionsCount()`, `overdueInvoicesCount()`, `collectedTrendByDate()`, `collectedTrendByMonth()`, `expenseTrendByDate()`, `expenseTrendByMonth()`, `topPlansByCollected()`, `expenseBreakdownByCategory()`, `expenseCategoryBreakdownForChart()`
### `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php`
- Namespace: `App\Services\Api\Docs`
- Classes/traits/interfaces/enums: `AddIndexQueryParametersTransformer`
- Methods/functions: `handle()`, `add()`, `stringParam()`, `intParam()`, `boolParam()`
### `app/Services/Api/QueryFilters.php`
- Namespace: `App\Services\Api`
- Classes/traits/interfaces/enums: `QueryFilters`
- Methods/functions: `applyIndexFilters()`, `validateIndexQueryParameters()`, `applyQueryBuilderFilters()`, `perPage()`, `applySearch()`, `applyStatus()`, `applyTrashed()`, `applyRange()`, `parseRange()`
### `app/Services/Api/ResourceQueryRules.php`
- Namespace: `App\Services\Api`
- Classes/traits/interfaces/enums: `ResourceQueryRules`
- Methods/functions: `searchable()`, `sortable()`, `defaultSort()`, `statusColumn()`, `includes()`, `filters()`, `rules()`
### `app/Services/Api/Schemas/EnquirySchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `EnquirySchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/ExpenseSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `ExpenseSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/FollowUpSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `FollowUpSchema`
- Methods/functions: `__construct()`, `queryRules()`, `nestedStoreRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/InvoiceSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `InvoiceSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/InvoiceTransactionSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `InvoiceTransactionSchema`
- Methods/functions: `__construct()`, `storeRules()`, `resource()`
### `app/Services/Api/Schemas/MemberSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `MemberSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/PermissionSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `PermissionSchema`
- Methods/functions: `__construct()`, `resource()`
### `app/Services/Api/Schemas/PlanSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `PlanSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/RoleSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `RoleSchema`
- Methods/functions: `__construct()`, `resource()`
### `app/Services/Api/Schemas/ServiceSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `ServiceSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Api/Schemas/SubscriptionSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `SubscriptionSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `renewRules()`, `invoiceRules()`, `resource()`
### `app/Services/Api/Schemas/UserSchema.php`
- Namespace: `App\Services\Api\Schemas`
- Classes/traits/interfaces/enums: `UserSchema`
- Methods/functions: `__construct()`, `queryRules()`, `storeRules()`, `updateRules()`, `resource()`
### `app/Services/Backup/ApplicationBackupService.php`
- Namespace: `App\Services\Backup`
- Classes/traits/interfaces/enums: `ApplicationBackupService`
- Methods/functions: `downloadBackupZip()`, `importBackup()`, `tables()`, `databaseSql()`, `columns()`, `sqlValue()`, `writeTableExcel()`, `runSqlFile()`, `copyIfExists()`, `copyDirectoryIfExists()`, `zipDirectory()`
### `app/Services/Email/InvoiceEmailService.php`
- Namespace: `App\Services\Email`
- Classes/traits/interfaces/enums: `InvoiceEmailService`
- Methods/functions: `__construct()`, `queueInvoiceIssuedEmail()`, `queuePaymentReceiptEmail()`, `sendInvoiceIssuedEmail()`, `sendPaymentReceiptEmail()`, `withLocaleFromSettings()`, `isValidRecipientEmail()`, `gymIdentityFromSettings()`, `invoiceSubjectTokens()`, `renderSubjectTemplate()`
### `app/Services/Excel/ExcelImportResult.php`
- Namespace: `App\Services\Excel`
- Classes/traits/interfaces/enums: `ExcelImportResult`
- Methods/functions: `__construct()`, `hasErrors()`, `isSuccessful()`, `summary()`
### `app/Services/Excel/ResourceExcelService.php`
- Namespace: `App\Services\Excel`
- Classes/traits/interfaces/enums: `ResourceExcelService`
- Methods/functions: `downloadExport()`, `downloadDemo()`, `import()`, `config()`, `recordToRow()`, `rowToValues()`, `headerMap()`, `normalizeHeader()`, `extractRowData()`, `prepareRow()`, `createRecord()`, `normalizeDate()`, `cellToString()`, `isEmptyRow()`, `temporaryFilePath()`
### `app/Services/JsonSequenceRepository.php`
- Namespace: `App\Services`
- Classes/traits/interfaces/enums: `JsonSequenceRepository`
- Methods/functions: `__construct()`, `generate()`, `update()`
### `app/Services/JsonSettingsRepository.php`
- Namespace: `App\Services`
- Classes/traits/interfaces/enums: `JsonSettingsRepository`
- Methods/functions: `setTestOverride()`, `get()`, `put()`, `initializeFile()`, `normalize()`
### `app/Services/Members/MemberExcelService.php`
- Namespace: `App\Services\Members`
- Classes/traits/interfaces/enums: `MemberExcelService`
- Methods/functions: `exportHeaders()`, `importHeaders()`, `downloadExport()`, `downloadDemoTemplate()`, `import()`, `memberToExportRow()`, `rowToValues()`, `headerMap()`, `normalizeHeader()`, `extractRowData()`, `validateRow()`, `normalizeGender()`, `normalizeStatus()`, `normalizeDate()`, `cellToString()`, `isEmptyRow()`, `humanColumn()`, `temporaryFilePath()`
### `app/Services/Members/MemberImportResult.php`
- Namespace: `App\Services\Members`
- Classes/traits/interfaces/enums: `MemberImportResult`
- Methods/functions: `__construct()`, `hasErrors()`, `isSuccessful()`, `isFailed()`, `summary()`
### `app/Services/Subscriptions/SubscriptionRenewalService.php`
- Namespace: `App\Services\Subscriptions`
- Classes/traits/interfaces/enums: `SubscriptionRenewalService`
- Methods/functions: `renew()`
### `app/Support/Analytics/AnalyticsDateRange.php`
- Namespace: `App\Support\Analytics`
- Methods/functions: `__construct()`, `fromFilters()`, `referenceDateString()`
### `app/Support/AppConfig.php`
- Namespace: `App\Support`
- Classes/traits/interfaces/enums: `AppConfig`
- Methods/functions: `string()`, `timezone()`, `supportedLocales()`
### `app/Support/Billing/Currency.php`
- Namespace: `App\Support\Billing`
- Classes/traits/interfaces/enums: `Currency`
- Methods/functions: `codeFromSettings()`, `format()`, `symbol()`
### `app/Support/Billing/Discounts.php`
- Namespace: `App\Support\Billing`
- Classes/traits/interfaces/enums: `Discounts`
- Methods/functions: `optionsFromSettings()`, `amount()`
### `app/Support/Billing/InvoiceCalculator.php`
- Namespace: `App\Support\Billing`
- Classes/traits/interfaces/enums: `InvoiceCalculator`
- Methods/functions: `summary()`
### `app/Support/Billing/PaymentMethod.php`
- Namespace: `App\Support\Billing`
- Classes/traits/interfaces/enums: `PaymentMethod`
- Methods/functions: `normalize()`, `isOnline()`, `channelLabel()`, `options()`
### `app/Support/Billing/TaxRate.php`
- Namespace: `App\Support\Billing`
- Classes/traits/interfaces/enums: `TaxRate`
- Methods/functions: `fromSettings()`
### `app/Support/Dashboard/DashboardAccess.php`
- Namespace: `App\Support\Dashboard`
- Classes/traits/interfaces/enums: `DashboardAccess`
- Methods/functions: `customPermissions()`, `canAccessDashboard()`, `allowsWidget()`, `allowsMetric()`, `allowsFilterPermission()`, `pageFilterOptions()`, `widgetFilterOptions()`, `sanitizePageFilters()`, `sanitizeWidgetFilter()`, `rangeFromPageFilters()`, `lockedHeading()`, `lockedMessage()`, `zeroCurrency()`, `presetFilterState()`, `granted()`
### `app/Support/Data.php`
- Namespace: `App\Support`
- Classes/traits/interfaces/enums: `Data`
- Methods/functions: `string()`, `nullableString()`, `int()`, `float()`, `array()`, `map()`
### `app/Support/Dates/FiscalYear.php`
- Namespace: `App\Support\Dates`
- Classes/traits/interfaces/enums: `FiscalYear`
- Methods/functions: `spanForDate()`, `parseTemplates()`, `parseTemplateMonthDay()`
### `app/Support/Filament/GlobalSearchBadge.php`
- Namespace: `App\Support\Filament`
- Classes/traits/interfaces/enums: `GlobalSearchBadge`
- Methods/functions: `status()`
### `app/Support/Invoices/InvoiceDocument.php`
- Namespace: `App\Support\Invoices`
- Classes/traits/interfaces/enums: `InvoiceDocument`
- Methods/functions: `loadForRendering()`, `missingRequiredData()`, `canRender()`, `viewData()`, `pdfFilename()`, `logoDataUriFromSettings()`
### `app/Support/Invoices/InvoiceDocumentNotRenderable.php`
- Namespace: `App\Support\Invoices`
- Classes/traits/interfaces/enums: `InvoiceDocumentNotRenderable`
- Methods/functions: `__construct()`
### `app/Support/Invoices/InvoicePdfRenderer.php`
- Namespace: `App\Support\Invoices`
- Classes/traits/interfaces/enums: `InvoicePdfRenderer`
- Methods/functions: `render()`, `ensureDompdfFontCacheDirectoryExists()`
### `app/Support/Members/MemberCodeGenerator.php`
- Namespace: `App\Support\Members`
- Classes/traits/interfaces/enums: `MemberCodeGenerator`
- Methods/functions: `__construct()`, `generate()`, `isValid()`, `randomSuffix()`, `exists()`, `allPossibleCodes()`
### `app/Support/Roles/BusinessRoleManager.php`
- Namespace: `App\Support\Roles`
- Classes/traits/interfaces/enums: `BusinessRoleManager`
- Methods/functions: `options()`, `assignUserToGymRole()`, `currentRoleName()`, `firstGym()`, `setPermissionsTeamId()`, `resolveRole()`
### `database/factories/EnquiryFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `EnquiryFactory`
- Methods/functions: `definition()`
### `database/factories/ExpenseFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `ExpenseFactory`
- Methods/functions: `definition()`
### `database/factories/FollowUpFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `FollowUpFactory`
- Methods/functions: `definition()`
### `database/factories/InvoiceFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `InvoiceFactory`
- Methods/functions: `definition()`
### `database/factories/MemberFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `MemberFactory`
- Methods/functions: `definition()`
### `database/factories/PlanFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `PlanFactory`
- Methods/functions: `definition()`
### `database/factories/ServiceFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `ServiceFactory`
- Methods/functions: `definition()`
### `database/factories/SubscriptionFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `SubscriptionFactory`
- Methods/functions: `definition()`
### `database/factories/UserFactory.php`
- Namespace: `Database\Factories`
- Classes/traits/interfaces/enums: `UserFactory`
- Methods/functions: `definition()`
### `database/migrations/0001_01_01_000000_create_users_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/0001_01_01_000001_create_cache_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/0001_01_01_000002_create_jobs_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_05_26_020228_create_enquiries_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_05_27_065258_create_follow_ups_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_02_113254_create_services_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_04_100009_create_plans_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_09_100252_create_permission_tables.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_10_101915_create_members_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_11_134644_create_subscriptions_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_13_005807_create_invoices_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_06_15_102321_create_notifications_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2025_09_15_025013_create_personal_access_tokens_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_02_10_000001_create_expenses_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_02_12_000001_create_invoice_transactions_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_03_14_060518_normalize_invoice_subscription_fee_to_gross.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_19_000001_create_gyms_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_19_000002_create_gym_user_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_19_000004_add_gym_id_to_spatie_roles_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000001_add_owner_fields_to_gyms_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000002_add_assigned_id_to_gyms_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000004_convert_users_email_to_username.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000005_remove_contact_details_from_gyms_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000008_create_system_admins_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000009_purge_administrator_roles.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000010_strip_cluttered_fields_from_users_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_20_000011_database_segregation_audit.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_21_000001_create_system_plans_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_21_000002_create_gym_subscriptions_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_21_000003_add_expiry_columns_to_gyms.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_21_000004_add_map_link_to_gyms.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_21_000005_cleanup_duplicate_roles.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_22_000001_create_system_roles_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_22_000002_create_system_role_assignment_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_22_000003_cleanup_duplicate_roles.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_22_999999_add_business_details_to_gyms_table.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_23_000001_align_gym_subscriptions_schema.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_23_000002_drop_gym_subscription_payment_columns.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_24_000100_remove_predefined_business_roles.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_24_000200_separate_system_and_business_access.php`
- Methods/functions: `up()`, `down()`
### `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php`
- Methods/functions: `up()`, `down()`, `setMembersSourceDefault()`
### `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php`
- Methods/functions: `up()`, `down()`, `nextAvailableCode()`, `isValidCode()`, `hasUniqueCodeIndex()`, `indexExists()`
### `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php`
- Methods/functions: `up()`, `down()`, `backfillSlugs()`, `uniqueSlug()`, `truncateSlug()`, `normalizeSlug()`, `isReserved()`, `slugExists()`, `hasUniqueSlugIndex()`, `indexExists()`
### `database/seeders/DashboardDemoSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `DashboardDemoSeeder`
- Methods/functions: `run()`, `ensureMinimumCount()`, `seedSubscriptionsForMembers()`, `seedRenewals()`, `statusForSubscriptionDates()`, `subscriptionsNeedingInvoices()`, `seedInvoicesForSubscriptions()`, `demoInvoicePrefix()`, `nextDemoInvoiceSequenceNumber()`, `seedTransactionsForInvoice()`, `withoutInvoiceEmails()`
### `database/seeders/DatabaseSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `DatabaseSeeder`
- Methods/functions: `run()`
### `database/seeders/EnquirySeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `EnquirySeeder`
- Methods/functions: `run()`
### `database/seeders/ExpenseSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `ExpenseSeeder`
- Methods/functions: `run()`
### `database/seeders/ExpiringGymSubscriptionNotification.php`
- Namespace: `App\Notifications`
- Classes/traits/interfaces/enums: `ExpiringGymSubscriptionNotification`
- Methods/functions: `__construct()`, `via()`, `toArray()`, `sendToSystemAdmins()`, `sendToGymOwners()`
### `database/seeders/FeatureOneTemporaryTestDataSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `FeatureOneTemporaryTestDataSeeder`
- Methods/functions: `run()`, `createSystemAdmin()`, `createBusinessPermissions()`, `createFullAccessBusinessRole()`, `createSystemPlans()`, `createBusinesses()`, `upsertGym()`, `createBusinessUsers()`, `upsertUser()`, `attachUserToGym()`, `createBusinessDashboardData()`, `createMemberBundle()`, `createEnquiryWithFollowUp()`, `createExpenses()`, `upsertGetId()`
### `database/seeders/FollowUpSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `FollowUpSeeder`
- Methods/functions: `run()`
### `database/seeders/GymTenancySeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `GymTenancySeeder`
- Methods/functions: `run()`
### `database/seeders/InvoiceSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `InvoiceSeeder`
- Methods/functions: `run()`
### `database/seeders/MandatoryTemporaryTestDataSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `MandatoryTemporaryTestDataSeeder`
- Methods/functions: `run()`, `createSystemAdmin()`, `createBusinessPermissions()`, `createFullAccessBusinessRole()`, `createSystemPlans()`, `createBusinesses()`, `upsertGym()`, `createBusinessUsers()`, `upsertUser()`, `attachUserToGym()`, `createBusinessDashboardData()`, `createMemberBundle()`, `createEnquiryWithFollowUp()`, `createExpenses()`, `createSettings()`, `memberCode()`, `suffixFromNumber()`, `upsertGetId()`, `onlyExistingColumns()`
### `database/seeders/MemberSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `MemberSeeder`
- Methods/functions: `run()`
### `database/seeders/PlanSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `PlanSeeder`
- Methods/functions: `run()`
### `database/seeders/ServiceSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `ServiceSeeder`
- Methods/functions: `run()`
### `database/seeders/SubscriptionSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `SubscriptionSeeder`
- Methods/functions: `run()`
### `database/seeders/SystemRolesSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `SystemRolesSeeder`
- Methods/functions: `run()`
### `database/seeders/UserSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `UserSeeder`
- Methods/functions: `run()`
### `database/seeders/WorldSeeder.php`
- Namespace: `Database\Seeders`
- Classes/traits/interfaces/enums: `WorldSeeder`
- Methods/functions: `run()`
### `tests/BaseGymieTest.php`
- Namespace: `Tests`
- Classes/traits/interfaces/enums: `BaseGymieTest`
- Methods/functions: `setUp()`, `expectedSourceOptions()`, `projectFile()`, `fileContents()`, `logPass()`
### `tests/Feature/ApiTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `ApiTest`
- Methods/functions: `test_feature_one_api_resources_include_source_and_exclude_goal()`
### `tests/Feature/BusinessSlugLoginTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `BusinessSlugLoginTest`
- Methods/functions: `test_feature_four_business_slug_login_files_are_wired()`, `test_feature_four_mandatory_temp_data_contains_business_slugs()`, `test_feature_four_reserved_slug_rule_blocks_generic_paths()`
### `tests/Feature/FollowUpTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `FollowUpTest`
- Methods/functions: `test_follow_up_feature_files_remain_present_after_feature_one()`
### `tests/Feature/InvoiceDocumentControllerTest.php`
- Methods/functions: `makeInvoiceWithViewer()`
### `tests/Feature/LeadTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `LeadTest`
- Methods/functions: `test_enquiry_form_uses_requested_source_options_and_removes_goal()`, `test_enquiry_model_and_api_schema_do_not_expose_goal()`, `test_feature_two_enquiry_dob_is_optional_and_lead_owner_labels_are_clean()`
### `tests/Feature/LocaleSwitcherTest.php`
- Methods/functions: `get()`, `put()`, `get()`, `put()`
### `tests/Feature/MarkSubscriptionsStatusCommandTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `MarkSubscriptionsStatusCommandTest`
- Methods/functions: `setUp()`, `tearDown()`, `test_it_marks_expired_and_expiring_subscriptions_and_sends_database_notification()`
### `tests/Feature/MemberTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `MemberTest`
- Methods/functions: `test_member_form_uses_requested_source_options_and_removes_goal()`, `test_member_model_and_api_schema_do_not_expose_goal()`, `test_feature_three_members_receive_locked_global_m_prefixed_codes()`
### `tests/Feature/PaymentTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `PaymentTest`
- Methods/functions: `test_invoice_transaction_payment_files_remain_present_after_feature_one()`
### `tests/Feature/RolePermissionTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `RolePermissionTest`
- Methods/functions: `test_role_and_permission_files_remain_present_after_feature_one()`
### `tests/Feature/SettingsPagePersistenceTest.php`
- Methods/functions: `get()`, `put()`
### `tests/Feature/SubscriptionTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `SubscriptionTest`
- Methods/functions: `test_subscription_feature_files_remain_present_after_feature_one()`
### `tests/Feature/TenantIsolationTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `TenantIsolationTest`
- Methods/functions: `test_tenant_isolation_trait_remains_present_after_feature_one()`, `test_feature_four_slug_login_preserves_tenant_isolation_contract()`
### `tests/Feature/ValidationTest.php`
- Namespace: `Tests\Feature`
- Classes/traits/interfaces/enums: `ValidationTest`
- Methods/functions: `test_member_and_enquiry_source_validation_allows_only_requested_values()`, `test_feature_two_enquiry_dob_remains_nullable_in_api_validation()`
### `tests/Helpers/TestLogger.php`
- Namespace: `Tests\Helpers`
- Classes/traits/interfaces/enums: `TestLogger`
- Methods/functions: `init()`, `pass()`, `fail()`
### `tests/Pest.php`
- Methods/functions: `something()`
### `tests/Regression/RegressionTest.php`
- Namespace: `Tests\Regression`
- Classes/traits/interfaces/enums: `RegressionTest`
- Methods/functions: `test_feature_one_source_and_goal_regression_contract()`
### `tests/Security/SecurityTest.php`
- Namespace: `Tests\Security`
- Classes/traits/interfaces/enums: `SecurityTest`
- Methods/functions: `test_feature_one_removes_stale_goal_attack_surface_from_runtime_code()`
### `tests/TestCase.php`
- Namespace: `Tests`
- Classes/traits/interfaces/enums: `TestCase`
- Methods/functions: `setUp()`, `bootstrapDefaultGymTenant()`, `sanitizeSeededGymsForTests()`, `syncBelongsToGymStaticCaches()`
### `tests/Unit/DashboardLayoutTest.php`
- Methods/functions: `collectLivewireComponentsFromSchema()`
### `tests/Unit/InvoiceNumberGeneratorTest.php`
- Namespace: `Tests\Unit`
- Classes/traits/interfaces/enums: `InvoiceNumberGeneratorTest`
- Methods/functions: `setUp()`, `noExistingInvoicesReturnsGY1()`, `twoInRangeInvoicesReturnsGY3()`, `outOfRangeInvoicesReturnsGY1()`
### `tests/Unit/MemberCodeGeneratorTest.php`
- Namespace: `Tests\Unit`
- Classes/traits/interfaces/enums: `MemberCodeGeneratorTest`
- Methods/functions: `test_generated_member_code_uses_m_prefix_and_three_uppercase_alphanumeric_characters()`, `test_member_creation_assigns_global_unique_m_prefixed_codes()`, `test_member_code_is_locked_after_creation()`, `test_soft_deleted_member_code_is_not_reused()`
### `tests/Unit/SetAppLocaleMiddlewareTest.php`
- Methods/functions: `get()`, `put()`

## Routes and Endpoints
- `routes/web.php` — `GET` '/{business:url_slug}/login', [BusinessSlugLoginController::class, 'show'])
- `routes/web.php` — `POST` '/{business:url_slug}/login', [BusinessSlugLoginController::class, 'store'])
- `routes/web.php` — `GET` '/invoices/{invoice}/preview', [InvoiceDocumentController::class, 'preview'])
- `routes/web.php` — `GET` '/invoices/{invoice}/download', [InvoiceDocumentController::class, 'download'])
- `routes/api.php` — `GET` '/user', function (Request $request) { return $request->user()
- `routes/api.php` — `POST` '/auth/login', [AuthController::class, 'login'])
- `routes/api.php` — `GET` '/me', [AuthController::class, 'me'])
- `routes/api.php` — `POST` '/auth/logout', [AuthController::class, 'logout'])
- `routes/api.php` — `GET` '/settings', [SettingsController::class, 'show'])
- `routes/api.php` — `PUT` '/settings', [SettingsController::class, 'update'])
- `routes/api.php` — `GET` '/financial', [AnalyticsController::class, 'financial'])
- `routes/api.php` — `GET` '/membership', [AnalyticsController::class, 'membership'])
- `routes/api.php` — `GET` '/cashflow-trend', [AnalyticsController::class, 'cashflowTrend'])
- `routes/api.php` — `GET` '/expense-categories', [AnalyticsController::class, 'expenseCategories'])
- `routes/api.php` — `GET` '/top-plans', [AnalyticsController::class, 'topPlans'])
- `routes/api.php` — `GET` '/recent-transactions', [AnalyticsController::class, 'recentTransactions'])
- `routes/api.php` — `GET` '/roles', [RolesController::class, 'index'])
- `routes/api.php` — `GET` '/permissions', [PermissionsController::class, 'index'])
- `routes/api.php` — `APIRESOURCE` 'users', UsersController::class)
- `routes/api.php` — `POST` '/users/{user}/restore', [UsersController::class, 'restore'])
- `routes/api.php` — `DELETE` '/users/{user}/force', [UsersController::class, 'forceDelete'])
- `routes/api.php` — `APIRESOURCE` 'members', MembersController::class)
- `routes/api.php` — `POST` '/members/{member}/restore', [MembersController::class, 'restore'])
- `routes/api.php` — `DELETE` '/members/{member}/force', [MembersController::class, 'forceDelete'])
- `routes/api.php` — `APIRESOURCE` 'services', ServicesController::class)
- `routes/api.php` — `POST` '/services/{service}/restore', [ServicesController::class, 'restore'])
- `routes/api.php` — `DELETE` '/services/{service}/force', [ServicesController::class, 'forceDelete'])
- `routes/api.php` — `APIRESOURCE` 'plans', PlansController::class)
- `routes/api.php` — `POST` '/plans/{plan}/restore', [PlansController::class, 'restore'])
- `routes/api.php` — `DELETE` '/plans/{plan}/force', [PlansController::class, 'forceDelete'])
- `routes/api.php` — `APIRESOURCE` 'subscriptions', SubscriptionsController::class)
- `routes/api.php` — `POST` '/subscriptions/{subscription}/restore', [SubscriptionsController::class, 'restore'])
- `routes/api.php` — `DELETE` '/subscriptions/{subscription}/force', [SubscriptionsController::class, 'forceDelete'])
- `routes/api.php` — `POST` '/subscriptions/{subscription}/renew', [SubscriptionsController::class, 'renew'])
- `routes/api.php` — `APIRESOURCE` 'invoices', InvoicesController::class)
- `routes/api.php` — `POST` '/invoices/{invoice}/restore', [InvoicesController::class, 'restore'])
- `routes/api.php` — `DELETE` '/invoices/{invoice}/force', [InvoicesController::class, 'forceDelete'])
- `routes/api.php` — `GET` '/invoices/{invoice}/pdf', [InvoicesController::class, 'pdf'])
- `routes/api.php` — `GET` '/invoices/{invoice}/pdf/download', [InvoicesController::class, 'downloadPdf'])
- `routes/api.php` — `GET` '/invoices/{invoice}/transactions', [InvoiceTransactionsController::class, 'index'])
- `routes/api.php` — `POST` '/invoices/{invoice}/transactions', [InvoiceTransactionsController::class, 'store'])
- `routes/api.php` — `DELETE` '/invoices/{invoice}/transactions/{transaction}', [InvoiceTransactionsController::class, 'destroy'])
- `routes/api.php` — `APIRESOURCE` 'expenses', ExpensesController::class)
- `routes/api.php` — `APIRESOURCE` 'enquiries', EnquiriesController::class)
- `routes/api.php` — `POST` '/enquiries/{enquiry}/restore', [EnquiriesController::class, 'restore'])
- `routes/api.php` — `DELETE` '/enquiries/{enquiry}/force', [EnquiriesController::class, 'forceDelete'])
- `routes/api.php` — `GET` '/enquiries/{enquiry}/follow-ups', [EnquiryFollowUpsController::class, 'index'])
- `routes/api.php` — `POST` '/enquiries/{enquiry}/follow-ups', [EnquiryFollowUpsController::class, 'store'])
- `routes/api.php` — `APIRESOURCE` 'follow-ups', FollowUpsController::class)
- `routes/api.php` — `POST` '/follow-ups/{followUp}/restore', [FollowUpsController::class, 'restore'])
- `routes/api.php` — `DELETE` '/follow-ups/{followUp}/force', [FollowUpsController::class, 'forceDelete'])

## Database Tables and Migrations
### `database/migrations/0001_01_01_000000_create_users_table.php`
### `database/migrations/0001_01_01_000001_create_cache_table.php`
### `database/migrations/0001_01_01_000002_create_jobs_table.php`
### `database/migrations/2025_05_26_020228_create_enquiries_table.php`
### `database/migrations/2025_05_27_065258_create_follow_ups_table.php`
### `database/migrations/2025_06_02_113254_create_services_table.php`
### `database/migrations/2025_06_04_100009_create_plans_table.php`
### `database/migrations/2025_06_09_100252_create_permission_tables.php`
- Creates $tableNames['permissions']: `bigIncrements('id')`, `string('name')`, `string('guard_name')`, `timestamps()`, `unique(['name', 'guard_name'])`
- Creates $tableNames['roles']: `bigIncrements('id')`, `unsignedBigInteger($columnNames['team_foreign_key'])`, `index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index')`, `string('name')`, `string('guard_name')`, `timestamps()`, `unique([$columnNames['team_foreign_key'], 'name', 'guard_name'])`, `unique(['name', 'guard_name'])`
- Creates $tableNames['model_has_permissions']: `unsignedBigInteger($pivotPermission)`, `string('model_type')`, `unsignedBigInteger($columnNames['model_morph_key'])`, `foreign($pivotPermission)`, `unsignedBigInteger($columnNames['team_foreign_key'])`
- Creates $tableNames['model_has_roles']: `unsignedBigInteger($pivotRole)`, `string('model_type')`, `unsignedBigInteger($columnNames['model_morph_key'])`, `foreign($pivotRole)`, `unsignedBigInteger($columnNames['team_foreign_key'])`
- Creates $tableNames['role_has_permissions']: `unsignedBigInteger($pivotPermission)`, `unsignedBigInteger($pivotRole)`, `foreign($pivotPermission)`, `foreign($pivotRole)`
### `database/migrations/2025_06_10_101915_create_members_table.php`
### `database/migrations/2025_06_11_134644_create_subscriptions_table.php`
### `database/migrations/2025_06_13_005807_create_invoices_table.php`
### `database/migrations/2025_06_15_102321_create_notifications_table.php`
### `database/migrations/2025_09_15_025013_create_personal_access_tokens_table.php`
### `database/migrations/2026_02_10_000001_create_expenses_table.php`
### `database/migrations/2026_02_12_000001_create_invoice_transactions_table.php`
### `database/migrations/2026_03_14_060518_normalize_invoice_subscription_fee_to_gross.php`
### `database/migrations/2026_06_19_000001_create_gyms_table.php`
### `database/migrations/2026_06_19_000002_create_gym_user_table.php`
### `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php`
- Alters: `$tableName`
### `database/migrations/2026_06_19_000004_add_gym_id_to_spatie_roles_table.php`
- Alters: `'model_has_permissions'`, `'model_has_roles'`, `'roles'`
### `database/migrations/2026_06_20_000001_add_owner_fields_to_gyms_table.php`
- Alters: `'gyms'`
### `database/migrations/2026_06_20_000002_add_assigned_id_to_gyms_table.php`
- Alters: `'gyms'`
### `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php`
### `database/migrations/2026_06_20_000004_convert_users_email_to_username.php`
- Alters: `'users'`
### `database/migrations/2026_06_20_000005_remove_contact_details_from_gyms_table.php`
- Alters: `'gyms'`
### `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php`
### `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php`
### `database/migrations/2026_06_20_000008_create_system_admins_table.php`
### `database/migrations/2026_06_20_000009_purge_administrator_roles.php`
### `database/migrations/2026_06_20_000010_strip_cluttered_fields_from_users_table.php`
- Alters: `'users'`
### `database/migrations/2026_06_20_000011_database_segregation_audit.php`
- Alters: `'gyms'`, `'users'`
### `database/migrations/2026_06_21_000001_create_system_plans_table.php`
### `database/migrations/2026_06_21_000002_create_gym_subscriptions_table.php`
### `database/migrations/2026_06_21_000003_add_expiry_columns_to_gyms.php`
- Alters: `'gyms'`
### `database/migrations/2026_06_21_000004_add_map_link_to_gyms.php`
- Alters: `'gyms'`
### `database/migrations/2026_06_21_000005_cleanup_duplicate_roles.php`
### `database/migrations/2026_06_22_000001_create_system_roles_table.php`
### `database/migrations/2026_06_22_000002_create_system_role_assignment_table.php`
### `database/migrations/2026_06_22_000003_cleanup_duplicate_roles.php`
### `database/migrations/2026_06_22_999999_add_business_details_to_gyms_table.php`
- Alters: `'gyms'`
### `database/migrations/2026_06_23_000001_align_gym_subscriptions_schema.php`
- Alters: `'gym_subscriptions'`
### `database/migrations/2026_06_23_000002_drop_gym_subscription_payment_columns.php`
- Alters: `'gym_subscriptions'`
### `database/migrations/2026_06_24_000100_remove_predefined_business_roles.php`
### `database/migrations/2026_06_24_000200_separate_system_and_business_access.php`
### `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php`
- Alters: `'enquiries'`, `'members'`
### `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php`
- Alters: `'members'`
### `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php`
- Alters: `'gyms'`

## Import/Dependency Relationships
- `app/Console/Commands/CleanupTemporaryBackups.php` imports `Illuminate\Console\Command`
- `app/Console/Commands/CleanupTemporaryBackups.php` imports `Illuminate\Support\Facades\File`
- `app/Console/Commands/MarkInvoiceOverdue.php` imports `App\Models\Gym`
- `app/Console/Commands/MarkInvoiceOverdue.php` imports `App\Models\Invoice`
- `app/Console/Commands/MarkInvoiceOverdue.php` imports `App\Models\User`
- `app/Console/Commands/MarkInvoiceOverdue.php` imports `Carbon\Carbon`
- `app/Console/Commands/MarkInvoiceOverdue.php` imports `Filament\Notifications\Notification`
- `app/Console/Commands/MarkInvoiceOverdue.php` imports `Illuminate\Console\Command`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `App\Helpers\Helpers`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `App\Models\Gym`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `App\Models\Subscription`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `App\Models\User`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `Carbon\Carbon`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `Filament\Notifications\Notification`
- `app/Console/Commands/MarkSubscriptionsStatus.php` imports `Illuminate\Console\Command`
- `app/Console/Commands/NotifyExpiringGymSubscriptions.php` imports `App\Models\Gym`
- `app/Console/Commands/NotifyExpiringGymSubscriptions.php` imports `App\Notifications\ExpiringGymSubscriptionNotification`
- `app/Console/Commands/NotifyExpiringGymSubscriptions.php` imports `App\Support\AppConfig`
- `app/Console/Commands/NotifyExpiringGymSubscriptions.php` imports `Carbon\Carbon`
- `app/Console/Commands/NotifyExpiringGymSubscriptions.php` imports `Illuminate\Console\Command`
- `app/Console/Commands/SyncGymSubscriptionStatus.php` imports `App\Models\Gym`
- `app/Console/Commands/SyncGymSubscriptionStatus.php` imports `Illuminate\Console\Command`
- `app/Enums/Status.php` imports `Filament\Support\Contracts\HasColor`
- `app/Enums/Status.php` imports `Filament\Support\Contracts\HasLabel`
- `app/Enums/Status.php` imports `Illuminate\Support\Facades\Lang`
- `app/Exceptions/CrossTenantException.php` imports `Exception`
- `app/Filament/Concerns/HasResourceExcelActions.php` imports `App\Services\Excel\ResourceExcelService`
- `app/Filament/Concerns/HasResourceExcelActions.php` imports `Filament\Actions\Action`
- `app/Filament/Concerns/HasResourceExcelActions.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Concerns/HasResourceExcelActions.php` imports `Filament\Forms\Components\FileUpload`
- `app/Filament/Concerns/HasResourceExcelActions.php` imports `Filament\Notifications\Notification`
- `app/Filament/Concerns/HasResourceExcelActions.php` imports `Illuminate\Support\Facades\Storage`
- `app/Filament/Livewire/LocaleSwitcher.php` imports `App\Contracts\SettingsRepository`
- `app/Filament/Livewire/LocaleSwitcher.php` imports `Filament\Notifications\Notification`
- `app/Filament/Livewire/LocaleSwitcher.php` imports `Illuminate\Contracts\View\View`
- `app/Filament/Livewire/LocaleSwitcher.php` imports `Livewire\Component`
- `app/Filament/Pages/Auth/CustomLogin.php` imports `Filament\Auth\Pages\Login as BaseLogin`
- `app/Filament/Pages/Auth/CustomLogin.php` imports `Filament\Schemas\Components\Component`
- `app/Filament/Pages/Auth/CustomLogin.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Pages/Auth/CustomLogin.php` imports `Illuminate\Support\Facades\Schema`
- `app/Filament/Pages/Billing.php` imports `App\Models\SystemPlan`
- `app/Filament/Pages/Billing.php` imports `Filament\Facades\Filament`
- `app/Filament/Pages/Billing.php` imports `Filament\Pages\Page`
- `app/Filament/Pages/Billing.php` imports `BackedEnum`
- `app/Filament/Pages/Billing.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Pages/Billing.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\CashflowTrendChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\ExpenseCategoriesDoughnutChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\FinancialMetricsWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\FinancialSummaryPieChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\MemberSourceChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\MembershipMetricsWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\MembershipOverviewSubscriptionsTableWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\MemberStatusPieChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\MemberTrendChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\RecentTransactionsTableWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\TopPlansChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Filament\Widgets\Analytics\TopServicesChartWidget`
- `app/Filament/Pages/Dashboard.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Pages\Dashboard\Concerns\HasFilters`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Schemas\Components\Component`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Schemas\Components\Utilities\Get`
- `app/Filament/Pages/Dashboard.php` imports `Filament\Schemas\Schema`
- `app/Filament/Pages/Dashboard.php` imports `Illuminate\Contracts\View\View`
- `app/Filament/Pages/Settings.php` imports `App\Contracts\SettingsRepository`
- `app/Filament/Pages/Settings.php` imports `App\Helpers\Helpers`
- `app/Filament/Pages/Settings.php` imports `App\Services\Backup\ApplicationBackupService`
- `app/Filament/Pages/Settings.php` imports `Carbon\Carbon`
- `app/Filament/Pages/Settings.php` imports `Filament\Actions\Action`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\FileUpload`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\TagsInput`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Components\Toggle`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Concerns\InteractsWithForms`
- `app/Filament/Pages/Settings.php` imports `Filament\Forms\Contracts\HasForms`
- `app/Filament/Pages/Settings.php` imports `Filament\Notifications\Notification`
- `app/Filament/Pages/Settings.php` imports `Filament\Pages\Page`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Components\Tabs`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Pages/Settings.php` imports `Filament\Schemas\Schema`
- `app/Filament/Pages/Settings.php` imports `Illuminate\Support\Facades\Storage`
- `app/Filament/Pages/Settings.php` imports `Livewire\Features\SupportFileUploads\TemporaryUploadedFile`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php` imports `App\Filament\Resources\BusinessRoleResource`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php` imports `Spatie\Permission\Models\Permission`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php` imports `App\Filament\Resources\BusinessRoleResource`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php` imports `Spatie\Permission\Models\Permission`
- `app/Filament/Resources/BusinessRoleResource/Pages/ListBusinessRoles.php` imports `App\Filament\Resources\BusinessRoleResource`
- `app/Filament/Resources/BusinessRoleResource/Pages/ListBusinessRoles.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/BusinessRoleResource/Pages/ListBusinessRoles.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/BusinessRoleResource.php` imports `App\Filament\Resources\BusinessRoleResource\Pages\CreateBusinessRole`
- `app/Filament/Resources/BusinessRoleResource.php` imports `App\Filament\Resources\BusinessRoleResource\Pages\EditBusinessRole`
- `app/Filament/Resources/BusinessRoleResource.php` imports `App\Filament\Resources\BusinessRoleResource\Pages\ListBusinessRoles`
- `app/Filament/Resources/BusinessRoleResource.php` imports `App\Models\SystemAdmin`
- `app/Filament/Resources/BusinessRoleResource.php` imports `BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Support\Enums\FontWeight`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Illuminate\Support\Str`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Illuminate\Validation\Rules\Unique`
- `app/Filament/Resources/BusinessRoleResource.php` imports `Spatie\Permission\Models\Role`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Pages\CreateEnquiry`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Pages\EditEnquiry`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Pages\ListEnquiries`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Pages\ViewEnquiry`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\RelationManagers\FollowUpsRelationManager`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Schemas\EnquiryForm`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Schemas\EnquiryInfolist`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Filament\Resources\Enquiries\Tables\EnquiryTable`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Enquiries/EnquiryResource.php` imports `Illuminate\Database\Eloquent\SoftDeletingScope`
- `app/Filament/Resources/Enquiries/Pages/CreateEnquiry.php` imports `App\Filament\Resources\Enquiries\EnquiryResource`
- `app/Filament/Resources/Enquiries/Pages/CreateEnquiry.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `App\Filament\Resources\Enquiries\EnquiryResource`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `Filament\Actions\ForceDeleteAction`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `Filament\Actions\RestoreAction`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Enquiries/Pages/EditEnquiry.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `App\Enums\Status`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `App\Filament\Resources\Enquiries\EnquiryResource`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Enquiries/Pages/ListEnquiries.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `App\Enums\Status`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `App\Filament\Resources\Enquiries\EnquiryResource`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Enquiries/Pages/ViewEnquiry.php` imports `Filament\Resources\Pages\ViewRecord`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `App\Models\User`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\AttachAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\DetachAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\DetachBulkAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Resources\RelationManagers\RelationManager`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Illuminate\Support\Facades\Hash`
- `app/Filament/Resources/Enquiries/RelationManagers/FollowUpsRelationManager.php` imports `Spatie\Permission\Models\Role`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `App\Models\Service`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `App\Models\User`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Forms\Components\Radio`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Forms\Components\Repeater`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryForm.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Filament\Support\Enums\FontWeight`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Enquiries/Schemas/EnquiryInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Carbon\Carbon`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Tables\Filters\TrashedFilter`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Enquiries/Tables/EnquiryTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Filament\Resources\Expenses\Pages\ListExpenses`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Filament\Resources\Expenses\Schemas\ExpenseForm`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Filament\Resources\Expenses\Schemas\ExpenseInfolist`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Filament\Resources\Expenses\Tables\ExpenseTable`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Models\Expense`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Expenses/ExpenseResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `App\Enums\Status`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `App\Filament\Concerns\HasResourceExcelActions`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `App\Filament\Resources\Expenses\ExpenseResource`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `App\Models\Expense`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `Filament\Support\Enums\Width`
- `app/Filament/Resources/Expenses/Pages/ListExpenses.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Expenses/Pages/ViewExpense.php` imports `App\Filament\Resources\Expenses\ExpenseResource`
- `app/Filament/Resources/Expenses/Pages/ViewExpense.php` imports `Filament\Resources\Pages\ViewRecord`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `App\Enums\Status`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Forms\Components\DateTimePicker`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Schemas\Components\Utilities\Get`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Schemas\Components\Utilities\Set`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Expenses/Schemas/ExpenseForm.php` imports `Filament\Support\RawJs`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `App\Models\Expense`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Expenses/Schemas/ExpenseInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `App\Enums\Status`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `App\Filament\Resources\Expenses\Schemas\ExpenseInfolist`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `App\Models\Expense`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Support\Enums\Width`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Expenses/Tables/ExpenseTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `App\Filament\Resources\FollowUps\Pages\ListFollowUps`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `App\Filament\Resources\FollowUps\Schemas\FollowUpForm`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `App\Filament\Resources\FollowUps\Schemas\FollowUpInfolist`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `App\Filament\Resources\FollowUps\Tables\FollowUpTable`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `App\Models\FollowUp`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/FollowUps/FollowUpResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `App\Enums\Status`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `App\Filament\Resources\FollowUps\FollowUpResource`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `App\Models\FollowUp`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/FollowUps/Pages/ListFollowUps.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpForm.php` imports `App\Filament\Resources\Enquiries\RelationManagers\FollowUpsRelationManager`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpForm.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `App\Models\FollowUp`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `Filament\Support\Enums\FontWeight`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/FollowUps/Schemas/FollowUpInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `App\Filament\Resources\FollowUps\FollowUpResource`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `App\Models\FollowUp`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `App\Models\User`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Carbon\Carbon`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Tables\Filters\TrashedFilter`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/FollowUps/Tables/FollowUpTable.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `App\Filament\Resources\GymResource`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `App\Models\GymSubscription`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `App\Models\SystemPlan`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `App\Models\User`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `App\Support\Roles\BusinessRoleManager`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `Illuminate\Support\Facades\DB`
- `app/Filament/Resources/GymResource/Pages/CreateGym.php` imports `Illuminate\Support\Facades\Hash`
- `app/Filament/Resources/GymResource/Pages/EditGym.php` imports `App\Filament\Resources\GymResource`
- `app/Filament/Resources/GymResource/Pages/EditGym.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/GymResource/Pages/EditGym.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/GymResource/Pages/ListGyms.php` imports `App\Filament\Resources\GymResource`
- `app/Filament/Resources/GymResource/Pages/ListGyms.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/GymResource/Pages/ListGyms.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `App\Models\Gym`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `App\Models\User`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `App\Support\Roles\BusinessRoleManager`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\DetachAction`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\DetachBulkAction`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Resources\RelationManagers\RelationManager`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Illuminate\Support\Facades\Hash`
- `app/Filament/Resources/GymResource/RelationManagers/UsersRelationManager.php` imports `Illuminate\Support\Str`
- `app/Filament/Resources/GymResource.php` imports `App\Filament\Resources\GymResource\Pages`
- `app/Filament/Resources/GymResource.php` imports `App\Filament\Resources\GymResource\RelationManagers\UsersRelationManager`
- `app/Filament/Resources/GymResource.php` imports `App\Models\Gym`
- `app/Filament/Resources/GymResource.php` imports `App\Models\SystemPlan`
- `app/Filament/Resources/GymResource.php` imports `App\Models\User`
- `app/Filament/Resources/GymResource.php` imports `App\Rules\ReservedBusinessSlug`
- `app/Filament/Resources/GymResource.php` imports `App\Support\Roles\BusinessRoleManager`
- `app/Filament/Resources/GymResource.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/GymResource.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/GymResource.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/GymResource.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/GymResource.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/GymResource.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/GymResource.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/GymResource.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/GymResource.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/GymResource.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/GymResource.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/GymResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/GymResource.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/GymResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/GymResource.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/GymResource.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/GymResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/GymResource.php` imports `Illuminate\Database\Eloquent\Collection`
- `app/Filament/Resources/GymSubscriptionResource/Pages/CreateGymSubscription.php` imports `App\Filament\Resources\GymSubscriptionResource`
- `app/Filament/Resources/GymSubscriptionResource/Pages/CreateGymSubscription.php` imports `App\Models\GymSubscription`
- `app/Filament/Resources/GymSubscriptionResource/Pages/CreateGymSubscription.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/GymSubscriptionResource/Pages/EditGymSubscription.php` imports `App\Filament\Resources\GymSubscriptionResource`
- `app/Filament/Resources/GymSubscriptionResource/Pages/EditGymSubscription.php` imports `App\Models\GymSubscription`
- `app/Filament/Resources/GymSubscriptionResource/Pages/EditGymSubscription.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/GymSubscriptionResource/Pages/EditGymSubscription.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/GymSubscriptionResource/Pages/ListGymSubscriptions.php` imports `App\Filament\Resources\GymSubscriptionResource`
- `app/Filament/Resources/GymSubscriptionResource/Pages/ListGymSubscriptions.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/GymSubscriptionResource/Pages/ListGymSubscriptions.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `App\Filament\Resources\GymSubscriptionResource\Pages`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `App\Models\Gym`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `App\Models\GymSubscription`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `App\Models\SystemPlan`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Tables\Filters\SelectFilter`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/GymSubscriptionResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\Pages\EditInvoice`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\Pages\ListInvoices`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\Pages\ViewInvoice`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\RelationManagers\InvoiceTransactionsRelationManager`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\Schemas\InvoiceForm`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\Schemas\InvoiceInfolist`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Filament\Resources\Invoices\Tables\InvoiceTable`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Invoices/InvoiceResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Invoices/Pages/CreateInvoice.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Filament/Resources/Invoices/Pages/CreateInvoice.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `Filament\Actions\ForceDeleteAction`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `Filament\Actions\RestoreAction`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Invoices/Pages/EditInvoice.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `App\Enums\Status`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `App\Filament\Concerns\HasResourceExcelActions`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Invoices/Pages/ListInvoices.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Invoices/Pages/ViewInvoice.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Filament/Resources/Invoices/Pages/ViewInvoice.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/Pages/ViewInvoice.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Invoices/Pages/ViewInvoice.php` imports `Filament\Resources\Pages\ViewRecord`
- `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` imports `App\Support\Billing\PaymentMethod`
- `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` imports `Filament\Resources\RelationManagers\RelationManager`
- `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Invoices/RelationManagers/InvoiceTransactionsRelationManager.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `App\Filament\Resources\Subscriptions\RelationManagers\InvoicesRelationManager`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `App\Support\Billing\InvoiceCalculator`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `App\Support\Billing\PaymentMethod`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Forms\Components\Radio`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Schemas\Components\Utilities\Get`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Schemas\Components\Utilities\Set`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Invoices/Schemas/InvoiceForm.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `App\Support\Billing\PaymentMethod`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Filament\Schemas\Components\Flex`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Filament\Support\Enums\FontWeight`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Invoices/Schemas/InvoiceInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Models\InvoiceTransaction`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Services\Email\InvoiceEmailService`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Support\Billing\PaymentMethod`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `App\Support\Data`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Forms\Components\DateTimePicker`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Invoices/Tables/InvoiceTable.php` imports `Illuminate\Support\Carbon`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Pages\CreateMember`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Pages\EditMember`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Pages\ListMembers`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Pages\ViewMember`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\RelationManagers\SubscriptionsRelationManager`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Schemas\MemberForm`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Schemas\MemberInfolist`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Filament\Resources\Members\Tables\MemberTable`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Models\Member`
- `app/Filament/Resources/Members/MemberResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/Members/MemberResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Members/MemberResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Members/MemberResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Members/MemberResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Members/MemberResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Members/MemberResource.php` imports `Illuminate\Database\Eloquent\SoftDeletingScope`
- `app/Filament/Resources/Members/Pages/CreateMember.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Members/Pages/CreateMember.php` imports `App\Models\Enquiry`
- `app/Filament/Resources/Members/Pages/CreateMember.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Members/Pages/CreateMember.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/Members/Pages/CreateMember.php` imports `Illuminate\Support\Facades\Request`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `App\Models\Member`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `Filament\Actions\ForceDeleteAction`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `Filament\Actions\RestoreAction`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Members/Pages/EditMember.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `App\Enums\Status`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `App\Models\Member`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `App\Services\Members\MemberExcelService`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Filament\Forms\Components\FileUpload`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Members/Pages/ListMembers.php` imports `Illuminate\Support\Facades\Storage`
- `app/Filament/Resources/Members/Pages/ViewMember.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Members/Pages/ViewMember.php` imports `App\Models\Member`
- `app/Filament/Resources/Members/Pages/ViewMember.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Members/Pages/ViewMember.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Members/Pages/ViewMember.php` imports `Filament\Resources\Pages\ViewRecord`
- `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` imports `Filament\Resources\RelationManagers\RelationManager`
- `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Members/RelationManagers/SubscriptionsRelationManager.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Facades\Filament`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Forms\Components\FileUpload`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Forms\Components\Repeater`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Schemas\Contracts\HasSchemas`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Illuminate\Validation\Rules\Unique`
- `app/Filament/Resources/Members/Schemas/MemberForm.php` imports `Livewire\Component`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `App\Models\Member`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Filament\Infolists\Components\ImageEntry`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Members/Schemas/MemberInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `App\Models\Member`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Carbon\Carbon`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\ForceDeleteBulkAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\RestoreBulkAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Tables\Columns\ImageColumn`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Tables\Filters\TrashedFilter`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Members/Tables/MemberTable.php` imports `Illuminate\Support\Collection`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `App\Enums\Status`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `App\Filament\Concerns\HasResourceExcelActions`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `App\Filament\Resources\Plans\PlanResource`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `App\Models\Plan`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Plans/Pages/ListPlans.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Plans/PlanResource.php` imports `App\Filament\Resources\Plans\Pages\ListPlans`
- `app/Filament/Resources/Plans/PlanResource.php` imports `App\Filament\Resources\Plans\Schemas\PlanForm`
- `app/Filament/Resources/Plans/PlanResource.php` imports `App\Filament\Resources\Plans\Schemas\PlanInfolist`
- `app/Filament/Resources/Plans/PlanResource.php` imports `App\Filament\Resources\Plans\Tables\PlanTable`
- `app/Filament/Resources/Plans/PlanResource.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Plans/PlanResource.php` imports `App\Models\Plan`
- `app/Filament/Resources/Plans/PlanResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Plans/PlanResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Plans/PlanResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Plans/PlanResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Plans/PlanResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `App\Enums\Status`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Filament\Facades\Filament`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Filament\Schemas\Components\Utilities\Get`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Plans/Schemas/PlanForm.php` imports `Illuminate\Validation\Rules\Unique`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `App\Models\Plan`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Plans/Schemas/PlanInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `App\Models\Plan`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `App\Models\Service`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Carbon\Carbon`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Tables\Filters\TrashedFilter`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Plans/Tables/PlanTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Services/Pages/ListServices.php` imports `App\Filament\Concerns\HasResourceExcelActions`
- `app/Filament/Resources/Services/Pages/ListServices.php` imports `App\Filament\Resources\Services\ServiceResource`
- `app/Filament/Resources/Services/Pages/ListServices.php` imports `App\Models\Service`
- `app/Filament/Resources/Services/Pages/ListServices.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Services/Pages/ListServices.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Services/Schemas/ServiceForm.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Services/Schemas/ServiceForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Services/Schemas/ServiceForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Services/Schemas/ServiceInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Services/Schemas/ServiceInfolist.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Services/Schemas/ServiceInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Services/ServiceResource.php` imports `App\Filament\Resources\Services\Pages\ListServices`
- `app/Filament/Resources/Services/ServiceResource.php` imports `App\Filament\Resources\Services\Schemas\ServiceForm`
- `app/Filament/Resources/Services/ServiceResource.php` imports `App\Filament\Resources\Services\Schemas\ServiceInfolist`
- `app/Filament/Resources/Services/ServiceResource.php` imports `App\Filament\Resources\Services\Tables\ServiceTable`
- `app/Filament/Resources/Services/ServiceResource.php` imports `App\Models\Service`
- `app/Filament/Resources/Services/ServiceResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Services/ServiceResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Services/ServiceResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Services/ServiceResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `App\Models\Service`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Services/Tables/ServiceTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Subscriptions/Pages/CreateSubscription.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Resources/Subscriptions/Pages/CreateSubscription.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `App\Models\Member`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `Filament\Actions\ForceDeleteAction`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `Filament\Actions\RestoreAction`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Subscriptions/Pages/EditSubscription.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `App\Enums\Status`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `App\Filament\Concerns\HasResourceExcelActions`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Subscriptions/Pages/ListSubscriptions.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` imports `App\Models\Member`
- `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Subscriptions/Pages/ViewSubscription.php` imports `Filament\Resources\Pages\ViewRecord`
- `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php` imports `Filament\Resources\RelationManagers\RelationManager`
- `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Subscriptions/RelationManagers/InvoicesRelationManager.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Filament\Resources\Members\Pages\CreateMember`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Filament\Resources\Members\RelationManagers\SubscriptionsRelationManager`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Helpers\Helpers`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Models\Invoice`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Models\Member`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Models\Plan`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Support\Billing\InvoiceCalculator`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Support\Billing\PaymentMethod`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `App\Support\Data`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Carbon\Carbon`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Forms\Components\Radio`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Forms\Components\Repeater`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Schemas\Components\Fieldset`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Schemas\Components\Utilities\Get`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Schemas\Components\Utilities\Set`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionForm.php` imports `Illuminate\Validation\Rule`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Subscriptions/Schemas/SubscriptionInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Pages\CreateSubscription`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Pages\EditSubscription`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Pages\ListSubscriptions`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Pages\ViewSubscription`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\RelationManagers\InvoicesRelationManager`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Schemas\SubscriptionInfolist`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Filament\Resources\Subscriptions\Tables\SubscriptionTable`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Subscriptions/SubscriptionResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Filament\Resources\Plans\PlanResource`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Models\Member`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Models\Plan`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `App\Models\Subscription`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Carbon\Carbon`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\ForceDeleteBulkAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\RestoreBulkAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Tables\Filters\TrashedFilter`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Subscriptions/Tables/SubscriptionTable.php` imports `Illuminate\Database\Eloquent\SoftDeletingScope`
- `app/Filament/Resources/SystemAdminResource/Pages/CreateSystemAdmin.php` imports `App\Filament\Resources\SystemAdminResource`
- `app/Filament/Resources/SystemAdminResource/Pages/CreateSystemAdmin.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/SystemAdminResource/Pages/EditSystemAdmin.php` imports `App\Filament\Resources\SystemAdminResource`
- `app/Filament/Resources/SystemAdminResource/Pages/EditSystemAdmin.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/SystemAdminResource/Pages/EditSystemAdmin.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/SystemAdminResource/Pages/ListSystemAdmins.php` imports `App\Filament\Resources\SystemAdminResource`
- `app/Filament/Resources/SystemAdminResource/Pages/ListSystemAdmins.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/SystemAdminResource/Pages/ListSystemAdmins.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/SystemAdminResource.php` imports `App\Filament\Resources\SystemAdminResource\Pages`
- `app/Filament/Resources/SystemAdminResource.php` imports `App\Models\SystemAdmin`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/SystemAdminResource.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/SystemAdminResource.php` imports `Illuminate\Support\Facades\Hash`
- `app/Filament/Resources/SystemPlanResource/Pages/CreateSystemPlan.php` imports `App\Filament\Resources\SystemPlanResource`
- `app/Filament/Resources/SystemPlanResource/Pages/CreateSystemPlan.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/SystemPlanResource/Pages/EditSystemPlan.php` imports `App\Filament\Resources\SystemPlanResource`
- `app/Filament/Resources/SystemPlanResource/Pages/EditSystemPlan.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/SystemPlanResource/Pages/EditSystemPlan.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/SystemPlanResource/Pages/ListSystemPlans.php` imports `App\Filament\Resources\SystemPlanResource`
- `app/Filament/Resources/SystemPlanResource/Pages/ListSystemPlans.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/SystemPlanResource/Pages/ListSystemPlans.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/SystemPlanResource.php` imports `App\Filament\Resources\SystemPlanResource\Pages`
- `app/Filament/Resources/SystemPlanResource.php` imports `App\Models\SystemPlan`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Forms\Components\Textarea`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/SystemPlanResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/SystemPlanResource.php` imports `Illuminate\Database\Eloquent\Collection`
- `app/Filament/Resources/SystemRoleResource/Pages/CreateSystemRole.php` imports `App\Filament\Resources\SystemRoleResource`
- `app/Filament/Resources/SystemRoleResource/Pages/CreateSystemRole.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/SystemRoleResource/Pages/EditSystemRole.php` imports `App\Filament\Resources\SystemRoleResource`
- `app/Filament/Resources/SystemRoleResource/Pages/EditSystemRole.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/SystemRoleResource/Pages/ListSystemRoles.php` imports `App\Filament\Resources\SystemRoleResource`
- `app/Filament/Resources/SystemRoleResource/Pages/ListSystemRoles.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/SystemRoleResource/Pages/ListSystemRoles.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/SystemRoleResource.php` imports `App\Filament\Resources\SystemRoleResource\Pages\CreateSystemRole`
- `app/Filament/Resources/SystemRoleResource.php` imports `App\Filament\Resources\SystemRoleResource\Pages\EditSystemRole`
- `app/Filament/Resources/SystemRoleResource.php` imports `App\Filament\Resources\SystemRoleResource\Pages\ListSystemRoles`
- `app/Filament/Resources/SystemRoleResource.php` imports `App\Models\SystemAdmin`
- `app/Filament/Resources/SystemRoleResource.php` imports `App\Models\SystemRole`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Forms\Components\CheckboxList`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Schemas\Components\Grid`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Schemas\Components\Tabs`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Support\Enums\FontWeight`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/SystemRoleResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/SystemRoleResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Resources/Users/Pages/CreateUser.php` imports `App\Filament\Resources\Users\UserResource`
- `app/Filament/Resources/Users/Pages/CreateUser.php` imports `App\Models\Gym`
- `app/Filament/Resources/Users/Pages/CreateUser.php` imports `App\Support\Roles\BusinessRoleManager`
- `app/Filament/Resources/Users/Pages/CreateUser.php` imports `Filament\Facades\Filament`
- `app/Filament/Resources/Users/Pages/CreateUser.php` imports `Filament\Resources\Pages\CreateRecord`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `App\Filament\Resources\Users\UserResource`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `App\Models\Gym`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `App\Models\User`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `App\Support\Roles\BusinessRoleManager`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `Filament\Actions\ForceDeleteAction`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `Filament\Actions\RestoreAction`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `Filament\Facades\Filament`
- `app/Filament/Resources/Users/Pages/EditUser.php` imports `Filament\Resources\Pages\EditRecord`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `App\Enums\Status`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `App\Filament\Resources\Users\UserResource`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `App\Models\User`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `Filament\Actions\CreateAction`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `Filament\Resources\Pages\ListRecords`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `Filament\Schemas\Components\Tabs\Tab`
- `app/Filament/Resources/Users/Pages/ListUsers.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Users/Pages/ViewUser.php` imports `App\Filament\Resources\Users\UserResource`
- `app/Filament/Resources/Users/Pages/ViewUser.php` imports `App\Models\User`
- `app/Filament/Resources/Users/Pages/ViewUser.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Users/Pages/ViewUser.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Users/Pages/ViewUser.php` imports `Filament\Resources\Pages\ViewRecord`
- `app/Filament/Resources/Users/Schemas/UserForm.php` imports `App\Models\Gym`
- `app/Filament/Resources/Users/Schemas/UserForm.php` imports `App\Support\Roles\BusinessRoleManager`
- `app/Filament/Resources/Users/Schemas/UserForm.php` imports `Filament\Forms\Components\Select`
- `app/Filament/Resources/Users/Schemas/UserForm.php` imports `Filament\Forms\Components\TextInput`
- `app/Filament/Resources/Users/Schemas/UserForm.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Users/Schemas/UserForm.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `App\Models\User`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Filament\Infolists\Components\ImageEntry`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Filament\Infolists\Components\TextEntry`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Filament\Schemas\Components\Group`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Filament\Schemas\Components\Section`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Resources/Users/Schemas/UserInfolist.php` imports `Illuminate\Support\Str`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `App\Models\User`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Carbon\Carbon`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\Action`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\BulkActionGroup`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\DeleteAction`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\EditAction`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\RestoreAction`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Forms\Components\DatePicker`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Notifications\Notification`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Tables\Columns\ImageColumn`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Tables\Filters\Filter`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Tables\Filters\TrashedFilter`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Resources/Users/Tables/UserTable.php` imports `Illuminate\Support\Str`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Pages\CreateUser`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Pages\EditUser`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Pages\ListUsers`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Pages\ViewUser`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Schemas\UserForm`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Schemas\UserInfolist`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Filament\Resources\Users\Tables\UserTable`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Models\User`
- `app/Filament/Resources/Users/UserResource.php` imports `App\Support\Filament\GlobalSearchBadge`
- `app/Filament/Resources/Users/UserResource.php` imports `Filament\Resources\Resource`
- `app/Filament/Resources/Users/UserResource.php` imports `Filament\Schemas\Schema`
- `app/Filament/Resources/Users/UserResource.php` imports `Filament\Tables\Table`
- `app/Filament/Resources/Users/UserResource.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Carbon\CarbonImmutable`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Carbon\CarbonInterface`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Carbon\CarbonPeriod`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/CashflowTrendChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `Filament\Support\Facades\FilamentColor`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `Filament\Widgets\Widget`
- `app/Filament/Widgets/Analytics/ExpenseCategoriesDoughnutChartWidget.php` imports `Illuminate\Support\Collection`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `App\Models\Subscription`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Carbon\CarbonImmutable`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Filament\Actions\Action`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Filament\Tables\Table`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Filament\Widgets\TableWidget`
- `app/Filament/Widgets/Analytics/ExpiringSoonSubscriptionsTableWidget.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `Filament\Widgets\StatsOverviewWidget`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `Filament\Widgets\StatsOverviewWidget\Stat`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Widgets/Analytics/FinancialMetricsWidget.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/FinancialSummaryPieChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `App\Models\Member`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/MemberSourceChartWidget.php` imports `Illuminate\Support\Str`
- `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/MemberStatusPieChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Carbon\CarbonImmutable`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Carbon\CarbonInterface`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Carbon\CarbonPeriod`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/MemberTrendChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `Filament\Widgets\StatsOverviewWidget`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `Filament\Widgets\StatsOverviewWidget\Stat`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Widgets/Analytics/MembershipMetricsWidget.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `App\Filament\Resources\Subscriptions\Schemas\SubscriptionForm`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `App\Models\Subscription`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Carbon\CarbonImmutable`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Filament\Actions\Action`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Filament\Actions\ActionGroup`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Filament\Actions\ViewAction`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Filament\Tables\Table`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Filament\Widgets\TableWidget`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Widgets/Analytics/MembershipOverviewSubscriptionsTableWidget.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `App\Helpers\Helpers`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `App\Models\InvoiceTransaction`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `App\Support\Billing\PaymentMethod`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Filament\Tables\Table`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Filament\Widgets\TableWidget`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Illuminate\Support\Facades\Blade`
- `app/Filament/Widgets/Analytics/RecentTransactionsTableWidget.php` imports `Illuminate\Support\HtmlString`
- `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/TopPlansByCollectedBarChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `App\Models\Subscription`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/TopPlansChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `App\Models\Subscription`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Carbon\CarbonImmutable`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Carbon\CarbonInterface`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Carbon\CarbonPeriod`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Filament\Support\RawJs`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Filament\Widgets\ChartWidget`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Filament\Widgets\Concerns\InteractsWithPageFilters`
- `app/Filament/Widgets/Analytics/TopServicesChartWidget.php` imports `Illuminate\Contracts\Support\Htmlable`
- `app/Helpers/Helpers.php` imports `App\Contracts\SequenceRepository`
- `app/Helpers/Helpers.php` imports `App\Contracts\SettingsRepository`
- `app/Helpers/Helpers.php` imports `App\Models\Plan`
- `app/Helpers/Helpers.php` imports `App\Services\JsonSettingsRepository`
- `app/Helpers/Helpers.php` imports `App\Support\Billing\Currency`
- `app/Helpers/Helpers.php` imports `App\Support\Billing\Discounts`
- `app/Helpers/Helpers.php` imports `App\Support\Billing\TaxRate`
- `app/Helpers/Helpers.php` imports `App\Support\Dates\FiscalYear`
- `app/Helpers/Helpers.php` imports `Carbon\Carbon`
- `app/Helpers/Helpers.php` imports `Illuminate\Support\Facades\Lang`
- `app/Helpers/Helpers.php` imports `Illuminate\Support\Str`
- `app/Helpers/Helpers.php` imports `Nnjeim\World\WorldHelper`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `App\Http\Resources\V1\InvoiceTransactionResource`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `App\Models\InvoiceTransaction`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `App\Services\Analytics\AnalyticsService`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `App\Support\Dashboard\DashboardAccess`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/AnalyticsController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `App\Http\Controllers\Controller`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `App\Models\User`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `Illuminate\Database\Eloquent\SoftDeletingScope`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/ApiController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `App\Http\Requests\Api\V1\Auth\LoginRequest`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `App\Http\Resources\V1\UserResource`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `App\Models\User`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `Illuminate\Support\Facades\Hash`
- `app/Http/Controllers/Api/V1/AuthController.php` imports `Illuminate\Validation\ValidationException`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `App\Http\Requests\Api\V1\EnquiryStoreRequest`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `App\Http\Requests\Api\V1\EnquiryUpdateRequest`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `App\Http\Resources\V1\EnquiryResource`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `App\Models\Enquiry`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/EnquiriesController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `App\Http\Requests\Api\V1\EnquiryFollowUpStoreRequest`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `App\Http\Resources\V1\FollowUpResource`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `App\Models\Enquiry`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/EnquiryFollowUpsController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `App\Http\Requests\Api\V1\ExpenseStoreRequest`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `App\Http\Requests\Api\V1\ExpenseUpdateRequest`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `App\Http\Resources\V1\ExpenseResource`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `App\Models\Expense`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/ExpensesController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `App\Http\Requests\Api\V1\FollowUpStoreRequest`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `App\Http\Requests\Api\V1\FollowUpUpdateRequest`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `App\Http\Resources\V1\FollowUpResource`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `App\Models\FollowUp`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/FollowUpsController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `App\Http\Requests\Api\V1\InvoiceTransactionStoreRequest`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `App\Http\Resources\V1\InvoiceTransactionResource`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `App\Models\Invoice`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `App\Models\InvoiceTransaction`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/InvoiceTransactionsController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Http\Requests\Api\V1\InvoiceStoreRequest`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Http\Requests\Api\V1\InvoiceUpdateRequest`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Http\Resources\V1\InvoiceResource`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Models\Invoice`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Models\Subscription`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Support\Invoices\InvoiceDocument`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Support\Invoices\InvoiceDocumentNotRenderable`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `App\Support\Invoices\InvoicePdfRenderer`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/InvoicesController.php` imports `Illuminate\Http\Response`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `App\Http\Requests\Api\V1\MemberStoreRequest`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `App\Http\Requests\Api\V1\MemberUpdateRequest`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `App\Http\Resources\V1\MemberResource`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `App\Models\Member`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/MembersController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/PermissionsController.php` imports `App\Http\Resources\V1\PermissionResource`
- `app/Http/Controllers/Api/V1/PermissionsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/PermissionsController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/PermissionsController.php` imports `Spatie\Permission\Models\Permission`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `App\Http\Requests\Api\V1\PlanStoreRequest`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `App\Http\Requests\Api\V1\PlanUpdateRequest`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `App\Http\Resources\V1\PlanResource`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `App\Models\Plan`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/PlansController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/RolesController.php` imports `App\Http\Resources\V1\RoleResource`
- `app/Http/Controllers/Api/V1/RolesController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/RolesController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/RolesController.php` imports `Spatie\Permission\Models\Role`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `App\Http\Requests\Api\V1\ServiceStoreRequest`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `App\Http\Requests\Api\V1\ServiceUpdateRequest`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `App\Http\Resources\V1\ServiceResource`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `App\Models\Service`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/ServicesController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/SettingsController.php` imports `App\Contracts\SettingsRepository`
- `app/Http/Controllers/Api/V1/SettingsController.php` imports `App\Http\Requests\Api\V1\SettingsUpdateRequest`
- `app/Http/Controllers/Api/V1/SettingsController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/SettingsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Helpers\Helpers`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Http\Requests\Api\V1\SubscriptionRenewRequest`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Http\Requests\Api\V1\SubscriptionStoreRequest`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Http\Requests\Api\V1\SubscriptionUpdateRequest`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Http\Resources\V1\InvoiceResource`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Http\Resources\V1\SubscriptionResource`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Models\Invoice`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Models\Plan`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Models\Subscription`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Services\Subscriptions\SubscriptionRenewalService`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Support\AppConfig`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Support\Billing\PaymentMethod`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `App\Support\Data`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `Carbon\Carbon`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/SubscriptionsController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `App\Http\Requests\Api\V1\UserStoreRequest`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `App\Http\Requests\Api\V1\UserUpdateRequest`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `App\Http\Resources\V1\UserResource`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `App\Models\User`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `App\Services\Api\QueryFilters`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `Illuminate\Http\JsonResponse`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `Illuminate\Http\Resources\Json\AnonymousResourceCollection`
- `app/Http/Controllers/Api/V1/UsersController.php` imports `Spatie\Permission\Models\Role`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `App\Filament\Pages\Dashboard`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `App\Models\Gym`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Illuminate\Http\RedirectResponse`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Illuminate\Http\Request`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Illuminate\Support\Facades\Auth`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Illuminate\Support\Facades\Schema`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Illuminate\Support\HtmlString`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Illuminate\Validation\ValidationException`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Spatie\Permission\PermissionRegistrar`
- `app/Http/Controllers/BusinessSlugLoginController.php` imports `Symfony\Component\HttpFoundation\Response`
- `app/Http/Controllers/Controller.php` imports `Illuminate\Foundation\Auth\Access\AuthorizesRequests`
- `app/Http/Controllers/Controller.php` imports `Illuminate\Foundation\Validation\ValidatesRequests`
- `app/Http/Controllers/InvoiceDocumentController.php` imports `App\Models\Invoice`
- `app/Http/Controllers/InvoiceDocumentController.php` imports `App\Support\Invoices\InvoiceDocument`
- `app/Http/Controllers/InvoiceDocumentController.php` imports `App\Support\Invoices\InvoiceDocumentNotRenderable`
- `app/Http/Controllers/InvoiceDocumentController.php` imports `App\Support\Invoices\InvoicePdfRenderer`
- `app/Http/Controllers/InvoiceDocumentController.php` imports `Illuminate\Http\Response`
- `app/Http/Controllers/InvoiceDocumentController.php` imports `Symfony\Component\HttpFoundation\BinaryFileResponse`
- `app/Http/Middleware/CheckGymStatus.php` imports `App\Filament\Pages\Billing`
- `app/Http/Middleware/CheckGymStatus.php` imports `App\Models\Gym`
- `app/Http/Middleware/CheckGymStatus.php` imports `Closure`
- `app/Http/Middleware/CheckGymStatus.php` imports `Filament\Facades\Filament`
- `app/Http/Middleware/CheckGymStatus.php` imports `Illuminate\Http\Request`
- `app/Http/Middleware/CheckGymStatus.php` imports `Spatie\Permission\PermissionRegistrar`
- `app/Http/Middleware/CheckGymStatus.php` imports `Symfony\Component\HttpFoundation\Response`
- `app/Http/Middleware/ForceJsonResponse.php` imports `Closure`
- `app/Http/Middleware/ForceJsonResponse.php` imports `Illuminate\Http\Request`
- `app/Http/Middleware/ForceJsonResponse.php` imports `Symfony\Component\HttpFoundation\Response`
- `app/Http/Middleware/SetAppLocale.php` imports `App\Contracts\SettingsRepository`
- `app/Http/Middleware/SetAppLocale.php` imports `App\Support\AppConfig`
- `app/Http/Middleware/SetAppLocale.php` imports `App\Support\Data`
- `app/Http/Middleware/SetAppLocale.php` imports `Closure`
- `app/Http/Middleware/SetAppLocale.php` imports `Illuminate\Http\Request`
- `app/Http/Middleware/SetAppLocale.php` imports `Illuminate\Support\Carbon`
- `app/Http/Middleware/SetAppLocale.php` imports `Symfony\Component\HttpFoundation\Response`
- `app/Http/Requests/Api/V1/Auth/LoginRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/Auth/LoginRequest.php` imports `Illuminate\Validation\Validator`
- `app/Http/Requests/Api/V1/EnquiryFollowUpStoreRequest.php` imports `App\Services\Api\Schemas\FollowUpSchema`
- `app/Http/Requests/Api/V1/EnquiryFollowUpStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/EnquiryStoreRequest.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `app/Http/Requests/Api/V1/EnquiryStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/EnquiryUpdateRequest.php` imports `App\Http\Requests\Concerns\ResolvesRouteKey`
- `app/Http/Requests/Api/V1/EnquiryUpdateRequest.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `app/Http/Requests/Api/V1/EnquiryUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/ExpenseStoreRequest.php` imports `App\Services\Api\Schemas\ExpenseSchema`
- `app/Http/Requests/Api/V1/ExpenseStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/ExpenseUpdateRequest.php` imports `App\Services\Api\Schemas\ExpenseSchema`
- `app/Http/Requests/Api/V1/ExpenseUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/FollowUpStoreRequest.php` imports `App\Services\Api\Schemas\FollowUpSchema`
- `app/Http/Requests/Api/V1/FollowUpStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/FollowUpUpdateRequest.php` imports `App\Services\Api\Schemas\FollowUpSchema`
- `app/Http/Requests/Api/V1/FollowUpUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/InvoiceStoreRequest.php` imports `App\Services\Api\Schemas\InvoiceSchema`
- `app/Http/Requests/Api/V1/InvoiceStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/InvoiceTransactionStoreRequest.php` imports `App\Services\Api\Schemas\InvoiceTransactionSchema`
- `app/Http/Requests/Api/V1/InvoiceTransactionStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/InvoiceUpdateRequest.php` imports `App\Http\Requests\Concerns\ResolvesRouteKey`
- `app/Http/Requests/Api/V1/InvoiceUpdateRequest.php` imports `App\Services\Api\Schemas\InvoiceSchema`
- `app/Http/Requests/Api/V1/InvoiceUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/MemberStoreRequest.php` imports `App\Services\Api\Schemas\MemberSchema`
- `app/Http/Requests/Api/V1/MemberStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/MemberUpdateRequest.php` imports `App\Http\Requests\Concerns\ResolvesRouteKey`
- `app/Http/Requests/Api/V1/MemberUpdateRequest.php` imports `App\Services\Api\Schemas\MemberSchema`
- `app/Http/Requests/Api/V1/MemberUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/PlanStoreRequest.php` imports `App\Services\Api\Schemas\PlanSchema`
- `app/Http/Requests/Api/V1/PlanStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/PlanUpdateRequest.php` imports `App\Http\Requests\Concerns\ResolvesRouteKey`
- `app/Http/Requests/Api/V1/PlanUpdateRequest.php` imports `App\Services\Api\Schemas\PlanSchema`
- `app/Http/Requests/Api/V1/PlanUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/ServiceStoreRequest.php` imports `App\Services\Api\Schemas\ServiceSchema`
- `app/Http/Requests/Api/V1/ServiceStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/ServiceUpdateRequest.php` imports `App\Services\Api\Schemas\ServiceSchema`
- `app/Http/Requests/Api/V1/ServiceUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/SettingsUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/SubscriptionRenewRequest.php` imports `App\Services\Api\Schemas\SubscriptionSchema`
- `app/Http/Requests/Api/V1/SubscriptionRenewRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/SubscriptionStoreRequest.php` imports `App\Services\Api\Schemas\SubscriptionSchema`
- `app/Http/Requests/Api/V1/SubscriptionStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/SubscriptionUpdateRequest.php` imports `App\Services\Api\Schemas\SubscriptionSchema`
- `app/Http/Requests/Api/V1/SubscriptionUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/UserStoreRequest.php` imports `App\Services\Api\Schemas\UserSchema`
- `app/Http/Requests/Api/V1/UserStoreRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Api/V1/UserUpdateRequest.php` imports `App\Http\Requests\Concerns\ResolvesRouteKey`
- `app/Http/Requests/Api/V1/UserUpdateRequest.php` imports `App\Services\Api\Schemas\UserSchema`
- `app/Http/Requests/Api/V1/UserUpdateRequest.php` imports `Illuminate\Foundation\Http\FormRequest`
- `app/Http/Requests/Concerns/ResolvesRouteKey.php` imports `App\Support\Data`
- `app/Http/Requests/Concerns/ResolvesRouteKey.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Http/Resources/V1/EnquiryResource.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `app/Http/Resources/V1/EnquiryResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/EnquiryResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/ExpenseResource.php` imports `App\Services\Api\Schemas\ExpenseSchema`
- `app/Http/Resources/V1/ExpenseResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/ExpenseResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/FollowUpResource.php` imports `App\Services\Api\Schemas\FollowUpSchema`
- `app/Http/Resources/V1/FollowUpResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/FollowUpResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/InvoiceResource.php` imports `App\Services\Api\Schemas\InvoiceSchema`
- `app/Http/Resources/V1/InvoiceResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/InvoiceResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/InvoiceTransactionResource.php` imports `App\Services\Api\Schemas\InvoiceTransactionSchema`
- `app/Http/Resources/V1/InvoiceTransactionResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/InvoiceTransactionResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/MemberResource.php` imports `App\Services\Api\Schemas\MemberSchema`
- `app/Http/Resources/V1/MemberResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/MemberResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/PermissionResource.php` imports `App\Services\Api\Schemas\PermissionSchema`
- `app/Http/Resources/V1/PermissionResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/PermissionResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/PermissionResource.php` imports `Spatie\Permission\Models\Permission`
- `app/Http/Resources/V1/PlanResource.php` imports `App\Services\Api\Schemas\PlanSchema`
- `app/Http/Resources/V1/PlanResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/PlanResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/RoleResource.php` imports `App\Services\Api\Schemas\RoleSchema`
- `app/Http/Resources/V1/RoleResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/RoleResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/RoleResource.php` imports `Spatie\Permission\Models\Role`
- `app/Http/Resources/V1/ServiceResource.php` imports `App\Services\Api\Schemas\ServiceSchema`
- `app/Http/Resources/V1/ServiceResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/ServiceResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/SubscriptionResource.php` imports `App\Services\Api\Schemas\SubscriptionSchema`
- `app/Http/Resources/V1/SubscriptionResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/SubscriptionResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Http/Resources/V1/UserResource.php` imports `App\Services\Api\Schemas\UserSchema`
- `app/Http/Resources/V1/UserResource.php` imports `Illuminate\Http\Request`
- `app/Http/Resources/V1/UserResource.php` imports `Illuminate\Http\Resources\Json\JsonResource`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `App\Services\Email\InvoiceEmailService`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `App\Support\Invoices\InvoiceDocumentNotRenderable`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `Illuminate\Bus\Queueable`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `Illuminate\Contracts\Queue\ShouldQueue`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `Illuminate\Foundation\Bus\Dispatchable`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `Illuminate\Queue\InteractsWithQueue`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `Illuminate\Queue\SerializesModels`
- `app/Jobs/SendInvoiceIssuedEmail.php` imports `Illuminate\Support\Facades\Log`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `App\Services\Email\InvoiceEmailService`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `App\Support\Invoices\InvoiceDocumentNotRenderable`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `Illuminate\Bus\Queueable`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `Illuminate\Contracts\Queue\ShouldQueue`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `Illuminate\Foundation\Bus\Dispatchable`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `Illuminate\Queue\InteractsWithQueue`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `Illuminate\Queue\SerializesModels`
- `app/Jobs/SendInvoicePaymentReceiptEmail.php` imports `Illuminate\Support\Facades\Log`
- `app/Mail/InvoiceIssuedMail.php` imports `App\Models\Invoice`
- `app/Mail/InvoiceIssuedMail.php` imports `App\Support\Invoices\InvoiceDocument`
- `app/Mail/InvoiceIssuedMail.php` imports `Illuminate\Bus\Queueable`
- `app/Mail/InvoiceIssuedMail.php` imports `Illuminate\Mail\Mailable`
- `app/Mail/InvoiceIssuedMail.php` imports `Illuminate\Mail\Mailables\Attachment`
- `app/Mail/InvoiceIssuedMail.php` imports `Illuminate\Mail\Mailables\Content`
- `app/Mail/InvoiceIssuedMail.php` imports `Illuminate\Mail\Mailables\Envelope`
- `app/Mail/InvoiceIssuedMail.php` imports `Illuminate\Queue\SerializesModels`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `App\Models\Invoice`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `App\Models\InvoiceTransaction`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `App\Support\Invoices\InvoiceDocument`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `Illuminate\Bus\Queueable`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `Illuminate\Mail\Mailable`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `Illuminate\Mail\Mailables\Attachment`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `Illuminate\Mail\Mailables\Content`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `Illuminate\Mail\Mailables\Envelope`
- `app/Mail/InvoicePaymentReceiptMail.php` imports `Illuminate\Queue\SerializesModels`
- `app/Models/Concerns/BelongsToGym.php` imports `App\Exceptions\CrossTenantException`
- `app/Models/Concerns/BelongsToGym.php` imports `App\Models\Gym`
- `app/Models/Concerns/BelongsToGym.php` imports `Filament\Facades\Filament`
- `app/Models/Concerns/BelongsToGym.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Models/Concerns/BelongsToGym.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Concerns/BelongsToGym.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Concerns/BelongsToGym.php` imports `Illuminate\Support\Facades\DB`
- `app/Models/Concerns/BelongsToGym.php` imports `Illuminate\Support\Facades\Schema`
- `app/Models/Concerns/CascadesSoftDeletes.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Enquiry.php` imports `App\Enums\Status`
- `app/Models/Enquiry.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Enquiry.php` imports `App\Models\Concerns\CascadesSoftDeletes`
- `app/Models/Enquiry.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Enquiry.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Enquiry.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Enquiry.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/Enquiry.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/Expense.php` imports `App\Enums\Status`
- `app/Models/Expense.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Expense.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Expense.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/FollowUp.php` imports `App\Enums\Status`
- `app/Models/FollowUp.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/FollowUp.php` imports `Database\Factories\FollowUpFactory`
- `app/Models/FollowUp.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/FollowUp.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/FollowUp.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/FollowUp.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/Gym.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Gym.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Gym.php` imports `Illuminate\Database\Eloquent\Relations\BelongsToMany`
- `app/Models/Gym.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/GymSubscription.php` imports `Carbon\Carbon`
- `app/Models/GymSubscription.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/GymSubscription.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/GymSubscription.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Invoice.php` imports `App\Enums\Status`
- `app/Models/Invoice.php` imports `App\Helpers\Helpers`
- `app/Models/Invoice.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Invoice.php` imports `App\Support\Billing\InvoiceCalculator`
- `app/Models/Invoice.php` imports `Carbon\Carbon`
- `app/Models/Invoice.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Invoice.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Invoice.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Invoice.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/Invoice.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/InvoiceTransaction.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/InvoiceTransaction.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/InvoiceTransaction.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/InvoiceTransaction.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Member.php` imports `App\Enums\Status`
- `app/Models/Member.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Member.php` imports `App\Models\Concerns\CascadesSoftDeletes`
- `app/Models/Member.php` imports `App\Support\Members\MemberCodeGenerator`
- `app/Models/Member.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Member.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Member.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/Member.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/Plan.php` imports `App\Enums\Status`
- `app/Models/Plan.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Plan.php` imports `App\Models\Concerns\CascadesSoftDeletes`
- `app/Models/Plan.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Plan.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Plan.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Plan.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/Plan.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/Service.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Service.php` imports `App\Models\Concerns\CascadesSoftDeletes`
- `app/Models/Service.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Service.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Service.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/Service.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/Subscription.php` imports `App\Enums\Status`
- `app/Models/Subscription.php` imports `App\Models\Concerns\BelongsToGym`
- `app/Models/Subscription.php` imports `App\Models\Concerns\CascadesSoftDeletes`
- `app/Models/Subscription.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/Subscription.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/Subscription.php` imports `Illuminate\Database\Eloquent\Relations\BelongsTo`
- `app/Models/Subscription.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/Subscription.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/SystemAdmin.php` imports `App\Enums\Status`
- `app/Models/SystemAdmin.php` imports `Filament\Models\Contracts\FilamentUser`
- `app/Models/SystemAdmin.php` imports `Filament\Models\Contracts\HasAvatar`
- `app/Models/SystemAdmin.php` imports `Filament\Panel`
- `app/Models/SystemAdmin.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/SystemAdmin.php` imports `Illuminate\Database\Eloquent\Relations\BelongsToMany`
- `app/Models/SystemAdmin.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/SystemAdmin.php` imports `Illuminate\Foundation\Auth\User as Authenticatable`
- `app/Models/SystemAdmin.php` imports `Illuminate\Notifications\Notifiable`
- `app/Models/SystemPlan.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/SystemPlan.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/SystemPlan.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/SystemRole.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/SystemRole.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/SystemRole.php` imports `Illuminate\Database\Eloquent\Relations\BelongsToMany`
- `app/Models/SystemRole.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/User.php` imports `App\Enums\Status`
- `app/Models/User.php` imports `Database\Factories\UserFactory`
- `app/Models/User.php` imports `Filament\Models\Contracts\FilamentUser`
- `app/Models/User.php` imports `Filament\Models\Contracts\HasAvatar`
- `app/Models/User.php` imports `Filament\Models\Contracts\HasTenants`
- `app/Models/User.php` imports `Filament\Panel`
- `app/Models/User.php` imports `Illuminate\Database\Eloquent\Factories\HasFactory`
- `app/Models/User.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Models/User.php` imports `Illuminate\Database\Eloquent\Relations\BelongsToMany`
- `app/Models/User.php` imports `Illuminate\Database\Eloquent\Relations\HasMany`
- `app/Models/User.php` imports `Illuminate\Database\Eloquent\SoftDeletes`
- `app/Models/User.php` imports `Illuminate\Foundation\Auth\User as Authenticatable`
- `app/Models/User.php` imports `Illuminate\Notifications\Notifiable`
- `app/Models/User.php` imports `Illuminate\Support\Collection`
- `app/Models/User.php` imports `Illuminate\Support\Facades\DB`
- `app/Models/User.php` imports `Illuminate\Support\Facades\Schema`
- `app/Models/User.php` imports `Illuminate\Support\Facades\Storage`
- `app/Models/User.php` imports `Laravel\Sanctum\HasApiTokens`
- `app/Models/User.php` imports `Spatie\Permission\Traits\HasRoles`
- `app/Notifications/ExpiringGymSubscriptionNotification.php` imports `App\Models\Gym`
- `app/Notifications/ExpiringGymSubscriptionNotification.php` imports `Illuminate\Bus\Queueable`
- `app/Notifications/ExpiringGymSubscriptionNotification.php` imports `Illuminate\Contracts\Queue\ShouldQueue`
- `app/Notifications/ExpiringGymSubscriptionNotification.php` imports `Illuminate\Notifications\Notification`
- `app/Observers/GymSubscriptionObserver.php` imports `App\Models\GymSubscription`
- `app/Observers/InvoiceObserver.php` imports `App\Contracts\SettingsRepository`
- `app/Observers/InvoiceObserver.php` imports `App\Jobs\SendInvoiceIssuedEmail`
- `app/Observers/InvoiceObserver.php` imports `App\Models\Invoice`
- `app/Observers/InvoiceObserver.php` imports `App\Support\Data`
- `app/Observers/InvoiceObserver.php` imports `Illuminate\Support\Facades\Log`
- `app/Observers/InvoiceTransactionObserver.php` imports `App\Contracts\SettingsRepository`
- `app/Observers/InvoiceTransactionObserver.php` imports `App\Jobs\SendInvoicePaymentReceiptEmail`
- `app/Observers/InvoiceTransactionObserver.php` imports `App\Models\InvoiceTransaction`
- `app/Observers/InvoiceTransactionObserver.php` imports `App\Support\Data`
- `app/Observers/InvoiceTransactionObserver.php` imports `Illuminate\Support\Facades\Log`
- `app/Policies/EnquiryPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/EnquiryPolicy.php` imports `App\Models\Enquiry`
- `app/Policies/EnquiryPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/ExpensePolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/ExpensePolicy.php` imports `App\Models\Expense`
- `app/Policies/ExpensePolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/FollowUpPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/FollowUpPolicy.php` imports `App\Models\FollowUp`
- `app/Policies/FollowUpPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/GymPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/GymPolicy.php` imports `App\Models\Gym`
- `app/Policies/GymPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/GymSubscriptionPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/GymSubscriptionPolicy.php` imports `App\Models\GymSubscription`
- `app/Policies/GymSubscriptionPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/InvoicePolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/InvoicePolicy.php` imports `App\Models\Invoice`
- `app/Policies/InvoicePolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/MemberPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/MemberPolicy.php` imports `App\Models\Member`
- `app/Policies/MemberPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/PlanPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/PlanPolicy.php` imports `App\Models\Plan`
- `app/Policies/PlanPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/RolePolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/RolePolicy.php` imports `Spatie\Permission\Models\Role`
- `app/Policies/RolePolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/ServicePolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/ServicePolicy.php` imports `App\Models\Service`
- `app/Policies/ServicePolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/SubscriptionPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/SubscriptionPolicy.php` imports `App\Models\Subscription`
- `app/Policies/SubscriptionPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/SystemAdminPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/SystemAdminPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/SystemPlanPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/SystemPlanPolicy.php` imports `App\Models\SystemPlan`
- `app/Policies/SystemPlanPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Policies/UserPolicy.php` imports `Illuminate\Foundation\Auth\User as AuthUser`
- `app/Policies/UserPolicy.php` imports `Illuminate\Auth\Access\HandlesAuthorization`
- `app/Providers/AppServiceProvider.php` imports `App\Contracts\SequenceRepository`
- `app/Providers/AppServiceProvider.php` imports `App\Contracts\SettingsRepository`
- `app/Providers/AppServiceProvider.php` imports `App\Models\GymSubscription`
- `app/Providers/AppServiceProvider.php` imports `App\Models\Invoice`
- `app/Providers/AppServiceProvider.php` imports `App\Models\InvoiceTransaction`
- `app/Providers/AppServiceProvider.php` imports `App\Observers\GymSubscriptionObserver`
- `app/Providers/AppServiceProvider.php` imports `App\Observers\InvoiceObserver`
- `app/Providers/AppServiceProvider.php` imports `App\Observers\InvoiceTransactionObserver`
- `app/Providers/AppServiceProvider.php` imports `App\Services\JsonSequenceRepository`
- `app/Providers/AppServiceProvider.php` imports `App\Services\JsonSettingsRepository`
- `app/Providers/AppServiceProvider.php` imports `App\Support\Data`
- `app/Providers/AppServiceProvider.php` imports `Filament\Actions\Action`
- `app/Providers/AppServiceProvider.php` imports `Filament\Actions\CreateAction`
- `app/Providers/AppServiceProvider.php` imports `Filament\Actions\DeleteAction`
- `app/Providers/AppServiceProvider.php` imports `Filament\Actions\DeleteBulkAction`
- `app/Providers/AppServiceProvider.php` imports `Filament\Actions\EditAction`
- `app/Providers/AppServiceProvider.php` imports `Filament\Actions\ViewAction`
- `app/Providers/AppServiceProvider.php` imports `Filament\Forms\Components\DatePicker`
- `app/Providers/AppServiceProvider.php` imports `Filament\Forms\Components\DateTimePicker`
- `app/Providers/AppServiceProvider.php` imports `Filament\Forms\Components\Select`
- `app/Providers/AppServiceProvider.php` imports `Filament\Support\Assets\Css`
- `app/Providers/AppServiceProvider.php` imports `Filament\Support\Facades\FilamentAsset`
- `app/Providers/AppServiceProvider.php` imports `Filament\Support\Facades\FilamentView`
- `app/Providers/AppServiceProvider.php` imports `Filament\Tables\Columns\TextColumn`
- `app/Providers/AppServiceProvider.php` imports `Filament\View\PanelsRenderHook`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Cache\RateLimiting\Limit`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Http\Request`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Support\Collection`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Support\Facades\Gate`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Support\Facades\RateLimiter`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Support\ServiceProvider`
- `app/Providers/AppServiceProvider.php` imports `Illuminate\Support\Str`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Pages\Dashboard`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Pages\Settings`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Pages\Billing`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Enquiries\EnquiryResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Expenses\ExpenseResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\FollowUps\FollowUpResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Members\MemberResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Plans\PlanResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Services\ServiceResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Http\Middleware\CheckGymStatus`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Http\Middleware\SetAppLocale`
- `app/Providers/Filament/AdminPanelProvider.php` imports `App\Models\Gym`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Http\Middleware\Authenticate`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Http\Middleware\AuthenticateSession`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Http\Middleware\DisableBladeIconComponents`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Http\Middleware\DispatchServingFilamentEvent`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Navigation\MenuItem`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Navigation\NavigationBuilder`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Navigation\NavigationGroup`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Navigation\NavigationItem`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Panel`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\PanelProvider`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Filament\Support\Colors\Color`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Illuminate\Cookie\Middleware\EncryptCookies`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Illuminate\Foundation\Http\Middleware\VerifyCsrfToken`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Illuminate\Routing\Middleware\SubstituteBindings`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Illuminate\Session\Middleware\StartSession`
- `app/Providers/Filament/AdminPanelProvider.php` imports `Illuminate\View\Middleware\ShareErrorsFromSession`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\BusinessRoleResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\GymResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\GymSubscriptionResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\SystemAdminResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\SystemPlanResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\SystemRoleResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Filament\Resources\Users\UserResource`
- `app/Providers/Filament/SystemPanelProvider.php` imports `App\Http\Middleware\SetAppLocale`
- `app/Providers/Filament/SystemPanelProvider.php` imports `BezhanSalleh\FilamentShield\FilamentShieldPlugin`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Http\Middleware\Authenticate`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Http\Middleware\DisableBladeIconComponents`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Http\Middleware\DispatchServingFilamentEvent`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Navigation\NavigationBuilder`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Navigation\NavigationGroup`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Navigation\NavigationItem`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Pages\Dashboard`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Panel`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\PanelProvider`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\Support\Colors\Color`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Filament\View\PanelsRenderHook`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Cookie\Middleware\EncryptCookies`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Foundation\Http\Middleware\VerifyCsrfToken`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Routing\Middleware\SubstituteBindings`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Session\Middleware\StartSession`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Support\Facades\Blade`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\Support\HtmlString`
- `app/Providers/Filament/SystemPanelProvider.php` imports `Illuminate\View\Middleware\ShareErrorsFromSession`
- `app/Rules/ModelExists.php` imports `Closure`
- `app/Rules/ModelExists.php` imports `Illuminate\Contracts\Validation\ValidationRule`
- `app/Rules/ModelUnique.php` imports `Closure`
- `app/Rules/ModelUnique.php` imports `Illuminate\Contracts\Validation\ValidationRule`
- `app/Rules/ModelUnique.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Rules/ReservedBusinessSlug.php` imports `Closure`
- `app/Rules/ReservedBusinessSlug.php` imports `Illuminate\Contracts\Validation\ValidationRule`
- `app/Rules/ReservedBusinessSlug.php` imports `Illuminate\Support\Str`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Helpers\Helpers`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Models\Expense`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Models\Invoice`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Models\InvoiceTransaction`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Models\Member`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Models\Plan`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Models\Subscription`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Support\AppConfig`
- `app/Services/Analytics/AnalyticsService.php` imports `App\Support\Data`
- `app/Services/Analytics/AnalyticsService.php` imports `Carbon\CarbonImmutable`
- `app/Services/Analytics/AnalyticsService.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Services/Analytics/AnalyticsService.php` imports `Illuminate\Support\Collection`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `App\Services\Api\ResourceQueryRules`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Contracts\OperationTransformer`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\Generator\Operation`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\Generator\Parameter`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\Generator\Schema`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\Generator\Types\BooleanType`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\Generator\Types\IntegerType`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\Generator\Types\StringType`
- `app/Services/Api/Docs/AddIndexQueryParametersTransformer.php` imports `Dedoc\Scramble\Support\RouteInfo`
- `app/Services/Api/QueryFilters.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Services/Api/QueryFilters.php` imports `Illuminate\Http\Exceptions\HttpResponseException`
- `app/Services/Api/QueryFilters.php` imports `Illuminate\Http\Request`
- `app/Services/Api/QueryFilters.php` imports `Spatie\QueryBuilder\AllowedFilter`
- `app/Services/Api/QueryFilters.php` imports `Spatie\QueryBuilder\QueryBuilder`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\ExpenseSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\FollowUpSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\InvoiceSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\MemberSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\PlanSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\ServiceSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\SubscriptionSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `App\Services\Api\Schemas\UserSchema`
- `app/Services/Api/ResourceQueryRules.php` imports `InvalidArgumentException`
- `app/Services/Api/Schemas/EnquirySchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/EnquirySchema.php` imports `App\Models\Enquiry`
- `app/Services/Api/Schemas/EnquirySchema.php` imports `App\Models\User`
- `app/Services/Api/Schemas/EnquirySchema.php` imports `App\Rules\ModelExists`
- `app/Services/Api/Schemas/EnquirySchema.php` imports `App\Rules\ModelUnique`
- `app/Services/Api/Schemas/EnquirySchema.php` imports `Illuminate\Validation\Rule`
- `app/Services/Api/Schemas/ExpenseSchema.php` imports `App\Models\Expense`
- `app/Services/Api/Schemas/FollowUpSchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/FollowUpSchema.php` imports `App\Models\Enquiry`
- `app/Services/Api/Schemas/FollowUpSchema.php` imports `App\Models\FollowUp`
- `app/Services/Api/Schemas/FollowUpSchema.php` imports `App\Models\User`
- `app/Services/Api/Schemas/FollowUpSchema.php` imports `App\Rules\ModelExists`
- `app/Services/Api/Schemas/FollowUpSchema.php` imports `Illuminate\Validation\Rule`
- `app/Services/Api/Schemas/InvoiceSchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/InvoiceSchema.php` imports `App\Models\Invoice`
- `app/Services/Api/Schemas/InvoiceSchema.php` imports `App\Models\Subscription`
- `app/Services/Api/Schemas/InvoiceSchema.php` imports `App\Rules\ModelExists`
- `app/Services/Api/Schemas/InvoiceSchema.php` imports `App\Rules\ModelUnique`
- `app/Services/Api/Schemas/InvoiceTransactionSchema.php` imports `App\Models\InvoiceTransaction`
- `app/Services/Api/Schemas/InvoiceTransactionSchema.php` imports `Illuminate\Validation\Rule`
- `app/Services/Api/Schemas/MemberSchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/MemberSchema.php` imports `App\Models\Member`
- `app/Services/Api/Schemas/MemberSchema.php` imports `App\Rules\ModelUnique`
- `app/Services/Api/Schemas/MemberSchema.php` imports `Illuminate\Support\Facades\Storage`
- `app/Services/Api/Schemas/MemberSchema.php` imports `Illuminate\Validation\Rule`
- `app/Services/Api/Schemas/PermissionSchema.php` imports `Spatie\Permission\Models\Permission`
- `app/Services/Api/Schemas/PlanSchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/PlanSchema.php` imports `App\Models\Plan`
- `app/Services/Api/Schemas/PlanSchema.php` imports `App\Models\Service`
- `app/Services/Api/Schemas/PlanSchema.php` imports `App\Rules\ModelExists`
- `app/Services/Api/Schemas/PlanSchema.php` imports `App\Rules\ModelUnique`
- `app/Services/Api/Schemas/RoleSchema.php` imports `Spatie\Permission\Models\Role`
- `app/Services/Api/Schemas/ServiceSchema.php` imports `App\Models\Service`
- `app/Services/Api/Schemas/SubscriptionSchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/SubscriptionSchema.php` imports `App\Http\Resources\V1\InvoiceResource`
- `app/Services/Api/Schemas/SubscriptionSchema.php` imports `App\Models\Member`
- `app/Services/Api/Schemas/SubscriptionSchema.php` imports `App\Models\Plan`
- `app/Services/Api/Schemas/SubscriptionSchema.php` imports `App\Models\Subscription`
- `app/Services/Api/Schemas/SubscriptionSchema.php` imports `App\Rules\ModelExists`
- `app/Services/Api/Schemas/UserSchema.php` imports `App\Enums\Status`
- `app/Services/Api/Schemas/UserSchema.php` imports `App\Models\User`
- `app/Services/Api/Schemas/UserSchema.php` imports `App\Rules\ModelExists`
- `app/Services/Api/Schemas/UserSchema.php` imports `App\Rules\ModelUnique`
- `app/Services/Api/Schemas/UserSchema.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Services/Api/Schemas/UserSchema.php` imports `Illuminate\Support\Facades\Storage`
- `app/Services/Api/Schemas/UserSchema.php` imports `Illuminate\Validation\Rule`
- `app/Services/Api/Schemas/UserSchema.php` imports `Spatie\Permission\Models\Role`
- `app/Services/Backup/ApplicationBackupService.php` imports `Illuminate\Support\Facades\DB`
- `app/Services/Backup/ApplicationBackupService.php` imports `Illuminate\Support\Facades\File`
- `app/Services/Backup/ApplicationBackupService.php` imports `OpenSpout\Common\Entity\Row`
- `app/Services/Backup/ApplicationBackupService.php` imports `OpenSpout\Writer\XLSX\Writer`
- `app/Services/Backup/ApplicationBackupService.php` imports `Symfony\Component\HttpFoundation\BinaryFileResponse`
- `app/Services/Backup/ApplicationBackupService.php` imports `Throwable`
- `app/Services/Backup/ApplicationBackupService.php` imports `ZipArchive`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Contracts\SettingsRepository`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Helpers\Helpers`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Jobs\SendInvoiceIssuedEmail`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Jobs\SendInvoicePaymentReceiptEmail`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Mail\InvoiceIssuedMail`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Mail\InvoicePaymentReceiptMail`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Models\Invoice`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Models\InvoiceTransaction`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Support\AppConfig`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Support\Data`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Support\Invoices\InvoiceDocument`
- `app/Services/Email/InvoiceEmailService.php` imports `App\Support\Invoices\InvoicePdfRenderer`
- `app/Services/Email/InvoiceEmailService.php` imports `Illuminate\Support\Facades\Log`
- `app/Services/Email/InvoiceEmailService.php` imports `Illuminate\Support\Facades\Mail`
- `app/Services/Email/InvoiceEmailService.php` imports `Illuminate\Support\Str`
- `app/Services/Excel/ResourceExcelService.php` imports `App\Models\Expense`
- `app/Services/Excel/ResourceExcelService.php` imports `App\Models\Invoice`
- `app/Services/Excel/ResourceExcelService.php` imports `App\Models\Member`
- `app/Services/Excel/ResourceExcelService.php` imports `App\Models\Plan`
- `app/Services/Excel/ResourceExcelService.php` imports `App\Models\Service`
- `app/Services/Excel/ResourceExcelService.php` imports `App\Models\Subscription`
- `app/Services/Excel/ResourceExcelService.php` imports `Carbon\Carbon`
- `app/Services/Excel/ResourceExcelService.php` imports `DateTimeInterface`
- `app/Services/Excel/ResourceExcelService.php` imports `Illuminate\Database\Eloquent\Builder`
- `app/Services/Excel/ResourceExcelService.php` imports `Illuminate\Database\Eloquent\Model`
- `app/Services/Excel/ResourceExcelService.php` imports `Illuminate\Support\Facades\File`
- `app/Services/Excel/ResourceExcelService.php` imports `Illuminate\Support\Facades\Validator`
- `app/Services/Excel/ResourceExcelService.php` imports `Illuminate\Validation\Rule`
- `app/Services/Excel/ResourceExcelService.php` imports `OpenSpout\Common\Entity\Row`
- `app/Services/Excel/ResourceExcelService.php` imports `OpenSpout\Reader\XLSX\Reader`
- `app/Services/Excel/ResourceExcelService.php` imports `OpenSpout\Writer\XLSX\Writer`
- `app/Services/Excel/ResourceExcelService.php` imports `Symfony\Component\HttpFoundation\BinaryFileResponse`
- `app/Services/Excel/ResourceExcelService.php` imports `Throwable`
- `app/Services/JsonSequenceRepository.php` imports `App\Contracts\SequenceRepository`
- `app/Services/JsonSequenceRepository.php` imports `App\Contracts\SettingsRepository`
- `app/Services/JsonSequenceRepository.php` imports `App\Helpers\Helpers`
- `app/Services/JsonSequenceRepository.php` imports `App\Support\Data`
- `app/Services/JsonSequenceRepository.php` imports `Filament\Facades\Filament`
- `app/Services/JsonSequenceRepository.php` imports `Illuminate\Support\Facades\Schema`
- `app/Services/JsonSequenceRepository.php` imports `Illuminate\Support\Str`
- `app/Services/JsonSettingsRepository.php` imports `App\Contracts\SettingsRepository`
- `app/Services/Members/MemberExcelService.php` imports `App\Models\Member`
- `app/Services/Members/MemberExcelService.php` imports `Carbon\Carbon`
- `app/Services/Members/MemberExcelService.php` imports `DateTimeInterface`
- `app/Services/Members/MemberExcelService.php` imports `Illuminate\Support\Facades\File`
- `app/Services/Members/MemberExcelService.php` imports `Illuminate\Support\Facades\Validator`
- `app/Services/Members/MemberExcelService.php` imports `Illuminate\Validation\Rule`
- `app/Services/Members/MemberExcelService.php` imports `OpenSpout\Common\Entity\Row`
- `app/Services/Members/MemberExcelService.php` imports `OpenSpout\Reader\XLSX\Reader`
- `app/Services/Members/MemberExcelService.php` imports `OpenSpout\Writer\XLSX\Writer`
- `app/Services/Members/MemberExcelService.php` imports `Symfony\Component\HttpFoundation\BinaryFileResponse`
- `app/Services/Members/MemberExcelService.php` imports `Throwable`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `App\Helpers\Helpers`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `App\Models\Invoice`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `App\Models\Plan`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `App\Models\Subscription`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `App\Support\Billing\PaymentMethod`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `App\Support\Data`
- `app/Services/Subscriptions/SubscriptionRenewalService.php` imports `Carbon\Carbon`
- `app/Support/Analytics/AnalyticsDateRange.php` imports `Carbon\CarbonImmutable`
- `app/Support/Billing/Currency.php` imports `Illuminate\Support\Number`
- `app/Support/Billing/Currency.php` imports `NumberFormatter`
- `app/Support/Billing/Discounts.php` imports `Illuminate\Support\Number`
- `app/Support/Dashboard/DashboardAccess.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `app/Support/Dashboard/DashboardAccess.php` imports `App\Support\AppConfig`
- `app/Support/Dashboard/DashboardAccess.php` imports `Carbon\CarbonImmutable`
- `app/Support/Dashboard/DashboardAccess.php` imports `Illuminate\Support\Facades\Blade`
- `app/Support/Dashboard/DashboardAccess.php` imports `Illuminate\Support\HtmlString`
- `app/Support/Data.php` imports `Stringable`
- `app/Support/Dates/FiscalYear.php` imports `App\Support\Data`
- `app/Support/Dates/FiscalYear.php` imports `Carbon\Carbon`
- `app/Support/Dates/FiscalYear.php` imports `Carbon\CarbonInterface`
- `app/Support/Filament/GlobalSearchBadge.php` imports `App\Enums\Status`
- `app/Support/Filament/GlobalSearchBadge.php` imports `Illuminate\Support\Facades\Blade`
- `app/Support/Filament/GlobalSearchBadge.php` imports `Illuminate\Support\HtmlString`
- `app/Support/Invoices/InvoiceDocument.php` imports `App\Helpers\Helpers`
- `app/Support/Invoices/InvoiceDocument.php` imports `App\Models\Invoice`
- `app/Support/Invoices/InvoiceDocument.php` imports `Illuminate\Support\Carbon`
- `app/Support/Invoices/InvoiceDocumentNotRenderable.php` imports `RuntimeException`
- `app/Support/Invoices/InvoicePdfRenderer.php` imports `App\Models\Invoice`
- `app/Support/Invoices/InvoicePdfRenderer.php` imports `Barryvdh\DomPDF\Facade\Pdf`
- `app/Support/Invoices/InvoicePdfRenderer.php` imports `Illuminate\Support\Facades\File`
- `app/Support/Members/MemberCodeGenerator.php` imports `App\Models\Member`
- `app/Support/Members/MemberCodeGenerator.php` imports `RuntimeException`
- `app/Support/Roles/BusinessRoleManager.php` imports `App\Models\Gym`
- `app/Support/Roles/BusinessRoleManager.php` imports `App\Models\User`
- `app/Support/Roles/BusinessRoleManager.php` imports `Illuminate\Support\Str`
- `app/Support/Roles/BusinessRoleManager.php` imports `InvalidArgumentException`
- `app/Support/Roles/BusinessRoleManager.php` imports `Spatie\Permission\Models\Role`
- `app/Support/Roles/BusinessRoleManager.php` imports `Spatie\Permission\PermissionRegistrar`
- `bootstrap/app.php` imports `Illuminate\Foundation\Application`
- `bootstrap/app.php` imports `Illuminate\Foundation\Configuration\Exceptions`
- `bootstrap/app.php` imports `Illuminate\Foundation\Configuration\Middleware`
- `bootstrap/app.php` imports `Illuminate\Http\Request`
- `bootstrap/app.php` imports `Spatie\QueryBuilder\Exceptions\InvalidFilterQuery`
- `bootstrap/app.php` imports `Spatie\QueryBuilder\Exceptions\InvalidIncludeQuery`
- `bootstrap/app.php` imports `Spatie\QueryBuilder\Exceptions\InvalidQuery`
- `bootstrap/app.php` imports `Spatie\QueryBuilder\Exceptions\InvalidSortQuery`
- `config/cache.php` imports `Illuminate\Support\Str`
- `config/database.php` imports `Illuminate\Support\Str`
- `config/logging.php` imports `Monolog\Handler\NullHandler`
- `config/logging.php` imports `Monolog\Handler\StreamHandler`
- `config/logging.php` imports `Monolog\Handler\SyslogUdpHandler`
- `config/logging.php` imports `Monolog\Processor\PsrLogMessageProcessor`
- `config/sanctum.php` imports `Laravel\Sanctum\Sanctum`
- `config/session.php` imports `Illuminate\Support\Str`
- `database/factories/EnquiryFactory.php` imports `App\Models\Service`
- `database/factories/EnquiryFactory.php` imports `App\Models\User`
- `database/factories/EnquiryFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/ExpenseFactory.php` imports `App\Enums\Status`
- `database/factories/ExpenseFactory.php` imports `App\Helpers\Helpers`
- `database/factories/ExpenseFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/ExpenseFactory.php` imports `Illuminate\Support\Carbon`
- `database/factories/FollowUpFactory.php` imports `App\Models\Enquiry`
- `database/factories/FollowUpFactory.php` imports `App\Models\User`
- `database/factories/FollowUpFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/InvoiceFactory.php` imports `App\Helpers\Helpers`
- `database/factories/InvoiceFactory.php` imports `App\Models\Subscription`
- `database/factories/InvoiceFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/MemberFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/PlanFactory.php` imports `App\Models\Service`
- `database/factories/PlanFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/ServiceFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/SubscriptionFactory.php` imports `App\Models\Member`
- `database/factories/SubscriptionFactory.php` imports `App\Models\Plan`
- `database/factories/SubscriptionFactory.php` imports `Carbon\CarbonImmutable`
- `database/factories/SubscriptionFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/UserFactory.php` imports `Illuminate\Database\Eloquent\Factories\Factory`
- `database/factories/UserFactory.php` imports `Illuminate\Support\Facades\Hash`
- `database/factories/UserFactory.php` imports `Illuminate\Support\Str`
- `database/migrations/0001_01_01_000000_create_users_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/0001_01_01_000000_create_users_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/0001_01_01_000000_create_users_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/0001_01_01_000001_create_cache_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/0001_01_01_000001_create_cache_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/0001_01_01_000001_create_cache_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/0001_01_01_000002_create_jobs_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/0001_01_01_000002_create_jobs_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/0001_01_01_000002_create_jobs_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_05_26_020228_create_enquiries_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_05_26_020228_create_enquiries_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_05_26_020228_create_enquiries_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_05_27_065258_create_follow_ups_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_05_27_065258_create_follow_ups_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_05_27_065258_create_follow_ups_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_02_113254_create_services_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_02_113254_create_services_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_02_113254_create_services_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_04_100009_create_plans_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_04_100009_create_plans_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_04_100009_create_plans_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_09_100252_create_permission_tables.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_09_100252_create_permission_tables.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_09_100252_create_permission_tables.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_10_101915_create_members_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_10_101915_create_members_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_10_101915_create_members_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_11_134644_create_subscriptions_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_11_134644_create_subscriptions_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_11_134644_create_subscriptions_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_13_005807_create_invoices_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_13_005807_create_invoices_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_13_005807_create_invoices_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_06_15_102321_create_notifications_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_06_15_102321_create_notifications_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_06_15_102321_create_notifications_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2025_09_15_025013_create_personal_access_tokens_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2025_09_15_025013_create_personal_access_tokens_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2025_09_15_025013_create_personal_access_tokens_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_02_10_000001_create_expenses_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_02_10_000001_create_expenses_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_02_10_000001_create_expenses_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_02_12_000001_create_invoice_transactions_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_02_12_000001_create_invoice_transactions_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_02_12_000001_create_invoice_transactions_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_03_14_060518_normalize_invoice_subscription_fee_to_gross.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_03_14_060518_normalize_invoice_subscription_fee_to_gross.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_19_000001_create_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_19_000001_create_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_19_000001_create_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_19_000002_create_gym_user_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_19_000002_create_gym_user_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_19_000002_create_gym_user_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_19_000003_add_gym_id_to_core_tables.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_19_000004_add_gym_id_to_spatie_roles_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_19_000004_add_gym_id_to_spatie_roles_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_19_000004_add_gym_id_to_spatie_roles_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000001_add_owner_fields_to_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000001_add_owner_fields_to_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000001_add_owner_fields_to_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000002_add_assigned_id_to_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000002_add_assigned_id_to_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000002_add_assigned_id_to_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_20_000003_cleanup_zombie_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000004_convert_users_email_to_username.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000004_convert_users_email_to_username.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000004_convert_users_email_to_username.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000005_remove_contact_details_from_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000005_remove_contact_details_from_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000005_remove_contact_details_from_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_20_000006_repair_null_usernames_in_users_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_20_000007_force_restore_superadmin_user.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000008_create_system_admins_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000008_create_system_admins_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000008_create_system_admins_table.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_20_000008_create_system_admins_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000009_purge_administrator_roles.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000009_purge_administrator_roles.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000009_purge_administrator_roles.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_20_000009_purge_administrator_roles.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000010_strip_cluttered_fields_from_users_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000010_strip_cluttered_fields_from_users_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000010_strip_cluttered_fields_from_users_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_20_000011_database_segregation_audit.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_20_000011_database_segregation_audit.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_20_000011_database_segregation_audit.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_21_000001_create_system_plans_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_21_000001_create_system_plans_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_21_000001_create_system_plans_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_21_000002_create_gym_subscriptions_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_21_000002_create_gym_subscriptions_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_21_000002_create_gym_subscriptions_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_21_000003_add_expiry_columns_to_gyms.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_21_000003_add_expiry_columns_to_gyms.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_21_000003_add_expiry_columns_to_gyms.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_21_000004_add_map_link_to_gyms.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_21_000004_add_map_link_to_gyms.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_21_000004_add_map_link_to_gyms.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_21_000005_cleanup_duplicate_roles.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_21_000005_cleanup_duplicate_roles.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_22_000001_create_system_roles_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_22_000001_create_system_roles_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_22_000001_create_system_roles_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_22_000002_create_system_role_assignment_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_22_000002_create_system_role_assignment_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_22_000002_create_system_role_assignment_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_22_000003_cleanup_duplicate_roles.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_22_000003_cleanup_duplicate_roles.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_22_999999_add_business_details_to_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_22_999999_add_business_details_to_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_22_999999_add_business_details_to_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_23_000001_align_gym_subscriptions_schema.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_23_000001_align_gym_subscriptions_schema.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_23_000001_align_gym_subscriptions_schema.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_23_000002_drop_gym_subscription_payment_columns.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_23_000002_drop_gym_subscription_payment_columns.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_23_000002_drop_gym_subscription_payment_columns.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_24_000100_remove_predefined_business_roles.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_24_000100_remove_predefined_business_roles.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_24_000100_remove_predefined_business_roles.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_24_000200_separate_system_and_business_access.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_24_000200_separate_system_and_business_access.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_24_000200_separate_system_and_business_access.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_25_000001_remove_goal_and_update_sources_on_members_and_enquiries.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_25_000002_enforce_global_unique_member_codes.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php` imports `Illuminate\Database\Migrations\Migration`
- `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php` imports `Illuminate\Database\Schema\Blueprint`
- `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php` imports `Illuminate\Support\Facades\DB`
- `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php` imports `Illuminate\Support\Facades\Schema`
- `database/migrations/2026_06_25_000003_add_url_slug_to_gyms_table.php` imports `Illuminate\Support\Str`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Contracts\SettingsRepository`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Helpers\Helpers`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\Expense`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\Invoice`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\InvoiceTransaction`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\Member`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\Plan`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\Service`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\Subscription`
- `database/seeders/DashboardDemoSeeder.php` imports `App\Models\User`
- `database/seeders/DashboardDemoSeeder.php` imports `Carbon\CarbonImmutable`
- `database/seeders/DashboardDemoSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/DashboardDemoSeeder.php` imports `Illuminate\Support\Collection`
- `database/seeders/DatabaseSeeder.php` imports `App\Models\Gym`
- `database/seeders/DatabaseSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/DatabaseSeeder.php` imports `Illuminate\Support\Facades\DB`
- `database/seeders/DatabaseSeeder.php` imports `Nnjeim\World\Actions\SeedAction`
- `database/seeders/EnquirySeeder.php` imports `App\Models\Enquiry`
- `database/seeders/EnquirySeeder.php` imports `Illuminate\Database\Console\Seeds\WithoutModelEvents`
- `database/seeders/EnquirySeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/ExpenseSeeder.php` imports `App\Models\Expense`
- `database/seeders/ExpenseSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/ExpiringGymSubscriptionNotification.php` imports `App\Models\Gym`
- `database/seeders/ExpiringGymSubscriptionNotification.php` imports `Illuminate\Bus\Queueable`
- `database/seeders/ExpiringGymSubscriptionNotification.php` imports `Illuminate\Contracts\Queue\ShouldQueue`
- `database/seeders/ExpiringGymSubscriptionNotification.php` imports `Illuminate\Notifications\Notification`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `App\Models\Gym`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `App\Models\GymSubscription`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `App\Models\SystemAdmin`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `App\Models\SystemPlan`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `App\Models\User`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `App\Support\Dashboard\DashboardAccess`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Carbon\CarbonImmutable`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Illuminate\Support\Facades\DB`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Illuminate\Support\Facades\Hash`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Illuminate\Support\Facades\Schema`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Spatie\Permission\Models\Permission`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Spatie\Permission\Models\Role`
- `database/seeders/FeatureOneTemporaryTestDataSeeder.php` imports `Spatie\Permission\PermissionRegistrar`
- `database/seeders/FollowUpSeeder.php` imports `App\Models\FollowUp`
- `database/seeders/FollowUpSeeder.php` imports `Illuminate\Database\Console\Seeds\WithoutModelEvents`
- `database/seeders/FollowUpSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/GymTenancySeeder.php` imports `App\Models\Gym`
- `database/seeders/GymTenancySeeder.php` imports `App\Models\User`
- `database/seeders/GymTenancySeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/GymTenancySeeder.php` imports `Illuminate\Support\Facades\DB`
- `database/seeders/GymTenancySeeder.php` imports `Illuminate\Support\Facades\Schema`
- `database/seeders/InvoiceSeeder.php` imports `App\Models\Invoice`
- `database/seeders/InvoiceSeeder.php` imports `Illuminate\Database\Console\Seeds\WithoutModelEvents`
- `database/seeders/InvoiceSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Contracts\SettingsRepository`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Models\Gym`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Models\GymSubscription`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Models\SystemAdmin`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Models\SystemPlan`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Models\User`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Support\Dashboard\DashboardAccess`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `App\Support\Members\MemberCodeGenerator`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Carbon\CarbonImmutable`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Illuminate\Support\Facades\DB`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Illuminate\Support\Facades\Hash`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Illuminate\Support\Facades\Schema`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Spatie\Permission\Models\Permission`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Spatie\Permission\Models\Role`
- `database/seeders/MandatoryTemporaryTestDataSeeder.php` imports `Spatie\Permission\PermissionRegistrar`
- `database/seeders/MemberSeeder.php` imports `App\Models\Member`
- `database/seeders/MemberSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/PlanSeeder.php` imports `App\Models\Plan`
- `database/seeders/PlanSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/ServiceSeeder.php` imports `App\Models\Enquiry`
- `database/seeders/ServiceSeeder.php` imports `App\Models\Service`
- `database/seeders/ServiceSeeder.php` imports `Illuminate\Database\Console\Seeds\WithoutModelEvents`
- `database/seeders/ServiceSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/SubscriptionSeeder.php` imports `App\Models\Subscription`
- `database/seeders/SubscriptionSeeder.php` imports `Illuminate\Database\Console\Seeds\WithoutModelEvents`
- `database/seeders/SubscriptionSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/SystemRolesSeeder.php` imports `App\Models\SystemRole`
- `database/seeders/SystemRolesSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/UserSeeder.php` imports `App\Models\User`
- `database/seeders/UserSeeder.php` imports `Illuminate\Database\Console\Seeds\WithoutModelEvents`
- `database/seeders/UserSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/UserSeeder.php` imports `Illuminate\Support\Facades\Hash`
- `database/seeders/WorldSeeder.php` imports `Illuminate\Database\Seeder`
- `database/seeders/WorldSeeder.php` imports `Nnjeim\World\Actions\SeedAction`
- `public/index.php` imports `Illuminate\Foundation\Application`
- `public/index.php` imports `Illuminate\Http\Request`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\AnalyticsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\AuthController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\EnquiriesController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\EnquiryFollowUpsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\ExpensesController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\FollowUpsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\InvoicesController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\InvoiceTransactionsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\MembersController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\PermissionsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\PlansController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\RolesController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\ServicesController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\SettingsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\SubscriptionsController`
- `routes/api.php` imports `App\Http\Controllers\Api\V1\UsersController`
- `routes/api.php` imports `Illuminate\Http\Request`
- `routes/api.php` imports `Illuminate\Support\Facades\Route`
- `routes/console.php` imports `Illuminate\Foundation\Inspiring`
- `routes/console.php` imports `Illuminate\Support\Facades\Artisan`
- `routes/console.php` imports `Illuminate\Support\Facades\Schedule`
- `routes/web.php` imports `App\Http\Controllers\BusinessSlugLoginController`
- `routes/web.php` imports `App\Http\Controllers\InvoiceDocumentController`
- `routes/web.php` imports `App\Rules\ReservedBusinessSlug`
- `routes/web.php` imports `Filament\Http\Middleware\Authenticate`
- `routes/web.php` imports `Illuminate\Support\Facades\Route`
- `tests/BaseGymieTest.php` imports `Tests\Helpers\TestLogger`
- `tests/Feature/Api/AnalyticsApiTest.php` imports `App\Models\User`
- `tests/Feature/Api/AnalyticsApiTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/AnalyticsApiTest.php` imports `Laravel\Sanctum\Sanctum`
- `tests/Feature/Api/ApiCrudFlowTest.php` imports `App\Models\Invoice`
- `tests/Feature/Api/ApiCrudFlowTest.php` imports `App\Models\User`
- `tests/Feature/Api/ApiCrudFlowTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/ApiCrudFlowTest.php` imports `Laravel\Sanctum\Sanctum`
- `tests/Feature/Api/ApiCrudFlowTest.php` imports `Spatie\Permission\Models\Permission`
- `tests/Feature/Api/ApiCrudFlowTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/Api/ApiPermissionsTest.php` imports `App\Models\User`
- `tests/Feature/Api/ApiPermissionsTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/ApiPermissionsTest.php` imports `Laravel\Sanctum\Sanctum`
- `tests/Feature/Api/ApiPermissionsTest.php` imports `Spatie\Permission\Models\Permission`
- `tests/Feature/Api/ApiPermissionsTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/Api/AuthApiTest.php` imports `App\Models\User`
- `tests/Feature/Api/AuthApiTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/AuthApiTest.php` imports `Illuminate\Support\Facades\Auth`
- `tests/Feature/Api/LocaleApiTest.php` imports `App\Models\User`
- `tests/Feature/Api/LocaleApiTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/LocaleApiTest.php` imports `Laravel\Sanctum\Sanctum`
- `tests/Feature/Api/LocaleApiTest.php` imports `Spatie\Permission\Models\Permission`
- `tests/Feature/Api/LocaleApiTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `App\Models\Plan`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `App\Models\Service`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `App\Models\User`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `Laravel\Sanctum\Sanctum`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `Spatie\Permission\Models\Permission`
- `tests/Feature/Api/RichFilteringApiTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/Api/SettingsApiTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/Api/SettingsApiTest.php` imports `App\Models\User`
- `tests/Feature/Api/SettingsApiTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/Api/SettingsApiTest.php` imports `Laravel\Sanctum\Sanctum`
- `tests/Feature/ApiTest.php` imports `App\Models\Enquiry`
- `tests/Feature/ApiTest.php` imports `App\Models\Member`
- `tests/Feature/ApiTest.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `tests/Feature/ApiTest.php` imports `App\Services\Api\Schemas\MemberSchema`
- `tests/Feature/ApiTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/BusinessSlugLoginTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/CascadingSoftDeletesTest.php` imports `App\Models\Enquiry`
- `tests/Feature/CascadingSoftDeletesTest.php` imports `App\Models\FollowUp`
- `tests/Feature/CascadingSoftDeletesTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Contracts\SettingsRepository`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Jobs\SendInvoiceIssuedEmail`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Jobs\SendInvoicePaymentReceiptEmail`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Models\Expense`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Models\Invoice`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Models\InvoiceTransaction`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Models\Member`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Models\Plan`
- `tests/Feature/DashboardDemoSeederTest.php` imports `App\Models\Subscription`
- `tests/Feature/DashboardDemoSeederTest.php` imports `Database\Seeders\DashboardDemoSeeder`
- `tests/Feature/DashboardDemoSeederTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/DashboardDemoSeederTest.php` imports `Illuminate\Support\Collection`
- `tests/Feature/DashboardDemoSeederTest.php` imports `Illuminate\Support\Facades\Queue`
- `tests/Feature/ExpiringNotificationCommandTest.php` imports `App\Models\Gym`
- `tests/Feature/ExpiringNotificationCommandTest.php` imports `App\Models\SystemAdmin`
- `tests/Feature/ExpiringNotificationCommandTest.php` imports `App\Models\User`
- `tests/Feature/ExpiringNotificationCommandTest.php` imports `App\Notifications\ExpiringGymSubscriptionNotification`
- `tests/Feature/ExpiringNotificationCommandTest.php` imports `Illuminate\Support\Facades\Hash`
- `tests/Feature/ExpiringNotificationCommandTest.php` imports `Illuminate\Support\Facades\Notification`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `App\Filament\Widgets\Analytics\MembershipOverviewSubscriptionsTableWidget`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `App\Models\Member`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `App\Models\Plan`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `App\Models\Subscription`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `Carbon\CarbonImmutable`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/ExpiringSoonSubscriptionsTableWidgetTest.php` imports `Livewire\Livewire`
- `tests/Feature/FacilityStaffRelationManagerTest.php` imports `App\Models\Gym`
- `tests/Feature/FacilityStaffRelationManagerTest.php` imports `App\Models\User`
- `tests/Feature/FacilityStaffRelationManagerTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/FacilityStaffRelationManagerTest.php` imports `Illuminate\Support\Facades\Hash`
- `tests/Feature/FacilityStaffRelationManagerTest.php` imports `Spatie\Permission\Models\Role`
- `tests/Feature/FacilityStaffRelationManagerTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/FinancialMetricsWidgetTest.php` imports `App\Filament\Widgets\Analytics\FinancialMetricsWidget`
- `tests/Feature/FinancialMetricsWidgetTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/FinancialMetricsWidgetTest.php` imports `Carbon\CarbonImmutable`
- `tests/Feature/FinancialMetricsWidgetTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/FinancialMetricsWidgetTest.php` imports `Livewire\Livewire`
- `tests/Feature/FollowUpTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `App\Models\Invoice`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `App\Models\Member`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `App\Models\Plan`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `App\Models\Subscription`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `App\Models\User`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `Spatie\Permission\Models\Permission`
- `tests/Feature/InvoiceDocumentControllerTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/InvoiceDocumentViewRendersTest.php` imports `App\Models\Invoice`
- `tests/Feature/InvoiceDocumentViewRendersTest.php` imports `App\Support\Invoices\InvoiceDocument`
- `tests/Feature/InvoiceDocumentViewRendersTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Mail\InvoiceIssuedMail`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Models\Invoice`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Models\Member`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Models\Plan`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Models\Subscription`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `App\Services\Email\InvoiceEmailService`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/InvoiceEmailServiceTest.php` imports `Illuminate\Support\Facades\Mail`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `App\Jobs\SendInvoiceIssuedEmail`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `App\Models\Invoice`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `App\Models\Member`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `App\Models\Plan`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `App\Models\Subscription`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/InvoiceIssuedEmailJobTest.php` imports `Illuminate\Support\Facades\Queue`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Jobs\SendInvoicePaymentReceiptEmail`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Models\Invoice`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Models\InvoiceTransaction`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Models\Member`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Models\Plan`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `App\Models\Subscription`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/InvoicePaymentReceiptEmailJobTest.php` imports `Illuminate\Support\Facades\Queue`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `App\Models\Invoice`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `App\Models\Member`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `App\Models\Plan`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `App\Models\Subscription`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `Carbon\Carbon`
- `tests/Feature/InvoiceTotalsConsistencyTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/LeadTest.php` imports `App\Models\Enquiry`
- `tests/Feature/LeadTest.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `tests/Feature/LeadTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/LocaleSwitcherTest.php` imports `App\Contracts\SettingsRepository`
- `tests/Feature/LocaleSwitcherTest.php` imports `App\Filament\Livewire\LocaleSwitcher`
- `tests/Feature/LocaleSwitcherTest.php` imports `Livewire\Livewire`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `App\Models\Subscription`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `App\Models\User`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `Carbon\Carbon`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `Spatie\Permission\Models\Role`
- `tests/Feature/MarkSubscriptionsStatusCommandTest.php` imports `Tests\TestCase`
- `tests/Feature/MemberTest.php` imports `App\Models\Member`
- `tests/Feature/MemberTest.php` imports `App\Services\Api\Schemas\MemberSchema`
- `tests/Feature/MemberTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `App\Filament\Widgets\Analytics\MembershipMetricsWidget`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `App\Models\Member`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `App\Models\Plan`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `App\Models\Subscription`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `Carbon\CarbonImmutable`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/MembershipMetricsWidgetTest.php` imports `Livewire\Livewire`
- `tests/Feature/PaymentTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Filament\Widgets\Analytics\RecentTransactionsTableWidget`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Helpers\Helpers`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Models\Invoice`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Models\InvoiceTransaction`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Models\Member`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Models\Plan`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `App\Models\Subscription`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `Carbon\CarbonImmutable`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/RecentTransactionsTableWidgetTest.php` imports `Livewire\Livewire`
- `tests/Feature/RolePermissionTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/SettingsPagePersistenceTest.php` imports `App\Contracts\SettingsRepository`
- `tests/Feature/SettingsPagePersistenceTest.php` imports `App\Filament\Pages\Settings`
- `tests/Feature/SettingsPagePersistenceTest.php` imports `Livewire\Livewire`
- `tests/Feature/SubscriptionTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/TenantIsolationTest.php` imports `Tests\BaseGymieTest`
- `tests/Feature/UserCreateFormRolesTest.php` imports `App\Enums\FacilityRole`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `App\Models\Gym`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `App\Models\SystemAdmin`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `App\Models\User`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `Illuminate\Support\Facades\Hash`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `Spatie\Permission\Models\Role`
- `tests/Feature/UserResourceExcludesAdminsTest.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Feature/ValidationTest.php` imports `App\Services\Api\Schemas\EnquirySchema`
- `tests/Feature/ValidationTest.php` imports `App\Services\Api\Schemas\MemberSchema`
- `tests/Feature/ValidationTest.php` imports `Illuminate\Support\Facades\Validator`
- `tests/Feature/ValidationTest.php` imports `Tests\BaseGymieTest`
- `tests/Helpers/TestLogger.php` imports `Throwable`
- `tests/Regression/RegressionTest.php` imports `Tests\BaseGymieTest`
- `tests/Security/SecurityTest.php` imports `Tests\BaseGymieTest`
- `tests/TestCase.php` imports `App\Models\Gym`
- `tests/TestCase.php` imports `Illuminate\Foundation\Testing\TestCase as BaseTestCase`
- `tests/TestCase.php` imports `Illuminate\Support\Facades\DB`
- `tests/TestCase.php` imports `Illuminate\Support\Facades\Schema`
- `tests/TestCase.php` imports `Spatie\Permission\PermissionRegistrar`
- `tests/Unit/AdminPanelProviderMiddlewareTest.php` imports `App\Http\Middleware\SetAppLocale`
- `tests/Unit/AdminPanelProviderMiddlewareTest.php` imports `App\Providers\Filament\AdminPanelProvider`
- `tests/Unit/AdminPanelProviderMiddlewareTest.php` imports `Filament\Panel`
- `tests/Unit/AnalyticsDateRangeTest.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `tests/Unit/AnalyticsDateRangeTest.php` imports `Carbon\CarbonImmutable`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Helpers\Helpers`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Models\Expense`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Models\Invoice`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Models\InvoiceTransaction`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Models\Member`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Models\Plan`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Models\Subscription`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Services\Analytics\AnalyticsService`
- `tests/Unit/AnalyticsServiceTest.php` imports `App\Support\Analytics\AnalyticsDateRange`
- `tests/Unit/AnalyticsServiceTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Unit/DashboardHeaderActionsTest.php` imports `App\Filament\Pages\Dashboard`
- `tests/Unit/DashboardLayoutTest.php` imports `App\Filament\Pages\Dashboard`
- `tests/Unit/DashboardLayoutTest.php` imports `App\Filament\Widgets\Analytics\ExpenseCategoriesDoughnutChartWidget`
- `tests/Unit/DashboardLayoutTest.php` imports `App\Filament\Widgets\Analytics\FinancialMetricsWidget`
- `tests/Unit/DashboardLayoutTest.php` imports `App\Filament\Widgets\Analytics\MembershipMetricsWidget`
- `tests/Unit/DashboardLayoutTest.php` imports `App\Filament\Widgets\Analytics\MembershipOverviewSubscriptionsTableWidget`
- `tests/Unit/DashboardLayoutTest.php` imports `App\Filament\Widgets\Analytics\RecentTransactionsTableWidget`
- `tests/Unit/DashboardLayoutTest.php` imports `Filament\Schemas\Components\Livewire`
- `tests/Unit/DiscountsTest.php` imports `App\Support\Billing\Discounts`
- `tests/Unit/FilamentLocalizationTest.php` imports `App\Filament\Resources\Plans\PlanResource`
- `tests/Unit/FilamentLocalizationTest.php` imports `App\Filament\Resources\Services\ServiceResource`
- `tests/Unit/FilamentLocalizationTest.php` imports `App\Filament\Resources\Users\UserResource`
- `tests/Unit/FiscalYearTest.php` imports `App\Support\Dates\FiscalYear`
- `tests/Unit/FiscalYearTest.php` imports `Carbon\CarbonImmutable`
- `tests/Unit/FollowUpTableColumnsTest.php` imports `App\Filament\Resources\FollowUps\Tables\FollowUpTable`
- `tests/Unit/FollowUpTableColumnsTest.php` imports `Filament\Tables\Columns\Column`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Enums\Status`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Enquiries\EnquiryResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Expenses\ExpenseResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\FollowUps\FollowUpResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Invoices\InvoiceResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Members\MemberResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Plans\PlanResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Services\ServiceResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Subscriptions\SubscriptionResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Filament\Resources\Users\UserResource`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Enquiry`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Expense`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\FollowUp`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Invoice`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Member`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Plan`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Service`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\Subscription`
- `tests/Unit/GlobalSearchConfigurationTest.php` imports `App\Models\User`
- `tests/Unit/InvoiceCalculatorTest.php` imports `App\Support\Billing\InvoiceCalculator`
- `tests/Unit/InvoiceDisplayStatusLabelTest.php` imports `App\Models\Invoice`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `App\Helpers\Helpers`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `App\Models\Invoice`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `App\Models\Member`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `Carbon\Carbon`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `PHPUnit\Framework\Attributes\Test`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `PHPUnit\Framework\Attributes\TestDox`
- `tests/Unit/InvoiceNumberGeneratorTest.php` imports `Tests\TestCase`
- `tests/Unit/JsonSettingsRepositoryCacheTest.php` imports `App\Contracts\SettingsRepository`
- `tests/Unit/JsonSettingsRepositoryCacheTest.php` imports `App\Helpers\Helpers`
- `tests/Unit/MemberCodeGeneratorTest.php` imports `App\Models\Member`
- `tests/Unit/MemberCodeGeneratorTest.php` imports `App\Support\Members\MemberCodeGenerator`
- `tests/Unit/MemberCodeGeneratorTest.php` imports `Illuminate\Foundation\Testing\RefreshDatabase`
- `tests/Unit/MemberCodeGeneratorTest.php` imports `Tests\TestCase`
- `tests/Unit/PaymentMethodTest.php` imports `App\Support\Billing\PaymentMethod`
- `tests/Unit/SetAppLocaleMiddlewareTest.php` imports `App\Contracts\SettingsRepository`
- `tests/Unit/SetAppLocaleMiddlewareTest.php` imports `App\Http\Middleware\SetAppLocale`
- `tests/Unit/SetAppLocaleMiddlewareTest.php` imports `Illuminate\Http\Request`
- `tests/Unit/SetAppLocaleMiddlewareTest.php` imports `Illuminate\Support\Carbon`

## Feature 2 Phase 1 Snapshot Addendum — 2026-06-26

### Error analyzed
- Source: `main_code/uploads/error.txt`.
- Failure: `SQLSTATE[42S22] Unknown column 'App\Filament\Resources\Enquiries\EnquiryResource' in 'INSERT INTO'` when posting Livewire update from `/system/shield/roles/create`.

### Relevant files inspected
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `config/filament-shield.php`
- `app/Providers/Filament/SystemPanelProvider.php`
- `app/Models/SystemAdmin.php`
- `app/Policies/RolePolicy.php`
- `tests/Feature/RolePermissionTest.php`
- `tests/test.sh`

### Current finding
`CreateBusinessRole::mutateFormDataBeforeCreate()` and `EditBusinessRole::mutateFormDataBeforeSave()` force `guard_name` and `gym_id`, but they do not remove Shield permission UI keys from the data returned to Filament's model create/update operation.

### Planned target state
Business role create/edit will persist only real `roles` table attributes while continuing to sync selected permissions after create/save.

## Feature 2 Phase 3 Snapshot Addendum — 2026-06-26

### Implemented and reviewed files
- `app/Filament/Resources/BusinessRoleResource.php`
  - Added `sanitizeRolePersistenceData()`.
  - Added `extractPermissionNamesFromFormState()`.
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
  - Uses sanitized persistence data and centralized permission extraction.
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
  - Uses sanitized persistence data and centralized permission extraction.
- `tests/Feature/BusinessRoleResourceTest.php`
  - Added strict backend and Livewire role create/edit coverage.
- `tests/Regression/RegressionTest.php`
  - Added regression assertions for sanitizer and permission extraction wiring.
- `zero/security.md`
  - Added unsafe form-state persistence finding and Phase 3 permission extraction addendum.

### Review status
Phase 3 review is clean after review iteration 1.

## Feature 2 Phase 4 Snapshot Addendum — 2026-06-26

### Generated artifact
- `zero/feature-2/change.sh`

### Script contents
The script writes complete final content for:
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

### User instruction
After applying `zero/feature-2/change.sh`, run:
`bash tests/test.sh --super=[ID] --business=[ID]`

## Feature 2 Revision 1 Phase 1 Snapshot Addendum — 2026-06-26

### Reported local test failures analyzed
- Source files: `uploads/error-20260626-151744.txt`, `uploads/raw-20260626-151744.txt`.
- Failing test 1: `Tests\Feature\BusinessRoleResourceTest::test_system_business_role_create_page_can_create_role_with_permission_selection`.
- Error: Spatie permission `ViewAny:Enquiry` does not exist for guard `web` at assertion time.
- Failing test 2: `Tests\Feature\BusinessRoleResourceTest::test_business_role_edit_filters_shield_permission_state_before_database_update`.
- Error: expected role permission assertion is false.

### Current implementation state
- `BusinessRoleResource::sanitizeRolePersistenceData()` correctly returns only `name`, `guard_name`, and `gym_id`.
- `BusinessRoleResource::extractPermissionNamesFromFormState()` filters valid permission-shaped strings.
- `CreateBusinessRole::afterCreate()` currently reads permission names from `$this->form->getState()`.
- `EditBusinessRole::afterSave()` currently reads permission names from `$this->form->getState()`.

### Planned target state
- Create/edit pages will capture permission names from the original submitted form data during mutate methods before returning sanitized persistence data.
- Create/edit pages will sync from captured permission names after persistence.

## Feature 2 Revision 1 Phase 2 Snapshot Addendum — 2026-06-26

### Files modified
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
  - Added `capturedPermissionNames` property.
  - Captures permission names in `mutateFormDataBeforeCreate()` before returning sanitized role data.
  - Syncs permissions from captured names in `afterCreate()`.
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
  - Added `capturedPermissionNames` property.
  - Captures permission names in `mutateFormDataBeforeSave()` before returning sanitized role data.
  - Syncs permissions from captured names in `afterSave()`.
- `tests/Feature/BusinessRoleResourceTest.php`
  - Kept strict create/edit tests and added clearer permission-record assertions before role permission checks.
- `tests/Regression/RegressionTest.php`
  - Updated regression assertions to require captured permission state instead of post-sanitization form-state reads.

### Test runner verification
- `tests/test.sh` already runs `tests/Unit tests/Feature tests/Regression tests/Security`; no change required.

## Feature 2 Revision 1 Phase 3 Snapshot Addendum — 2026-06-26

### Review status
Phase 3 clean review confirmed for revision 1.

### Reviewed files
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`
- `zero/security.md`

### Result
No remaining issues found. Revision is ready for revised change script generation.

## Feature 2 Revision 1 Phase 4 Snapshot Addendum — 2026-06-26

### Generated artifact
- `zero/feature-2/change-v1.sh`

### Script contents
The script writes complete final content for:
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

### User instruction
After applying `zero/feature-2/change-v1.sh`, run:
`bash tests/test.sh --super=[ID] --business=[ID]`

## Feature 2 Revision 2 Phase 1 Snapshot Addendum — 2026-06-26

### Latest error analyzed
- Source: `uploads/error-20260626-153744.txt`.
- PHPUnit summary: `Tests: 118, Assertions: 727, Failures: 2`.
- Failing create test: permission row `ViewAny:Enquiry` / `web` missing.
- Failing edit test: role does not have expected permission.
- Test runner issue: terminal summary counts duplicate PHPUnit output forms and reports inflated pass/fail totals.

### Current code state
- Create and edit pages capture permission names from mutation data.
- Captured permission names can still be empty during the Livewire test path.
- `tests/test.sh` parses both `✓/⨯` and `✔/✘` output styles, causing duplicate counts.

### Planned target state
- Create/edit pages will resolve permissions from captured state first and page/form fallback state second.
- `tests/test.sh` will count each test once.

## Feature 2 Revision 2 Phase 2 Snapshot Addendum — 2026-06-26

### Files modified
- `app/Filament/Resources/BusinessRoleResource.php`
  - Added `extractPermissionNamesFromStateSources()` for strict multi-source permission extraction.
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
  - Added `resolvePermissionNames()` and `permissionStateFallbackSources()`.
  - `afterCreate()` now syncs from resolved permission names.
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
  - Added `resolvePermissionNames()` and `permissionStateFallbackSources()`.
  - `afterSave()` now syncs from resolved permission names.
- `tests/Feature/BusinessRoleResourceTest.php`
  - UI create/edit tests now also set Livewire `data` state to match Filament page state.
- `tests/Regression/RegressionTest.php`
  - Added regression checks for fallback permission resolver and test runner parser guard.
- `tests/test.sh`
  - Updated `emit_results()` to choose one PHPUnit output style and avoid duplicate test counts.

## Feature 2 Revision 2 Phase 3 Snapshot Addendum — 2026-06-26

### Review status
Phase 3 clean review confirmed for revision 2.

### Reviewed files
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`
- `zero/security.md`

### Result
No remaining issues found. Revision 2 is ready for revised change script generation.

## Feature 2 Revision 2 Phase 4 Snapshot Addendum — 2026-06-26

### Generated artifact
- `zero/feature-2/change-v2.sh`

### Script contents
The script writes complete final content for:
- `app/Filament/Resources/BusinessRoleResource.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/CreateBusinessRole.php`
- `app/Filament/Resources/BusinessRoleResource/Pages/EditBusinessRole.php`
- `tests/Feature/BusinessRoleResourceTest.php`
- `tests/Regression/RegressionTest.php`
- `tests/test.sh`

### User instruction
After applying `zero/feature-2/change-v2.sh`, run:
`bash tests/test.sh --super=[ID] --business=[ID]`

## Feature 3 Phase 1 Snapshot Addendum — 2026-06-26

### Prompt read
- `/main_code/prompt.md` was read before starting Feature 3 Phase 1.

### Current test state observed
- Existing tests include Unit, Feature, Regression, and Security suites.
- Existing API routes cover `/api/v1` auth, settings, analytics, roles, permissions, users, members, services, plans, subscriptions, invoices, expenses, enquiries, follow-ups, restore, force-delete, PDF, and transaction routes.
- Existing Filament resources include business roles, gyms, gym subscriptions, members, enquiries, expenses, follow-ups, invoices, plans, services, subscriptions, users, system admins, system plans, and system roles.

### Feature 3 target state
- Add stricter test-only coverage for UI/Livewire CRUD, role access, tenant isolation, invalid payload/security cases, and regression guarantees.

## Feature 3 Phase 2 Snapshot Addendum — 2026-06-26

### Files created
- `tests/Feature/StrictFilamentCrudUiTest.php`
  - Adds strict Filament resource page registration checks, member/enquiry backend create-edit-list contracts, and business role Livewire create/edit permission sync tests.
- `tests/Feature/StrictRoleAccessTest.php`
  - Adds strict API permission allow/deny tests and system-admin/business-user separation test.
- `tests/Feature/StrictTenantIsolationEdgeTest.php`
  - Adds two-gym tenant visibility and tenant access tests.
- `tests/Security/StrictSecurityPayloadTest.php`
  - Adds unauthorized API, invalid XSS-like payload, SQL-like search, and negative expense amount tests.

### Files modified
- `tests/Regression/RegressionTest.php`
  - Added Feature 3 strict test file and method presence assertions.
  - Preserved all existing regression assertions.
- `tests/test.sh`
  - Verified existing suite paths already include `tests/Feature`, `tests/Regression`, and `tests/Security`; no change required.

### Production code status
- No production application files were changed in Feature 3 Phase 2.
