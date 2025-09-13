@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.designs')</span></li>
    @if($status == 1)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.designs active')</span></li>
    @else
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.designs pending')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button() !!}



    {!! myDataTable_table([
        "id"             => 'id',
        "img"  => __('form.label.img'),

        "design_name"  => __('form.label.design_name'),
        "user_name"  => __('form.label.user_name'),
        "phone"  => __('form.label.phone'),
        "note"  => __('form.label.note'),
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
                        'img',
                      'design_name',
                      'user_name',
                      // 'email',
                      'phone',
                       'note'
                     ],

           file   : {'img':"{{asset('/{img}')}}"},
            btn    :  {
              'show': ['{{route('admin.design.show.one' , '')}}'+'/{id}' , '@lang('form.label.show')' , 'btn-danger'],

                @if($status == 1)
                    @can('role' , 'rating.reject')
                    'reject': ['{{route('admin.design.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
                    @endcan

                @else
                    @can('role' , 'rating.accept')
                    'accept': ['{{route('admin.design.accept' , '')}}'+'/{id}' , '@lang('form.label.accept')'],
                    @endcan

                    @can('role' , 'rating.reject')
                    'reject'       : ['{{route('admin.design.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
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
