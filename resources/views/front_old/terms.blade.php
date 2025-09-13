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
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">  سياسة الخصوصية </li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="check-out-form pb-lg-3 pb-11 privacy">
            <div class="container">
                <h2 class="text-center mt-8">  سياسة الخصوصية </h2>

                <div class="row">

                    <div class="col-lg-12 m-auto order-lg-first form-control-01 py-5">

                        @foreach($pages_content as $page)

                            @if($page->name == "terms")




                                <li>
                                    <h5>
                                        {{$page->title_en}}
                                    </h5>
                                    <p>
                                        {{$page->content_en}}
                                    </p>
                                </li>




                            @endif

                        @endforeach


                    </div>
                </div>

            </div>
        </section>
    </main>
 
 @stop