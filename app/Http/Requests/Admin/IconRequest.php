<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class IconRequest extends FormRequest
{


    use SanitizesInputs;

    protected $sanitizers = [

        'title' => [
            TrimDuplicateSpaces::class
        ],


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

        return [

            'title'      => ['required' , 'string' , 'max:100'],
            'img'        => ['nullable', 'image'  , 'mimes:jpeg,jpg,png', 'max:10000'],
            'link'       => ['required' , 'string'],
            'type'       => ['required' , 'string', 'in:icon,information'],
        ];
    }

}
