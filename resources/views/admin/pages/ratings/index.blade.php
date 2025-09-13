@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.ratings')</span></li>
    @if($status == 1)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.ratings active')</span></li>
    @else
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.ratings pending')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button() !!}



    {!! myDataTable_table([
        "id"             => 'id',
        "img"            => __('form.label.product img'),
        "product_$lang"  => __('form.label.product name'),
        "rating"         => __('form.label.rating'),
        "comment"        => __('form.label.comment'),
        "updated_at"     => __('form.label.updated_at'),
        "created_at"     => __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let $lang = '{{$lang}}'
        myDataTableColumns({
            name   :  ['id', 'product.img', 'product.name_'+$lang, 'rating', 'comment',  'updated_at', 'created_at'],
            file   : {'product.img':"{{asset('assets/images/products/min/small_{product.img}')}}"},
            btn    :  {

                @if($status == 1)
                    @can('role' , 'rating.reject')
                    'reject': ['{{route('admin.rating.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
                    @endcan

                @else
                    @can('role' , 'rating.accept')
                    'accept': ['{{route('admin.rating.accept' , '')}}'+'/{id}' , '@lang('form.label.accept')'],
                    @endcan

                    @can('role' , 'rating.reject')
                    'reject'       : ['{{route('admin.rating.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
                    @endcan
                @endif
                'print'        : '#',

            }
        })

        $('body').on('click', '.reject , .accept' , function(e){

            e.preventDefault();

            $comnfirmd = $(this).hasClass('reject')? window.confirm('@lang('form.label.confirm delete rating')') : true

            if ($comnfirmd){

                $(this).parents('tr').hide(500);

                $.ajax({

                    url: $(this).attr('href'),
                    method: 'post',
                })
            }

        })
    </script>
@endsection
