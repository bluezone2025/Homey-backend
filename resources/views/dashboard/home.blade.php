@extends('dashboard.layouts.app')
@section('page_title')  @lang('site.home')  @endsection

@section('style')

    <script src="{{asset('js/app.js')}}" defer></script>
    <style>



       #exampleModal {
        top: 20%;
       }


        @media (min-width: 576px){
            #exampleModal {
                position: fixed;
                top: 15%;
                left: 15%;
            }
            #exampleModal {
                max-width: 600px;
                margin: 1.75rem auto;
            }
            #exampleModal .modal-dialog {
                max-width: 520px;
            }
        }

         @media (min-width: 800px){
            #exampleModal {
                position: fixed;
                top: 30%;
                left: 30%;
            }
             #exampleModal .modal-body.row {
                width: 515px !important;
            }
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid py-4">
        <!-- Modal -->



        <div class="row mt-2">
            @permission('manage-users')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="{{route('users.index')}}">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.num_users')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{App\User::where('country_id',$country_id)->count()}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            @endpermission


            @permission('manage-paid-orders')
            @php
              $orders1=App\Order::where('cash',1)
                                            ->where('country_id',$country_id)
                                            ->whereDate('created_at', \Carbon\Carbon::today());
             $orders2=App\Order::where('status','!=',0)->where('cash',0)->where('country_id',$country_id)
             ->whereDate('created_at', \Carbon\Carbon::today());

              $total_orders1=App\Order::where('cash',1)->where('country_id',$country_id)
                                            ->whereDate('created_at', \Carbon\Carbon::today())->sum('total_price');
             $total_orders2=App\Order::where('status','!=',0)->where('cash',0)->where('country_id',$country_id)
             ->whereDate('created_at', \Carbon\Carbon::today())->sum('total_price');

             $daliy_total_order=$total_orders1+$total_orders2;


            @endphp
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="{{route('todayorders')}}">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.today_orders')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{$orders1->count()+ $orders2->count()}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="{{route('todayorders')}}">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.Total requests today')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{$daliy_total_order}} @lang('site.kwd')
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @endpermission

            @permission('manage-paid-orders')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="#">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.month_orders')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php
                                            $today = \Carbon\Carbon::today();
                                            $currentMonth = $today->month;
                                            $currentYear = $today->year;

                                            $cashOrdersCount = App\Order::where('cash', 1)
                                                ->where('country_id',$country_id)
                                                ->whereMonth('created_at', $currentMonth)
                                                ->whereYear('created_at', $currentYear)
                                                ->count();

                                            $nonZeroStatusOrdersCount = App\Order::where('status', '!=', 0)
                                                ->where('cash', 0)
                                                ->where('country_id',$country_id)
                                                ->whereMonth('created_at', $currentMonth)
                                                ->whereYear('created_at', $currentYear)
                                                ->count();

                                            $totalCount = $cashOrdersCount + $nonZeroStatusOrdersCount;

                                            echo $totalCount;
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endpermission

            @permission('manage-paid-orders')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="#">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.year_orders')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php
                                            $today = \Carbon\Carbon::today();
                                            $currentYear = $today->year;

                                            $cashOrdersCount = App\Order::where('cash', 1)
                                                ->where('country_id',$country_id)
                                                ->whereYear('created_at', $currentYear)
                                                ->count();

                                            $nonZeroStatusOrdersCount = App\Order::where('status', '!=', 0)
                                                ->where('cash', 0)
                                                ->where('country_id',$country_id)
                                                ->whereYear('created_at', $currentYear)
                                                ->count();

                                            $totalCount = $cashOrdersCount + $nonZeroStatusOrdersCount;

                                            echo $totalCount;
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endpermission

            @permission('manage-paid-orders')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="#">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.today_money')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{
                                            App\Order::where('cash',1)->where('country_id',$country_id)
                                            ->whereDate('created_at', \Carbon\Carbon::today())->sum('total_price')
                                            + App\Order::where('status','!=',0)->where('country_id',$country_id)
                                            ->where('cash',0)->whereDate('created_at', \Carbon\Carbon::today())->sum('total_price')
                                            }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endpermission


            @permission('manage-paid-orders')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="#">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.month_money')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php
                                            $today = \Carbon\Carbon::today();
                                            $currentMonth = $today->month;
                                            $currentYear = $today->year;

                                            $cashOrdersCount = App\Order::where('cash', 1)
                                                ->where('country_id',$country_id)
                                                ->whereMonth('created_at', $currentMonth)
                                                ->whereYear('created_at', $currentYear)
                                                ->sum('total_price');

                                            $nonZeroStatusOrdersCount = App\Order::where('status', '!=', 0)
                                                ->where('country_id',$country_id)
                                                ->where('cash', 0)
                                                ->where('status', '!=',0)
                                                ->whereMonth('created_at', $currentMonth)
                                                ->whereYear('created_at', $currentYear)
                                                ->sum('total_price');

                                            $totalCount = $cashOrdersCount + $nonZeroStatusOrdersCount;

                                            echo $totalCount;
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endpermission

            @permission('manage-paid-orders')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin: 10px 0px">
                <a href="#">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.year_money')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php
                                            $today = \Carbon\Carbon::today();
                                            $currentMonth = $today->month;
                                            $currentYear = $today->year;

                                            $cashOrdersCount = App\Order::where('cash', 1)
                                                ->where('country_id',$country_id)
                                                ->whereYear('created_at', $currentYear)
                                                ->sum('total_price');

                                            $nonZeroStatusOrdersCount = App\Order::where('status', '!=', 0)
                                                ->where('country_id',$country_id)
                                                ->where('cash', 0)
                                                ->where('status', '!=',0)
                                                ->whereYear('created_at', $currentYear)
                                                ->sum('total_price');

                                            $totalCount = $cashOrdersCount + $nonZeroStatusOrdersCount;

                                            echo $totalCount;
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endpermission
        </div>

        {{--<div class="row mt-2">--}}

        {{--</div>--}}
    </div>
    @permission('manage-users')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                    <div class="card-body px-0 pt-0 pb-2">


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


{{--                        @if(Auth::user()->hasRole('admin'))--}}

{{--welcome admin--}}
{{--                        @else--}}
{{--                    welcome user--}}

                        {{--                        @endif--}}



                        <div class="pd-0">
                            <br>
                            <h6 style="text-align: center">
                                @lang('site.last_ten')
                            </h6>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0 data-table  text-secondary text-xs ">
                                <thead>
                                <tr>
                        <th>
                            @lang('site.username')
                        </th>
                        <th>
                            @lang('site.email')

                        </th>
                        <th>
                            @lang('site.password')

                        </th>
                                </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\User::where('job_id' , 0)->orderBy('id','DESC')->take(10)->get() as $u)

                            <tr>
                                <td>
                                    {{$u->name}}
                                </td>
                                <td>
                                    {{$u->email}}
                                </td>
                                <td>
                                    {{$u->password_view}}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
    </div>
</div>
    @endpermission

    @permission('manage-paid-orders')
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content p-3">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"  onclick="closeexampleModal()" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body row">
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                    <a href="{{route('orders.index')}}">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.num_orders')</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{App\Order::where('status','!=',0)->where('country_id',$country_id)->orWhere('cash',1)->count()}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                    <a href="{{route('orders.index')}}">

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('site.total_orders_p')</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{App\Order::where('status','!=',0)->where('country_id',$country_id)->orWhere('cash',1)->sum('total_price')}} @lang('site.kwd')
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
              </div>

            </div>
          </div>
        </div>
    @endpermission
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('#exampleModal').modal('show');
    });
    function closeexampleModal() {
         $('#exampleModal').modal('hide');
    }
</script>

@endsection
