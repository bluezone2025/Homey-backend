<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ComingSoonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->inMaintenanceMode()) {
            return redirect('/coming-soon');
        }

        return $next($request);
    }

    protected function inMaintenanceMode()
    {
        // Logic to determine if the site is in maintenance mode
        // For example, check an environment variable or a config setting
        return env('APP_COMING_SOON', true);
    }
}
