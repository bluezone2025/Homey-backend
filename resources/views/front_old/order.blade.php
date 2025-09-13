@extends('layouts.front')
@section('title',__('site.My orders'))
@section('content')
    <div class="container"  id="divid"> <br><br>
        @if(  count($orders) > 0)

            <div class="row pad text-center ">

                <h1  class="col-12 text-center">{{__('site.My orders')}}</h1>
                <div class="col-lg-12 col-md-12"> <!--d-md-block d-none-->
                    <div class="table_block table-responsive " >


                        <table class="table table-bordered" >
                            <thead class="btn-dark">

                            <tr>
                                <th > #</th>
                                <th >{{ __('site.code')}}</th>
                                <th >{{ __('site.ORDER TOTAL')}}</th>
                                <th >{{ __('site.Phone')}}</th>
                                <th >{{ __('site.country')}}</th>
                                <th >{{ __('site.city')}}</th>
                                <th >{{ __('site.address')}}</th>
                                <th >{{ __('site.order_date')}}</th>
                                <th >{{ __('site.payment_way')}}</th>
                                <th >{{ __('site.status')}}</th>
                                <th >{{ __('site.order Details')}}</th>

                            </tr>
                            </thead>
                            <tbody >

                            @foreach($orders as $order)
                                <tr >
                                    <td>{{$loop->iteration}}</td>

                                    <td>{{$order->id}}</td>
                                    <td >{{get_price_helper($order->total_price)}}  </td>
                                    <td>{{$order->shipping_address!= null ?$order->shipping_address->phone : null }}</td>
                                    <td>{{$order->shipping_address!= null ? ($order->shipping_address->area != null ? ($order->shipping_address->area->country != null ? $order->shipping_address->area->country->name:null ): null ): null }}</td>
                                    <td>{{$order->shipping_address!= null ? ($order->shipping_address->area != null ? $order->shipping_address->area->name:null): null }}</td>
                                    <td>{{$order->shipping_address!= null ?$order->shipping_address->address : null }}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{__('site.'.$order->payment_method)}}</td>
                                    <!-- 'pending','accept','reject','done','shipping','InPaying','Paymentfailed' -->
                                      @if($order->status =='pending' && $order->payment_method=='knet')
                                        @php
                                             $order->status='Paymentfailed';
                                             $order->save();

                                        @endphp
                                      @endif
                                        <td class="text-center"> <div class="alert
                                           @if(in_array($order->status ,['pending','accept']))
                                             alert-info
                                           @elseif(in_array($order->status ,['InPaying','shipping']))
                                             alert-warning
                                           @elseif(in_array($order->status ,['done']))
                                              alert-success
                                           @else
                                             alert-danger
                                           @endif">


                                            {{__('site.'.$order->status)}}

                                         </div></td>
                                    {{-- @elseif($order->status==2)
                                        <td class="text-center"> <div class="alert alert-danger">تم الشحن</div></td>

                                    @elseif($order->status==3)
                                        <td class="text-center"> <div class="alert alert-success">تم الاستلام </div></td>
                                    @elseif($order->status==4)
                                        <td class="text-center"> <div class="alert alert-danger">تم الالغاء</div></td>
                                    @else
                                        <td class="text-center"> </td>

                                    @endif--}}
<td class="text-center">
                                    <a href="{{url(route("order.view",$order->id)) }}" class="btn btn-dark btn-sm"><i class="fa fa-eye" style="color: white"></i> @lang('')</a>
</td>

                                </tr>
                            @endforeach





                            </tbody>
                        </table>


                    </div>
                </div>
                @elseif( count($orders) == 0)
                    <br><br><br><br>
                    <h1 style="color: red ;text-align: center;">لا يوجد طلبات</h1><br><br><br><br>



                @endif




            </div>
    </div>

@endsection
