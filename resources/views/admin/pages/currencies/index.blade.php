@extends('admin.master')


@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.currencies')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.currencies.index')}}">@lang('layout.currencies')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction' )

    {!! myDataTable_button([
        __('layout.add currencies') => route('admin.currencies.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "name"    =>  __('form.label.name'),
        "rate"    =>  __('form.label.rate'),
        "code_ar" =>  __('form.label.code_ar'),
        "code_en" =>  __('form.label.code_en'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>


        myDataTableColumns({
            name  :  ['id', 'name', 'rate','code_ar'  ,'code_en'],
            input : {'rate':'number'},
            btn   :  {

                @can('role' , 'currency.update')
                'edit'         : '{{route('admin.currencies.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'currency.destroy')
                    'delete'       : '{{route('admin.currencies.destroy' , '')}}'+'/{id}',
                    @endcan
                @else

                    @can('role' , 'currency.restore')
                    'restore'      : '{{route('admin.currencies.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'currency.finalDelete')
                    'delete'       : '{{route('admin.currencies.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif
                'print'        : '#',
            }
        })
    </script>
@endsection
