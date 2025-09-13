@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>الطلاب</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.student.index')}}">الطلاب</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>سلة المحذوفات</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        'اضافة مستخدم جديد' => route('admin.student.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"           => 'id',
        "name"         => 'الاسم',
        "email"        => 'البريد',
        "phone"        => 'رقم الهاتف',
        "updated_at"   => "اخر تعديل",
        "created_at"   => "تاريخ الاضافة",
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'name', 'email', 'phone', 'date', 'university' , 'major' , 'limit_products'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'password':'d-none'},
            btn    :  {

                'edit'         : '{{route('admin.student.update' , '')}}'+'/{id}',
                @if(!$is_trash)
                'delete'       : '{{route('admin.student.destroy' , '')}}'+'/{id}',
                @else
                'restore'      : '{{route('admin.student.restore' , '')}}'+'/{id}',
                'delete'       : '{{route('admin.student.finalDelete' , '')}}'+'/{id}',
                @endif
                'print'        : '#',

            }
        })
    </script>
@endsection
