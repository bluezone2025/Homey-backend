@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">@lang('layout.products')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add product')</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('admin.pages.products.form_create.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')

    <link href="{{asset('assets/css/pages/admin/product.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">

@endsection
@php
    $attrOptions = $attributes->load('options')->mapWithKeys(function ($attr) {
        return [
            $attr->id => [
                'id' => $attr->id,
                'name' => $attr->name_en,
                'is_free' => $attr->is_free,
                'options' => $attr->options->map(function ($opt) {
                    return [
                        'id' => $opt->id,
                        'value' => $opt->name_ar,
                    ];
                }),
            ],
        ];
    });
@endphp
@section('js')
     <script>
        function myFunctionIsOrder(is_check) {
            console.log(is_check);
            if (is_check== 1) {
                    $('#day_order_dev').addClass('d-none');
                        $('#day_order').val("{{$day_not_order}}");

                  $(this).attr('onchange','myFunctionIsOrder(0)')
            } else {
                $('#day_order_dev').removeClass('d-none');
                $('#day_order').val("{{$day_order}}");
                $(this).attr('onchange',"myFunctionIsOrder(1)")

            }
        }

    </script>
    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('assets/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
     <script>
        lang_not_follow_option = '@lang('form.label.not follow option')'
        lang_remove_attribute = '@lang('form.label.remove attribute')'
        lang_name_option_ar = '@lang('form.label.name_option_ar')'
        lang_name_option_ar = '@lang('form.label.name_option_en')'
        lang_min_one_option = '@lang('form.label.min_one_option')'
        lang_min_one_category = '@lang('form.label.min_one_category')'
        required_value_sale = '@lang('form.label.required_value_sale')'
        required_one_option = '@lang('form.label.required_one_option')'
        required_value_attr = '@lang('form.label.required_value_attr')'
        sale_bigger_price = '@lang('form.label.sale_bigger_price')'
    </script>

    <script src="{{asset('assets/js/pages/admin/product.js')}}"></script>

     <script>
         $(document).ready(function() {
             let colorIndex = 1;
             $('#add-color').click(function() {
                 let newColor = `
            <div class="color-item d-flex align-items-center mb-2">
                <input type="color" name="product_colors[${colorIndex}][color]" class="form-control color-picker">
                <input type="file" name="product_colors[${colorIndex}][image]" class="form-control ml-2">
                <button type="button" class="btn btn-danger remove-color ml-2">X</button>
            </div>`;
                 $('#product-colors-container').append(newColor);
                 colorIndex++;
             });

             $(document).on('click', '.remove-color', function() {
                 $(this).closest('.color-item').remove();
             });
         });
     </script>



     <script>
         const allOptions = @json($attrOptions);

         $(document).on('change', '.attribute-checkbox', function () {
             const $wrapper = $('#attribute-options-wrapper');
             $wrapper.empty();

             const selected = $('.attribute-checkbox:checked').map(function () {
                 return $(this).data('attribute-id');
             }).get();

             if (selected.length > 0) {
                 $('#options-container').removeClass('d-none');
             } else {
                 $('#options-container').addClass('d-none');
             }

             selected.forEach(attrId => {
                 const attr = allOptions[attrId];
             let html = `
                <div class="form-group">
                    <label><strong>${attr.name} Options</strong></label>
                    <div class="d-flex flex-wrap">
            `;
             attr.options.forEach(opt => {
                 html += `
                    <div class="form-check mr-3 mb-2">
                        <input type="checkbox" class="form-check-input option-checkbox"
                            data-attr-id="${attrId}"
                            data-attr-name="${attr.name}"
                            data-is-free="${attr.is_free}"
                            data-opt-id="${opt.id}"
                            data-opt-value="${opt.value}"
                            name="attribute_options[${attrId}][]"
                            id="opt_${attrId}_${opt.id}"
                            value="${opt.id}">
                        <label class="form-check-label" for="opt_${attrId}_${opt.id}">
                            ${opt.value}
                        </label>
                    </div>
                `;
         });
             html += `</div></div>`;
             $wrapper.append(html);
         });
         });

         function generateVariants() {
             const selectedOptions = {};

             // Hide main quantity input when generating variants
             const $mainQtyWrapper = $('#main-quantity-wrapper');
             if ($mainQtyWrapper.length) {
                 $mainQtyWrapper.find('input[name="quantity"]').removeAttr('required');
                 $mainQtyWrapper.addClass('d-none');
             }

             $('.option-checkbox:checked').each(function () {
                 const $el = $(this);
                 const attrId = $el.data('attr-id');
                 const attrName = $el.data('attr-name');
                 const isFree = $el.data('is-free') === 1 || $el.data('is-free') === true;
                 const optId = $el.data('opt-id');
                 const optVal = $el.data('opt-value');

                 if (!selectedOptions[attrId]) {
                     selectedOptions[attrId] = {
                         id: attrId,
                         name: attrName,
                         is_free: isFree,
                         options: []
                     };
                 }

                 selectedOptions[attrId].options.push({
                     id: optId,
                     label: optVal
                 });
             });

             const attributes = Object.values(selectedOptions);

             if (attributes.length === 0 || attributes.some(attr => attr.options.length === 0)) {
                 alert("Select at least one attribute and at least one option for each.");
                 return;
             }

             function cartesian(arr) {
                 return arr.reduce((acc, curr) =>
                 acc.flatMap(a => curr.map(b => Array.isArray(a) ? [...a, b] : [a, b])), [[]]
             );
             }

             const optionsArr = attributes.map(a =>
                 a.options.map(opt => ({
                     attr: a.name,
                     attr_id: a.id,
                     is_free: a.is_free,
                     opt_id: opt.id,
                     opt: opt.label
                 }))
         );

             const combinations = cartesian(optionsArr);

             const hasPaidVariants = combinations.some(combo =>
                 Array.isArray(combo) && combo.some(opt => !opt.is_free)
         );

             const $mainPriceWrapper = $('#main-price-wrapper');
             const $salePriceWrapper = $('#sale-price-wrapper');

             if (hasPaidVariants) {
                 $mainPriceWrapper.addClass('d-none');
                 $salePriceWrapper.addClass('d-none');
                 $('input[name="regular_price"]').removeAttr('required');
                 $('input[name="sale_price"]').removeAttr('required');
             } else {
                 $mainPriceWrapper.removeClass('d-none');
                 $salePriceWrapper.removeClass('d-none');
             }

             const $container = $('#variant-container');
             $container.html('');

             combinations.forEach((combo, index) => {
                 const comboStr = combo.map(c => `${c.attr}: ${c.opt}`).join(', ');
             const isFree = combo.every(c => c.is_free);

             const html = `
                <div class="border p-3 mb-2">
                    <strong>${comboStr}</strong>
                    <input type="hidden" name="variants[${index}][combination]" value='${JSON.stringify(combo)}'>
                    ${isFree ? `
                        <input type="hidden" name="variants[${index}][price]" value="">
                        <input type="hidden" name="variants[${index}][discount_price]" value="">
                    ` : `
                        <div class="form-group mt-2">
                            <label>Price</label>
                            <input type="number" step="0.01" class="form-control" name="variants[${index}][price]" required>
                        </div>
                        <div class="form-group">
                            <label>Discount Price</label>
                            <input type="number" step="0.01" class="form-control" name="variants[${index}][discount_price]">
                        </div>
                    `}
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="variants[${index}][quantity]" required>
                    </div>
                </div>
            `;
             $container.append(html);
         });
         }
     </script>



@endsection
