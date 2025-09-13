@extends('layouts.front')
@section('title', __('site.cart'))
@section('style')


<style>

a.btn.btn-default.btn-minus-des {
    cursor: auto;
    background-color: var(--bs-primary-green);
}
.styl-item-r {
      float: right;
      direction: ltr;
  }
</style>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <style>
        .styl-item-r {
              float: left;
          }
        #tttt p {
            direction: rtl;
            text-align: right;
        }
    </style>

    @endif
@endsection
@section('content')





<div class="container"  id="divid"> <br><br>
<div class="row pad text-center ">

<!--
@if(session('success'))

<div class="alert alert-success text-center" style="width: 60%; margin-left: 15%;">
{{ session('success') }}
</div>

@endif
-->
<h1  class="col-12 text-center">{{__('site.cart')}}</h1>

<div class="col-lg-8 col-md-12"> <!--d-md-block d-none-->
<div class="table_block table-responsive " >
<table class="table table-bordered">
<thead class="btn-dark">
<tr>
<th colspan="2" class="text-center">{{__('site.Product name')}}</th>
<th >{{__('site.Price')}}</th>
<th >{{__('site.QUANTITY')}}</th>
<th >{{__('site.SUBTOTAL')}}</th>
<th >&nbsp;</th>
</tr>
</thead>
<tbody >

  <?php $total = 0 ; ?>
  @if(session('cart'))
    @foreach(session('cart') as $id => $items)
      @foreach($items as $key => $details)
        <?php
        $price=round($details['price'],2);
        // dd($price);
        $total += $price * (int)$details['quantity'] ;
        $product = \App\Models\Product::where('id', $details['id'])->first();

        ?>
        <tr >
            <td >
              <a href="{{route("product",$product->id)}}">
                  <img class="product-cart" alt="{{$product->name}}" src="{{asset('assets/images/products/min/'.$product->img)}}" width="100px;">
                </a>
              </td>
              <td >
                <p class="">
                  <a href="{{route("product",$product->id)}} " class="active">{{$product->name}}</a>
                  @if($details['attributes'])

                        @foreach($details['attributes'] as $attribute => $option )
                            <div class="row row-attributes">
                              <?php
                                $m_attribute=  App\Models\Attribute::find($attribute);
                                if($product->is_clothes == 1){
                                    $m_option =$product ? App\Models\Option::where('id',$option)->first():null;
                                  // dd($m_attribute);

                                }else{
                                  $m_option=  $product ? $product->options->where('id',$option)->first():null ;
                                }
                              ?>
                              <span class="c-attribute"> {{$m_attribute ? $m_attribute->name_ar : ''}} : </span>
                              <span class="c-option">{{ $product->is_clothes == 0 ?($m_option ? $m_option->option->name_ar : ''): ($m_option ? $m_option->name_ar : '')}} </span>
                            </div>
                        @endforeach

                  @endif
                </p>
              </td>
              <td >
                <span>{{get_price_helper($details['price'],true)}}</span>
              </td>
              <td data-th="Quantity" class=" text-center" style="width:15%">
                <?php $price = $details["price"] ;?>
                <div class=" product-count col-12">
                  <a {{ $details['quantity'] >= 2 ? "onClick=update_cart(".$details['id'].",".$price.",'minus',".$details['id'].",".$key.");":"" }} rel="nofollow" data-id="{{ $id }}" class="btn btn-default  {{ $details['quantity'] >= 2 ? 'btn-minus':'btn-minus-des'}} " href="#" id="{{'a_mun_'.$details["id"].'_'.$key}}" title="Subtract">&ndash;</a>
                  <input type="text" style="background-color: #ffffff;" name="quantity" id="qty_<?=$details["id"]?>_{{$key}}" value="<?=(isset($details['quantity']))?$details['quantity']: 1 ?>" size="2" class="cart_quantity_input form-control grey count quantity m-0" min=1 style="" />
                  <a onClick="update_cart(<?=$details["id"]?>,<?=$price?>,'plus',<?=$details["id"]?>,<?=$key?>);"  rel="nofollow" class="btn btn-default btn-plus " href="#" title="Add">+</a>
                </div>
              </td>
              <td class="subtotal text-center" data-title="SUBTOTAL">
                  @php
                  $sum = $details['price'] * $details['quantity'];
                  @endphp
                  <p class="x_sub_total_price_<?=$details["id"]?>_{{$key}}">{{get_price_helper($sum,true)}}</p>
              </td>
              <td class="text-center" >

                  <form action="{{route("cart.remove")}}" method="get">
                  <input type="hidden" name="id" value = "{{$details['id']}}">
                  <button type="submit" title="delete" style="border: none;color: #fe3843;padding:0px;background: none; cursor: pointer;" class="btn btn-danger btn-sm " ><i style="width:15px"  class="fas fa-trash"></i></button></form>

              </td>
            </tr>
          @endforeach
        @endforeach
  @else
  	<tr >
      <td colspan="7" class="text-center" >  {{__('site.There are no items in the cart')}}  </td>
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
<h3 class=" col-12 c-w  mr-0">  {{__('site.Cart detail')}} </h3>
</div><br>
<p >{{__('site.Cart Subtotal')}}:<span id="total" class=" my_total styl-item-r">{{get_price_helper($total,true)}}</span></p><br>
<p >{{__('site.Shipping')}}:<span class=" styl-item-r ">{{__('site.Depend on city')}}</span></p><br>
<p >{{__('site.ORDER TOTAL')}}: <span class="  styl-item-r"> <span id="" class=" my_total styl-item-r">{{get_price_helper($total,true)}} </span>+ {{__('site.City shipping cost')}}</span></p><br>
<!--
<h4 class="main-color">Coupon Discount</h4>

<input type="text" class="form-control "  placeholder="Coupon code" required> <br>
-->
<a  href="{{route("checkout")}}" class="btn w-100 bg-main ">{{__('site.Checkout')}}</a>  <br><br>
<a  href="{{url('/'.app()->getLocale())}}" class="btn w-100 btn-light border">{{__('site.Continue Shopping')}}</a> <br><br>

</div>
</div>


</div>




</div>
</div>
@endsection
@section('js')
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
$("#my_total").val(response + '{{__("site.KWD")}}');

 //$("#divid").load(" #divid");
	//return response;
}

});

}


function update_cart(elem,pro_price,factor,item_id,key)
{

 var ele = document.getElementById('qty_'+elem+'_'+key).value;
 var element_qq = document.getElementById("a_mun_"+ elem+"_"+key);

//alert(ele);
if(factor == 'minus'){

//	 alert('marwa');
	       qq = (Number($("#qty_"+ elem+'_'+key).val()) - 1 > 1)?Number($("#qty_"+ elem+'_'+key).val()) - 1:1;
         if(qq <= 1){
           element_qq.classList.remove('btn-minus');
           element_qq.classList.add('btn-minus-des');
           $("#a_mun_"+ elem+"_"+key).attr('onClick','');
        }

        $.ajax({
          url: "{{url('/update_cart')}}/"+item_id+"/"+qq+'/'+key,
          method: "get",
          success: function (response) {
                $(".my_total").html(response.data + '{{__("site.KWD")}}');

          //alert(response.data);
          },error: function (response,u) {
          //$(".my_total").html(response + '{{__("site.KWD")}}');
          	alert(u);

          }

        });
}else if(factor == 'plus'){
qq = Number($("#qty_"+ elem+'_'+key).val()) + 1 ;
if(qq >=2){

  element_qq.classList.add('btn-minus');
  element_qq.classList.remove('btn-minus-des');
  $("#a_mun_"+ elem+"_"+key).attr('onClick','update_cart('+elem+','+pro_price+',"minus",'+item_id+','+key+')');
}
	 $.ajax({
url: "{{url('/update_cart')}}/"+item_id+"/"+qq+'/'+key,
method: "get",

success: function (response) {
$(".my_total").html(response.data + '{{__("site.KWD")}}');
	//alert(response.data);

},error: function (response,u) {
	alert(u);

}

});
}else{}
//calc_total_cost(elem,pro_price,factor);
$(".x_sub_total_price_"+elem+'_'+key).html(pro_price * qq + '{{__("site.KWD")}}');
 //$("#total").load(location.href +"#total");

 //$("#total").load("#total > *");
}


 function calc_total_cost(elem,pro_price,factor)
{

pro_price = pro_price;
if(factor == 'minus'){
qty = document.getElementById('qty_'+elem+'_'+key).value;
qty = (Number(qty) - 2 > 0)?Number(qty) - 1:1;
}else if(factor == 'plus'){
qty = document.getElementById('qty_'+elem+'_'+key).value;
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
$(".x_sub_total_price_"+elem).html(result + '{{__("site.KWD")}}');
get_total_price(result);

}});
*/
}




</script>


<!-- pg-body -->


@stop
