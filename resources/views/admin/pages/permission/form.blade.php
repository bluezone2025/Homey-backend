<form action="{{route('admin.permission.update' , $role->id)}}" method="post">
    @csrf

    <table class="table table-hover">
        <thead>
        <tr>
            <th>@lang('form.label.name')</th>
            <th>@lang('form.label.status')</th>
        </tr>
        </thead>
        <tbody>
        @php($lastNameRole = '')

        @foreach($permissions as $permission)

            @php($permissionNow =  explode('.' ,  $permission->name))
            @if ($permissionNow[0] !== $lastNameRole)

                <tr>
                    <td class="title" colspan="2">@lang("roles.title.".preg_replace("/.index/" , '' , $permissionNow[0] ))</td>
                </tr>
            @endif
            <tr>
                <th>@lang("roles.names.".$permissionNow[1])</th>
                <td>
                    <div class="form-check">


                        <label class="switch  s-outline-danger mr-2">
                            <input  name="role_id[]" type="checkbox" value="{{$permission->id}}" {{in_array($permission->name , $permissionChecked) ? 'checked'  : ''}} class="form-check-input">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </td>
            </tr>
            @php($lastNameRole =  explode('.' , $permission->name)[0])
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-info mt-5 d-block m-auto w-100 font-weight-bold">@lang('form.label.edit permission')</button>
</form>
