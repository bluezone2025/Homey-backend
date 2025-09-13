<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{

    use SanitizesInputs;

    protected $sanitizers = [
        'title_ar' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'title_en' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

      'note_ar' => [
            //StripTags::class,
            //Trim::class,
        ],

        'note_en' => [
            //StripTags::class,
            //Trim::class,
        ],



    ];
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
            'note_ar'   => ['required' , 'string'  , 'max:500'],
            'note_en'   => ['required' , 'string'  , 'max:500'],
            'img'       => ['nullable' , 'image', 'max:10000'],

        ];
    }
}
