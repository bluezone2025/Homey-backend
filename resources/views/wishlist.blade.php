


@extends('layouts.front')
@section('title', __('site.wishlist'))
@section('content')






    <div class="container"  id="divid"> <br><br>

         @if(  count($items) > 0)

        <div class="row pad text-center ">

            <h1  class="col-12 text-center"> @lang('site.wishlist')</h1>
            <div class="col-lg-12 col-md-12" style="margin:auto;"> <!--d-md-block d-none-->


                            @foreach($items as $item)

<div class="col-md-4" style="display:flex;justify-content:center;align-items:center;flex-wrap:wrap;padding-top:20px;padding-bottom:20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);margin-bottom:15px;margin-top:15px">

                                    <div class="col-md-4 col-12">
                                        <a href="#">
                                            <img alt="{{$item->name}}" src="{{asset('assets/images/products/min/'.$item->img)}}" style="height: auto;
  width: 100%;display: block;
  margin-left: auto;
  margin-right: auto;margin-bottom:10px
">
                                        </a>
                                    </div>
                                     <div class="col-md-6 col-12" style="margin-bottom:10px">
                                        <p class="">
                                          <a href="{{route("product",$item->id)}} " class="active">{{$item->name}}</a>
                                        </p>
                                       <strong>@lang('site.Price') : </strong>   <span>
                                         @if($item->if_sale)
                                           <b>{{get_price_helper($item->sale_price,true)}}</b>
                                           <span class="regular_price">{{get_price_helper($item->regular_price,true)}} </span>
                                         @else
                                           <b>{{get_price_helper($item->regular_price,true)}}</b>
                                         @endif
                                           </span>

                                    </div>
                                     <a href="#" title="delete" style="border: none;color: #fe3843;padding:0px;background: none; cursor: pointer;" class="btn btn-danger btn-sm remove-from-wish " data-id="{{ $item->id }}"><i style="width:15px"  class="fas fa-trash"></i></a>


                              </div>

                            @endforeach

            </div>
 @elseif( count($items) == 0)
                           <br><br><br><br>
                                 <h1 style="color: red ;text-align: center;">@lang('site.There are no items in the Wish List')</h1><br><br><br><br>



                        @endif




        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script  >
        $(document).on('click','.remove-from-wish',function (e) {

            e.preventDefault();
            $.ajax({
                type: 'delete',
                url:"{{route('wishlist.destroy')}}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    'productId':$(this).attr('data-id'),
                },
                success:function (data) {
                    if (data.message){
                        const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'error',
                                title: data.message,
                                width: 600,
                                padding: '3em',

                            })
                        location.reload();
                    }
                }
            });


        });


    </script>






    <!-- pg-body -->


@stop
