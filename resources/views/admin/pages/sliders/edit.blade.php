@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.sliders.index')}}">@lang('layout.show sliders')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.edit slider')</span></li>
@endsection

@section('content')
    @include('admin.includes.alert_success')

    <div class="row">
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('layout.edit slider')</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @include('admin.pages.sliders.form_edit')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .img-preview {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('js')
    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Track current reference ID
        let currentReferenceId = @json($slider->slider_reference);
        let currentSliderType = @json($slider->slider_for);

        document.addEventListener('DOMContentLoaded', function() {
            const sliderFor = document.getElementById('slider_for');
            sliderFor.value = currentSliderType;
            initializeReferenceField(currentSliderType, currentReferenceId);
        });

        // Handle slider type change
        document.getElementById('slider_for').addEventListener('change', function() {
            const newType = this.value;

            // Only reinitialize if type changed
            if (newType !== currentSliderType) {
                currentSliderType = newType;
                currentReferenceId = null; // Reset reference ID when type changes
                initializeReferenceField(newType, null);
            }
        });

        function initializeReferenceField(type, referenceId) {
            const sliderReferenceGroup = document.getElementById('slider_reference_group');
            const selectGroup = document.getElementById('select_group');

            // Hide both fields initially
            sliderReferenceGroup.style.display = 'none';
            selectGroup.style.display = 'none';

            // Handle out_link type
            if (type === 'out_link') {
                sliderReferenceGroup.style.display = 'block';
                document.getElementById('slider_reference').value = referenceId || '';
                return;
            }

            // Handle product/brand/category types
            if (['product_id', 'brand_id', 'category_id'].includes(type)) {
                selectGroup.style.display = 'block';
                initializeSelect2(type, referenceId);
            }
        }

        function initializeSelect2(type, selectedId = null) {
            const selectElement = document.getElementById('select_reference');

            // Clear existing Select2 if it exists
            if ($(selectElement).hasClass('select2-hidden-accessible')) {
                $(selectElement).select2('destroy');
            }

            // Recreate the select element to ensure clean state
            const newSelect = selectElement.cloneNode(false);
            selectElement.parentNode.replaceChild(newSelect, selectElement);

            // Initialize new Select2 instance
            $(newSelect).select2({
                placeholder: 'Search...',
                allowClear: true,
                ajax: {
                    url: getApiUrl(type),
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response.data.map(item => ({
                                id: item.id,
                                text: item.text_ar || item.text
                            }))
                    };
                    }
                },
                minimumInputLength: 1
            });

            // Load selected value if provided
            if (selectedId) {
                loadSelectedValue(type, selectedId, newSelect);
            }
        }

        function getApiUrl(type) {
            switch(type) {
                case 'product_id': return '{{ route("api.getProducts") }}';
                case 'brand_id': return '{{ route("api.getBrands") }}';
                case 'category_id': return '{{ route("api.getCategories") }}';
                default: return '';
            }
        }

        function loadSelectedValue(type, id, selectElement) {
            let url;
            switch(type) {
                case 'product_id':
                    url = '{{ route("api.getProduct", "") }}/' + id;
                    break;
                case 'brand_id':
                    url = '{{ route("api.getBrand", "") }}/' + id;
                    break;
                case 'category_id':
                    url = '{{ route("api.getCategory", "") }}/' + id;
                    break;
                default: return;
            }

            fetch(url)
                .then(response => response.json())
        .then(data => {
                // Create and select new option
                const option = new Option(data.text_ar || data.text, data.id, true, true);
            selectElement.appendChild(option);
            $(selectElement).val(data.id).trigger('change');
        })
        .catch(error => console.error('Error loading selected value:', error));
        }
    </script>
@endsection