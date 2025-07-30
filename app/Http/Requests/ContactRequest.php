<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{


    protected $sanitizers = [

        'title' => [
            StripTags::class,
        ],

        'name' => [
            StripTags::class,
        ],



        'email' => [
            StripTags::class,
        ],

        'phone' => [
            StripTags::class,
        ],


        'message' => [
            StripTags::class,
            TrimDuplicateSpaces::class,
        ],

    ];

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return
            [
            'title'       => ['nullable' , 'string' , 'max:255'],
            'name'        => ['nullable' , 'string' , 'max:100'],
            'email'       => ['nullable' , 'email'  , 'max:100'],
            'phone'       => ['nullable' , 'string' , 'max:100'],
            'whatsapp'       => ['nullable' , 'string' , 'max:100'],
            ];
    }


}
