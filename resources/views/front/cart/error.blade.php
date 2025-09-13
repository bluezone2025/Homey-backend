@extends('layouts.layout2')
@section('title', 'Payment Failed')

@section('content')
    <style>
        .payment-fail-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .fail-icon {
            font-size: 60px;
            color: #dc3545; /* Bootstrap danger red */
        }
    </style>



    <div class="container payment-fail-container text-center">
        <div>
            <i class="fas fa-times-circle fail-icon mb-3"></i>
            <h2 class="text-danger">Payment Failed</h2>
            <p class="text-muted">Unfortunately, your payment could not be processed.</p>
            <a href="{{ url('/') }}" class="btn btn-outline-danger mt-3">Return to Home</a>
        </div>
    </div>
@stop
