@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('currencies.store')}}" method="post">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
@lang('site.add_currency')
            </h3>
            {{--            <button class="btn btn-light" >--}}
            {{--                <i class="fas fa-phone-alt"></i>--}}
            {{--                {{Auth::user()->phone}}--}}
            {{--            </button>--}}
        </div>

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
                <input value="{{ old('name') }}"  type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name">
            </div>

            <div class="form-group">
                <label for="rate">

                    @lang('site.rate')
                </label>
                <input value="{{ old('rate') }}"  type="number" step="0.01" name="rate"
                       class="form-control @error('rate') is-invalid @enderror" id="rate">
            </div>

            <div class="form-group">
                <label for="code">

                    @lang('site.code_en')
                </label>
                <input value="{{ old('code') }}"  type="text" name="code"
                       class="form-control @error('code') is-invalid @enderror" id="code">
            </div>
            <div class="form-group">
                <label for="code_ar">

                    @lang('site.code_ar')
                </label>
                <input value="{{ old('code_ar') }}"  type="text" name="code_ar"
                       class="form-control @error('code_ar') is-invalid @enderror" id="code_ar">
            </div>




        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>
        </div>
    </form>
@endsection
