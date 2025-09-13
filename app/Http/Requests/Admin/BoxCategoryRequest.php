<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class BoxCategoryRequest extends FormRequest
{

    use SanitizesInputs;

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
        $pagesSection = request()->segment(1) === 'sections' || request()->segment(2) === 'sections';

        return [

            'title_ar'   => ['required' , 'string'  , 'max:50'],
            'title_en'   => ['required' , 'string'  , 'max:50'],
            'can_by_multiple'      => ['nullable' , 'in:0,1'],
            'canbm'      => ['nullable' , 'in:Yes,No'],

        ];
    }
}
