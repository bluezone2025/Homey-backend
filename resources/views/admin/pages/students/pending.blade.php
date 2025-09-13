@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.student.index')}}">@lang('layout.students')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.pending')</span></li>
@endsection

@section('content')

    @include('admin.includes.modalBtnAction'  , ['big' => true])

    {!! myDataTable_button() !!}



    {!! myDataTable_table([
        "id"             => 'id',
        "name"           => __('form.label.name'),
        "img"            => __('form.label.img'),
        "email"          => __('form.label.email'),
        "phone"          => __('form.label.phone'),
        "date"           => __('form.label.date'),
        "university"     => __('form.label.university'),
        "university_id"  => __('form.label.university id'),
        "major"          => __('form.label.major'),
        "limit_products" => __('form.label.count products'),
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
            name   :  ['id', 'name', 'img', 'email', 'phone', 'date', 'university', 'university_id', 'major' , 'limit_products'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit',},
            file   : {'img':'{{asset('assets/images/student/{img}')}}'},
            btn    :  {

                'edit'   : '{{route('admin.student.update' , '')}}'+'/{id}',
                'accept' : ['{{route('admin.student.accept' , '')}}'+'/{id}' , '@lang('form.label.accept')', ''],
                'reject' : ['{{route('admin.student.reject' , '')}}'+'/{id}' , '@lang('form.label.delete')' , 'btn-danger'],
            }
        })

        $('body').on('click', '.reject , .accept' , function(e){

            e.preventDefault();

            $comnfirmd = $(this).hasClass('reject') ? window.confirm('@lang('form.label.confirm delete student')') : true

            if ($comnfirmd){

                $(this).parents('tr').hide(500);

                $.ajax({

                    url: $(this).attr('href'),
                    method: 'post',
                })
            }

        })

    </script>
@endsection
