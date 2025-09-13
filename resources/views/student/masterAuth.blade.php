<!DOCTYPE html >
<html lang="{{app()->getLocale()}}" dir="ltr" style="direction: ltr">

<head>

    <!-- ///// meta ///// -->
    @include('student.includes.meta')

    <title>Davinshi</title>


    <!-- ///// style css ///// -->
    @include('student.includes.styleAuth')

    <style>
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


@include('student.includes.script')

<script src="{{asset('assets/js/authentication/form-2.js')}}"></script>

</html>
