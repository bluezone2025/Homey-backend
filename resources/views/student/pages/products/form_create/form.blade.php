@include('student.includes.createOption')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<form method="post" action="{{route('student.products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">



        @include('student.pages.products.form_create.checkboxes')
        @include('student.pages.products.form_create.top_section')

        @include('student.pages.products.form_create.colors_with_images')
        @include('student.pages.products.form_create.price')
        {{--@include('admin.pages.products.form_create.new_size')--}}



        @include('student.pages.products.form_create.kurly')
        @include('student.pages.products.form_create.statements')

        @include('student.pages.products.form_create.file_upload')

        @include('student.pages.products.form_create.description')

        @include('student.pages.products.form_create.categories')
        @include('student.pages.products.form_create.attributes')


    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add product')</button>
</form>
