@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.wallets.index')}}">@lang('layout.wallets')</a></li>

@endsection

@section('content')

    <div class="d-flex justify-content-between mb-3" style="margin: 10px">
        <a href="{{ route('admin.wallets.create') }}" class="btn btn-primary">@lang('form.label.add wallet')</a>
        {{--<form action="{{ route('admin.wallets.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="@lang('form.label.search')" value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">@lang('form.label.search')</button>
        </form>--}}
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>@lang('form.label.id')</th>
                <th>@lang('form.label.user')</th>
                <th>@lang('form.label.deposit')</th>
                <th>@lang('form.label.withdraw')</th>
                <th>@lang('form.label.total')</th>
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
                    <td>{{ $wallet->name }}</td>
                    <td>{{ $wallet->wallets->first()->total_deposit }}</td>
                    <td>{{ $wallet->wallets->first()->total_withdraw }}</td>
                    <td>{{ $wallet->wallets->first()->total_deposit - $wallet->wallets->first()->total_withdraw }}</td>
                    <td><a href="{{route('admin.wallets.view', $wallet->id)}}"><i class="fa fa-eye"></i></a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">@lang('layout.no_records_found')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center" style="margin: 40px auto">
        {{ $wallets->links() }}
    </div>


@endsection
