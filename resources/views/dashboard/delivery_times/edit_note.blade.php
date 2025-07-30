@extends('dashboard.layouts.app')
@section('page_title') @lang('site.edit_note') @endsection

@section('style')
    <style>
        .input {
            border: 5px solid black;
        }
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
    <form class="card col-md-12 col-12" style="margin: auto" action="{{ route('delivery_times.update.note', $delivery_time->id) }}"
        method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body text-right">

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
                    <div class="form-group col-12">
                        <label for="name">

                            @lang('site.note')
                        </label>
                        <textarea name="note" class="form-control @error('note') is-invalid @enderror"
                                  id="description_ar">{{$delivery_time->note}}</textarea>
                    </div>
                </div>


                <input type="hidden" value="{{ $delivery_time->id }}" name="id">

        </div>

        <button type="submit" class="btn btn-primary col-6 m-auto mb-5">
            @lang('site.edit')
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
        console.log($("#basic_cat_type").val());
        if ($("#basic_cat_type").val()==1) {
            console.log("value is 1");
            $('#size_guide_id1').hide();
            $('#size1').hide();
        }
        else{
            $('#size_guide_id1').show();
            $('#size1').show();
            $('#qut').hide();
        }


        $('#basic_category_id').on('change', function(e) {

            console.log(e);
            var cat_id = e.target.value;


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
                            $('#size1').hide()
                            $('#size_guide_id1').hide()
                            $('#qut').show()

                        }
                        else{
                            $('#size1').show()
                            $('#size_guide_id1').show()
                            $('#qut').hide()

                        }

                    } else {

                        if (result.cat_type == 1) {
                            $('#size1').hide()
                            $('#size_guide_id1').hide()
                            $('#qut').show()

                                                }
                        else{
                            $('#size1').show()
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
                        confirmButtonColor: '#212529',
                        position: 'bottom-start',
                        showCloseButton: true,
                    })
                }
            });


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
