<div class="card-body">
    <form action="{{route('student.products.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <input type="file" name="file" class="form-control" required>
          </div>
          <div class="col-md-4">
            <button class="btn btn-success">@lang('layout.Import product Data') </button>
          </div>
        </div>
    </form>
</div>
