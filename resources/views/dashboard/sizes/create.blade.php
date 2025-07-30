@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('sizes.store')}}" method="post">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
@lang('site.add_size')
            </h3>
            {{--            <button class="btn btn-light" >--}}
            {{--                <i class="fas fa-phone-alt"></i>--}}
            {{--                {{Auth::user()->phone}}--}}
            {{--            </button>--}}
        </div>

        <div class="card-body">

            <div class="form-group">
                <label for="name">

@lang('site.size_name')
                </label>
                <input value="{{ old('name') }}"  type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name">
            </div>







        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>
        </div>
    </form>
@endsection
