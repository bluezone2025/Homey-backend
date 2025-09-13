<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AreaRequest extends FormRequest
{


    use SanitizesInputs;

    protected $sanitizers = [


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

            'name_ar'        => [ 'required' , 'string' , 'max:100'],
            'name_en'        => [ 'required' , 'string' , 'max:100'],
            'slug'           => [ 'nullable' , 'string' , 'max:100'],
            'shipping_price' => [ 'required' , 'numeric'],
            'cache'          => [ 'nullable' , 'integer'],
            'country_id'     => [ 'required' , 'integer'],
        ];
    }

}
