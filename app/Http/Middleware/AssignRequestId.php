<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AssignRequestId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = (string) Str::uuid();

        Log::shareContext([
            'user_id' => UserService::getUserIdFromSession(),
            'request_id' => $requestId,
        ]);

        $response = $next($request);

        // do this for avoid error on StreamedResponse
        if ($response instanceof \Illuminate\Http\Response) {
            return $response->header('Request-Id', $requestId);
        }

        return $response;
    }
}
