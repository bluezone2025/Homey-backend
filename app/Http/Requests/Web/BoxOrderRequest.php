<?php

namespace App\Http\Requests\Web;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use Illuminate\Foundation\Http\FormRequest;

class BoxOrderRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [

            'box_id'       => ['required' ,  'exists:boxes,id'],
            'total_price'       => ['required'],
            'note'       => ['nullable' ],
        ];
    }


}
