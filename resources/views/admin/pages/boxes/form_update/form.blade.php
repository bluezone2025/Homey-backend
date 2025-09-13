@include('admin.includes.createOption')
@include('admin.includes.alert_errors')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

<form method="post" action="{{route('admin.boxes.update'  , $box->id)}}" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-row mb-4">


        @include('admin.pages.boxes.form_update.top_section')

        @include('admin.pages.boxes.form_update.price')

        @include('admin.pages.boxes.form_update.file_upload')

        @include('admin.pages.boxes.form_update.description')



    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('form.label.update box')</button>
</form>
