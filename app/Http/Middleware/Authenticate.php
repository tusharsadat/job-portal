<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Check if the request is from the admin guard
            if ($request->is('admin/*')) {
                return route('admin.login'); // Redirect to the admin login route
            }

            return route('login'); // Default user login route
        }

        //return $request->expectsJson() ? null : route('login');
    }
}
