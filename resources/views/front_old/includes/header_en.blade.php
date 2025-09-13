<script>

function get_country(id){
 idd = document.getElementById(id).value ;
  //alert(idd);
  $.ajax({
url: "{{url('set_session')}}",
data:'country='+ idd,
type: "GET",
success:function(data){
window.location = "{{url('/en')}}";
}

});

}
</script>

<div class=" container-fluid  d-lg-block d-none bg-light">
<header class=" container">
<div class="float-left ">
<a  class="  logo  " href="{{url('/')}}">
<img src="{{url('/public/img/logo2.png')}}">
</a>           
</div>


<ul class="nav  float-right pad-10" >
@if(!Auth::user())
<li class="nav-item link-login">  <a class="nav-link border-right "  href="{{url('/en/login')}}" > <i class="fas fa-unlock"></i> log in</a>	
<div class=" login">
@include('includes.en_sign-in'); 

</div>
</li>                    

<li class="nav-item">  <a class="nav-link  border-right"  href="{{url('/en/register')}}" > <i class="fas fa-key"></i> register</a>
</li>
@else
<li class="nav-item">  <a class="nav-link  border-right"  href="{{url('/en/wishlist')}}" > <i class="fas fa-heart"></i> wishlist</a>
</li>

<li class="nav-item">  <a class="nav-link  border-right"  href="{{ route('/en/profile') }}" > <i class="fas fa-heart"></i>  Welcome , {{ Auth::getUser()->name }}</a>
</li>

<li class="nav-item">  <a class="nav-link  border-right"  href="{{ route('logout') }}" > <i class="fas fa-heart"></i>  Logout </a>
</li>
@endif
<!--  <li class="nav-item"><a class="nav-link border-right " href="account.html">  <i class="fas fa-user-tie"></i>  My Account </a></li> -->
<li class="nav-item  li1" > 

@include('includes.header_cart')

</li>  

<li style="" class="nav-item relative link-login"><a class="nav-link border-right" href="#" >   
<img src="<?=(\Session::get('country') !== null)? Site::get_country_img(\Session::get('country')) : Site::get_country_img(\Session::get(1)) ?>" width="20"><?=(\Session::get('country') !== null)? Site::get_country_name(\Session::get('country')) : Site::get_country_name(\Session::get(1)) ?> 
<i class="fas fa-chevron-down "></i> </a>
<div class=" login  bg-w  text-left ">
 @foreach (Site::country() as $i=>$country)

<a class="nav-link " style="cursor: pointer;" onClick="get_country('{{$country->id}}');" > <img src="{{url('/public/uploads/')}}/{{ $country->image}}" width="20">  {{$country->name}} </a>
<input type="hidden" id="{{$country->id}}" value="{{$country->id}}" />
<hr class="mr-0">
 @endforeach
</div>

</li>


<li class="nav-item">  <a class="nav-link "  href="#" ><img src="{{url('/public/img/k.svg')}}"  width="30px">  العربية</a>
</li>
</ul> 
<div style="clear: both"></div>
</header>
</div>
<header class=" container-fluid d-lg-block d-none bg-b " >
<div class=" container  ">
<div class="row">
<ul class="nav  col-9" >
<li class="nav-item ">  <a class="nav-link  "  href="{{url('/')}}" > Home       </a>
</li>
<li class="nav-item li1">  
<a class="nav-link  "  href="#" > categories     <i class="fas fa-angle-down"></i>   </a>
<div class=" li2 pad-0">
<ul class="navbar-nav  w-100 pad-0" >
 

 @foreach (Site::category() as $i=>$category)
 @php
 $sub_categories = \App\Category:: where('parent_id' , $category->id)-> get();
 @endphp
<li class="nav-item  pad-10  {{(count($sub_categories))?'li3  relative':''}}"> 
<a class="nav-link  "  href="{{url('/en/category/'.$category->slug)}}" > <i class="fas fa-female"></i> 
{{$category->name}}
@if(count($sub_categories) > 0)
<i class="fas fa-angle-down"></i>
@endif
</a>
@if(count($sub_categories) > 0)
<div class=" li4 pad-0">
<ul class="navbar-nav  w-100 pad-0" >
 @foreach ($sub_categories as $i => $sub_category)
<li class="nav-item  pad-10"> 
<a class="nav-link  "  href="{{url('/en/category/'.$sub_category->slug)}}" > <i class="fas fa-female"></i>{{$sub_category->name}}</a>
</li>
@endforeach
</ul> 
</div>
@endif


</li>
  @endforeach
</ul> 
</div>
</li>

<li class="nav-item "> 
<a class="nav-link  "  href="{{url('/en/terms')}}" > terms and condition</a>
</li>
<li class="nav-item "> 
<a class="nav-link  "  href="{{url('/en/policy')}}" > policies</a>
</li>

</ul> 
<ul class="nav  col-3 "  >
<li class="nav-item w-100 "> 
<form  class="mr-0 " action="{{url('/en/search')}}">	
<div class="input-group  ">
<input type="text" class="form-control " name="keyword" value="<?=(isset($_GET['keyword']))?$_GET['keyword']:''?>" placeholder="search" aria-label="search" aria-describedby="basic-addon2">
<div class="input-group-append">
<a class="btn btn-outline-secondary" href=""> <i class="fas fa-search" style="font-size: 20px"></i></a>
</div>
</div>

</form>

</li>

</ul>
</div>
</div></header>
<!-----md-nav ---> 
<header class=" container-fluid d-lg-none d-block ">

<a  class="  logo " href="{{url('/')}}">
<img src="{{url('/public/img/logo2.png')}}">
</a> 
<button class="navbar-toggler open float-right nav-item" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<a class="nav-link  "  > 
<i class="fas fa-align-justify" style="font-size: 25px"></i> </a>
</button>


</header>
<header class=" container-fluid d-lg-none d-block bg-b">
<form action="{{url('/en/search')}}"  class="mr-0 " >	
<div class="input-group ">
<input type="text" name="keyword" value="<?=(isset($_GET['keyword']))?$_GET['keyword']:''?>" class="form-control " placeholder="search" aria-label="search" aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-outline-secondary" > <i class="fas fa-search" style="font-size: 20px"></i></button>
</div>
</div>

</form>  
</header>
<!--- sidbar --->

<header class="sidbar col-md-6 col-sm-8 col-10">	
<div class="close hide text-right col-12"> 
<i class="fas fa-times "></i>
</div>
<div class="text-center">
<a href="{{url('/en/login')}}" class="btn bg-main">sign in</a> or
<a href="{{url('/en/register')}}" class="btn bg-main">sign up</a> 
</div>

<ul class="navbar-nav   pad-10" >

<li class="nav-item link-login border-bottom">  <a class="nav-link  "  href="" > <i class="fas fa-search" style="font-size: 20px"></i></a>	
<form  role="form" class=" search">
<input placeholder="search " class="w-100 " type="text">		 
</form>

</li>
<li class="nav-item  border-bottom">  <a class="nav-link   "  href="{{url('/en/cart')}}" >  <i class="fas fa-shopping-bag" style="font-size: 20px"></i>  cart</a>
</li>    

<li class="nav-item border-bottom"> 
<a class="nav-link  "  href="{{url('/en/wishlist')}}" >  wishlist</a>
</li>
<li class="nav-item border-bottom">
<a class="nav-link " href="{{ route('/en/profile') }}">   my account </a>
</li>
<li class="nav-item border-bottom"> 
<a class="nav-link  "  href="#" ><img src="{{url('/public/img/k.svg')}}"  width="30px">  عربي</a>
</li>
<li style="" class="nav-item relative link-login  border-bottom"><a class="nav-link " href="#" >   
<img src="<?=(\Session::get('country') !== null)? Site::get_country_img(\Session::get('country')) : Site::get_country_img(\Session::get(1)) ?>" width="20"> <?=(\Session::get('country') !== null)? Site::get_country_name(\Session::get('country')) : Site::get_country_name(\Session::get(1)) ?>
<i class="fas fa-chevron-down "></i> </a>
<div class=" login  bg-w  text-left ">

  @foreach (Site::country() as $i=>$country)
<a class="nav-link " style="cursor: pointer;" onClick="get_country('{{$country->id}}');"> <img src="{{url('/public/uploads/')}}/{{ $country->image}}" width="20">  {{$country->name}} </a>
<input type="hidden" id="{{$country->id}}" value="{{$country->id}}" />

<hr class="mr-0">
 
 @endforeach
</div>

</li>                  

@foreach (Site::category() as $i=>$category)
 @php
 $sub_categories = \App\Category:: where('parent_id' , $category->id)-> get();
 @endphp
<li class="nav-item dropdown border-bottom li1 ">
<a class="nav-link " href="{{url('/en/category/'.$category->slug)}}" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{$category->name}}

@if(count($sub_categories) > 0)
<i class="fas fa-chevron-down"></i>
@endif  
</a>
 @if(count($sub_categories) > 0)
<div class="dropdown-menu  " aria-labelledby="dropdownMenuButton">
<ul class="navbar-nav  pad-0" >
 @foreach ($sub_categories as $i => $sub_category)
<li class="nav-item   pad-10"> 
<a class="nav-link  "  href="{{url('/en/category/'.$sub_category->slug)}}" >{{$sub_category->name}}</a>
</li>
 @endforeach 
</ul> 
</div>
 @endif
</li>
 @endforeach
 <li class="nav-item  border-bottom"> 
<a class="nav-link  "  href="{{url('/en/terms')}}" >  terms and condition</a>
</li>
<li class="nav-item  border-bottom"> 
<a class="nav-link  "  href="{{url('/en/policies')}}" >  policies</a>
</li>     

</ul>
</header>
<!-----end nav ---> 