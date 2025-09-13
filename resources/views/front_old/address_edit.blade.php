@extends('layouts.front')
@section('title','Address Edit')
@lang("")
@section('content')

    <form method="post" action="{{route('address.update',$address->id)}}">
        @csrf
        @method('put')

        <div class="sign w-50 text-center shadow pad-10">
            <br>
            <h1>Edit adress</h1>
            <div class="d-flex">

                <input placeholder="City" class="w-50 " type="text" name="city" value="{{ old('city',$address->city) }}">
                <input placeholder="Government" class="w-50 " type="text" name="gover" value="{{ old('gover',$address->gover) }}">


            </div>

            <div class="d-flex">
                <input placeholder="Plot" class="w-50 " type="number" name="plot" value="{{ old('plot',$address->plot) }}">
                <input placeholder="Street" class="w-50 " type="text" name="street" value="{{ old('street',$address->street) }}">
            </div>




            <div class="d-flex">

                <input placeholder="Building number" class="w-50 " type="text" name="building_number" value="{{ old('building_number',$address->building_number) }}">

                <input placeholder="Role" class="w-50 " type="number" name="role" value="{{ $address->role}}">
            </div>

            <textarea class="w-100 "name="additionaltips" rows="4" cols="50" >{{ old('additionaltips',$address->additionaltips) }}
            </textarea>



            <input placeholder="client_id" class="w-50 " type="hidden" name="client_id" value="{{Auth::guard('client')->user()->id}}">

            <button type="submit" class="btn w-100 btn-dark bg-main">Add address </button><br><br>

            <br>
        </div>
    </form>

    <br><br>



@endsection
