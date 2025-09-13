<?php

namespace App\Http\Requests\Web;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{


    protected $sanitizers = [

        'title' => [
            //StripTags::class,
        ],

        'name' => [
            //StripTags::class,
        ],



        'email' => [
            //StripTags::class,
        ],

        'phone' => [
            //StripTags::class,
        ],


        'message' => [
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

            'title'       => ['required' , 'string' , 'max:255'],
            'name'        => ['required' , 'string' , 'max:100'],
            'email'       => ['required' , 'email'  , 'max:100'],
            'phone'       => ['required' , 'string' , 'max:100'],
            'message'     => ['required' , 'string'],
            'contact_type'     => ['required' , 'in:product,contact'],
        ];
    }


}
