<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [

            'area_id'       => ['required' , 'integer' , 'exists:areas,id'],
            'title'         => ['nullable' , 'string' ],
            'delivered_by'         => ['nullable' , 'in:address,phone' ],
            'name'          => ['required' , 'string' ],
            'email'          => ['nullable' , 'string' ],
            'address_d'         => ['nullable' ],
            'phone'         => ['required' , 'string' ],
            // 'phone2'        => ['nullable' , 'string' , 'max:20'],
            'address'       => ['nullable' , 'string'  ],
            'lat_and_long' => ['nullable' , 'string'],
            'note'        => ['nullable' ],
            'region'        => ['nullable' ],
            'piece'        => ['nullable' ],
            'avenue'        => ['nullable' ],
            'street'        => ['nullable' ],
            'flat_number'        => ['nullable' ],
            'house_number'        => ['nullable' ],
            'floor'        => ['nullable' ],
        ];
    }


}
