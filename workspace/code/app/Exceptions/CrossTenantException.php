<?php

namespace App\Exceptions;

use Exception;

/**
 * Exception thrown when a tenant-scoped Eloquent model operation
 * is attempted without a valid gym_id or fallback tenant facility.
 */
class CrossTenantException extends Exception
{
    //
}
