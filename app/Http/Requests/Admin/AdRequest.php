<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{


    use SanitizesInputs;

    protected $sanitizers = [

        'title' => [
            TrimDuplicateSpaces::class
        ],

        'position' => [
            RemoveNonNumeric::class
        ]
    ];


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

            'img'     => [$pagesUpdate ? 'required' : 'nullable', 'image'  , 'mimes:jpeg,jpg,png', 'max:10000'],
            'link'    => ['required' , 'string'],
            'in_app'  => ['required', 'boolean'],
            'position' => ['required', 'integer']
        ];
    }

}
