<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <style>
        body{
            direction: rtl !important;
            text-align: right !important;
        }
        p{
            color: #000000 !important;
            direction: rtl !important;
            text-align: right !important;
        }
        .invoice{
            direction: rtl !important;text-align: right !important;
            background: #ffffff !important;
            color: #000000 !important;
        }
        .primary-color{
            color: #811b07 !important;
        }
        body{
            direction: rtl !important;text-align: right !important;
            background: #000000;
        }
        .d-flex{
            display: flex !important;
        }
        .justify-content-between{
            justify-content: space-between !important;
        }
        .text-center{
            text-align: center !important;
        }
        .row{
            width: 100% !important;
        }
        .col-5{
            width: 40% !important;
        }
        .col-7{
            width: 50% !important;
        }
    </style>
</head>

<body>
    <div class="  col-md-12 d-md-block" style="margin: 20px auto !important;direction: rtl !important;text-align: right !important;">
        <h4 style="direction: rtl !important;text-align: right !important;">
            {{$order_id}}   طلب جديد من تطبيق اركان – رقم الطلب
        </h4>
        <h6 style="direction: rtl !important;text-align: right !important;">مرحبًا {{$brand_name}}،</h6>
        <p style="direction: rtl !important;text-align: right !important;">م تسجيل طلب جديد يحتوي على منتجات من متجرك في تطبيق <strong>اركان</strong></p>
        <p style="direction: rtl !important;text-align: right !important;">        يرجى البدء في تجهيز الطلب استعدادًا للتسليم.
        </p>
        <p style="direction: rtl !important;text-align: right !important;">
            <p style="direction: rtl !important;text-align: right !important;">🧾 تفاصيل الطلب</p>
            <ul style="direction: rtl !important;text-align: right !important;">
                <li style="direction: rtl !important;text-align: right !important;">
                    <span> رقم الطلب :</span>
                    <span>{{$order_id}}</span>

                </li>
                <li style="direction: rtl !important;text-align: right !important;">
                    <span  style="direction: rtl !important;text-align: right !important;">
                        المنتج:
                    </span>
                     <span  style="direction: rtl !important;text-align: right !important;">
                        {{$product_name}}
                    </span>
                </li>
                <li style="direction: rtl !important;text-align: right !important;">
                     <span  style="direction: rtl !important;text-align: right !important;">
                        الكمية:
                    </span>
                     <span  style="direction: rtl !important;text-align: right !important;">
                        {{$product_quantity}}
                    </span>
                </li>
            </ul>
        </p>
        <p style="direction: rtl !important;text-align: right !important;">
            بمجرد تجهيز الطلب، يرجى التواصل مع فريق أركان.
        </p>


    </div>

{{--    <div class="invoice container"--}}
{{--         style=" background: #ffffff !important; border: 3px solid #811b07 !important;--}}
{{--    color: #000000 !important; width: 90% !important;margin: auto;padding: 7px !important;">--}}
{{--        <h3 class="primary-color text-center" style="">الفاتورة</h3>--}}
{{--        <h4>--}}
{{--            <span style="margin-right: 5px !important;">طلب </span>--}}
{{--            <span >{{$order_id}}</span>--}}

{{--        </h4>--}}

{{--        <?php--}}

{{--        $date = new DateTime($order->created_at, new DateTimeZone('UTC'));--}}

{{--        // Optional: convert to another timezone like Cairo--}}
{{--        $date->setTimezone(new DateTimeZone('Africa/Cairo'));--}}

{{--        // Format: Y-m-d (date) l (day name) h:i A (12-hour time with am/pm)--}}
{{--        $order_date= $date->format('Y-m-d l h:i A');--}}


{{--        if ($order->cash == 1){--}}
{{--            $payment_way= "كاش";--}}
{{--        }--}}
{{--        if($order->paid_by == 1){--}}

{{--            $payment_way=  'ماي فاتورة';--}}
{{--        }--}}
{{--        if($order->paid_by == 2){--}}
{{--            $payment_way=  'تابي';--}}
{{--        }--}}
{{--        ?>--}}
{{--        <div class="primary-color" style="margin-bottom: 20px !important;">--}}
{{--            <span style="margin-right: 5px;"> تم في</span>--}}
{{--            <span>{{$order_date}}</span>--}}

{{--        </div>--}}

{{--        @foreach($order->order_items as $item)--}}
{{--            <div class="d-flex" style="width: 100% !important;margin-bottom: 5px">--}}
{{--                <img width="60" height="60" src="{{asset('/storage/' . $item->img)}}">--}}

{{--                <div  style="margin-right: 10px !important;">--}}
{{--                    <p>{{$item->product->title_ar}}</p>--}}
{{--                    <p>--}}
{{--                        <span>الكمية : </span>--}}
{{--                        <span class="primary-color">{{$item->quantity}}</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}

{{--        <div >--}}
{{--            <h3>الاجمالى</h3>--}}
{{--            <p>--}}
{{--                {{$order->total_price .'KWD'}}--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <h3>عنوان الشحن</h3>--}}
{{--            <p>--}}
{{--                @if($order->address1 != null)--}}

{{--                    {{ $order->address1 }}--}}
{{--                @else--}}
{{--                    @if($order->region !=null)--}}
{{--                        <span>--}}
{{--                            {{'المنطقة : '}}  {{ $order->region}} ----}}
{{--                        </span>--}}
{{--                    @elseif($order->the_plot !=null)--}}
{{--                        <span>--}}
{{--                            {{'القطعة : '}} {{ $order->the_plot}} ----}}
{{--                        </span>--}}
{{--                    @elseif($order->the_street !=null)--}}
{{--                        <span>--}}
{{--                            {{'اسم الشارع أو رقمه : '}} : {{ $order->the_street}} ----}}
{{--                        </span>--}}
{{--                    @elseif($order->the_avenue !=null)--}}
{{--                        <span>--}}
{{--                              {{'الجادة : '}} {{ $order->the_avenue}} ----}}
{{--                         </span>--}}

{{--                    @elseif($order->building_number !=null)--}}
{{--                        <span>--}}
{{--                          {{' رقم المبني : '}} {{ $order->building_number}} ----}}
{{--                       </span>--}}
{{--                    @else--}}
{{--                        <span style="text-align: center !important;">-----</span>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <h3> طريقة الدفع</h3>--}}
{{--            <p>--}}
{{--                {{$payment_way}}--}}
{{--            </p>--}}
{{--        </div>--}}


{{--    </div>--}}


    <p style="direction: rtl !important;text-align: right !important;">
        لأي استفسارات:
        📧 {{App\Settings::first()->email}} |
        📞 {{App\Settings::first()->phone}}

    </p>
    <p style="direction: rtl !important;text-align: right !important;">
        <strong style="direction: rtl !important;text-align: right !important;">
           نحياتنا,
        </strong>
    </p>
    <p style="direction: rtl !important;text-align: right !important;">
        <strong style="direction: rtl !important;text-align: right !important;">
            فريق اركان
        </strong>
    </p>

    </body>
</html>


