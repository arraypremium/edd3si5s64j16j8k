<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Deletion prevention map
    |--------------------------------------------------------------------------
    |
    | Only list relationships that should BLOCK deletion from the Filament UI.
    | Relationships that are intentionally handled by CascadesSoftDeletes must
    | not be listed here, otherwise the UI blocks the delete before the model's
    | cascade events can run.
    |
    | Examples intentionally not listed:
    | - Enquiry -> followUps
    | - Service -> plans
    | - Plan -> subscriptions
    | - Member -> subscriptions
    | - Subscription -> invoices
    |
    */

    \App\Models\User::class => ['followUps', 'enquiries'],

];
