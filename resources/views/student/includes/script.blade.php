<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<script src="{{asset('assets/js/custom.js')}}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        App.init();

        let arrayUrl = location.pathname.split('/');

        linkNow = arrayUrl[arrayUrl.length - 1];

        console.log(linkNow)
        $('#toggle-'+linkNow).attr('data-active' , 'true')

    });

    $(function (){

        $('#load_screen').hide()

    })
</script>




@yield('js')
