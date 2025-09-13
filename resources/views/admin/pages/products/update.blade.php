@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">@lang('layout.products')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('edit')</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('admin.pages.products.form_update.form')
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
        document.getElementById('addColor').addEventListener('click', function() {
            let index = document.querySelectorAll('.color-item').length;
            let newColorHtml = `
            <div class="color-item d-flex align-items-center mb-2">
                <input type="color" name="product_colors[${index}][color]" class="form-control">
                <input type="file" name="product_colors[${index}][image]" class="form-control">

                <button type="button" class="btn btn-danger remove-color">@lang('layout.remove')</button>
            </div>
        `;
            document.getElementById('colors-container').insertAdjacentHTML('beforeend', newColorHtml);
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-color')) {
                event.target.closest('.color-item').remove();
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            // Only run this if the remove-variations checkbox exists
            if ($('#remove-variations').length) {
                $('#remove-variations').change(function() {
                    if ($(this).is(':checked')) {
                        // Hide options container and clear variants
                        $('#options-container').addClass('d-none');
                        $('#variant-container').empty();
                        $('.attribute-checkbox').prop('checked', false);
                        $('#generate-variants-btn').prop('disabled', true);

                        // Show simple product fields
                        $('#simple-price-fields').show();
                        $('#simple-quantity-field').show();
                    } else {
                        // Enable generate button if going back to variable product
                        $('#generate-variants-btn').prop('disabled', false);

                        // Hide simple product fields
                        $('#simple-price-fields').hide();
                        $('#simple-quantity-field').hide();
                    }
                });
            }

            // Initialize based on current state
            @if($product->has_paid_variant)
            $('#simple-price-fields').hide();
            $('#simple-quantity-field').hide();
            @endif
        });
    </script>

    <script>
        const allOptions = @json($attrOptions);
        const oldVariants = @json($product->variants);

        let isInitialLoad = true;

        $(document).ready(function () {
            const $container = $('#variant-container');

            // Show old variants (only on first load)
            if (oldVariants && oldVariants.length > 0) {
                $('#options-container').removeClass('d-none');

                oldVariants.forEach((variant, index) => {
                    const comboStr = variant.combination.map(c => `${c.attr}: ${c.opt}`).join(', ');
                const isFree = variant.price === null;

                const html = `
                    <div class="border p-3 mb-2">
                        <strong>${comboStr}</strong>
                        <input type="hidden" name="variants[${index}][combination]" value='${JSON.stringify(variant.combination)}'>
                        ${isFree ? `
                            <input type="hidden" name="variants[${index}][price]" value="">
                            <input type="hidden" name="variants[${index}][discount_price]" value="">
                        ` : `
                            <div class="form-group mt-2">
                                <label>Price</label>
                                <input type="number" step="0.01" class="form-control" name="variants[${index}][price]" value="${variant.price}" required>
                            </div>
                            <div class="form-group">
                                <label>Discount Price</label>
                                <input type="number" step="0.01" class="form-control" name="variants[${index}][discount_price]" value="${variant.discount_price ?? ''}">
                            </div>
                        `}
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="variants[${index}][quantity]" value="${variant.quantity}" required>
                        </div>
                    </div>
                `;
                $container.append(html);
            });
            }

            // On change of any attribute checkbox
            $(document).on('change', '.attribute-checkbox', function () {
                isInitialLoad = false;

                // Clear variants container and show options UI
                $('#variant-container').empty();
                $('#options-container').removeClass('d-none');

                // Generate new option checkboxes
                const selectedAttrIds = $('.attribute-checkbox:checked').map(function () {
                    return $(this).data('attribute-id');
                }).get();

                const $wrapper = $('#attribute-options-wrapper');
                $wrapper.empty();

                selectedAttrIds.forEach(attrId => {
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
        });

        function generateVariants() {
            // Hide simple product fields
            $('#simple-price-fields, #simple-quantity-field').hide();

            // Remove required attribute from all simple product inputs
            $('#simple-price-fields input, #simple-quantity-field input').each(function() {
                $(this).removeAttr('required');
                $(this).val(''); // Clear values as well
            });

            // Ensure remove variations checkbox is unchecked
            $('#remove-variations').prop('checked', false);

            // Remove any simple product marker if it exists
            $('#is-simple-product').remove();

            const selectedOptions = {};

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

                selectedOptions[attrId].options.push({ id: optId, label: optVal });
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
            const $container = $('#variant-container').empty();

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
