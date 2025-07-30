@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('sizes.update.size',$size->id)}}" method="post">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
@lang('site.edit_size'){{$size->name}}
            </h3>
        </div>

        <div class="card-body">

            <div class="form-group">
                <label for="name">

                    @lang('site.size_name')

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
