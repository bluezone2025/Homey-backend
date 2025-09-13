
@if(session('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<form method="post" action="{{route('admin.boxes.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">
        @include('admin.pages.boxes.form_create.checkboxes')
        @include('admin.pages.boxes.form_create.top_section')
        @include('admin.pages.boxes.form_create.price')
        @include('admin.pages.boxes.form_create.file_upload')
        @include('admin.pages.boxes.form_create.description')
    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add box')</button>
</form>
