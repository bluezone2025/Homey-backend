<!DOCTYPE html >
<html lang="{{app()->getLocale()}}" dir="ltr" style="direction: ltr">

<head>

    <!-- ///// meta ///// -->
    @include('admin.includes.meta')

    <title>Trendat</title>

    <!-- ///// style css ///// -->
    @include('admin.includes.styleAuth')

    <style>
    .header-container {
    direction: ltr;
    z-index: 1030;
    border-bottom: 1px solid #0eafdaa3;
}
    .navbar {
    padding: 0;
    background: #700202  !important;
}
.spinner-grow {
    color: #c52228 !important;
}
.header-container .navbar {
    background: #0780b4c4 !important;
}
        label{
            display: block;
            text-align: left;
        }
    </style>

</head>

    <body class="rtl form">
         <div class="main-wrapper">

             <!-- ****** start page ****** -->
             <div class="page-wrapper">


                 <!-- start content -->
                 <div class="page-content">

                     @yield('content')

                 </div>
                 <!-- end content -->

             </div>
         <!-- ****** end page ****** -->
         </div>
    </body>


@include('admin.includes.script')

<script src="{{asset('assets/js/authentication/form-2.js')}}"></script>

</html>
