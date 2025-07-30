@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')

    {{--{{dd($orders[0]->order_item[0]->id)}}--}}
    <!-----start  --->
    <!-- end header -->
    <div class="container-fluid pad-0 m-3">
        <h1 class="title text-center">@lang('site.notifications') </h1>
    </div>
    <!-----  ----->
    <div class="container-fluid">
        <br><br>
        <div class="row dir-rtl">
            <div class=" text-center border col-md-2 col-sm-4">
                <div class="img-cover m-2"><img src="{{asset('upload/avatar.png')}}"
                                                     alt="" class="w-100"></div>
                <h6 class="name">  {{Auth::user()->name}}</h6>
            </div>
            <div class="border col-sm-8 col-md-10 text-dir">
                <div class="row wellcome pad-top-25 p-4">
                    <div class="col-xs-12 col-sm-6 ">
                        <h4> @lang('site.hello') <span>
                                {{Auth::user()->name}}
                            </span></h4>
                        <p>
                            @lang('site.welcome')
                        </p>
                    </div>
                </div>

            </div>
            <br><br>
        </div>
    </div>

    <!-----  ----->

    <br><br>
    <div class="container-fluid pad-top-25">
        <div class="row  dir-rtl col-dir" style="display: flex">
            <div class="col-xs-3 col-3 col-md-2 left-menu row-dir" style="float:right">


                <a href="{{route('myaccount')}}" class="icon-container"><div class="">
                        <i class="fas fa-user"></i><br><span class="title-span">@lang('site.myaccount') </span></div></a>
                <a href="{{route('wishlist.view')}}" class="icon-container">
                    <div class=""><i class=" far fa-heart"></i><br><span class="title-span">@lang('site.wishlist')</span></div></a>
                <a href="{{route('myorder')}}" class="icon-container">
                    <div class="bg-b"><i class="fas fa-clock"></i><br><span class="title-span">@lang('site.myorder')</span></div></a>

                <a href="{{route('notifications')}}" class="icon-container">
                    <div class="bg-b"><i class="fas fa-bell"></i><br><span class="title-span">@lang('site.notifications')</span></div></a>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="icon-container">
                    <div><i class="fas fa-lock"></i><br><span class="title-span">log out</span></div>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


            </div>
            <div class=" col-md-10">
                <div class="table_block table-responsive " >
                    <table class="table table-bordered">
                        <thead class="btn-dark">

                        <tr>
                            <th >@lang('site.title')</th>
                            <th >@lang('site.description')</th>
                            <th >@lang('site.model')</th>

                        </tr>
                        </thead>

                        {{--@if($orders->count() > 0)--}}
                        <tbody >

                        @foreach($notifications_m as $notification)

                            <tr >
                                <td>{{ $notification->{'title_'.app()->getLocale()}  }}</td>
                                <td>{{ $notification->{'body_'.app()->getLocale()}  }}</td>
                                <td>
                                    <?php
                                    if ($notification->type == "Order"){
                                        echo $notification->type_id;
                                    }
                                    elseif($notification->type == "Product"){
                                        echo '<a href="/product/'.$notification->type_id.'">LINK</a>';
                                    }
                                    ?>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--- end  --->

@endsection
