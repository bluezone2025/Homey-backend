<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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

            'name'          => ['required' , 'string' , Rule::unique('coupons')->ignore($this->id), 'max:100'],
            'code'          => ['required' , 'string' , Rule::unique('coupons')->ignore($this->id) , 'max:50'],
            'end_date'      => ['required' , 'date'],
            'discount'      => ['required' , 'numeric'],
            'type_discount' => ['required' , 'string', 'in:price,percentage'],
            'min_price'     => ['required' , 'integer'],
            'limit_use'         => ['required' , 'integer'],
//            'limit_user'    => ['required' , 'integer'],
        ];
    }

}
