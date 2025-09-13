 @extends('layouts.layout2')
 @section('title', " terms")
 @section('content')

     <section class="sec-title1">
         <div class="container">
             <div class="col-md-8 d-flex">
                 <span><a href="{{ route('home') }}">@lang('site.index')</a></span>


                 <span class="mx-2"><b>/</b></span>
                 <b><span>{{ __('site.'.$pages->first()->type) }}</span></b>
             </div>
         </div>
     </section>


     <section class="check-out-form pb-lg-3 pb-11 privacy mt-5">
         <div class="container">
             <h2 class="text-center mt-8">  {{ __('site.'.$pages->first()->type)}}</h2>

             <div class="row">

                 <div class="col-lg-12 m-auto order-lg-first form-control-01 py-3">

                     @foreach($pages as $page)
                         <div class="row">
                             {!! app()->getLocale()=='ar'? $page->description_ar : $page->description_en !!}
                         </div>
                     @endforeach


                 </div>
             </div>

         </div>
     </section>

 @stop
