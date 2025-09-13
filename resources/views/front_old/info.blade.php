 @extends('layouts.layout')
 @section('title', " terms")
 @section('content')



     <main id="content">
         <!-- breadcrumb -->
         <section class="py-2 bg-gray-2">
             <div class="container">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                         <li class="breadcrumb-item"><a class="text-decoration-none text-body"
                                                        href="{{route('home')}}">الرئيسية</a>
                         </li>
                         <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">  {{ __('site.'.$pages->first()->type) }}</li>
                     </ol>
                 </nav>
             </div>
         </section>
         <section class="check-out-form pb-lg-3 pb-11 privacy">
             <div class="container">
                 <h2 class="text-center mt-8">  {{ __('site.'.$pages->first()->type)}}</h2>

                 <div class="row">

                     <div class="col-lg-12 m-auto order-lg-first form-control-01 py-5">

                         @foreach($pages as $page)
                             <div class="row">
                                 {!! app()->getLocale()=='ar'? $page->description_ar : $page->description_en !!}
                             </div>
                         @endforeach


                     </div>
                 </div>

             </div>
         </section>
     </main>

 @stop