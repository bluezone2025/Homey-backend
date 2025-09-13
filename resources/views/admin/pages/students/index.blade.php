@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.students')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.student.index')}}">@lang('layout.students')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction'  , ['big' => true])
    @include('admin.pages.students.points')

    {!! myDataTable_button([
        __('layout.add student') => route('admin.student.create'),
      ]) !!}


    {!! myDataTable_table([
        "id"             => 'id',
        "row_no"             => __('form.label.row_no'),
        "name_ar"           => __('form.label.title_ar'),
        "name_en"           => __('form.label.title_en'),
        "email"          => __('form.label.email'),
        "phone"          => __('form.label.phone'),
        "trendat_percentage"          => __('form.label.trendat_percentage'),
        "student_percentage"          => __('form.label.student_percentage'),
        "total_orders"          => __('form.label.total_orders'),
        "total_products"          => __('form.label.total_paid_products'),
        "trendat_percentage_calc"          => __('form.label.trendat_percentage_cacl'),
        "student_percentage_calc"          => __('form.label.student_percentage_cacl'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>


        colLg = 6

        myDataTableColumns({
            name   :  ['id','row_no', 'name_ar','name_en', /*'img',*/ 'email', 'phone','trendat_percentage','student_percentage','total_orders','total_products','trendat_percentage_calc','student_percentage_calc'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit',},
            btn    :  {

        {{--
                @can('role' , 'student.update')
                'edit': '{{route('admin.student.update' , '')}}'+'/{id}',
                @endcan--}}

                @if(!$is_trash)

                    @can('role' , 'student.destroy')
                    'delete': '{{route('admin.student.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'student.restore')
                    'restore': '{{route('admin.student.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'student.finalDelete')
                    'delete': '{{route('admin.student.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif
                'edit2': ['/admin/student/'+'{id}/edit' , '@lang('form.label.update')' , 'btn-primary'],
                'orders': ['{{route('admin.student.orders' , '')}}'+'/{id}' , '@lang('form.label.show orders')' , 'btn-primary'],




                'print': '#',

            }
        })


        $('body').on('click', '.points' , function(e){

            e.preventDefault();

            $('#fadeinModal').modal('show')

            $('input#points').val($(this).parents('tr').find('.td_points').text())

            $('#update_points').attr('href', $(this).attr('href'))

        })

        $('body').on('click', '#update_points' , function(e){

            e.preventDefault();

            $('#fadeinModal').modal('hide')

            let points = $('input#points').val();

            $.ajax({
                url: $(this).attr('href'),
                method: 'post',
                data:{points},
            })

            $('.reload-dataTable').click()
        })
    </script>
@endsection
