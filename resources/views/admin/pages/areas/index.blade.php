@extends('admin.master')


@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.areas')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.areas.index')}}">@lang('layout.areas')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif

@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add area') => route('admin.areas.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"             => 'id',
        "name_ar"        => __('form.label.name ar'),
        "name_en"        => __('form.label.name en'),
        "shipping_price" => __('form.label.shipping price'),
        "shipping_time" => __('form.label.shipping time'),
        "country_id"     => __('form.label.country'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let country_id = '@json($countries)';

        myDataTableColumns({
           name:  ['id', 'name_ar', 'name_en',   'shipping_price','shipping_time', 'country_id'],
            input:{'shipping_price':'number','shipping_time':'number'},
            select: {country_id},
            alias: {country_id},
            btn :  {

                @can('role' , 'area.update')
            'edit'         : '{{route('admin.areas.update' , '')}}'+'/{id}',
                @endcan

        @if(!$is_trash)

            @can('role' , 'area.destroy')
                'delete'       : '{{route('admin.areas.destroy' , '')}}'+'/{id}',
                    @endcan

        @else

            @can('role' , 'area.restore')
                'restore'      : '{{route('admin.areas.restore' , '')}}'+'/{id}',
                    @endcan

            @can('role' , 'area.finalDelete')
                'delete'       : '{{route('admin.areas.finalDelete' , '')}}'+'/{id}',
                    @endcan

        @endif
        'print'        : '#',
    }
})
</script>
@endsection
