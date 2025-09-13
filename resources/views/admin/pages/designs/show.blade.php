@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.design.show','active')}}">@lang('layout.designs.title')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.show')</span></li>
@endsection

@section('content')

    <div class="container">
        <article class="card">
            <header class="card-header">@lang('layout.designs.details')</header>
            <div class="card-body">
                <h6></h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>@lang('form.label.design_name'):</strong> <br>{{$design->design_name}}</div>
                        <div class="col"> <strong>@lang('form.label.user_name')</strong> <br> {{$design->user_name}} </div>
                        <div class="col"> <strong>@lang('form.label.email'):</strong> <br> {{$design->email}} </div>

                        <div class="col"> <strong>@lang('form.label.phone'):</strong> <br> {{$design->phone}} </div>

                    </div>

                </article>

                @php($status = ['reject' => 0, 'accept' => 1])

                @if ($design->status === 'reject')
                    <div class="alert alert-danger mt-5"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">@lang('aliases.status.reject')</span> </div>


                @else
                <div class="alert alert-success mt-5"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">@lang('aliases.status.accept')</span> </div>


                @endif


                <hr>
                <ul class="row">

                    @foreach($design->images as $img)
                        <li class="col-md-4">
                            <figure class="itemside mb-3">
                                <div class="aside">
                                  <img src="{{asset($img->src)}}" class="img-sm border"></div>
                                <figcaption class="info align-self-center">

                                </figcaption>
                            </figure>

                        </li>
                    @endforeach

                </ul>
            </div>
        </article>

        <article class="card">

            <div class="card-body row">
                <div class="col"> <strong>@lang('form.label.note'):</strong> <br>{{$design->note}}</div>

            </div>

        </article>
    </div>


@endsection

@section('css')

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        body {
            background-color: #eeeeee;
            font-family: 'Open Sans', serif
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }
        .alert.alert-success.mt-5 {
            margin: 0 !important;
        }
        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>

@endsection

@section('js')


@endsection
