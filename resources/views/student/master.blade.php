<!DOCTYPE html >
<html lang="{{app()->getLocale()}}" dir="ltr">

<head>

    <!-- ///// meta ///// -->
    @include('student.includes.meta')

    <title>Trendat</title>
    <link rel="shortcut icon" href="{{asset('new_front/img/logo/logo.png')}}" />

    <!-- ///// style css ///// -->
    @include('student.includes.style')
   <style>
    .header-container  .navbar{
    background: var(--bs-primary-green) !important ;
}

.counter-box.colored {
    background: var(--bs-primary-color) !important;
}
span.align-self-center {
    color: white;
}
.sidebar-theme {
    background: #ffffffbf;
}
.bg-info {
    border-color: var(--bs-primary-green) !important;
    color: #fff;
    background: linear-gradient(var(--bs-primary-green) !important 5%,#00326f 100%);
}
#sidebar ul.menu-categories li.menu > .dropdown-toggle svg {
    color: var(--bs-primary-green) !important;
}
.spinner-grow {
    color: #c52228 !important;
}
    .custom-file-container__image-multi-preview {
        height: 200px;
        background-size: contain;
        background-position: center center;
        background-repeat: no-repeat;
    }

    </style>
</head>

    <body>

        @include('student.includes.load_screen')

        @include('student.layouts.navbar')

        @include('student.layouts.sub_navbar')


        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

         <!-- ///// start sidebar ///// -->
            @include('student.layouts.sidebar')
         <!-- ///// end sidebar ///// -->


         <!-- ****** start page ****** -->
            <div id="content" class="main-content">

                <div class="layout-px-spacing">

                    @yield('content')

                    @include('student.includes.footer')

                </div>
            </div>
         <!-- ****** end page ****** -->
         </div>
    </body>


@include('student.includes.script')


</html>
