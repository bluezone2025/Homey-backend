@extends('student.master')


@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.countries')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('student.countries.index')}}">@lang('layout.countries')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('student.includes.modalBtnAction' , ['big' => true])

    {!! myDataTable_button([
        __('layout.add country') => route('student.countries.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name_ar"    =>  __('form.label.name ar'),
        "name_en"    =>  __('form.label.name en'),
        "code_phone" =>  __('form.label.code phone'),
        "count_number_phone" =>  __('form.label.count number phone'),
        "flag"       =>  __('form.label.flag'),
        "currency.code"       =>  __('form.label.currency_code'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        colLg = 6 ;
        let currency_id = '@json($currencies)';

        myDataTableColumns({
            name  :  ['id', 'name_ar', 'name_en',  'code_phone', 'count_number_phone', 'flag','currency_id'],
            class : {'updated_at': 'notEdit' ,'name_ar': 'notEdit','name_en':'noEdit' , 'created_at': 'notEdit'},
            file  : {'flag':'{{asset('assets/images/flags/{flag}')}}'},
            select: {currency_id},
            alias: {currency_id},
            input : {'count_number_phone':'number'},
            btn   :  {


                'edit'         : '{{route('student.countries.update' , '')}}'+'/{id}',

                @if(!$is_trash)
                    'delete'       : '{{route('student.countries.destroy' , '')}}'+'/{id}',
                @else
                    'restore'      : '{{route('student.countries.restore' , '')}}'+'/{id}',

                    'delete'       : '{{route('student.countries.finalDelete' , '')}}'+'/{id}',

                @endif
                'print'        : '#',
            }
        })
    </script>
@endsection
