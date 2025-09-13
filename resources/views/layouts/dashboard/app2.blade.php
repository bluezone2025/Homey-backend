
 @include('layouts.dashboard.header')

{{--TODO :: EDITED--}}

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> {{ request()->user()->name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> @lang('site.online')</a>
            </div>
          </div>



          <!-- Sidebar Menu -->
          <ul class="sidebar-menu pad-0">  <!-- Optionally, you can add icons to the links -->
            <li  class="moha" ><a style="" href="{{route("dashboard.index")}}"><i class="fa fa-home"></i> <span> @lang('site.dashboard')</span></a></li>


              @if(Auth::user()->job_id == 1)


              <li  class="moha" ><a style="" href="{{route("categories.index")}}"><i class="fa fa-list"></i> <span> @lang('site.vendors') </span></a></li>

			     <li  class="moha" ><a style="" href="{{route("subCategories.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.categories')  </span></a></li>

			    <li  class="moha" ><a style="" href="{{route("subSubCategories.index")}}"><i class="fa fa-list"></i> <span> 
			    @lang('site.sub_cat')
			    </span></a></li>

              @endif

			    <li  class="moha" ><a style="" href="{{route("items.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.old_products') </span></a></li>
                  <li  class="moha" ><a style="" href="{{route("products.index")}}"><i class="fa fa-list"></i> <span> @lang('site.products') </span></a></li>


 <li  class="moha" ><a style="" href="{{route("orders.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.orders') </span></a></li>





              @if(Auth::user()->job_id == 1)



                  <li  class="moha" ><a style="" href="{{route("sliders.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.slider') </span></a></li>
                  <li  class="moha" ><a style="" href="{{route("brands.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.brands') </span></a></li>

                  <li  class="moha" ><a style="" href="{{route("governs.index")}}"><i class="fa fa-list"></i> <span> @lang('site.governments') </span></a></li>
			    <li  class="moha" ><a style="" href="{{route("countries.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.countries') </span></a></li>
			    <li  class="moha" ><a style="" href="{{route("settings.index")}}"><i class="fa fa-list"></i> <span>  @lang('site.settings') </span></a></li>
 <li  class="moha" ><a style="" href="{{route("users.index")}}"><i class="fa fa-users"> </i><span>@lang('site.managers') </span></a></li>
            <li  class="moha" ><a style="" href="{{route("roles.index")}}"><i class="fa fa-list"></i> <span>
@lang('site.manager_roles')
              </span></a></li>
            <li  class="moha" ><a style="" href="{{route("profile.index")}}"><i class="fa fa-user"></i> <span>@lang('site.profile') </span></a></li>
           <li  class="moha" ><a style="" href="{{route("slashes.index")}}"><i class="fa fa-list"></i> <span>
               @lang('site.ads')
            </span></a></li>
			    <li  class="moha" ><a style="" href="{{route("store.index")}}"><i class="fa fa-list"></i> <span> 
			    @lang('site.sales')
			    </span></a></li>
                  <li  class="moha" ><a style="" href="{{route("clients.index")}}"><i class="fa fa-list"></i> <span> 
                  @lang('site.users')
                  </span></a></li>
                  <li  class="moha" ><a style="" href="{{route("pages.index")}}"><i class="fa fa-list"></i> <span> 
                  
                  @lang('site.pages')
                  </span></a></li>

			  <li  class="moha" ><a style="" href="{{route("items.storeg")}}"><i class="fa fa-list"></i> <span> 
			  
			  @lang('site.finished')
			  </span></a></li>

@endif

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              @yield('ti')

          </h1>

        </section>

        <!-- Main content -->
        <section class="content">

  @yield('mo')


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
         KOCART
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020 <a href="#">blueZone</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

   <!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

{{--icheck--}}
<script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

{{--<!-- FastClick -->--}}
<script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

{{--<!-- AdminLTE App -->--}}
<script src="{{ asset('dashboard_files/js/adminlte.min.js') }}"></script>

{{--ckeditor standard--}}
<script src="{{ asset('dashboard_files/plugins/ckeditor/ckeditor.js') }}"></script>

{{--jquery number--}}
<script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>

{{--print this--}}
<script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
{{--morris --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('dashboard_files/plugins/morris/morris.min.js') }}"></script>

{{--custom js--}}
<script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>
<script src="{{ asset('dashboard_files/js/custom/order.js') }}"></script>
<script src="{{ asset('dashboard_files/js/select2.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('dashboard_files/plugins/chartjs/Chart.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('dashboard_files/plugins/fastclick/fastclick.min.js') }}"></script>
 <!-- FLOT CHARTS -->
 <script src="{{ asset('dashboard_files/plugins/flot/jquery.flot.min.js') }}"></script>
 <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
 <script src="{{ asset('dashboard_files/plugins/flot/jquery.flot.resize.min.js') }}"></script>
 <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
 <script src="{{ asset('dashboard_files/plugins/flot/jquery.flot.pie.min.js') }}"></script>
 <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
 <script src="{{ asset('dashboard_files/plugins/flot/jquery.flot.categories.min.js') }}"></script>
	  <script src="{{ asset('dashboard_files/js/ajax.js') }}"></script>

 <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script src="{{ asset('front/js/firbase.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

	 <script src=" {{ asset('dashboard_files/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }} "></script>


<script>

    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();

});
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

    $(document).ready(function () {

        $('.sidebar-menu').tree();

        //icheck
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //delete
        $('.delete').click(function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

        // // image preview
        // $(".image").change(function () {
        //
        //     if (this.files && this.files[0]) {
        //         var reader = new FileReader();
        //
        //         reader.onload = function (e) {
        //             $('.image-preview').attr('src', e.target.result);
        //         }
        //
        //         reader.readAsDataURL(this.files[0]);
        //     }
        //
        // });

        CKEDITOR.config.language =  "{{ app()->getLocale() }}";

    });//end of ready

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
	 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@stack('scripts')
@include('sweetalert::alert')
</body>
</html>
