@extends('layouts.front')
@section('title','Client Address')
@lang("")
@section('content')

<form method="post" action="{{route('address.store')}}">
    @csrf
    <div class="sign w-50 text-center shadow pad-10">
        <br>
        <h1>Add adress</h1>
        <div class="d-flex">
            
        <input placeholder="City" class="w-50 " type="text" name="city">
        <input placeholder="Government" class="w-50 " type="text" name="gover">
        

        </div>
        
        <div class="d-flex">
        <input placeholder="Plot" class="w-50 " type="number" name="plot">
        <input placeholder="Street" class="w-50 " type="text" name="street">
        </div>
        
                

        
        <div class="d-flex">

        <input placeholder="Building number" class="w-50 " type="text" name="building_number">
        
        <input placeholder="Role" class="w-50 " type="number" name="role">
        </div>
        
        <textarea class="w-100 "name="additionaltips" rows="4" cols="50">Additional tips
            </textarea>

        
        
        <input placeholder="client_id" class="w-50 " type="hidden" name="client_id" value="{{Auth::guard('client')->user()->id}}">

        <button type="submit" class="btn w-100 btn-dark bg-main">Add address </button><br><br>

        <br>
    </div>
</form>

<br><br>



@endsection
