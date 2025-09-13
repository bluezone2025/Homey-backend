 
  @extends('layouts.front')
@section('title', 'Contact')
@section('content')
 
<div class="container  border-main" ><br>
<div class="row  bg-w">

<div class="col-md-6 ">
<h2> contact us</h2>
<p>We are happy to receive your inquiries and suggestions.</p>
@if (Session::has('success-contact')) 
<div class="alert alert-info">{{ Session::get('success-contact') }}</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form  method="post" name="contact_form" class="" action="">
@csrf
<div class="form-group row">
<label class="col-sm-3 col-form-label">name</label>
<div class="col-sm-9">
<input type="text" name="name"  class="form-control-plaintext"   placeholder=" name" >
</div>
</div>
<div class="form-group row">
<label class="col-sm-3 col-form-label"> phone number</label>
<div class="col-sm-9">
<input type="tel" name="phone" class="form-control-plaintext"   placeholder="phone number" >
</div>
</div>
<div class="form-group row">
<label class="col-sm-3 col-form-label">email</label>
<div class="col-sm-9">
<input type="email" name="email"   class="form-control-plaintext"   placeholder="example@domain.com" >
</div>
</div>
<div class="form-group row">
<label class="col-sm-3 col-form-label">comment</label>
<div class="col-sm-9">
<textarea  rows="3" name="msg" class="form-control-plaintext"  ></textarea>
</div>
</div>
<div class="form-group row">
<label class="col-sm-3 col-form-label"></label>
<div class="col-sm-9">
<button class="btn btn-dark" type="submit" >send</button>
</div>
</div>

</form>
</div>





<br><br>
</div><br><br></div>
<div class="container  border-main" >
</div>
 @stop