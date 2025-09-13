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
        "design_name"  => __('form.label.product name'),
        "rating"         => __('form.label.rating'),
        "comment"        => __('form.label.comment'),
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
            name   :  ['id',
              'design.design_name',
               'rating',
                'comment'],
            btn    :  {

                @if($status == 1)
                    @can('role' , 'rating.reject')
                    'reject': ['{{route('admin.design.rating.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
                    @endcan

                @else
                    @can('role' , 'rating.accept')
                    'accept': ['{{route('admin.design.rating.accept' , '')}}'+'/{id}' , '@lang('form.label.accept')'],
                    @endcan

                    @can('role' , 'rating.reject')
                    'reject'       : ['{{route('admin.design.rating.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
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
