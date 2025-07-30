<?php

namespace App\Http\Middleware;
use Closure;
use App\Models\Language;
use App\Helpers\CommonHelper;

class ChangeGuardApi
{

	public function handle($request, Closure $next)
	{
		 config(['auth.defaults.guard' => 'web-api']);
        // dd('fff');
		return $next($request);

	}
}
