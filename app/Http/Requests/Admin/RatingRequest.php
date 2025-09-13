<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{


    protected $sanitizers = [

        'rating' => [
            //StripTags::class,
            RemoveNonNumeric::class,
        ],


        'comment' => [
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

            'rating'      => ['required' , 'integer' , 'in:1,2,3,4,5'],
            'comment'     => ['nullable' , 'string' , 'max:255'],
        ];
    }


}
