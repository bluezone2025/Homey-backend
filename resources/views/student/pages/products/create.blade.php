@extends('student.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('student.products.index')}}">@lang('layout.products')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add product')</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('student.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('student.pages.products.form_create.form')
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
        $(document).ready(function() {
            let colorIndex = 0; // Start from 0

            $('#add-color').click(function() {
                let newColor = `
                <div class="color-item d-flex align-items-center mb-2">
                    <input type="color" name="product_colors[${colorIndex}][color]" class="form-control color-picker" required>
                    <input type="file" name="product_colors[${colorIndex}][image]" class="form-control ml-2">
                    <button type="button" class="btn btn-danger remove-color ml-2">X</button>
                </div>`;
                $('#product-colors-container').append(newColor);
                colorIndex++;
            });

            $(document).on('click', '.remove-color', function() {
                $(this).closest('.color-item').remove();
                // Optional: You might want to reindex the remaining inputs here
            });
        });
    </script>


    <script>
        const allOptions = @json($attrOptions);

        document.querySelectorAll('.attribute-checkbox').forEach(cb => {
            cb.addEventListener('change', function () {
            const wrapper = document.getElementById('attribute-options-wrapper');
            wrapper.innerHTML = '';
            const selected = Array.from(document.querySelectorAll('.attribute-checkbox:checked'))
                .map(cb => cb.dataset.attributeId);

            if (selected.length > 0) {
                document.getElementById('options-container').classList.remove('d-none');
            } else {
                document.getElementById('options-container').classList.add('d-none');
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
            wrapper.insertAdjacentHTML('beforeend', html);
        });
        });
        });

        function generateVariants() {
            const selectedOptions = {};

            // Hide the main quantity input when variants are generated
            const mainQtyWrapper = document.getElementById('main-quantity-wrapper');
            if (mainQtyWrapper) {
                const mainQtyInput = document.querySelector('input[name="quantity"]');
                if (mainQtyInput) {
                    mainQtyInput.removeAttribute('required');
                }
                mainQtyWrapper.classList.add('d-none');
            }

            document.querySelectorAll('.option-checkbox:checked').forEach(el => {
                const attrId = el.dataset.attrId;
            const attrName = el.dataset.attrName;
            const isFree = el.dataset.isFree === "1";
            const optId = el.dataset.optId;
            const optVal = el.dataset.optValue;

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

            // Validate
            if (attributes.length === 0 || attributes.some(attr => attr.options.length === 0)) {
                alert("Select at least one attribute and at least one option for each.");
                return;
            }

            // Cartesian product helper
            function cartesian(arr) {
                return arr.reduce((acc, curr) => {
                    return acc.flatMap(a => curr.map(b => Array.isArray(a) ? [...a, b] : [a, b]));
            }, [[]]);
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

            // Check if any combo has at least one paid option (not is_free)
            const hasPaidVariants = combinations.some(combo =>
                Array.isArray(combo) && combo.some(opt => !opt.is_free)
        );

// Toggle main price and sale price inputs
            const mainPriceWrapper = document.getElementById('main-price-wrapper');
            const salePriceWrapper = document.getElementById('sale-price-wrapper');

            if (hasPaidVariants) {
                mainPriceWrapper?.classList.add('d-none');
                salePriceWrapper?.classList.add('d-none');
                const regular_price = document.querySelector('input[name="regular_price"]');
                if (regular_price) {
                    regular_price.removeAttribute('required');
                }

                const sale_price = document.querySelector('input[name="sale_price"]');
                if (sale_price) {
                    sale_price.removeAttribute('required');
                }

            } else {
                mainPriceWrapper?.classList.remove('d-none');
                salePriceWrapper?.classList.remove('d-none');
            }

            const container = document.getElementById('variant-container');
            container.innerHTML = '';


            combinations.forEach((combo, index) => {
                const comboStr = combo.map(c => `${c.attr}: ${c.opt}`).join(', ');
            const isFree = combo.every(c => c.is_free); // ✅ FIXED

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
            container.insertAdjacentHTML('beforeend', html);
        });
        }
    </script>

@endsection
