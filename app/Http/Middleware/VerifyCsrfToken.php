<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //

        'web-hooks-event/*',
        '/web-hooks-event',
        'https://demo.trendatt.net/web-hooks-event',
        'https://trendatt.com/web-hooks-event',
    ];
}
