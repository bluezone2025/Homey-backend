@extends('dashboard.layouts.app')
@section('page_title') @lang('site.add_notification')
@endsection
@section('style')
    <style>

        .form-check.li_without label {
            color: #212529 !important;
            font-weight: 900;
        }
        .form-check.li_without {
            width: 100%;
            text-align: left;
            margin: 0 30% !important;
        }
        @media (max-width: 700px){
            .form-check.li_without {

            margin: 5px !important;
        }
        }

    </style>

@endsection
@section('content')
    {{-- {{dd($sizes)}} --}}
    <form class="card col-md-12 col-12" style="margin: auto" action="{{ route('notifications.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <div class="card-body text-dir">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="d-flex flex-wrap">

                <div class="form-group col-6">
                    <label for="title_ar">
                        @lang('site.title_ar')

                    </label>
                    <input value="{{ old('title_ar') }}" type="text" name="title_ar"
                        class="form-control @error('title_ar') is-invalid @enderror" id="title_ar">
                </div>

                <div class="form-group col-6">
                    <label for="title_en">

                        @lang('site.title_en')

                    </label>
                    <input value="{{ old('title_en') }}" type="text" name="title_en"
                        class="form-control @error('title_en') is-invalid @enderror" id="title_en">
                </div>

                <div class="form-group col-12">
                    <label for="name">

                        @lang('site.body_ar')
                    </label>
                    <textarea name="body_ar" class="form-control @error('body_ar') is-invalid @enderror"
                        id="description_ar">{{ old('body_ar') }}</textarea>
                </div>



                <div class="form-group col-12">
                    <label for="name">

                        @lang('site.body_en')
                    </label>
                    <textarea name="body_en" class="form-control @error('body_en') is-invalid @enderror"
                        id="description_ar">{{ old('body_en') }}</textarea>

                </div>

                <div class="form-group col-3">
                    <label for="photo">

                        @lang('site.img')
                    </label>
                    <input type="file" name="img" class="form-control">
                </div>
            </div>



        </div>
        <button type="submit" class="btn btn-primary col-6 m-auto mb-5">
            @lang('site.save')
        </button>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">

        function validate(this_ch){
            if (this_ch.checked) {
               var val_is=parseInt($('#is_select_color').val())+1;
               $('#is_select_color').val(val_is);
            } else {
                 var val_is=parseInt($('#is_select_color').val())-1;
               $('#is_select_color').val(val_is);
            }
        }
        $('#basic_category_id').on('change', function(e) {

            console.log(e);
            var cat_id = e.target.value;
            var test= $('#test_id').attr('name')
            console.log('test ID is '+ test);



            $.get('/ajax-subcat?cat_id=' + cat_id, function(data) {
                $('#category_id').empty();
                $.each(data, function(index, subcatObj) {
                    $('#category_id').append('<option value="' + subcatObj.id + '">' + subcatObj
                        .name_en + ' - ' + subcatObj.name_ar + '</option>');
                })
            })


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('check.cat') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    cat_id: cat_id
                },
                success: function(result) {
                    // console.log(result);

                    if (!result.success) {
                        console.log('no');
                        if (result.cat_type == 1) {
                            $('#size_ul').hide()
                            $('#size_guide_id1').hide()
                            $('#qut').show()
                        }
                        else{
                            $('#size_ul').show()
                            $('#size_guide_id1').show()
                            $('#qut').hide()

                        }

                    } else {

                        if (result.cat_type == 1) {
                            $('#size_ul').hide()
                            $('#size_guide_id1').hide()
                            $('#qut').show()

                        }
                        else{
                            $('#size_ul').show()
                            $('#size_guide_id1').show()
                            $('#qut').hide()

                        }



                        // getDelivery();

                    }

                },
                error: function(error) {
                    Swal.fire({
                        title: 'لم تكتمل العمليه ',
                        icon: '?',
                        //confirmButtonColor: '#212529',
                        showConfirmButtonColor: false,
                        position: 'bottom-start',
                        showCloseButton: true,
                    })
                }
            });

        });


        $('#basic_category_id').on('change', function(e) {
            var cat_id = e.target.value;

    });




        // when page is ready
        $(document).ready(function() {
            // on form submit
            $("#form").on('submit', function() {
                // to each unchecked checkbox
                $(this + 'input[type=checkbox]:not(:checked)').each(function() {
                    // set value 0 and check it
                    $(this).attr('checked', true).val(0);
                });
            })


            $(function() {
                if ($('#has_offer').is(':checked')) {
                        $('#before_price').attr('disabled', false);
                    } else {
                        $('#before_price').attr('disabled', true);
                        $('#before_price').val("");

                    }
                $('#has_offer').on('click', function() {
                    if ($(this).is(':checked')) {
                        $('#before_price').attr('disabled', false);
                    } else {
                        $('#before_price').attr('disabled', true);
                        $('#before_price').val("");

                    }
                });

                $('#has_offer').on('click', function() {
                    // assuming the textarea is inside <div class="controls /">
                    if ($(this).is(':checked')) {
                        $('#before_price input:number, .controls textarea').attr('disabled', false);

                    } else {
                        $('#before_price input:number, .controls textarea').attr('disabled', true);
                        $('#before_price input:number, .controls textarea').val("");

                    }
                });
            });
        })
    </script>




@endsection
