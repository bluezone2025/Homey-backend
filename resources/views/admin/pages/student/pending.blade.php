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

    @include('admin.includes.modalBtnAction'  , ['big' => true])

    {!! myDataTable_button() !!}



    {!! myDataTable_table([
        "id"             => 'id',
        "name"           => 'الاسم',
        "email"          => 'البريد',
        "phone"          => 'رقم الهاتف',
        "updated_at"     => "تاريخ الميلاد",
        "university"     => "الجامعه",
        "major"          => "المستوي",
        "limit_products" => "عدد المنتجات",
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
            name   :  ['id', 'name', 'email', 'phone', 'date', 'university' , 'major' , 'limit_products'],
            // class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'password':'d-none'},
            btn    :  {

                'edit'   : '{{route('admin.student.update' , '')}}'+'/{id}',
                'accept' : ['{{route('admin.student.accept' , '')}}'+'/{id}' , 'موافقة'],
                'reject' : ['{{route('admin.student.reject' , '')}}'+'/{id}' , 'حذف' , 'btn-danger'],
            }
        })

        $('body').on('click', '.reject , .accept' , function(e){

            e.preventDefault();

            $comnfirmd = $(this).hasClass('reject') ? window.confirm('سوف يتم حذف المستخدم بشكل نهائي') : true

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
