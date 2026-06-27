<?php

use App\Http\Controllers\BusinessSlugLoginController;
use App\Http\Controllers\InvoiceDocumentController;
use App\Rules\ReservedBusinessSlug;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/{business:url_slug}/login', [BusinessSlugLoginController::class, 'show'])
    ->where('business', ReservedBusinessSlug::routePattern())
    ->name('business.slug.login');

Route::post('/{business:url_slug}/login', [BusinessSlugLoginController::class, 'store'])
    ->where('business', ReservedBusinessSlug::routePattern())
    ->middleware('throttle:api-login')
    ->name('business.slug.login.store');

Route::middleware([Authenticate::class])
    ->group(function (): void {
        Route::get('/invoices/{invoice}/preview', [InvoiceDocumentController::class, 'preview'])
            ->name('invoices.preview');

        Route::get('/invoices/{invoice}/download', [InvoiceDocumentController::class, 'download'])
            ->name('invoices.download');
    });
