@extends('dashboard.layouts.app')
@section('title')
{{ __('admin.permissions.perm_v')}}
@endsection
@section('content')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    {{--                <a class="btn btn-success mb-2" id="new-user" data-toggle="modal">New User</a>--}}
                    <a class="btn btn-success mb-2" href="{{route('admin.roles.create')}}">@lang('site.new_role')</a>
                </div>
            </div>
        </div>

        <div class="card-header pb-0">
            <h6>@lang('site.roles')</h6>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">

                <table
                        class="table align-items-center justify-content-center mb-0 data-table  text-secondary text-xs ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        <th style="width: 40%">@lang('site.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $index => $record)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->name}}</td>
                            {{-- @if(auth()->user()->can('تعديل الرتب') || auth()->user()->can('حذف الرتب')) --}}
                            <td style="width: 40%">
                                <form action="{{ route('admin.roles.destroy', $record->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{-- @can('تعديل الرتب') --}}
                                    <a href="{{ route('admin.roles.edit', $record->id) }}"
                                       class="btn btn-info"><i
                                                class="fa fa-pencil"></i> @lang('site.edit')</a>
                                    {{-- @endcan --}}
                                    {{-- @can('حذف الرتب') --}}
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                                class="fa fa-trash"></i> @lang('site.delete')</button>
                                    {{-- @endcan --}}
                                </form>
                            </td>
                            {{-- @endif --}}
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        {{-- @if(auth()->user()->can('تعديل الرتب') || auth()->user()->can('حذف الرتب')) --}}
                        <th style="width: 40%">@lang('site.acton')</th>
                        {{-- @endif --}}
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>



    </div>



@stop
