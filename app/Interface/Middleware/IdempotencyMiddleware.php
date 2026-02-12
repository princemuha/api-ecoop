<?php

namespace App\Interface\Middleware;

use App\Shared\Exeptions\ApiException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IdempotencyMiddleware
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(Request $request, Closure $next)
    {
        $idempotencyKey = $request->header('Idempotency-Key');

        if (!$idempotencyKey) {
            throw new ApiException('Idempotency-Key header is required', 400);
        }

        // Check if the request has been processed before
        $cacheKey = 'idempotency:' . $idempotencyKey;
        if (Cache::has($cacheKey)) {
            return (object) Cache::get($cacheKey);
        }

        // Process the request
        $response = $next($request);

        if (in_array($response->status(), [200, 201, 409])) {
            // Cache the response
            Cache::put($cacheKey, $response->getData(true), now()->addMonths(1));
        }

        return $response;
    }
}
