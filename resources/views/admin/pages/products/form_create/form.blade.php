

@include('admin.includes.createOption')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<form method="post" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">


        @include('admin.pages.products.form_create.checkboxes')
        @include('admin.pages.products.form_create.top_section')
        @include('admin.pages.products.form_create.colors_with_images')

        @include('admin.pages.products.form_create.price')

        
        {{--@include('admin.pages.products.form_create.new_size')--}}

        @include('admin.pages.products.form_create.kurly')
        @include('admin.pages.products.form_create.statements')

        @include('admin.pages.products.form_create.file_upload')

        @include('admin.pages.products.form_create.description')

        @include('admin.pages.products.form_create.categories')
        @include('admin.pages.products.form_create.attributes')



    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add product')</button>
</form>
