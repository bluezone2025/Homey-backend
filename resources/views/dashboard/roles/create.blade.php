
@extends('dashboard.layouts.app')
<?php

$permissions = \App\Models\Permission::all();

?>
@section('content')
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"> {{__('site.new_role')}}</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">

    <form class="" style="margin: auto" action="{{route('admin.roles.store')}}" method="POST" enctype="multipart/form-data" role="form">
        {{csrf_field()}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput1"> @lang('site.name')</label>
                <input type="text" id="name"
                       class="form-control"
                       placeholder="  "
                       value="{{old('name')}}"
                       name="name">
                @error("name")
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        @if(count($permissions) != 0)
            {{--					<div class="form-group row">--}}
            {{--						<label for="permissions_list" class="col-xs-12 col-form-label">{{trans('admin.permissions_list')}}</label>--}}
            {{--						<div class="col-xs-10">--}}
            {{--							<select name="permissions_list[]" class='select2 js-states form-control' multiple required id="permissions_list">--}}
            {{--								@foreach($permissions as $permission)--}}
            {{--									<option  {{ in_array($permission,$permissions) ? 'selected' : '' }}  value="{{ $permission }}">{{ $permission }}</option>--}}
            {{--								@endforeach--}}
            {{--							</select>--}}
            {{--						</div>--}}
            {{--					</div>--}}
            <div class="form-group">
                <label for="name">الصلاحيات</label><br>
                <br>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>

                                    <input type="checkbox" name="permissions_list[]" value="{{$permission->name}}">
                                    {{__('site.'.$permission->display_name)}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="form-group">
                <label for="permissions_list">{{trans('site.permissions_list')}}</label>
                <div class="alert alert-danger"> {{trans('site.permissions_list_zero')}}</div>
            </div>
        @endif

        <div class="form-actions">

            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> @lang('site.save')
            </button>
        </div>
    </form>

                </div>
            </div>
        </div>
    </div>
@stop
