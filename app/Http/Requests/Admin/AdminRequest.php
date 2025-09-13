<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{

    use SanitizesInputs;

    protected $sanitizers = [
        'name' => [
            TrimDuplicateSpaces::class,
        ],

        'email' => [
            TrimDuplicateSpaces::class,
        ],

        'phone' => [
            RemoveNonNumeric::class,
        ],

    ];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $pagesUpdate =  request()->route()->methods[0] === 'POST';

        return [
            'name'         => ['required' , 'string'  , 'max:50'],
            'email'        => ['required' , 'string'  , 'max:100'],
            'role_id'      => ['nullable' , 'integer'  , 'max:100'],
            'password'     => [$pagesUpdate ? 'required' : 'nullable' , 'string'  , 'max:50'],

        ];
    }

}
