<?php

namespace App\Http\Requests\Admin;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Sanitizers\Trim;
use ArondeParon\RequestSanitizer\Sanitizers\TrimDuplicateSpaces;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        'description_ar' => [
            //StripTags::class,
            Trim::class,
        ],

        'description_en' => [
            //StripTags::class,
            Trim::class,
        ],

        'slug' => [
            //Slug::class,
        ],

        'quantity' => [
            RemoveNonNumeric::class,
            //StripTags::class,
        ],

        'regular_price' => [
            //StripTags::class,
        ],

        'sale_price' => [
            //StripTags::class,
        ],

        'start_sale' => [
            //StripTags::class,
        ],
        'end_sale' => [
            //StripTags::class,
        ],

        'alt' => [
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
    $hasVariants = is_array($this->input('variants')) && count($this->input('variants')) > 0;

    return [

        'img'                                 => [request()->segment(2) ? 'nullable' : 'required' , 'image'],
        'barcode'                             => ['nullable' , 'string'  , 'max:255'],
        'name_ar'                             => ['required' , 'string'], // تم إزالة max
        'name_en'                             => ['required' , 'string'], // تم إزالة max
        'description_ar'                      => ['nullable' , 'string'],
        'description_en'                      => ['nullable' , 'string'],
        'slug'                                => ['nullable' , 'string'  , 'max:50'],
        /*'quantity'                            => ['required' , 'integer', 'min:0' , 'digits_between:1,11'],
        'regular_price'                       => ['required' , 'numeric' , 'min:0'],
        'sale_price'                          => ['required_with:in_sale', 'min:0'],*/
        'quantity'                            => [$hasVariants ? 'nullable' : 'required', 'integer', 'min:0', 'digits_between:1,11'],
        'regular_price'                       => [$hasVariants ? 'nullable' : 'required', 'numeric', 'min:0'],
        'sale_price'                          => [$hasVariants ? 'nullable' : 'nullable', 'numeric', 'min:0'],

        /*'start_sale'                          => ['required' , 'date_format:Y-m-d'],
        'end_sale'                            => ['nullable', 'date_format:Y-m-d' , 'after_or_equal:start_sale', 'after_or_equal:today'],*/
        # 'categories'                          => ['required' , 'array'],
        # 'categories.*'                        => ['integer'],
        'images'                              => ['nullable' , 'array'],
        'images.*'                            => ['image'],

        'statements'                          => ['nullable' , 'array'],
        'statements.*'                        => ['required_with:statements' , 'array'],
        'statements.*.name_ar'                => ['required', 'string' , 'max:50'],
        // 'statements.*.value_ar'               => ['required', 'string' , 'max:50'],
        'statements.*.name_en'                => ['required', 'string' , 'max:50'],
        // 'statements.*.value_en'               => ['required', 'string' , 'max:50'],

        'kurly'                               => ['nullable' , 'array'],
        'kurly.*'                             => ['required_with:kurly' , 'array'],
        'kurly.*.name_ar'                     => ['required', 'string' , 'max:50'],
        // 'kurly.*.value_ar'                    => ['required', 'string' , 'max:50'],
        'kurly.*.name_en'                     => ['required', 'string' , 'max:50'],
        // 'kurly.*.value_en'                    => ['required', 'string' , 'max:50'],

        'attributes'                          => ['required_with:has_options' , 'array'],
        'attributes.*.id'                     => ['required' , 'integer' , 'exists:attributes,id'],
        'attributes.*.option'                 => ['required' , 'array'],
        'attributes.*.option.*.id'            => ['required', 'integer' , 'exists:options,id'],
        // 'attributes.*.option.*.regular_price' => ['required', 'numeric' , 'min:0'],
        // 'attributes.*.option.*.sale_price'    => ['nullable', 'numeric' , 'min:0' , 'lt:attributes.*.option.*.regular_price'],
        'attributes.*.option.*.quantity'      => ['required', 'integer' , 'digits_between:1,11'],
        'attributes.*.option.*.parent_id'     => ['nullable', 'string' , 'digits_between:1,11'],

        // ✅ Variant combos
        'variants'                            => ['nullable', 'array'],
        'variants.*.combination'              => ['required', 'string'],
        'variants.*.quantity'                 => ['required', 'integer', 'min:0', 'digits_between:1,11'],
        'variants.*.price'                    => ['nullable', 'numeric', 'min:0'],
        'variants.*.discount_price'           => ['nullable', 'numeric', 'min:0', 'lt:variants.*.price'],

    ];
}


//    public function attributes()
//    {
//        return [
//            'statements.*.name_ar' => 'اسم الميزه باللغة العربية',
//            'statements.*.name_en' => 'اسم الميزه باللغة الانجليزيه',
//            'statements.*.value_ar' => 'قيمة الميزه باللغة العربية',
//            'statements.*.value_en' => 'قيمة الميزه باللغة الانجليزيه',
//
//            'kurly.*.name_ar' => 'اسم الميزه باللغة العربية',
//            'kurly.*.name_en' => 'اسم الميزه باللغة الانجليزيه',
//            'kurly.*.value_ar' => 'قيمة الميزه باللغة العربية',
//            'kurly.*.value_en' => 'قيمة الميزه باللغة الانجليزيه',
//
//            'attributes.*.name.name_ar' => 'اسم الخاصية باللغة العربية',
//            'attributes.*.name.name_en' => 'اسم الخاصية باللغة الانجليزية',
//            'attributes.*.option.*.id' => 'المعرف',
//            'attributes.*.option.*.quantity' => 'القيمه',
//            'attributes.*.option.*.regular_price' => 'السعر',
//            'attributes.*.option.*.sale_price' => 'سعر الخصم',
//
//        ];
//    }

    public function messages()
    {

        return [

            'categories.required' => __('form.label.categories_required'),
            'attributes.*.id.exists' =>  __('form.label.attributes_exists'),
            'attributes.*.id.required' => __('form.label.attributes_required'),
            'attributes.required_with' => __('form.label.attributes_required_with'),
            'attributes.*.option.required' => __('form.label.attributes_option_required'),
        ];
    }
}
