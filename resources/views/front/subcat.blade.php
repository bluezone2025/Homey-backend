@extends('layouts.front')
@section('title', $records->name_en)
@section('id',$records->id)
@section('cat_or_sub',2)

@section('new_titles')
    <h3 style="width: calc(100% - 90px);border-radius: 5px;margin: 30px 0 30px 30px;padding: 10px 15px;background: linear-gradient(90deg, rgba(0,24,36,1) 0%, rgba(9,32,121,1) 53%, rgba(0,212,255,1) 100%);color: white">
        {{$records->->name_en}}  </h3>


@endsection
@section('content')

    <br>
    <div class="container border-main">

        <div class="row  row5 ">
              @if($offers->count() < 1)

                            <p style="text-align: center ;width: 100%;margin: 30px" >
                                لا يوجد منتجات في هذا القسم
                            </p>
                        @else
            @foreach($offers as $one)
                <div class=" col-12 col-md-4 col-lg-3 ">
                    <br>
                    <div class="card">
                        <h6 class="bg-main abs">ref:{{$one->id}}</h6>
                        <a href="{{route("product",$one->id)}}">
                            <img style="height: 200px;
  width: auto;display: block;
  margin-left: auto;
  margin-right: auto;" src="{{asset($one->img)}}" class="card-img-top  " alt="..."> </a>
                        <div class="card-body">
                            <a href="{{route("product",$one->id)}}" class="card-text ">{{$one->name_en}}</a>
                            <p class="card-title" href=""><b>{{get_price_helper($one->price,true)}}</b></p>

                        </div>
                        <div class="row mr-0">
                            <a href="{{route('add.cart',[$one->id,1])}}" class="btn btn-dark border col-9">add to
                                cart</a>
                              @if(!Auth::guard('client')->check())

                                    <div class="btn btn-light border col-3 heart text-center"><a  href="{{route('login/client')}}"><i class="fas fa-heart heart-none"></i><i class="far fa-heart  heart-block"></i></a></div>

                                            @elseif(Auth::guard('client')->check())

                                                                                        <div class="addToWishlist btn btn-light border col-3 heart text-center" data-product-id = "{{$one->id}}"> <i class="fas fa-heart heart-none"></i><i class="far fa-heart  heart-block"></i>

                                            </div>
 @endif
                        </div>
                    </div>
                </div>
            @endforeach
@endif

        </div>
        <br>
        {{ $offers->appends(request()->query())->links() }}
        <br><br></div>





@stop



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script  >
    $(document).on('click','.addToWishlist',function (e) {

        e.preventDefault();
        $.ajax({
            type: 'get',
            url:"{{route('wishlist.store')}}",
            data:{
                'productId':$(this).attr('data-product-id'),
            },
            success:function (data) {
                if (data.message){
                alert(data.message)}
                else {
                    alert('This product already in you wishlist');
                }
            }
        });


    });


</script>
    
   
