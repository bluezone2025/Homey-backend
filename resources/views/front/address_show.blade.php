@extends('layouts.front')
@section('title','Address')
@lang("")
@section('content')
    <div class="container"  id="divid"> <br><br>
        <h1  class="col-12 text-center">Adresses</h1>
        <a href="{{route('address.create')}}" class="btn w-100 btn-dark bg-main mb-3">Add address </a><br><br>


        @if(  count($address) > 0)


            <div id="accordion" >
                @foreach($address as $key=> $one)

                    <div class="card mb-4">
                        <div class="card-header" style="" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Address  #{{$key +1}}
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <p class="font-weight-bold">Building number:&nbsp</p><span>{{$one->building_number}}</span>&nbsp <span>( {{$one->city}} )&nbsp</span> </div>
                                <div class="row">
                                    <p class="font-weight-bold">Plot: &nbsp </p>  <span>{{$one->plot}}&nbsp</span>
                                    <p class="font-weight-bold">,Street : </p> {{$one->street}} &nbsp<span>( {{$one->city}} )</span> </div>
                                <div class="row">
                                    {{$one->additionaltips}}
                                </div>
                                <a href="{{route('address.edit',$one->id)}}" class=" btn btn-primary align-items-lg-center">Edit </a>

                                <div class="row">

                                    <form method="post" action="{{route('address.destroy',$one->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mt-3">
                                            {{ __('Delete Address') }}
                                        </button>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        @elseif( count($address) == 0)
            <br><br><br><br>
            <h1 style="color: red ;text-align: center;">There are no Addresses</h1><br><br><br><br>



        @endif




    </div>



    </div>

@endsection
