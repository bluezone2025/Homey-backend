@extends('layouts.layout')
@section('title','Orders')
@lang("")

@section('content')
    <div class="container text-left"   id="divid"> <br><br>
        <div style=" padding:20px ">

        <div class="row ">

            <div class="col-md-3 col-xs-12 col-sm-6" >

								<span style="color:red">

								    @lang('site.code')
								     </span>
                <span class=""> : </span>

                <span>{{$order->id}}</span>

            </div>

            <div class="col-md-3 col-xs-12 col-sm-6" >

								<span style="color:red">
								    @lang('site.order_date')
								    </span>
                <span class=""> : </span>

                <span>{{$order->created_at}}</span>

            </div>





            <div class="col-md-3 col-xs-12 col-sm-6" >

                <span style="color:red"> @lang('site.status') </span>
                <span class=""> : </span>
                <span class="alert
                   @if(in_array($order->status ,['pending','accept']))
                     alert-info
                   @elseif(in_array($order->status ,['InPaying','shipping']))
                     alert-warning
                   @elseif(in_array($order->status ,['done']))
                      alert-success
                   @else
                     alert-danger
                   @endif p-0 "style="background-color:#fff;border:none;">{{__('site.'.$order->status)}}</span>

            </div>



            <div class="col-md-3 col-xs-12 col-sm-6" >

                <span style="color:red"> @lang('site.country') </span>
                <span class=""> : </span>

                <span>{{$order->shipping_address!= null ? ($order->shipping_address->area != null ? ($order->shipping_address->area->country != null ? $order->shipping_address->area->country->name:null ): null ): null }}</span>

            </div>







            <div class="col-md-3 col-xs-12 col-sm-6" >

                <span style="color:red"> @lang('site.city') </span>
                <span class=""> : </span>

                <span>{{$order->shipping_address!= null ? ($order->shipping_address->area != null ? $order->shipping_address->area->name:null): null }}</span>

            </div>


            <div class="col-md-3 col-xs-12 col-sm-6" >

                <span style="color:red"> @lang('site.address') </span>
                <span class=""> : </span>

                <span>{{$order->shipping_address!= null ?$order->shipping_address->address : null }}</span>

            </div>






            <div class="col-md-3 col-xs-12 col-sm-6" >

								<span style="color:red">
								@lang('site.Phone')
								</span>
                <span class=""> : </span>

                <span>{{$order->shipping_address!= null ?$order->shipping_address->phone : null }}</span>

            </div>



            <div class="col-md-3 col-xs-12 col-sm-6" >

								<span style="color:red">

								@lang('site.payment_way')
								</span>
                <span class=""> : </span>

                <span>@lang('site.'.$order->payment_method)</span>

            </div>



            <div class="col-md-3 col-xs-12 col-sm-6" >

								<span style="color:red">
								    @lang('site.ORDER TOTAL')
								     </span>
                <span class=""> : </span>

                <span>{{get_price_helper($order->total_price)}}</span>

            </div>











        </div>
        </div>

        <div class="box-body">


            <div class="table-responsive">
                <table class="table table-hover table-bordered  ">

                    <thead class="btn-dark">
                    <tr>
                        <th>#</th>
                        <th class="text-center">@lang('site.image')</th>
                        <th class="text-center">@lang('site.Product name')</th>
                        <th class="text-center">@lang('site.Price')</th>
                        <th class="text-center">@lang('site.QUANTITY')</th>
                        <th class="text-center">@lang('site.SUBTOTAL')</th>
                        <th class="text-center">@lang('site.attributes')</th>


                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($order->products as $product)


                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="text-center"><img src="{{ asset('assets/images/products/min/'.$product->img) }}" alt="" width="90px" height="70px"> </td>
                            <td class="text-center">{{$product->name}}</td>
                            <td class="text-center">{{get_price_helper($product->pivot->end_price / $product->pivot->quantity) }} </td>
                            <td class="text-center">{{$product->pivot->quantity}}</td>
                            <td class="text-center">{{get_price_helper($product->pivot->end_price)  }} </td>
                            <td class="text-center">
                              {{-- @if($product->pivot->attributes == null || $product->pivot->attributes =="" || $product->pivot->attributes=="{}")


                              @else
                                @foreach (json_decode($product->pivot->attributes, true) as $key => $value)
                                    {{App\Models\Attribute::whereId($key)->first()->name_ar}}  =>
                                    {{$product->is_clothes == 1 ? (App\Models\Option::where('id',$value)->first()->name_ar):($product->options->where('id',$value)->first()->option->name_ar??"")}} </br>
                                @endforeach
                              @endif --}}
                              @php($attrs = json_decode($product->pivot->attributes))
                            @php($name = "name_".app()->getlocale())
                              @if($attrs)
                              @foreach ($attrs as $attr)
                              @if (!isset($attrs->{'7'}) && !isset($attrs->{'6'}))
                                  <p>{{ $attr->attribute->$name . ': ' . $attr->$name }}</p>
                              @endif

                            @endforeach
                                @endif
                            @if ($product->is_clothes == 1)
                                @if (isset($attrs->{'6'}) && isset($attrs->{'6'}))
                                    <p>{{ 'المقاس' . ': ' . App\Models\Option::find($attrs->{'6'})->name_en }}</p>
                                    <p>{{ 'اللون' . ': ' . App\Models\Option::find($attrs->{'7'})->name_en }}</p>
                                @endif
                            @endif



                            </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table><!-- end of table -->
            </div>

        <!-- Button trigger modal -->


        </div><!-- end of box body -->



    </div>
    @endsection
