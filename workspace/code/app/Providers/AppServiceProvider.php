<?php

namespace App\Providers;

use App\Contracts\SequenceRepository;
use App\Contracts\SettingsRepository;
use App\Models\GymSubscription;
use App\Models\Invoice;
use App\Models\InvoiceTransaction;
use App\Observers\GymSubscriptionObserver;
use App\Observers\InvoiceObserver;
use App\Observers\InvoiceTransactionObserver;
use App\Services\JsonSequenceRepository;
use App\Services\JsonSettingsRepository;
use App\Support\Data;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Columns\TextColumn;
use Filament\View\PanelsRenderHook;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsRepository::class, JsonSettingsRepository::class);
        $this->app->singleton(SequenceRepository::class, JsonSequenceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ============================================================
        // FIX: Disable Livewire navigate to prevent stuck browser tab
        // loading spinner when navigating between Filament pages.
        // ============================================================
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn (): string => '<script>
                // Prevent Livewire from intercepting navigation (fixes stuck tab spinner)
                document.addEventListener("livewire:navigate", e => e.preventDefault());

                // Force-clear stuck "Processing..." states after 15s
                setTimeout(() => {
                    document.querySelectorAll("[data-processing]").forEach(el => {
                        el.removeAttribute("data-processing");
                        el.classList.remove("fi-processing");
                    });
                    document.querySelectorAll(".fi-btn[data-filament-loading]").forEach(el => {
                        el.removeAttribute("data-filament-loading");
                    });
                }, 15000);

                // Reset all Livewire state when page becomes visible (tab focus)
                document.addEventListener("visibilitychange", () => {
                    if (!document.hidden) {
                        document.querySelectorAll("[wire\\:loading]").forEach(el => {
                            el.style.opacity = "";
                            el.style.pointerEvents = "";
                        });
                    }
                });
            </script>',
        );

        $this->configureSuperAdminGate();
        $this->configureApiRateLimiting();
        $this->configureScrambleApiDocs();

        FilamentAsset::register([
            Css::make('gymie-styles', __DIR__.'/../../resources/css/custom.css'),
        ]);

        /**
         * Configure the CreateAction globally to use a specific icon.
         */
        CreateAction::configureUsing(function (CreateAction $action) {
            $action->icon('heroicon-s-plus');
        });

        /**
         * Configure the EditAction and DeleteAction globally to use specific icons.
         */
        EditAction::configureUsing(function (EditAction $action) {
            $action->icon('heroicon-s-pencil-square');
        });

        /**
         * Configure the DeleteAction globally to use a specific icon.
         */
        DeleteAction::configureUsing(function (DeleteAction $action) {
            $action->icon('heroicon-s-trash');
        });

        /**
         * Configure the ViewAction globally to use a specific icon.
         */
        ViewAction::configureUsing(function (ViewAction $action) {
            $action->icon('heroicon-s-eye');
        });
        /**
         * Configure the Select component globally to be searchable, non-native, and preloaded.
         */
        Select::configureUsing(function (Select $select) {
            $select
                ->searchable()
                ->native(false)
                ->preload();
        });

        /**
         * Configure the DatePicker component globally to use a specific format and placeholder.
         */
        DatePicker::configureUsing(function (DatePicker $datePicker) {
            $datePicker
                ->native(false)
                ->placeholder(__('app.placeholders.date_example'))
                ->displayFormat('d/m/Y')
                ->prefixIcon('heroicon-o-calendar-days');
        });

        /**
         * Configure the DateTimePicker component globally to use a specific format and placeholder.
         */
        DateTimePicker::configureUsing(function (DateTimePicker $datePicker) {
            $datePicker
                ->native(false)
                ->placeholder(__('app.placeholders.date_time_example'))
                ->displayFormat('d/m/Y H:i A')
                ->prefixIcon('heroicon-o-calendar-days');
        });

        /**
         * Configure the TextColumn globally to be toggleable and hidden by default.
         */
        TextColumn::configureUsing(function (TextColumn $column) {
            $column->toggleable(isToggledHiddenByDefault: false);
        });

        $this->configureDeletionPrevention();
        $this->registerModelObservers();
    }


    /**
     * Let a verified system super admin bypass generated Shield policies.
     */
    private function configureSuperAdminGate(): void
    {
        Gate::before(function (mixed $user): ?bool {
            if (is_object($user) && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
                return true;
            }

            return null;
        });
    }

    /**
     * Configure Scramble (OpenAPI) generation for the v1 API.
     *
     * This is guarded so the app remains bootable even when Scramble isn't installed yet.
     */
    private function configureScrambleApiDocs(): void
    {
        if (! class_exists(\Dedoc\Scramble\Scramble::class)) {
            return;
        }

        $config = \Dedoc\Scramble\Scramble::configure();

        $config->routes(static function (\Illuminate\Routing\Route $route): bool {
            return str_starts_with($route->uri, 'api/v1/');
        });

        $config->withOperationTransformers([
            \App\Services\Api\Docs\AddIndexQueryParametersTransformer::class,
        ]);

        if (class_exists(\Dedoc\Scramble\Support\Generator\SecurityScheme::class)) {
            $config->withDocumentTransformers(static function (mixed $openApi): void {
                if (! is_object($openApi) || ! method_exists($openApi, 'secure')) {
                    return;
                }

                $openApi->secure(\Dedoc\Scramble\Support\Generator\SecurityScheme::http('bearer'));
            });
        }
    }

    /**
     * Configure API rate limiters used by the `api` middleware group.
     *
     * Defining these explicitly prevents "throttle:api" from relying on
     * framework defaults that can vary between versions.
     */
    private function configureApiRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request): Limit {
            $key = $request->user()?->getAuthIdentifier() ?? $request->ip();

            return Limit::perMinute(60)->by(Data::string($key));
        });

        RateLimiter::for('api-login', function (Request $request): Limit {
            return Limit::perMinute(10)->by((string) $request->ip());
        });
    }

    /**
     * Register model observers.
     */
    private function registerModelObservers(): void
    {
        Invoice::observe(InvoiceObserver::class);
        InvoiceTransaction::observe(InvoiceTransactionObserver::class);
        GymSubscription::observe(GymSubscriptionObserver::class);
    }

    /**
     * Prevent deletion of records that still have related data.
     */
    protected function configureDeletionPrevention(): void
    {
        $map = [];

        foreach ((array) config('prevent-deletion', []) as $class => $relations) {
            if (! is_string($class) || ! is_array($relations)) {
                continue;
            }

            $map[$class] = array_values(array_filter(array_map(
                static fn (mixed $relation): string => Data::string($relation),
                $relations,
            )));
        }

        $shouldPreventDeletion = static function (object $record, string $relation): bool {
            if (
                method_exists($record, 'cascadesRelationOnDelete')
                && $record->cascadesRelationOnDelete($relation) === true
            ) {
                return false;
            }

            return true;
        };

        DeleteAction::configureUsing(function (DeleteAction $action) use ($map, $shouldPreventDeletion): DeleteAction {
            return $action
                ->requiresConfirmation(function (Action $action, $record) use ($map, $shouldPreventDeletion) {
                    if (! is_object($record)) {
                        return $action;
                    }

                    $class = get_class($record);
                    $action->modalIcon('heroicon-o-trash');
                    if (isset($map[$class])) {
                        foreach ($map[$class] as $relation) {
                            if ($shouldPreventDeletion($record, $relation) && $record->$relation()->exists()) {
                                $count = $record->$relation()->count();
                                $moduleName = class_basename($record);
                                $label = Str::kebab(Data::string($relation));
                                $action
                                    ->modalIcon('heroicon-o-x-mark')
                                    ->modalHeading(__('app.deletion_prevention.cannot_delete_title', ['module' => $moduleName]))
                                    ->modalDescription(__('app.deletion_prevention.cannot_delete_description', ['count' => $count, 'relation' => $label]))
                                    ->modalCancelAction(false)
                                    ->modalSubmitAction(false);
                                break;
                            }
                        }
                    }

                    return $action;
                });
        }, isImportant: true);

        DeleteBulkAction::configureUsing(function (DeleteBulkAction $action) use ($map, $shouldPreventDeletion): DeleteBulkAction {
            return $action
                ->requiresConfirmation(function (DeleteBulkAction $action, Collection $records) use ($map, $shouldPreventDeletion) {
                    foreach ($records as $record) {
                        if (! is_object($record)) {
                            continue;
                        }

                        $class = get_class($record);
                        $action->modalIcon('heroicon-o-trash');
                        if (isset($map[$class])) {
                            foreach ($map[$class] as $relation) {
                                if ($shouldPreventDeletion($record, $relation) && $record->$relation()->exists()) {
                                    $count = $record->$relation()->count();
                                    $moduleName = Str::pluralStudly(class_basename($record));
                                    $label = Str::kebab(Data::string($relation));
                                    $action
                                        ->modalIcon('heroicon-o-x-mark')
                                        ->modalHeading(__('app.deletion_prevention.cannot_delete_title', ['module' => $moduleName]))
                                        ->modalDescription(__('app.deletion_prevention.cannot_delete_bulk_description', ['module' => $moduleName, 'count' => $count, 'relation' => $label]))
                                        ->modalCancelAction(false)
                                        ->modalSubmitAction(false);
                                    break 2;
                                }
                            }
                        }
                    }

                    return $action;
                });
        }, isImportant: true);
    }

}
