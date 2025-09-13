@extends('admin.master')

@section('breadcrumb')

    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.products')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">@lang('layout.products')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

{{--    @include('includes.modalBtnAction' , ['big' => true])--}}

    {!! myDataTable_button([
       __('layout.add box') => route('admin.boxes.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"             => 'id',
        "default_image"            => __('form.label.img'),
        "title_ar"        => __('form.label.name ar'),
        "title_en"        => __('form.label.name ar'),
        "box_category.title_ar"        => __('form.label.box_category_id'),
        "price"  => __('form.label.price'),
        "quantity"  => __('form.label.quantity'),
        "required_order"  => __('form.label.required_order'),
        "order_min_price"  => __('form.label.order_min_price'),
        "created_at"     => __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>
        td.td_name_ar{
          max-width: 200px !important;
          overflow-x: scroll;
        }
    </style>
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let boolean = {'false':false , 'true':true};

        // colLg = 6;

        myDataTableColumns({
            name   :  ['id', 'default_image' , "title_ar", 'title_en','box_category.title_ar' , 'price','quantity' ,'required_order','order_min_price', 'created_at'],
            // class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'products_count':'notEdit' },
            file   : {'default_image':"{{asset('assets/images/boxes/min/small_{default_image}')}}"},
            btn    :  {

                'edit': '{id}',

                @if(!$is_trash)

                        'delete': '{{route('admin.boxes.destroy' , '')}}'+'/{id}',
                    @else
                        'restore': '{{route('admin.boxes.restore' , '')}}'+'/{id}',
                        'delete': '{{route('admin.boxes.finalDelete' , '')}}'+'/{id}',
                @endif

                'print'        : '#',

            }
        })

        $('body').on('click', '.dataEdit', function(e){

            e.preventDefault();
            location.href = '{{url('admin/boxes')}}'+'/'+ $(this).attr('href')+'/edit';
        })
    </script>
@endsection
