@extends('layouts.front2')
@section('title', 'Cart')
@section('content')





 
<div class="container"  id="divid"> <br><br>           
<div class="row pad text-center ">
@if(session('success'))

<div class="alert alert-success text-center" style="width: 60%; margin-left: 15%;">
{{ session('success') }}
</div>

@endif

@if(session('error'))

<div class="alert alert-danger text-center" style="width: 60%; margin-left: 15%;">
{{ session('error') }}
</div>

@endif

@stop

 