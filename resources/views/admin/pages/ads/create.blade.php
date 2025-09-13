@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.ads.index')}}">@lang('layout.ads')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add ad')</span></li>
@endsection

@section('content')

        @include('admin.includes.alert_success')

        <div class="row">
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('layout.add ad')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.pages.ads.form_create')
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('css')
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

    <script>
        $('input').maxlength({
            threshold: 40,
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
@endsection
