@extends('layouts.front')
@section('title', 'Cart')
@section('script')
<script src="{{url('/public/js/jquery-3.3.1.min.js')}}"></script>

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

if(confirm("تأكيد الحذف ؟ ")) {
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


@section('content')


<div class="container" id="about">
<div class="row pad text-center ">
@if(session('success'))

<div class="alert alert-success text-center">
{{ session('success') }}
</div>

@endif
<h1  class="col-12 text-center"><br>Cart<hr></h1>

<div class="col-lg-8 col-md-12 d-md-block d-none">
<div class="table_block table-responsive " >
<table class="table table-bordered" style="text-align:center">
<thead>
<tr>
<th colspan="2" >Product </th>
<th >Price</th>
<th >Quantity</th>
<th >Total</th>
<th >&nbsp;</th>
</tr>
</thead>
<tbody >

<?php $total = 0 ?>
@if(session('cart'))
@foreach(session('cart') as $id => $details)

<?php $total += $details['price'] * $details['quantity'] ?>
<tr >
<td >
<a href="{{url('/en/ad/'.$details['slug'])}}">
 <img alt="{{ $details['name'] }}" src="{{url('/images/'.$details['image'])}}" width="100px;">
</a>
</td>
<td >
<p class="">
 <a href="{{url('/en/ad/'.$details['slug'])}}" class="active">{{ $details['name'] }}</a>
</p>


</td>
<td >
<span>{{ $details['price'] }} EGP</span>
</td>

<td data-th="Quantity" class=" text-center" style="width:15%">
<input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control quantity " min=1 style="color:#fff" />
</td>
<td class="subtotal text-center" data-title="SUBTOTAL">
<p>{{ $details['price'] * $details['quantity'] }} EGP</p>
</td>
<td style="" >
<button title="update" style="color:#c9733a;padding:10;background: none; cursor: pointer;" class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i style="width:15px" class="fas fa-sync-alt"></i></button>
<button title="delete" style="color:#c9733a;padding:0px;background: none; cursor: pointer;" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i style="width:15px"  class="fas fa-trash"></i></button>

</td>
</tr>

@endforeach

@else
	<tr >
<td colspan="6" > No items in the cart  </td>
</tr>
@endif


</tbody>
</table>
</div>
</div>
@if(session('cart'))
@foreach(session('cart') as $id => $details)
<div class="col-sm-12 d-md-none d-block">
<div class="row border  text-center"><br>
<a href="{{url('/en/ad/'.$details['slug'])}}" class="col-12 "><br>
 <img alt="Faded Short Sleeve T-shirts" src="{{url('/images/'.$details['image'])}}" width="100px;">
</a>
<br>

 <a href="{{url('/en/ad/'.$details['slug'])}}" class="active col-12">{{ $details['name'] }}</a>
<br>


<p class="col-12">Price: {{ $details['price'] }} EGP </p>
<div class="  mr-auto">
<input type="text" name="quantity" value="1" title="Qty"  class="qty" data-min="1" data-max="0" readonly="true">
<div class="qty-adjust ">
<a class="button increment-quantity"  aria-label="Add one" data-direction="1"><i class="fas fa-angle-up"></i></a>
<a class="button decrement-quantity"   aria-label="Subtract one" data-direction="-1" disabled="disabled"><i class="fas fa-angle-down"></i></a>
</div> </div>
   <p class="col-12">Total: {{ $details['price'] }} EGP </p>
<p class="col-12 text-left">
<button title="update" style="color:#c9733a;padding:10;background: none; cursor: pointer;" class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i style="width:15px" class="fas fa-sync-alt"></i></button>
<button title="delete" style="color:#c9733a;padding:0px;background: none; cursor: pointer;" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i style="width:15px"  class="fas fa-trash"></i></button>

</p>

</div>
</div>


@endforeach
@endif

<div class="col-lg-4  col-xs-12  text-left">
<div class="row">
<div class="container col-xs-12  border">
<h6 > <br> Cart Details </h6><br>
<p >Cart Total:<span class="float-left">{{ $total }} EGP</span></p><br>
<p style="display:none" >shipping:<span class="float-left">Free Shipping</span></p>
<p >Total: <span class="float-left">${{ $total }} EGP</span></p><br>
<!--<p class="active"> الدفع عند الاستلام</p>-->
</div>
</div>


</div>


<div class="col-md-8 col-xs-12">
<form class="row text-right">
<div class="col-lg-3 col-sm-4 col-12">
<br>
<a  href="{{url('/en')}}" class="btn btn-md btn-third-col">Continue shopping</a> </div>                                            <div class="col-sm-8 col-12">
<br>
<a  href="{{url('/en/checkout/')}}" class="btn btn-md btn-third-col">Payment</a> </div>
</form>
</div>
</div>
</div>

<!-- pg-body -->


@stop

