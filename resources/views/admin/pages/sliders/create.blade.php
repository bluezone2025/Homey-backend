@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.sliders.index')}}">@lang('layout.show sliders')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add slider')</span></li>
@endsection

@section('content')

        @include('admin.includes.alert_success')

        <div class="row">
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('layout.add slider')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.pages.sliders.form_create')
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('css')
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .check-link{
            padding: 5px;
            margin-top: 5px;
            cursor: pointer;
        }

        .check-link:nth-of-type(odd){
            background-color: #343a4024;
        }

        .check-link:nth-of-type(even){
            background-color: rgba(246, 16, 16, 0.14) !important;
        }
    </style>
@endsection

@section('js')

    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('input').maxlength({
            threshold: 40,
        });
        $('#in_app').change(function() {
            if($('#in_app').val() === '1'){
                
               $('#link').attr("placeholder", "{{__('form.placeholder.link1')}}");

            }else{
               $('#link').attr("placeholder", "{{__('form.placeholder.link')}}");
 
            }
        });
        $('#link').on('input', function(){

            if ($('#in_app').val() === '1') {

                $.ajax({
                    url: '{{route('admin.searchProduct' , '')}}/'+$(this).val(),
                    success: function(data){

                        items = [];

                        $.each(data.products , function (key , value) {

                            items.push(`<li class="check-link"  data-id="${value.id}"  data-type='product'> <img class="d-block" height='50px' src="${value.img_src}/min/small_${value.img}"> <span class="d-block">${value.name_ar +" "+value.name_en}</span>  </li`)
                        })

                        $.each(data.categories , function (key , value) {

                            items.push(`<li class="check-link"  data-id="${value.id}" data-type='category'><span class="alert alert-info d-block" style="width: 100px ">Category</span> <span class="d-block">${value.name_ar +" "+value.name_en}</span>  </li`)
                        })

                        $('#cover-result').html(items);
                    }
                })
            }
        })


        $('body').on('click', '.check-link' , function(){

            $('#link').val($(this).attr("data-id"))

            if ($(this).attr("data-type") === 'product'){

                $('#type').val('product')

            }else {

                $('#type').val('category')
            }

            $('#cover-result').html('')
        })
    </script>

    <script>
        document.getElementById('slider_for').addEventListener('change', handleSliderForChange);

        function handleSliderForChange() {
            const selectedValue = document.getElementById('slider_for').value;
            const sliderReferenceGroup = document.getElementById('slider_reference_group');
            const selectGroup = document.getElementById('select_group');
            const selectReference = document.getElementById('select_reference');

            sliderReferenceGroup.style.display = 'none';
            selectGroup.style.display = 'none';
            selectReference.innerHTML = '';

            if (selectedValue === 'out_link') {
                sliderReferenceGroup.style.display = 'block';
            } else if (['product_id', 'brand_id', 'category_id'].includes(selectedValue)) {
                selectGroup.style.display = 'block';
                fetchOptions(selectedValue);
            }
        }

        function fetchOptions(type) {
            const selectReference = document.getElementById('select_reference');
            let url = '';


            if (type === 'product_id') {
                url = '{{ route("api.getProducts") }}';
            } else if (type === 'brand_id') {
                url = '{{ route("api.getBrands") }}';
            } else if (type === 'category_id') {
                url = '{{ route("api.getCategories") }}';
            }

            // Initialize Select2
            $(selectReference).select2({
                placeholder: 'Search...',
                allowClear: true,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term, // search term
                            page: params.page || 1
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                templateResult: formatResult,
                templateSelection: formatSelection
            });
        }

        function formatResult(item) {
            if (item.loading) return item.text;
            return item.text_ar || item.title_ar || item.name_ar;
        }

        function formatSelection(item) {
            return item.text_ar || item.title_ar || item.name_ar;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set up initial options for slider_for
            const forSelect = document.getElementById('slider_for');
            forSelect.innerHTML = '';
            forSelect.innerHTML += '<option value="">@lang("form.select_slider_for")</option>';
            forSelect.innerHTML += '<option value="out_link">@lang("form.out_link")</option>';
            forSelect.innerHTML += '<option value="product_id">@lang("form.product")</option>';
            forSelect.innerHTML += '<option value="category_id">@lang("form.category")</option>';
            forSelect.innerHTML += '<option value="brand_id">@lang("form.brand")</option>';

            // Initialize Select2 on the reference select
            $('#select_reference').select2();

            // Trigger initial change handler
            handleSliderForChange();
        });
    </script>
@endsection
