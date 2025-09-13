<form method="post" action="{{route('student.products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">

        @include('student.pages.products.form_attribute.attributes')

    </div>

</form>
