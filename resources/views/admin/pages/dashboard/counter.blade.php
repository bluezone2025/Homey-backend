<div class="m-5">
    <div class="row">

        <div class="four col-md-4">
            <a href="{{route('admin.orders.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_count_online}}</span>
                    <p>@lang('form.label.count orders online')</p>
                </div>
            </a>
        </div>
        <div class="four col-md-4">
            <a href="{{route('admin.index_cach.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_count_cash}}</span>
                    <p>@lang('form.label.count orders cash')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.box_orders.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$box_order_count}}</span>
                    <p>@lang('form.label.box order count')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.orders.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_amount_online}}</span>
                    <p>@lang('form.label.amount orders online')</p>
                </div>
            </a>
        </div>
        <div class="four col-md-4">
            <a href="{{route('admin.index_cach.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_amount_cash}}</span>
                    <p>@lang('form.label.amount orders cash')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.box_orders.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$box_order_amount}}</span>
                    <p>@lang('form.label.box order amount')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.orders.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i>
                    <div class="d-flex justify-content-center">
                        <span style="font-size: 20px;color:#fff">@lang('form.label.default currency')</span>
                    <span class="counter">{{$orders_price}} </span> &nbsp;
                </div>
                    <p>@lang('form.label.price orders')</p>
                </div>
            </a>
        </div>

        {{--<div class="four col-md-4">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i>
                    <div class="d-flex justify-content-center">
                        <span style="font-size: 20px;color:#fff">@lang('form.label.default currency')</span>
                        <span class="counter">{{$box_orders_price}} </span> &nbsp;
                    </div>
                    <p>@lang('form.label.price box orders')</p>
                </div>
            </a>
        </div>--}}

        <div class="four col-md-4">
            <a href="{{route('admin.today.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_count_today}}</span>
                    <p>@lang('form.label.count orders today')</p>
                </div>
            </a>
        </div>
        <div class="four col-md-4">
            <a href="{{route('admin.today.index')}}">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i>
                    <div class="d-flex justify-content-center">
                        <span style="font-size: 20px;color:#fff">@lang('form.label.default currency')</span>
                    <span class="counter">{{$orders_price_today}} </span> &nbsp;
                </div>
                    <p>@lang('form.label.price orders today')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.student.index')}}">
                <div class="counter-box colored "> <i class="fa fa-ravelry" aria-hidden="true"></i> <span class="counter">{{$students_count}}</span>
                    <p>@lang('form.label.count students')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.users.index')}}">
                <div class="counter-box colored "> <i class="fa fa-users" aria-hidden="true"></i> <span class="counter">{{$users_count}}</span>
                    <p>@lang('form.label.count users')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="{{route('admin.products.index')}}">
                <div class="counter-box colored "> <i class="fa fa-product-hunt" aria-hidden="true"></i> <span class="counter">{{$products_count}}</span>
                    <p>@lang('form.label.count products')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="#">
                <div class="counter-box colored "> <i class="fa fa-product-hunt" aria-hidden="true"></i> <span class="counter">{{ \App\Models\ProductOrderDelete::distinct('product_id')->count() }}</span>
                    <p>@lang('form.label.count deleted products')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="#">
                <div class="counter-box colored "> <i class="fa fa-product-hunt" aria-hidden="true"></i> <span class="counter">{{ \App\Models\ProductOrderDelete::sum('end_price') }}</span>
                    <p>@lang('form.label.total deleted products')</p>
                </div>
            </a>
        </div>

    </div>

    <form action="">
    <div class="row flex justify-content-center" style="margin: 20px 0px">
        <div class="col-4">

                <label for="selected_month">{{__('form.label.select_month')}}</label>
                <select class="form-control" data-live-search="true" name="selected_month">
                    <?php
                    $months = [
                        '01' => 'January',
                        '02' => 'February',
                        '03' => 'March',
                        '04' => 'April',
                        '05' => 'May',
                        '06' => 'June',
                        '07' => 'July',
                        '08' => 'August',
                        '09' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December'
                    ];

                    foreach ($months as $key => $month) {
                        $selected = ($_GET['selected_month'] ?? '') === $key ? 'selected' : ''; // Check if the option should be selected
                        printf('<option value="%s" %s>%s</option>', $key, $selected, $month);
                    }
                    ?>
                </select>




        </div>
            <div class="col-4">
                <label for="selected_year">{{ __('form.label.select_year') }}</label>
                <select class="form-control" name="selected_year">
                    <?php
                    $currentYear = date("Y");
                    for ($year = 2000; $year <= 2030; $year++) {
                        $selected = ($_GET['selected_year'] ?? $currentYear) == $year ? 'selected' : '';
                        printf('<option value="%s" %s>%s</option>', $year, $selected, $year);
                    }
                    ?>
                </select>

            </div>
            <div class="col-4">
                <button style="margin: 30px 0px" type="submit" class="btn btn-success form-control"> ارسال</button>
            </div>

    </div>
    </form>

    @if((request()->get('selected_month')) && request()->get('selected_month') != null)
    <div class="row">
        <div class="four col-md-6">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check" aria-hidden="true"></i> <span class="counter">{{$orders_count_by_month}}</span>
                    <p>@lang('form.label.count selected month orders')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-6">
            <a href="#">
                <div class="counter-box colored "> <i class="fa-solid fa-list-check" aria-hidden="true"></i> <span class="counter">{{$orders_money_by_month}}</span>
                    <p>@lang('form.label.count money month orders')</p>
                </div>
            </a>
        </div>



    </div>
    @endif
</div>
