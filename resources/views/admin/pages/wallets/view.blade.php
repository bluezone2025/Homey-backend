@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.wallets.index')}}">@lang('layout.wallets')</a></li>

@endsection

@section('content')


    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

    @include('admin.includes.alert_success')
    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>@lang('form.label.id')</th>
                <th>@lang('form.label.user')</th>
                <th>@lang('form.label.wallet_type')</th>
                <th>@lang('form.label.reason')</th>
                <th>@lang('form.label.amount')</th>
                <th>@lang('form.label.created_at')</th>
                <th>@lang('form.label.operation')</th>
                {{--<th>@lang('form.label.reason')</th>
                <th>@lang('form.label.amount')</th>
                <th>@lang('form.label.created_at')</th>--}}
            </tr>
            </thead>
            <tbody>
            @forelse($wallets as $key => $wallet)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $wallet->user->name }}</td>
                    <td>{{ $wallet->wallet_type }}</td>
                    <td>{{ $wallet->title }}</td>
                    <td>{{ $wallet->amount }}</td>
                    <td>{{ $wallet->created_at }}</td>
                    <td>
                        {{--@if($wallet->wallet_type == "deposit")--}}
                            <a href="{{route('admin.wallets.edit', $wallet->id)}}"><i class="fa fa-edit"></i></a>
                        {{--@endif--}}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">@lang('layout.no_records_found')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
