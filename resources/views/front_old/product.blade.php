 @extends('layouts.front')
@section('title', $result->name_en)
@section('content')
 @section('pixel')
     snaptr('track', PAGE_VIEW, {'item_ids': ['INSERT_ITEM_ID_1', 'INSERT_ITEM_ID_2'], 'item_category': 'INSERT_ITEM_CATEGORY', 'uuid_c1': 'INSERT_UUID_C1', 'user_email': 'INSERT_USER_EMAIL', 'user_phone_number': 'INSERT_USER_PHONE_NUMBER', 'user_hashed_email': 'INSERT_USER_HASHED_EMAIL', 'user_hashed_phone_number': 'INSERT_USER_HASHED_PHONE_NUMBER'})
 @endsection
 @php
$photos = $result->images;
 @endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function add_fav(pro_id)
{

alert(' Please login first...');

//id = <?=(\Auth::user() !== null)? Auth::user()->id :'0'?> ;
// alert(id);
if(id != 0){
$.ajax({url:"{{url('/en/ajaxFavorite')}}/product_id/" + pro_id  ,type: "GET",
success:function(data){
successmessage = data;
//$("._fav_id"+ pro_id).html(successmessage);
}

});

} else {
alert(' Please login first...');
}

}
</script>







<header class="container border-main">
<ul class="nav product" >
<li class="nav-item  ">  <a class="nav-link  "  href="{{url('/')}}" > home </a>
</li>
<li class="nav-item  ">  <a class="nav-link  "  href="" >  <i class="fas fa-arrow-right " style="font-size: 20px"></i></a>
</li>
<li class="nav-item ">  <a class="nav-link   "   > {{$result->name_en}}  </a>
</li>
</ul>
</header>
<!--- --->
<div class="container "><br><br>
<div class="row">
@if(session('success'))

<div class="alert alert-success text-center" style="width: 100%; margin-top: 1%;display:none">
{{ session('success') }}
</div>

@endif
<div id="message" class="alert  text-center" style="width:60%;margin:0 auto;margin-bottom: 2%;">

    </div>

<div class="col-md-6 col-12 pad-0">
<div id="carouselExampleIndicators" class="carousel slide carousel1 carousel-fade" data-ride="carousel" >

<div class="carousel-inner">
@foreach($photos as $i=>$photo)
<div class="carousel-item {{($i==0)?'active':''}}">
    <a href="{{asset($photo->img)}}" style="background-color:red;padding:15px;color:white;position:absolute;top:100%;left:20%; transform: translate(50%,-100%);border-radius:40px">
        <i class="fas fa-search-plus" style="font-size:30px;color:white;cursor:pointer"></i></a>
<a href="{{asset($photo->img)}}">
<img style="height: 330px;
  width: auto;display: block;
  margin-left: auto;
  margin-right: auto;" src="{{asset($photo->img)}}" class="d-block h-img" alt="..." data-toggle="modal" data-target="#staticBackdrop"/>
  </a>
</div>
 @endforeach
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>

</div>

<ol class=" position-relative navbar" style="width:100%;margin-top:10x;z-index: 10;list-style: none;justify-content:space-between" >
<br>
@foreach($photos as $i=>$photo)
<li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{($i==0)?'active':''}}"  >
  <img src="{{asset($photo->img)}}"  style="
  width: auto;display: block;
  margin-left: auto;
  margin-right: auto;height: 90px;margin: 10px">
	   </li><br>
  @endforeach
</ol>
</div>
  <div class="col-md-6 col-12" style="display:flex;flex-wrap: wrap;margin: auto;">
                <div class="col-12 col-md-12" style="display: flex;align-items: center;justify-content: space-between">
                    <div class="col-8 col-md-8">

                        <h2>{{$result->name_en}} </h2>
                        <h5>{{get_price_helper($result->price)}}  </h5>
                    </div>

                   <form method="post" id="cart{{ $result->id}}" name="cart_form" class="col-md-6 col-12" action="{{ route('add.cart.post') }}">
                        @csrf
                        <h6>&nbsp;&nbsp;&nbsp; Quantity</h6>
                        <div class=" product-count col-12" style="">
                            <a onClick="update_cart({{$result->id}},{{$result->price}},'minus',{{$result->id}});"
                               rel="nofollow" data-id="{{$result->id}}" class="btn btn-default btn-minus " href="#"
                               title="Subtract">&ndash;</a>
                            <input type="text" name="qut" id="qty_{{$result->id}}"
                                   value="<?=(isset((\Session::get('cart'))[$result->id]['quantity'])) ? (\Session::get('cart'))[$result->id]['quantity'] : 1 ?>"
                                   size="2" class="cart_quantity_input form-control grey count quantity" min=1
                                   style=""/>
                            <a onClick="update_cart({{$result->id}},{{$result->price}},'plus',{{$result->id}});"
                               rel="nofollow" class="btn btn-default btn-plus " href="#" title="Add">+</a>
                        </div>




                </div>
                   @foreach($list as $pro)
                    @if($pro->has_color==1)
                    @if($result->id==$pro->id)
                    <div class=" row" style="margin:20px 0px ">
                   <a href="{{route('product',$pro->id)}}"> <span style="margin:10px;border:1px solid #000;padding:10px;color:red">{{$pro->color_en}}</span></a>
                    </div>
                    @else
                     <div class=" " style="margin:20px 0px ">
                   <a href="{{route('product',$pro->id)}}"> <span style="margin:10px;border:1px solid #000;padding:10px">{{$pro->color_en}}</span></a>
                    </div>
                    @endif
                    @endif
                    @endforeach
                    <br/>
                    <div class="row col-12" style="margin: auto;margin-bottom: 30px;padding-bottom: 30px;border-bottom: 2px solid grey;display: flex;align-items: center;justify-content: space-between">
                    <div class="form-group " >

                      <div class="col-md-12">
                  {!! Form::select('option_id',$result->options->where("name_en","=","Size")->pluck('value_en','id')->toArray(),null,[
                     'class' => 'form-control select2 ',
                      'id' => 'category_id',
                      "style"=>"width:100%",
                      "required"=>"required",
                      'placeholder' => "select Size",


                  ]) !!}
                      </div>
                      </div>
                    </div>
                <div class=" row col-12">

                        <div class="col-12" style="height: 38px; padding: 0;">

                            <input type="hidden" name="item_id" value="{{$result->id}}"/>
                            <button id="send{{ $result->id}}" type="submit" class="btn btn-dark border col-12">Add
                                to cart
                            </button>
                            <br><br>
                        </div>
 </form>
                    </div>

                    <div class="col-md-2 col-2">
                        <div class="btn btn-light ">
                            <div class="row">
                                <div id="" class=" btn btn-light border col-12 heart text-center">
                                    <!--<i class="fas fa-heart heart-none"></i>-->
                                    <i class="far fa-heart  "></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br><br>
                </div>
                 </div>

 </div>


                <h5>Description</h5>

                <p>{{$result->description_en}} </p>




                @if($result->qut > 0)
                    <h5>status : <span class="text-danger">{{$result->qut}} in stock
@endif
</span></h5>
 <h5> Share on
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://al3semaa.com/<?php echo $result->name_en ?>"
                       target="_blank" class="mr-10"><i class="fab fa-facebook-f" style="font-size: 25px;"></i></a>
                    <a href="http://twitter.com/share?text=<?php echo $result->name_en ?>&url=https://al3semaa.com/product/<?php echo $result->id ?>"
                       class="mr-10"> <i class="fab fa-twitter" style="font-size: 25px;"></i> </a>
                    <a href="whatsapp://send?text=https://al3semaa.com/product<?php echo $result->id ?>"
                       data-action="share/whatsapp/share" class="mr-10"> <i class="fab fa-whatsapp"
                                                                            style="font-size: 25px;"></i> </a></h5>

            </div>
</div></div>


<script type="text/javascript">

 function get_total_price(price)
{
$.ajax({
url: "{{url('/en/total_price')}}",
method: "get",
data: {
_token: '{{ csrf_token() }}',
price: price

},
success: function (response) {
$("#my_total").val(response + "KWD");

 //$("#divid").load(" #divid");
	//return response;
}

});

}


function update_cart(elem,pro_price,factor,item_id)
{

 var ele = document.getElementById('qty_'+elem).value;
if(factor == 'minus'){
	// alert(ele);

	qq = (Number($("#qty_"+ elem).val()) - 1 > 1)?Number($("#qty_"+ elem).val()) - 1:1;
$.ajax({
url: "{{url('/update_cart')}}/"+item_id+"/"+qq,
method: "get",



success: function (response) {
$(".my_total").html(response.data + "KWD");
//alert(response.data);
},error: function (response,u) {
//$(".my_total").html(response + "KWD");
	alert(u);

}

});
}else if(factor == 'plus'){
qq = Number($("#qty_"+ elem).val()) + 1 ;
	 $.ajax({
url: "{{url('/update_cart')}}/"+item_id+"/"+qq,
method: "get",

success: function (response) {
$(".my_total").html(response.data + "KWD");
	//alert(response.data);

},error: function (response,u) {
//$(".my_total").html(response + "KWD");
//	alert(u);

}

});
}else{}
//calc_total_cost(elem,pro_price,factor);
$(".x_sub_total_price_"+elem).html(pro_price * qq + " KWD");
 //$("#total").load(location.href +"#total");

 //$("#total").load("#total > *");
}


 function calc_total_cost(elem,pro_price,factor)
{

pro_price = pro_price;
if(factor == 'minus'){
qty = document.getElementById('qty_'+elem).value;
qty = (Number(qty) - 1 > 0)?Number(qty) - 1:1;
}else if(factor == 'plus'){
qty = document.getElementById('qty_'+elem).value;
qty = Number(qty) + 1;
}else{
	qty = 1;
}

/*
$.ajax({
url: "{{url('/en/total_cost/qty')}}/" + qty+'/pro_price/'+pro_price+'/factor/'+factor ,
type: "POST",
data: {
_token: '{{ csrf_token() }}',
id: elem.value,
}, success: function (result) {
	//alert(result);
$(".x_sub_total_price_"+elem).html(result + "KWD");
get_total_price(result);

}});
*/
}




</script>
 @stop