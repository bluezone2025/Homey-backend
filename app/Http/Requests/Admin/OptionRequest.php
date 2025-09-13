<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
{

    use SanitizesInputs;

    protected $sanitizers = [
        'name_ar' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'name_en' => [
            //StripTags::class,
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

            'name_ar'      => ['required' , 'string'  , 'max:50'],
            'name_en'      => ['required' , 'string'  , 'max:50'],
            'attribute_id' => ['required' , 'exists:attributes,id' , 'max:11'],

        ];
    }

    public function attributes()
    {
        return [

            'name_ar' => 'الاسم'
        ];
    }
}
