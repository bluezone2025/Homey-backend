<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{



    use SanitizesInputs;

    protected $sanitizers = [
        'name' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'description' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name'     => ['required' , 'string' , 'max:50'],
            'description' => ['nullable' , 'string' , 'max:255'],
        ];
    }
}
