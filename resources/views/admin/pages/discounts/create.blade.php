@extends('admin.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-dropdown{
            left: 265px !important;
        }
    </style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('layout.dashboard')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة خصومات</span></li>
@endsection

@section('content')

                    <div class="">


                        <div class="widget-content widget-content-area">
                            @include('admin.includes.alert_success')
                            <form action="{{ route('admin.discounts.store') }}" method="POST">
                                @csrf


                                <!-- User Selection (Multiple) -->
                                <div class="form-group">
                                    <label for="user_id">اختر </label>
                                    <select  id="student_id" name="student_id" class="form-control form-control-alternative select2" >
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->id .' ' . $student->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Title as Reason of Deposit -->
                                <div class="form-group">
                                    <label for="discount_percentage">نسبة الخصم</label>
                                    <input type="text" name="discount_percentage" id="discount_percentage" class="form-control" maxlength="100" required>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">@lang('layout.submit')</button>
                            </form>
                        </div>
                    </div>



                    <div class="table-responsive">
                        <table class="table table-bordered table-active table-striped">
                            <thead>
                            <tr>
                                <th>@lang('form.label.id')</th>
                                <th>@lang('site.brand')</th>
                                <th>نسبة الخصم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->discount_percentage?? 0 }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">@lang('layout.no_records_found')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

@endsection

@section('js')

    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

@endsection