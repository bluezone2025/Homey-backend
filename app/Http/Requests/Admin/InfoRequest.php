<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
{

    use SanitizesInputs;

    protected $sanitizers = [
        'title' => [
            TrimDuplicateSpaces::class,
        ],

        'description_ar' => [
            // StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'description_en' => [
            // StripTags::class,
            TrimDuplicateSpaces::class,
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
        return [

            'name' => ['required' , 'string'  , 'max:255'],
            'description_ar' => ['required' , 'string'],
            'description_en' => ['required' , 'string'],

        ];
    }

}
