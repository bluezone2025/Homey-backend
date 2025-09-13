@extends('admin.master')

@section('content')

    @include('admin.pages.dashboard.counter')
{{--
    @include('admin.pages.dashboard.graph')--}}

    <hr>
    @include('admin.pages.dashboard.tables')


@endsection

@section('css')
    <style>
        .container {
            margin-top: 100px
        }

        .counter-box {
            display: block;
            background: #f6f6f6;
            padding: 40px 20px 37px;
            text-align: center
        }

        .counter-box p {
            margin: 5px 0 0;
            padding: 0;
            color: #909090 !important;
            font-size: 18px;
            font-weight: 500
        }


        .counter-box i {
            font-size: 60px;
            margin: 0 0 15px;
            color: #d2d2d2
        }

        .counter {
            display: block;
            font-size: 32px;
            font-weight: 700;
            color: #666;
            line-height: 28px
        }

        .counter-box.colored {
            background: #1274cb;
            margin: 5px
        }

        .counter-box.colored p,
        .counter-box.colored i,
        .counter-box.colored .counter {
            color: #fff
        }
    </style>
@endsection


@section('js')

    <script src="{{asset('assets/plugins/apex/apexcharts.min.js')}}"></script>
    <script>

        $(document).ready(function() {

            $('.counter').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });

        var d_2options2 = {
            chart: {
                id: 'sparkline1',
                group: 'sparklines',
                type: 'area',
                height: 280,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'منتج',
                data:  @json($orders)
            }],
            labels:  @json($orders),
            yaxis: {
                min: 0
            },
            grid: {
                padding: {
                    top: 125,
                    right: 0,
                    bottom: 36,
                    left: 0
                },
            },
            fill: {
                type:"gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .40,
                    opacityTo: .05,
                    stops: [45, 100]
                }
            },
            tooltip: {
                x: {
                    show: false,
                },
                theme: 'dark'
            },
            colors: ['#fff']
        }

        var d_2C_2 = new ApexCharts(document.querySelector("#total-products"), d_2options2);
        d_2C_2.render();

    </script>
    <script src="{{asset('assets/js/dashboard/dash_1.js')}}"></script>
@endsection
