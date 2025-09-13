<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        App.init();

        let arrayUrl = location.pathname.split('/');

        let linkNow = arrayUrl[2];
        console.log(linkNow)
        if (linkNow !== 'trash' && linkNow !== 'sort'){


            $('#toggle-'+linkNow).attr('data-active' , 'true').click()
            $('#'+linkNow + ' #li-'+arrayUrl[arrayUrl.length-1]).addClass('active')

        }else {

            let linkNow = arrayUrl[3];

            $('#toggle-'+linkNow).attr('data-active' , 'true').click()
            $('#'+linkNow + ' #li-'+arrayUrl[2]).addClass('active')

        }
    });

    $(function (){

        $('#load_screen').hide()

    })
</script>




@yield('js')
