@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('heights.update.height',$size->id)}}" method="post">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
@lang('site.edit_height') : {{$size->name}}
            </h3>
        </div>

        <div class="card-body">

            <div class="form-group">
                <label for="name">

                    @lang('site.height')

                </label>
                <input value="{{ $size->name }}"  type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name">
            </div>



            <input type="hidden" value="{{$size->id}}" name="id">




        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>
        </div>
    </form>
@endsection
