<?php

namespace App\Http\Requests\Student;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{

    use SanitizesInputs;

    protected $sanitizers = [
        'name_ar' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'name_en' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'email' => [
            //StripTags::class,
            TrimDuplicateSpaces::class,
        ],

        'phone' => [
            //StripTags::class,
            RemoveNonNumeric::class,
        ],

        'date' => [
            //StripTags::class,
        ],

        'university' => [
            //StripTags::class,
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
        $pagesUpdate =  request()->route()->methods[0] === 'POST';
        //
        //dd(request()->route()->getName());
        if (request()->route()->getName() == "student.profile.updateInfo"){
            $pagesUpdate = false;
            $id = auth('student')->id();
            //dd($id);
        }else{
            $id = @request()->segment(3);
        }


        return [
            'name_ar'         => ['required' , 'string'  , 'max:100'],
            'name_en'         => ['required' , 'string'  , 'max:100'],
            'email'        => $pagesUpdate ? ['required' , 'string'  , 'max:100', "unique:students,email"] : ['required' , 'string'  , 'max:100', "unique:students,email,$id"],
            'phone'        => ['nullable' , 'string'  , 'max:20'],
            'trendat_percentage'        => ['nullable','numeric','regex:/^\d+(\.\d{1,2})?$/' ],
            'student_percentage'        => ['nullable','numeric','regex:/^\d+(\.\d{1,2})?$/' ],
            'facebook'     => ['nullable' , 'string'  , 'max:255'],
            'instagram'    => ['nullable' , 'string'  , 'max:255'],
            'linkedin'     => ['nullable' , 'string'  , 'max:255'],
            'twitter'      => ['nullable' , 'string'  , 'max:255'],
            'img'          => ['nullable', 'file'  , 'mimes:jpeg,jpg,png,svg', 'max:20000'],
            'cover'        => ['nullable', 'image'  , 'mimes:jpeg,jpg,png', 'max:20000'],
            'password'     => [$pagesUpdate ? 'required' : 'nullable' , 'string'  , 'max:50'],

        ];
    }

}
