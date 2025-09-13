@extends('layouts.default_en')
@section('title', 'Cart')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
$(".update-cart").click(function (e) {  
e.preventDefault();

var ele = $(this);
 
$.ajax({
url: "{{ url('/update-cart') }}",
method: "patch",
data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
success: function (response) {
window.location.reload();
}
});
});


$(".remove-from-cart").click(function (e) {
e.preventDefault();

var ele = $(this);

if(confirm("Do you want to delete this item ?")) {
$.ajax({
url: '{{ url('remove-from-cart') }}',
method: "DELETE",
data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
success: function (response) {
window.location.reload();
}
});
}
});

});


</script>



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
$("#total").html(response + "KWD");

 //$("#divid").load(" #divid");
	//return response;
}

});        
 
}
 

function update_cart(elem,pro_price,factor,item_id)
{

 var ele = document.getElementById('qty_'+elem).value;
//alert(ele);
if(factor == 'minus'){
//	 alert('marwa');

	qq = (Number($("#qty_"+ elem).val()) - 1 > 1)?Number($("#qty_"+ elem).val()) - 1:1;
$.ajax({
url: "{{url('/en/updateCart')}}",
method: "patch",
data: {
_token: '{{ csrf_token() }}',
id: item_id, 
quantity: qq

},


success: function (response) {
//alert(response);
}

}); 
}else if(factor == 'plus'){
qq = Number($("#qty_"+ elem).val()) + 1 ;
	 $.ajax({
url: "{{url('/en/updateCart')}}?product_id="+item_id+"&quantity="+qq,
method: "patch",
data: { 
_token: '{{ csrf_token() }}',
id: item_id,
 quantity: qq
  },
success: function (response) {
	//alert(response);
	

}

}); 
}else{}         
//calc_total_cost(elem,pro_price,factor);
$(".x_sub_total_price_"+elem).html(pro_price * qq + " KWD");
 $("#total").load("#total");
 
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





<div class="container"  id="divid"> <br><br>           
<div class="row pad text-center ">
@if(session('success'))

<div class="alert alert-success text-center" style="width: 60%; margin-left: 15%;">
{{ session('success') }}
</div>

@endif
<h1  class="col-12 text-center">Cart</h1>  

<div class="col-lg-8 col-md-12"> <!--d-md-block d-none-->
<div class="table_block table-responsive " >
<table class="table table-bordered">
<thead class="btn-dark">
<tr>
<th colspan="2" >Product name</th>
<th >vendor</th>
<th >Price</th>
<th >QUANTITY</th>
<th >SUBTOTAL</th>
<th >&nbsp;</th>
</tr>
</thead>
<tbody >

<?php $total = 0 ?>
@if(session('cart')) 
@foreach(session('cart') as $id => $details)

<?php
$total += $details['price'] * $details['quantity'] ;
$product = \App\Product::where('id', $details['id'])->first();
$vendor = \App\Vendor::where('id', $product->vendor_id)->first();

?>
<tr >
<td >
<a href="{{url('/en/product/'.$product->slug)}}">
<img alt="{{$product->name}}" src="{{url('/public/uploads/')}}/{{ $product->thumbnail}}" width="100px;">
</a>
</td>
<td >
<p class="">
<a href="{{url('/en/product/'.$product->slug)}} " class="active">{{$product->name}}</a>
</p>

<small>Product Code: <span>{{$product->ref_id}} </span></small>
</td>
<td >
<span>{{$vendor->name}}</span>
</td>
<td >
<span>{{$product->price}}KWD</span>
</td>

<td data-th="Quantity" class=" text-center" style="width:15%">
 <?php $price = $details["price"] ;
?>
<div class=" product-count col-12">
<a onClick="update_cart(<?=$details["id"]?>,<?=$price?>,'minus',<?=$details["id"]?>);" rel="nofollow" data-id="{{ $id }}" class="btn btn-default btn-minus " href="#" title="Subtract">&ndash;</a>
<input type="text" name="quantity" id="qty_<?=$details["id"]?>" value="<?=(isset($details['quantity'] ))?$details['quantity'] : 1?>" size="2" class="cart_quantity_input form-control grey count quantity" min=1 style="" />
<a onClick="update_cart(<?=$details["id"]?>,<?=$price?>,'plus',<?=$details["id"]?>);"  rel="nofollow" class="btn btn-default btn-plus " href="#" title="Add">+</a>
</div>
</td>
<td class="subtotal text-center" data-title="SUBTOTAL">
<p class="x_sub_total_price_<?=$details["id"]?>">{{ $details['price'] * $details['quantity'] }} KWD</p> 
</td>
<td style="" >
<button title="refresh" style="border: none;color: #fe3843;padding:10;background: none; cursor: pointer;" class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i style="width:15px" class="fas fa-sync-alt"></i></button>
<button title="delete" style="border: none;color: #fe3843;padding:0px;background: none; cursor: pointer;" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i style="width:15px"  class="fas fa-trash"></i></button>

</td>
</tr>

@endforeach

@else
	<tr >
<td colspan="6" >  There are no items in the cart  </td>
</tr>
@endif
 

</tbody>
</table>
</div>
</div>
<div class="col-lg-4   col-xs-12  text-left">
<div class="row">
<div id="tttt" class="container col-xs-12  border">
<div class="btn-dark row">
<h3 class=" col-12 c-w  mr-0">  Cart detail </h3>
</div><br>
<p >Cart Subtotal:<span id="total" class="float-right">{{ $total }} KWD</span></p><br>
<p >Shipping:<span class="float-right">Free Shipping</span></p><br>
<p >ORDER TOTAL: <span class="float-right">{{ $total }} KWD</span></p><br>
<!--
<h4 class="main-color">Coupon Discount</h4>

<input type="text" class="form-control "  placeholder="Coupon code" required> <br>
-->
<a  href="{{url('/en/checkout/')}}" class="btn w-100 bg-main ">Checkout</a>  <br><br>
<a  href="{{url('/en')}}" class="btn w-100 btn-light border">Continue Shopping</a> <br><br>                                          

</div>
</div>


</div>


 
 
</div>
</div>

<!-- pg-body -->


@stop

 