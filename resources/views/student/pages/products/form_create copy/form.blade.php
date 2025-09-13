@include('student.includes.createOption')

<form method="post" action="{{route('student.products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">



        @include('student.pages.products.form_create.top_section')

        @include('student.pages.products.form_create.price')

        @include('student.pages.products.form_create.checkboxes')

        @include('student.pages.products.form_create.attributes')

        @include('student.pages.products.form_create.kurly')
        @include('student.pages.products.form_create.statements')

        @include('student.pages.products.form_create.file_upload')

        @include('student.pages.products.form_create.description')

        @include('student.pages.products.form_create.categories')


    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add product')</button>
</form>
