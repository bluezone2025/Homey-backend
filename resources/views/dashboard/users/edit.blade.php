@extends('dashboard.layouts.app')
@section('page_title')  @lang('site.edit_user') :
{{$user->name}}  @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('users.update.user')}}" method="post">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="name">

                    @lang('site.client_name')


                </label>
                <input value="{{ $user->name }}"  type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name">
            </div>
            <input type="hidden" value="{{$user->id}}" name="id">
            <div class="form-group">
                <label for="email">

                    @lang('site.email')

                </label>
                <input value="{{ $user->email }}"  type="text" name="email"
                       class="form-control @error('email') is-invalid @enderror" id="email">
            </div>

            <div class="form-group">
                <label for="phone"
                    {{--                       class="col-md-4 col-form-label text-md-right"--}}
                >
                    @lang('site.phone')

                    [ يرجي إدخال رقم الهاتف بدون كود الدوله ]


                </label>


                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                       name="phone" value="{{ $user->phone}}" required autocomplete="name" autofocus>

            </div>

            <div class="form-group ">
                <label for="country">
                    @lang('site.country')

                </label>


                <select class="form-control @error('country') is-invalid @enderror"  name="country" id="country">
                    @foreach(\App\Country::all() as $c)


                        @if($user->country_id == $c->id)

                            <option value="{{$c->id}}" selected>
                                {{$c->name_ar}}  -  {{$c->name_en}}
                            </option>
                            @else
                        <option value="{{$c->id}}">
                            {{$c->name_ar}}  -  {{$c->name_en}}
                        </option>

                        @endif
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="password">
                    @lang('site.password')
                </label>
                <input value="{{ $user->password_view }}"  type="text" name="password"
                       class="form-control @error('password') is-invalid @enderror" id="password">
            </div>

        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>
    </form>
@endsection
