 @extends('layouts.default_en')
@section('title', 'Checkout')

@section('content')
 

<!--- --->
<div class="container " >  <br><br>          
<div class="row pad  ">
<div class="col-md-8 ">
<div class="col-12 border">
<div class="btn-dark row">
<h4 class=" col-12 mr-0">   Shipping Details</h4>
</div><br>     
 <form >
   

<input type="text" class="form-control " name="first name" placeholder="first name" required>
<br>
	 <input type="text" class="form-control " name="last name" placeholder="last name" required>
<br>
<input type="text" class="form-control "  placeholder="Company name (optional)" required> <br>
<select  value="2"  class="form-control" required>
<option value="">country ..</option>
<option value="1">الكويت</option>
<option value="2">الامارات العربية المتحدة</option>
<option value="3">المملكة العربية السعودية</option>
<option value="4">قطر</option>
<option value="5">عمان</option>
<option value="6">البحرين</option>
<option value="7">امريكا</option>
<option value="8">أستراليا</option>
<option value="9">السويد</option>
<option value="10">انجلترا</option>
<option value="11">مصر</option>
<option value="12">هولندا</option>
<option value="13">الاردن</option>
</select>
<br>
	  <input type="text" class="form-control "  placeholder="House number and street name" required> <br>
	  <input type="text" class="form-control "  placeholder="Apartment, suite, unit, etc. (optional)" required> <br>
	  <input type="text" class="form-control "  placeholder="Town / City " required> <br>
		<input type="text" class="form-control "  placeholder="Postcode / ZIP " required> <br>
		<input type="text" class="form-control "  placeholder="Phone  " required> <br>
<input type="email" class="form-control "  placeholder="Email address   " required> <br>

	  <br>
<textarea class="col-12"  placeholder="Order notes (optional)" rows="6"></textarea>
<br><br>
 </form>
</div></div>
<div class="col-md-4 ">
<div class="col-12 border">
<div class="btn-dark row">
<h4 class=" col-12 mr-0">   Order Summary</h4>
</div><br>
<div class="row ">
		   <a href="product.html" class=" col-3">
 <img alt=" T-shirts" src="img/p17.jpg" width="80px;">
</a>
 <div class="col-6">
 <a href="product.html " >Majestic Beecroft Sweater For Him</a> 
	   <p class="mr-0">Qty : 1</p>
  <p class="mr-0">vendor : H&M</p>
 </div>
   <p class="col-3"> $2100.00 </p>
</div>
<hr>
<p > Subtotal:<b class="float-right main-color">$2100.00</b></p>

<hr>
<p > discount:<b class="float-right main-color">$100.00</b></p>
<hr>

<p >Shipping:<b class="float-right main-color">Free Shipping</b></p> <hr>
<p >ORDER TOTAL: <b class="float-right main-color">$2000.00</b></p> <hr>
<div class="form-check">
<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
<label class="form-check-label" for="exampleRadios1">
Cash on delivery 
<br>(Pay with cash upon delivery.
)

</label>
</div>
<br>
<div class="form-check">
<input class="form-check-input mt-3" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
<label class="form-check-label" for="exampleRadios2">
<img src="img/cash.png" class="w-100">  </label>
</div>
<hr><br>
<p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="policies.html" class="main-color">privacy policy.</a>

</p>   
<hr><br>                    
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
<label class="form-check-label" for="defaultCheck1">
I want to receive updates about products and promotions.
</label>
</div>

<br>                
<a  href="" class="btn w-100 bg-main ">place order</a>  <br><br>
<br></div>
</div></div><br><br></div>

 @stop