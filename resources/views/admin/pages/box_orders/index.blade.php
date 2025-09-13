@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.orders')</span></li>

@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button() !!}

    <div class="row">
        <div class="four col-md-2">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">
                        {{\App\Models\BoxOrder::where('payment_method','knet')->with('box')->withTrashed()
                        ->where('status','paid')->where('admin_status','!=','retrieved')->count()

                        }}</span>
                    <p>@lang('form.label.box order count')</p>
                </div>
            </a>
        </div>
        <div class="four col-md-2">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i>
                    <span class="counter">{{\App\Models\BoxOrder::where('payment_method','knet')->with('box')->withTrashed()
                    ->where('status','paid')->where('admin_status','!=','retrieved')->sum('total_price')
                    }}</span>
                    <p>@lang('form.label.box order amount')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-2">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">
                        {{\App\Models\BoxOrder::where('payment_method','knet')->with('box')->withTrashed()
                        ->where('status','paid')->where('admin_status','=','retrieved')->count()

                        }}</span>
                    <p>@lang('form.label.box order count retrieved')</p>
                </div>
            </a>
        </div>
        <div class="four col-md-2">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i>
                    <span class="counter">{{\App\Models\BoxOrder::where('payment_method','knet')->with('box')->withTrashed()
                    ->where('status','paid')->where('admin_status','=','retrieved')->sum('total_price')
                    }}</span>
                    <p>@lang('form.label.box order amount retrieved')</p>
                </div>
            </a>
        </div>
    </div>

    {!! myDataTable_table([
        "id"              => 'id',
        "user.name"       => __('form.label.user name'),
        "user.phone"      => __('form.label.phone'),
        "total_price"     => __('form.label.total order'),
        "status"          => __('form.label.status'),
        "admin_status"          => __('form.label.admin_status'),
        "imaget"          => __('form.label.image'),
    ]) !!}

@endsection

@section('css')

    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>

        img.img-item-one {
            width: 80px;
            padding: 5px;
        }
    </style>
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>


        let status = '@json(__('aliases.box_status'))';

        myDataTableColumns({
            name   :  ['id',  'user_name', 'user_address', 'total_price','status','admin_status','imaget'],
            class  : {'updated_at': 'notEdit' ,
                'created_at': 'notEdit',
                'products_count': 'notEdit',
                'order_price': 'notEdit' ,
                'discount': 'notEdit',
                'shipping_price': 'notEdit',
                'admin_status': 'notEdit',
                'total_price': 'notEdit',
                'image_t':'notEdit'},
            alias  : {status},
            select : {status},
            btn    :  {
                @can('role' , 'order.update')
                'edit'         : '{{route('admin.box_orders.update' , '')}}'+'/{id}',
                @endcan
                @can('role' , 'order.show')
                'show'         : '{{route('admin.box_orders.show' , '')}}'+'/{id}',
                @endcan
                'print'        : '#',

            }
        })
    </script>
@endsection
