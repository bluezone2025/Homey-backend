@extends('admin.master')

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="row">

                    <div class="col-xl-12  col-md-12">

                        <div class="mail-box-container">
                            <div class="mail-overlay"></div>


                            <div id="mailbox-inbox" class="accordion mailbox-inbox">


                                @include('admin.pages.contact.btnAction')

                                @include('admin.pages.contact.messageBoxSingle')


                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </div>

    </div>

@endsection

@section('css')
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/editors/quill/quill.snow.css')}}">--}}
    <link href="{{asset('assets/css/apps/mailbox.css')}}" rel="stylesheet" type="text/css" />

{{--    <script src="{{asset('assets/plugins/sweetalerts/promise-polyfill.js')}}"></script>--}}
{{--    <link href="{{asset('assets/plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{asset('assets/plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{asset('assets/plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />--}}
@endsection

@section('js')
{{--    <script src="{{asset('assets/js/ie11fix/fn.fix-padStart.js')}}"></script>--}}
{{--    <script src="{{asset('assets/plugins/editors/quill/quill.js')}}"></script>--}}
    <script src="{{asset('assets/plugins/sweetalerts/sweetalert2.min.js')}}"></script>
{{--    <script src="{{asset('assets/plugins/notification/snackbar/snackbar.min.js')}}"></script>--}}
    <script src="{{asset('assets/js/apps/custom-mailbox.js')}}"></script>


<script>
    $(function (){

        $('.delete-message').on('click', function (e) {

            e.preventDefault();
            e.stopPropagation();
            $(this).parents('.mailInbox').hide(500)

            $.ajax({
                method:'delete',
                url:$(this).attr('href'),
            })
        })
    })
</script>
@endsection
