<?php

namespace App\Http\Middleware;
use Closure;
use App\Models\Language;
use App\Helpers\CommonHelper;

class SetLocalApi
{

	public function handle($request, Closure $next)
	{
		$locale = $request->header('Content-Language');

// 		dd($locale);
		if (! $locale)
		{
			// get default Language
			$defaultLocale = 'en';
			if (! $defaultLocale) {
				$response = [ 'errors' => [ 'اللغة - Language' => ['message'=> 'Not Found - غير موجودة'] ] ];
				return response($response);
			}
			app()->setLocale($defaultLocale);
		} else {
				app()->setLocale($locale);

		}

		return $next($request);

	}
}
