<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{


    protected $sanitizers = [

        'name' => [
            //StripTags::class,
        ],

        'email' => [
            //StripTags::class,
        ],

        'phone' => [
            //StripTags::class,
        ],

        'phone2' => [
            //StripTags::class,
        ],

        'address' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'note' => [
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

            'shipping_address_id' => ['nullable' , 'integer' , 'exists:shipping_addresses,id'],
            'box_id'  => ['nullable' , 'integer' , 'exists:box_orders,id'],
            'area_id'  => ['required' , 'integer' , 'exists:areas,id'],
            'name'        => ['required' , 'string' , 'max:100'],
            'email'       => ['nullable' , 'email'  , 'max:255'],
            'phone'       => ['required' , 'string' , 'max:20'],
            'phone2'      => ['nullable' , 'string' , 'max:20'],
            'address'     => ['nullable' , 'string' , 'max:255'],
            'address_d'     => ['nullable' ,  'max:255'],

            'products_id'    => ['required' , 'string'],
            'quantity_products'    => ['required' , 'string'],
            'optionValue_products'    => ['nullable' , 'string'],
        ];
    }


}
