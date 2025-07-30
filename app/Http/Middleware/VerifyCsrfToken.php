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
        'https://arkan.rayan-storee.com/web-hooks-event',
        'https://arkan-q8.com/web-hooks-event',
    ];
}
