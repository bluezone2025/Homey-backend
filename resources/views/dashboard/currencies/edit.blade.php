@extends('dashboard.layouts.app')
@section('page_title')   : @lang('site.edit_currency')

{{$currency->name}} @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('currencies.update.currency')}}" method="post">
        @csrf

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">

                    @lang('site.currency_name')

                </label>
                <input value="{{ $currency->name }}"  type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name">
            </div>

            <div class="form-group">
                <label for="name">

                    @lang('site.rate')

                </label>
                <input value="{{ $currency->rate }}"  type="text" name="rate"
                       class="form-control @error('rate') is-invalid @enderror" id="rate">
            </div>

            <div class="form-group">
                <label for="code">

                    @lang('site.code_en')

                </label>
                <input value="{{ $currency->code }}"  type="text" name="code"
                       class="form-control @error('code') is-invalid @enderror" id="code">
            </div>
            <div class="form-group">
                <label for="code_ar">

                    @lang('site.code_ar')
                </label>
                <input value="{{ $currency->code_ar }}"  type="text" name="code_ar"
                       class="form-control @error('code_ar') is-invalid @enderror" id="code_ar">
            </div>
            <input type="hidden" value="{{$currency->id}}" name="id">




        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>

    </form>
@endsection
