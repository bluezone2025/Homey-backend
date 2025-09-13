<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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

        $pagesUpdate =  request()->route()->methods[0] === 'POST';

        return [

            'name_ar'    => ['required' , 'string' , 'max:50'],
            'name_en'    => ['required' , 'string' , 'max:50'],
            'code_phone' => ['required' , 'string' , 'max:50'],
            'flag'       => [$pagesUpdate ? 'required' : 'nullable', 'image'  , 'mimes:jpeg,jpg,png', 'max:10000'],
            'slug'       => ['nullable' , 'string' , 'max:50'],
            'count_number_phone' => ['required' , 'integer'],
        ];
    }

}
