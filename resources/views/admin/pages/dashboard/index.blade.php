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
        text-align: center;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transform: translateY(0);
        transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1), 
                    box-shadow 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        margin-bottom: 0.5rem;
    }

    .counter-box:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }


    .counter-box p {
        margin: 5px 0 0;
        padding: 0;
        color: #909090 !important;
        font-size: 18px;
        font-weight: 500;
        
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

    .counter-box.color-1 { background: #007bff; }
    .counter-box.color-2 { background: #28a745; }
    .counter-box.color-3 { background: #fd7e14; }
    .counter-box.color-4 { background: #6f42c1; }
    .counter-box.color-5 { background: #dc3545; }
    .counter-box.color-6 { background: #17a2b8; }
    .counter-box.color-7 { background: #ffc107; }
    .counter-box.color-8 { background: #20c997; }

    /* ✅ ضبط ألوان الخط داخل كل كرت */
    .counter-box.color-1 i,
    .counter-box.color-1 p,
    .counter-box.color-1 span,
    .counter-box.color-1 .counter {
        color: #fff !important;
    }

    .counter-box.color-2 i,
    .counter-box.color-2 p,
    .counter-box.color-2 span,
    .counter-box.color-2 .counter {
        color: #fff !important;
    }

    .counter-box.color-3 i,
    .counter-box.color-3 p,
    .counter-box.color-3 span,
    .counter-box.color-3 .counter {
        color: #fff !important;
    }

    .counter-box.color-4 i,
    .counter-box.color-4 p,
    .counter-box.color-4 span,
    .counter-box.color-4 .counter {
        color: #fff !important;
    }

    .counter-box.color-5 i,
    .counter-box.color-5 p,
    .counter-box.color-5 span,
    .counter-box.color-5 .counter {
        color: #fff !important;
    }

    .counter-box.color-6 i,
    .counter-box.color-6 p,
    .counter-box.color-6 span,
    .counter-box.color-6 .counter {
        color: #fff !important;
    }

    .counter-box.color-7 i,
    .counter-box.color-7 p,
    .counter-box.color-7 span,
    .counter-box.color-7 .counter {
        color: #fff !important;
    }

    .counter-box.color-8 i,
    .counter-box.color-8 p,
    .counter-box.color-8 span,
    .counter-box.color-8 .counter {
        color: #fff !important;
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
