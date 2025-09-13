<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attributes.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attributes rule.
    |
    */

    'custom' => [
        'attributes-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attributes placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */


    'attributes' => [
        'name'                  => 'The name',
        'username'              => 'user name',
        'email'                 => 'E-mail',
        'first_name'            => 'First Name',
        'last_name'             => 'family name',
        'password'              => 'password',
        'password_confirmation' => 'confirm password',
        'city'                  => 'City',
        'country'               => 'Country',
        'address'               => 'Address',
        'phone'                 => 'the phone',
        'mobile'                => 'cell phone',
        'age'                   => 'Age',
        'sex'                   => 'sex',
        'gender'                => 'Type',
        'day'                   => 'Today',
        'month'                 => 'the month',
        'year'                  => 'the year',
        'hour'                  => 'hour',
        'minute'                => 'Accurate',
        'second'                => 'a second',
        'title'                 => 'Address',
        'content'               => 'Content',
        'description'           => 'the description',
        'excerpt'               => 'Summary',
        'date'                  => 'Date',
        'time'                  => 'the time',
        'available'             => 'available',
        'size'                  => 'the size',

        // custom
        "status"            => 'Status',
        "note"              => 'note',
        "available_date"    => 'Available for shipment from date',
        "serial"            => 'The Serial',
        "phone_company"     => 'company phone',
        "name_company"      => 'The Company name',
        "address_company"   => 'Company Address',
        "phone2_company"    => 'The company second phone',
        "phone_customer"    => 'Customer Number',
        "name_customer"     => 'customer name',
        "address_customer"  => 'customer address',
        "phone2_customer"   => 'Customer second phone',
        'oldPassword'       => 'Old Password',
        'newPassword'       => 'New Password',
        'name_ar'           => 'Name in Arabic',
        'name_en'           => 'Name in English',
        'description_ar'    => 'Description in Arabic',
        'description_en'    => 'Description in English',
        'quantity'          => 'Quantity',
        'regular_price'     => 'product price',
        'sale_price'        => 'discount price',
        'start_sale'        => 'Discount start date',
        'end_sale'          => 'discount end date',
        'categories'        => 'Categories',
        'images'            => 'Pictures',
        'img'               => 'Picture',
        'statements'        => 'feature',
        'attribute'         => 'Feature',
        'attributes'        => 'Properties',
        'option'            => 'Option',
        'options'           => 'Options',
        'logo'              => 'logo',
        'rating'            => 'evaluation',
        'comment'           => 'comment',
        'statements.*.name_ar' => 'Feature name in Arabic',
        'statements.*.name_en' => 'English feature name',
        'statements.*.value_ar' => 'feature value in Arabic',
        'statements.*.value_en' => 'feature value in English',

        'kurly.*.name_ar' => 'Feature name in Arabic',
        'kurly.*.name_en' => 'English feature name',
        'kurly.*.value_ar' => 'feature value in Arabic',
        'kurly.*.value_en' => 'feature value in English',

        'attributes.*.name.name_ar' => 'The name of the property in Arabic',
        'attributes.*.name.name_en' => 'Name of the property in English',
        'attributes.*.option.*.id' => 'identifier',
        'attributes.*.option.*.quantity' => 'value',
        'attributes.*.option.*.regular_price' => 'price',
        'attributes.*.option.*.sale_price' => 'discount price',
    ],
];
