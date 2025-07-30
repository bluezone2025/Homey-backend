@extends('dashboard.layouts.app')
@section('page_title')  @lang('site.add_admin') @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('admins.store')}}" method="post">
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

                    @lang('site.admin_name')

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
                <label for="phone">

                    @lang('site.phone')
                    [ يرجي إدخال رقم الهاتف بدون كود الدوله ]

                </label>
                <input value="{{ old('phone') }}"  type="text" name="phone"
                       class="form-control @error('phone') is-invalid @enderror" id="phone">
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

            <input value="1"  type="hidden" name="job_id">
            <div class="form-group">
                <label for="password">
                    @lang('site.password')
                </label>
                <input value="{{ old('password') }}"  type="text" name="password"
                       class="form-control @error('password') is-invalid @enderror" id="password">
            </div>

            <div class="form-group ">
                <label for="country">
                    @lang('site.roles')

                </label>


                <select class="form-control @error('role') is-invalid @enderror"  name="role" id="role">
                    @foreach(\Laratrust\Models\LaratrustRole::all() as $c)

                        <option value="{{$c->name}}">
                            {{$c->name}}
                        </option>

                    @endforeach
                </select>

            </div>

        </div>

        <button type="submit" class="btn btn-primary">
            @lang('site.save')

        </button>
    </form>
@endsection
