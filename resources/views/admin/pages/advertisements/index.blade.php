@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.advertisements.index')}}">شرائح اعلانية</a></li>

@endsection

@section('content')

    <div class="d-flex justify-content-between mb-3" style="margin: 10px">
        <a href="{{ route('admin.advertisements.create') }}" class="btn btn-primary">اضافة شريحة اعلانية</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>الرقم التسلسلي</th>
                <th>الصورة</th>
                <th>نوع الاعلان</th>
                <th>النوع</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($advertisements as $advertisement)
                <tr>
                    <td>{{ $advertisement->id }}</td>
                    <td><a download href="{{asset($advertisement->image)}}" ><img style="width: 150px;" src="{{asset($advertisement->image)}}"></a></td>
                    <td>{{ ucfirst(str_replace('_', ' ', $advertisement->advertisement_type)) }}</td>
                    <td>
                        @if ($advertisement->advertisement_type !== 'out_source')
                            {{ $advertisement->reference_id ? $advertisement->reference->name_ar : '-' }}
                        @else
                            <a href="{{ $advertisement->out_source_link }}">{{ $advertisement->out_source_link }}</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.advertisements.edit', $advertisement->id) }}"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0);" onclick="confirmDelete('{{ route('admin.advertisements.delete', $advertisement->id) }}')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">@lang('layout.no_records_found')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center" style="margin: 40px auto">
        {{ $advertisements->links() }}
    </div>


@endsection
@section('js')


    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                window.location.href = deleteUrl; // Redirect to the delete route
            }
        });
        }
    </script>
@endsection