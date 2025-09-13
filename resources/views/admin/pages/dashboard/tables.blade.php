<div class="row">

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="p-2">@lang('form.label.lasts products')</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">id</div></th>
                            <th><div class="th-content">@lang('form.label.img')</div></th>
                            <th><div class="th-content">@lang('form.label.name')</div></th>
                            <th><div class="th-content">@lang('form.label.action')</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_products as $product)

                            <tr>
                                <td><div class="td-content">{{$product->id}}</div></td>
                                <td><div class="td-content"><img width="50" src="{{asset("assets/images/products/min/small_$product->img")}}" alt="avatar"></div></td>
                                <td><div class="td-content">{{$product["name_$lang"]}}</div></td>
                                <td><a href="{{route('admin.products.edit' , $product->id)}}" class="btn btn-secondary">@lang('layout.show')</a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="p-2">@lang('form.label.lasts orders')</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">id</div></th>
                            <th><div class="th-content">@lang('form.label.order price')</div></th>
                            <th><div class="th-content">@lang('form.label.status')</div></th>
                            <th><div class="th-content">@lang('form.label.action')</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_orders as $order)

                            <tr>
                                <td><div class="td-content">{{$order->id}}</div></td>
                                <td><div class="td-content">{{$order->total_price}}</div></td>
                                <td><div class="td-content">{{__("aliases.status.$order->status")}}</div></td>
                                <td><a href="{{route('admin.orders.show' , $order->id)}}" class="btn btn-secondary">@lang('layout.show')</a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="p-2">@lang('form.label.top favorite products')</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">id</div></th>
                            <th><div class="th-content">@lang('form.label.img')</div></th>
                            <th><div class="th-content">@lang('form.label.name')</div></th>
                            <th><div class="th-content">@lang('form.label.action')</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($top_products_likes as $product)

                            <tr>
                                <td><div class="td-content">{{$product->id}}</div></td>
                                <td><div class="td-content"><img width="50" src="{{asset("assets/images/products/min/small_$product->img")}}" alt="avatar"></div></td>
                                <td><div class="td-content">{{$product["name_$lang"]}}</div></td>
                                <td><a href="{{route('admin.products.edit' , $product->id)}}" class="btn btn-secondary">@lang('layout.show')</a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="p-2">@lang('form.label.top rating products')</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><div class="th-content">id</div></th>
                            <th><div class="th-content">@lang('form.label.img')</div></th>
                            <th><div class="th-content">@lang('form.label.name')</div></th>
                            <th><div class="th-content">@lang('form.label.action')</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($top_products_ratings as $product)

                            <tr>
                                <td><div class="td-content">{{$product->id}}</div></td>
                                <td><div class="td-content"><img width="50" src="{{asset("assets/images/products/min/small_$product->img")}}" alt="avatar"></div></td>
                                <td><div class="td-content">{{$product["name_$lang"]}}</div></td>
                                <td><a href="{{route('admin.products.edit' , $product->id)}}" class="btn btn-secondary">@lang('layout.show')</a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</div>
