<html>
<head>
         <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="{{asset('front/css/css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
	        <link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
          <link rel="stylesheet" href="{{asset('front/css/main-style.css')}}">
            <link rel="stylesheet" href="{{asset('front/css/media.css')}}">
     <link rel="stylesheet" href="{{asset('front/css/carousel.css')}}">
     <title>@yield('title')</title>
</head>
<body >
<div class=" container-fluid  d-lg-block d-none bg-light">
<header class=" container">
<div class="float-left ">
<a  class="  logo  " href="{{route('home')}}">
<img src="{{asset('front/img/logo2.png')}}">
</a>
</div>


<ul class="nav  float-right pad-10" >
<li class="nav-item link-login">  <a class="nav-link border-right "  href="{{route('login/client')}}" > <i class="fas fa-unlock"></i> log in</a>
    <div class=" login">
<form  role="form">
<div class="form-group">
<div class="arrow">
<i class="fas fa-sort-up"></i></div>
<input placeholder="email " class="w-100 " type="email">
<input placeholder="password " class="w-100" minlength="6" type="password">
<button type="submit" class="btn w-100 btn-dark bg-main">login </button>
<a href="#" class="" data-toggle="modal" data-target="#login">forget password?</a><br><br>
<p>do not have account yet <a href="{{route('register/client')}}" class="main-color">creat one</a></p>
</div>
</form>
</div>
</li>
<li class="nav-item">  <a class="nav-link  border-right"  href="{{route('wishlist.products.index')}}" > <i class="fas fa-heart"></i> wishlist</a>
</li>
<li class="nav-item">  <a class="nav-link  border-right"  href="{{route("register/client")}}" > <i class="fas fa-key"></i> register</a>
</li>
  <!--  <li class="nav-item"><a class="nav-link border-right " href="account.html">  <i class="fas fa-user-tie"></i>  My Account </a></li> -->
    <li class="nav-item  li1" >
@include('front.includes.header_cart')

    </li>

    <li class="nav-item relative link-login"><a class="nav-link border-right" href="{{route('home')}}" >
        <img src="{{asset('front/img/k.svg')}}" width="20"> Kuwait
        <i class="fas fa-chevron-down "></i> </a>
             <div class=" login  bg-w  text-left ">
            <a class="nav-link " href="{{route('home')}}"> <img src="{{asset('front/img/k.svg')}}" width="20">  Kuwait </a>
                 <hr class="mr-0">
            <a class="nav-link " href="#"> <img src="{{asset('front/img/k.svg')}}" width="20">  Kuwait </a>

                 </div>

                 </li>


<li class="nav-item">  <a class="nav-link "  href="#" ><img src="{{asset('front/img/k.svg')}}"  width="30px">  العربية</a>
</li>
</ul>
<div style="clear: both"></div>
</header></div>
<header class=" container-fluid d-lg-block d-none bg-b " >
<div class=" container  ">
    <div class="row">
    <ul class="nav  col-9" >
                <li class="nav-item ">  <a class="nav-link  "  href="{{route('home')}}" > Home       </a>
        </li>
        <li class="nav-item li1">  <a class="nav-link  "  href="#" > category     <i class="fas fa-angle-down"></i>   </a>
    <div class=" li2 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
       <li class="nav-item li3 pad-10 relative">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i>  fashion   <i class="fas fa-angle-down"></i>  </a>
                      <div class=" li4 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  pad-10 li5">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> men  <i class="fas fa-angle-down"></i>  </a>
                         <div class=" li6 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  pad-10 li7">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> clothes</a>
                                      <div class=" li8 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
       <li class="nav-item  bg-b pad-10">
                        <a class="nav-link  c-w"  >vendor</a>
                    </li>
                    <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <img src="{{asset('front/img/h&m.png')}}" width="20px"> H&M</a>
                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <img src="{{asset('front/img/zara.png')}}" width="20px"> zaraa</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <img src="{{asset('front/img/max.png')}}" width="20px"> max</a>
                    </li>

                    </ul>
</div>

                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub  sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i> sub sub  category</a>
                    </li>
                    </ul>
</div>


                    </li>
                  <li class="nav-item  pad-10 li5">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i>  women  <i class="fas fa-angle-down"></i>  </a>
                         <div class=" li6 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                     <li class="nav-item  pad-10 li7">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> clothes</a>
                                      <div class=" li8 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  bg-b pad-10">
                        <a class="nav-link  c-w"  >vendor</a>
                    </li>
                    <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <img src="{{asset('front/img/h&m.png')}}" width="20px"> H&M</a>
                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <img src="{{asset('front/img/zara.png')}}" width="20px"> zaraa</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <img src="{{asset('front/img/max.png')}}" width="20px"> max</a>
                    </li>

                    </ul>
</div>

                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub  sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub sub  category</a>
                    </li>
                    </ul>
</div>


                    </li>

       <li class="nav-item  pad-10 li5">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i>  shoes  <i class="fas fa-angle-down"></i>  </a>
                         <div class=" li6 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i>  sub sub category</a>
                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" >  <i class="fas fa-female"></i>  sub sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i>  sub  sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" >  <i class="fas fa-female"></i>  sub sub  category</a>
                    </li>
                    </ul>
</div>


                    </li>

       <li class="nav-item  pad-10 li5">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i>  kides  <i class="fas fa-angle-down"></i>  </a>
                         <div class=" li6 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" >  <i class="fas fa-female"></i> sub sub category</a>
                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i> sub sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i>  sub  sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i>  sub sub  category</a>
                    </li>
                    </ul>
</div>


                    </li>

                    </ul>
</div>


                    </li>

       <li class="nav-item li3 pad-10 relative">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i>  beauty   <i class="fas fa-angle-down"></i>  </a>
                      <div class=" li4 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  pad-10 li5">
                        <a class="nav-link  "  href="" > <i class="fas fa-female"></i> sub category   <i class="fas fa-angle-down"></i>  </a>
                         <div class=" li6 pad-0">
 <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i> sub sub category</a>
                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub  sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub sub  category</a>
                    </li>
                    </ul>
</div>


                    </li>
                   <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i> sub category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> sub category</a>
                    </li>
                    </ul>
</div>


                    </li>

                    <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" ><i class="fas fa-female"></i>  music</a>
                    </li>

      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> category</a>
                    </li>
      <li class="nav-item  pad-10">
                        <a class="nav-link  "  href="#" > <i class="fas fa-female"></i> category</a>
                    </li>
                    </ul>
</div>
</li>

      <li class="nav-item ">
        <a class="nav-link  "  href="#" > terms and condition</a>
    </li>
         <li class="nav-item ">
        <a class="nav-link  "  href="#" > policies</a>
    </li>

  </ul>
    <ul class="nav  col-3 "  >
               <li class="nav-item w-100 ">
    <form  class="mr-0 " >
   <div class="input-group  ">
  <input type="text" class="form-control " placeholder="search" aria-label="search" aria-describedby="basic-addon2">
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

    <a  class="  logo " href="{{route('home')}}">
<img src="{{asset('front/img/logo2.png')}}">
</a>
      <button class="navbar-toggler open float-right nav-item" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <a class="nav-link  "  >
              <i class="fas fa-align-justify" style="font-size: 25px"></i> </a>
        </button>


    </header>
    <header class=" container-fluid d-lg-none d-block bg-b">
          <form  class="mr-0 " >
   <div class="input-group ">
  <input type="text" class="form-control " placeholder="search" aria-label="search" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <a class="btn btn-outline-secondary" href=""> <i class="fas fa-search" style="font-size: 20px"></i></a>
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
                  <a href="{{route("login/client")}}" class="btn bg-main">sign in</a> or
                    <a href="{{route("register/client")}}" class="btn bg-main">sign up</a>
                   </div>

                      <ul class="navbar-nav   pad-10" >

               <li class="nav-item link-login border-bottom">  <a class="nav-link  "  href="" > <i class="fas fa-search" style="font-size: 20px"></i></a>
    <form  role="form" class=" search">
    <input placeholder="search " class="w-100 " type="text">
    </form>

    </li>
    <li class="nav-item  border-bottom">
          <a class="nav-link   "  href="{{route('cart.show')}}" >  <i class="fas fa-shopping-bag" style="font-size: 20px"></i>  cart</a>
    </li>

 <li class="nav-item border-bottom">
     <a class="nav-link  "  href="{{route('wishlist.products.index')}}" >  wishlist</a>
</li>
  <li class="nav-item border-bottom">
      <a class="nav-link " href="#">   my account </a></li>
   <li class="nav-item border-bottom">
        <a class="nav-link  "  href="#" ><img src="{{asset('front/img/k.svg')}}"  width="30px">  عربي</a>
    </li>
                           <li class="nav-item relative link-login  border-bottom"><a class="nav-link " href="{{route('home')}}" >
        <img src="{{asset('front/img/k.svg')}}" width="20"> Kuwait
        <i class="fas fa-chevron-down "></i> </a>
             <div class=" login  bg-w  text-left ">
            <a class="nav-link " href="{{route('home')}}"> <img src="{{asset('front/img/k.svg')}}" width="20">  Kuwait </a>
                 <hr class="mr-0">
            <a class="nav-link " href="#"> <img src="{{asset('front/img/k.svg')}}" width="20">  Kuwait </a>

                 </div>

                 </li>
                           <li class="nav-item dropdown border-bottom li1 ">
                                    <a class="nav-link " href="" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      category
                                  <i class="fas fa-chevron-down "></i>    </a>
                                    <div class="dropdown-menu  " aria-labelledby="dropdownMenuButton">
                                       <ul class="navbar-nav  pad-0" >
                   <li class="nav-item   pad-10">
                        <a class="nav-link  "  href="#" >sub category</a>
                    </li>
      <li class="nav-item ">
                        <a class="nav-link  pad-10 "  href="#" >sub category</a>
                    </li>
      <li class="nav-item  ">
                        <a class="nav-link   pad-10"  href="#" >sub category</a>
                    </li>
                    </ul>
                                    </div>
                                </li>

                  <li class="nav-item dropdown border-bottom li1 ">
                                    <a class="nav-link " href="" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      category
                                  <i class="fas fa-chevron-down "></i>    </a>
                                    <div class="dropdown-menu  " aria-labelledby="dropdownMenuButton">
                                       <ul class="navbar-nav  pad-0" >
                   <li class="nav-item   pad-10">
                        <a class="nav-link  "  href="#" >sub category</a>
                    </li>
      <li class="nav-item ">
                        <a class="nav-link  pad-10 "  href="#" >sub category</a>
                    </li>
      <li class="nav-item  ">
                        <a class="nav-link   pad-10"  href="#" >sub category</a>
                    </li>
                    </ul>
                                    </div>
                                </li>

                                    <li class="nav-item dropdown border-bottom li1 ">
                                    <a class="nav-link " href="" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      category
                                  <i class="fas fa-chevron-down "></i>    </a>
                                    <div class="dropdown-menu  " aria-labelledby="dropdownMenuButton">
                                       <ul class="navbar-nav  pad-0" >
                   <li class="nav-item   pad-10">
                        <a class="nav-link  "  href="#" >sub category</a>
                    </li>
      <li class="nav-item ">
                        <a class="nav-link  pad-10 "  href="#" >sub category</a>
                    </li>
      <li class="nav-item  ">
                        <a class="nav-link   pad-10"  href="#" >sub category</a>
                    </li>
                    </ul>
                                    </div>
                                </li>

      <li class="nav-item  border-bottom">
        <a class="nav-link  "  href="#" >  terms and condition</a>
    </li>
       <li class="nav-item  border-bottom">
        <a class="nav-link  "  href="#" >  policies</a>
    </li>

    </ul>
    </header>
      <!-----end nav --->


           @yield('content')

   <!-----start footer --->
    <footer class="container-fluid  border-top">
           <div class="container">  <br>
        <div class="row ">
              <div class="col-lg-4 col-sm-12 col-12 text-center">
                 <a href="{{route('home')}}"> <img src="{{asset('front/img/logo.png')}}" width="200"></a>
            </div>
          <div class="col-lg-4 col-sm-6 col-12">
          <h5>Company Information</h5>
              <ul class="navbar-nav  w-100" >
                    <li class="nav-item border-bottom ">
                        <a class="nav-link  "  href="#" >  About us</a>
                    </li>
                    <li class="nav-item   border-bottom">
                        <a class="nav-link  "  href="#" > contact us</a>
                    </li>
                   <li class="nav-item border-bottom ">
                        <a class="nav-link  "  href="#" > Terms and conditions</a>
                    </li>
                    <li class="nav-item   border-bottom">
                        <a class="nav-link  "  href="#" >Delivery Terms</a>
                    </li>
                    </ul>
             <br> <br></div>
     <div class="col-lg-4 col-sm-6 col-12">
         <h5>Contact us</h5>
              <ul class="navbar-nav  w-100" >
                    <li class="nav-item  border-bottom">
                        <a class="nav-link  "  href="tel:96555566788" >  Call: +965 22263400</a>
                    </li>
                    <li class="nav-item  border-bottom">
                        <a class="nav-link  "  href="" >  Email: s@gmail.com</a>
                    </li>
                    </ul>
                    <h5><br>Follow us on</h5>
            <a  href="#" class="mr-10"> <i class="fab fa-instagram" style="font-size: 25px;"></i> </a>
             <a  href="#" class="mr-10"> <i class="fab fa-snapchat-ghost" style="font-size: 25px;"></i> </a>
                    <a  href="#" class="mr-10"> <i class="fab fa-whatsapp" style="font-size: 25px;"></i> </a>
             <a  href="#" class="mr-10"> <i class="fab fa-facebook-f" style="font-size: 25px;"></i> </a>
           <br> <br> </div>
               </div></div></footer>
    <div class="container-fluid bg-b ">
                 <div class="row ">
                <p class="col-12"><br>All rights reserved to kocart 2020 Designed and developed by <a href="" class="main-color">blueZone</a></p>
        </div></div>
      <!-- country -->


        <!-- Modal -->
<div class="modal fade " id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content  text-center">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle">forget password </h5>
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="text" placeholder="Enter a phone number or email" class="pad-0 w-100">
            <br><br>
            <p>Enter a phone number or email <br>
You will receive a message to set the password </p>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark"  data-toggle="modal" data-target="#password"   data-dismiss="modal">send</button>
      </div>
    </div>
  </div>
</div>
    <!-- Modal -->
<div class="modal fade " id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle">change password</h5>
        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
               <div class="form-group row">
                <label class="col-sm-4 col-form-label">The new password
</label>
                <div class="col-sm-8">
                 <input type="password" placeholder="" class=" pad-0 mr-10">
                 </div></div>
             <div class="form-group row">
                <label class="col-sm-4 col-form-label">Repeat the password
</label>
                <div class="col-sm-8">
                 <input type="password" placeholder="" class=" pad-0 mr-10">
                 </div></div>
             </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">send</button>
      </div>
    </div>
  </div>
</div>



    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('front/js/popper.min.js')}}"></script>
        <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
          <script src="{{asset('front/js/all.min.js')}}"></script>
        <script src="{{asset('front/js/wow.min.js')}}"></script>
     <script>
              new WOW().init();
              </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="{{asset('front/js/scripts.js')}}"></script>
    <script src="{{asset('front/js/main-js.js')}}"></script>
    @stack('content')
    @include('sweetalert::alert')
</body>

</html>










