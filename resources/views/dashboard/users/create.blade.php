@extends('dashboard.layouts.app')
    @section('page_title')  @lang('site.new_user')  @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('users.store')}}" method="post">
        @csrf


        <div class="card-body">

            <div class="form-group">
                <label for="name">

          @lang('site.client_name')

                </label>
                <input value="{{ old('name') }}"  type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name">
            </div>
            <div class="form-group">
                <label for="email">
                    @lang('site.email')
                </label>
                <input value="{{ old('email') }}"  type="text" name="email"
                       class="form-control @error('email') is-invalid @enderror" id="email">
            </div>


            <div class="form-group">
                <label for="phone"
{{--                       class="col-md-4 col-form-label text-md-right"--}}
                >
                    @lang('site.phone')
                    [ يرجي إدخال رقم الهاتف بدون كود الدوله ]


                </label>


                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="name" autofocus>

            </div>

            <div class="form-group ">
                <label for="country">
                    @lang('site.country')

                </label>


                    <select class="form-control @error('country') is-invalid @enderror"  name="country" id="country">
                        @foreach(\App\Country::all() as $c)

                            <option value="{{$c->id}}">
                                {{$c->name_ar}}  -  {{$c->name_en}}
                            </option>

                        @endforeach
                    </select>

            </div>


            <div class="form-group">
                <label for="password">
                    @lang('site.password')
                </label>
                <input value="{{ old('password') }}"  type="text" name="password"
                       class="form-control @error('password') is-invalid @enderror" id="password">
            </div>

        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>

    </form>
@endsection
