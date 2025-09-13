 @include('layouts.dashboard.header')

@include('layouts.dashboard.side')

  @yield('mo')
 @stack('content')

 <!-- Main Footer -->
 <footer class="main-footer" style="background: #000;color:#fff">
  <!-- To the right -->
  <div class="pull-right hidden-xs">
  bluezone
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2020 <a style="color: rgb(12, 34, 199)" href="#">Company</a>.</strong> All rights reserved.
</footer>


<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

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
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script src="{{ asset('front/js/firbase.js') }}"></script>
<script>
  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
  $('.js-example-basic-single').select2();
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
@stack('scripts')
@include('sweetalert::alert')
</body>
</html>
