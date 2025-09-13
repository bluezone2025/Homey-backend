@extends('admin.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>

    </style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.wallets.index')}}">@lang('layout.wallets')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add wallet')</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('admin.wallets.store') }}" method="POST">
                                @csrf


                                <!-- User Selection (Multiple) -->
                                <div class="form-group">
                                    <label for="user_id">@lang('layout.select_users')</label>
                                    <select multiple id="user_id" name="user_id[]" class="form-control form-control-alternative select2" >
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->id .' ' . $user->name . '  ' . $user->phone }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hidden Wallet Type -->
                                <input type="hidden" name="wallet_type" value="deposit">

                                <!-- Title as Reason of Deposit -->
                                <div class="form-group">
                                    <label for="title">@lang('layout.reason_for_deposit')</label>
                                    <input type="text" name="title" id="title" class="form-control" maxlength="255" required>
                                </div>

                                <!-- Title as Reason of Deposit -->
                                <div class="form-group">
                                    <label for="amount">@lang('layout.amount')</label>
                                    <input type="text" name="amount" id="amount" class="form-control" maxlength="255" required>
                                </div>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">@lang('layout.submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

@endsection