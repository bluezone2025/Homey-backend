<div class="card-body">
    <form action="{{route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <select class="form-control" name="status" required>
                    <option value="created">@lang('layout.Create new products') </option>
                    <option value="updated">@lang('layout.Update Quantity') </option>
                </select>
            </div>

            <div class="col-md-4">
                <select class="form-control" name="student_id" >
                    <option value="">اختر المشهور / البراند</option>
                    @foreach(\App\Models\Student::orderBy('id','desc')->get() as $item)
                        <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success">@lang('layout.Import product Data') </button>
            </div>
        </div>
    </form>
</div>
