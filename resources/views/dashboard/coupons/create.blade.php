@extends('dashboard.layouts.app')
@section('page_title')  Add Coupon  @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('coupons.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="code">

                    @lang('site.code')

                </label>
                <input value="{{ old('code') }}"  type="text" name="code"
                       class="form-control @error('code') is-invalid @enderror" id="code">
            </div>

            <div class="form-group">
                <label for="content_en">

                    @lang('site.percentage')

                </label>
                <input value="{{ old('percentage') }}"  type="number" name="percentage"
                       class="form-control @error('percentage') is-invalid @enderror" id="percentage">
            </div>







        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>

    </form>
@endsection
