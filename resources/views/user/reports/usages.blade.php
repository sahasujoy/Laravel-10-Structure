@extends('user.layouts.userContentLayoutMaster')

@section('title', 'Usage Overview')


@section('content')
    <!-- account setting page -->
    <section id="page-account-settings">
        <!-- Goal Overview Card -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Web App Usage Overview</h4>

                        <i type="button" class="font-medium-3 text-muted cursor-pointer waves-effect" data-toggle="tooltip"
                           data-placement="bottom" title="" data-original-title="Web App usage overview, Limit vs usages report daily wise">
                            <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                        </i>
                    </div>
                    <div class="card-body p-0">
                        <div id="goal-overview-radial-bar-chart-daily" class="my-2"></div>
                        <div class="row border-top text-center mx-0">
                            <div class="col-6 border-right py-1">
                                <p class="card-text text-muted mb-0">Limit</p>
                                <h3 class="font-weight-bolder mb-0 daily-limit">0</h3>
                            </div>
                            <div class="col-6 py-1">
                                <p class="card-text text-muted mb-0">Usages</p>
                                <h3 class="font-weight-bolder mb-0 daily-usages">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Notification Message Usage Overview(Monthly Basis)</h4>
                        <i type="button" class="font-medium-3 text-muted cursor-pointer waves-effect" data-toggle="tooltip"
                           data-placement="bottom" title="" data-original-title="Monthly usage overview, Limit vs usages report monthly wise">
                            <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                        </i>
                    </div>
                    <div class="card-body p-0">
                        <div id="goal-overview-radial-bar-chart-monthly" class="my-2"></div>
                        <div class="row border-top text-center mx-0">
                            <div class="col-6 border-right py-1">
                                <p class="card-text text-muted mb-0">Limit</p>
                                <h3 class="font-weight-bolder mb-0 monthly-limit">0</h3>
                            </div>
                            <div class="col-6 py-1">
                                <p class="card-text text-muted mb-0">Usages</p>
                                <h3 class="font-weight-bolder mb-0 monthly-usages">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Goal Overview Card -->
        </div>
    </section>
    <!-- / account setting page -->
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script>
        $(window).on('load', function () {
            'use strict';


            getDailyUsageLimitReportWithPercentageCallApi();

            function getDailyUsageLimitReportWithPercentageCallApi() {
                let total_limit = 0;
                let total_usage = 0;
                let percentage = 0;
                $.ajax({
                    type: 'GET',
                    url: route('daily-usages-report-data'),
                    success: function (data) {

                        console.log(data.data['total_limit'])
                        $('.daily-limit').html(data.data['total_limit']) ;
                        $('.daily-usages').html(data.data['total_usages']) ;
                        percentage = data.data['percentage'];
                        renderChartDailyUsageLimitReportWithPercentage(percentage);
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            }

            var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart-daily');
            var goalOverviewChartOptions;
            var goalOverviewChart;
            var $strokeColor = '#ebe9f1';
            var $textHeadingColor = '#5e5873';
            var $goalStrokeColor2 = '#51e5a8';
            //------------ Goal Overview Chart ------------
            //---------------------------------------------
            function renderChartDailyUsageLimitReportWithPercentage($percentage) {
                goalOverviewChartOptions = {
                    chart: {
                        height: 245,
                        type: 'radialBar',
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            blur: 3,
                            left: 1,
                            top: 1,
                            opacity: 0.1
                        }
                    },
                    colors: [$goalStrokeColor2],
                    plotOptions: {
                        radialBar: {
                            offsetY: -10,
                            startAngle: -150,
                            endAngle: 150,
                            hollow: {
                                size: '77%'
                            },
                            track: {
                                background: $strokeColor,
                                strokeWidth: '50%'
                            },
                            dataLabels: {
                                name: {
                                    show: false
                                },
                                value: {
                                    color: $textHeadingColor,
                                    fontSize: '2.86rem',
                                    fontWeight: '600'
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'horizontal',
                            shadeIntensity: 0.5,
                            gradientToColors: [window.colors.solid.success],
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    series: [$percentage],
                    stroke: {
                        lineCap: 'round'
                    },
                    grid: {
                        padding: {
                            bottom: 30
                        }
                    }
                };
                goalOverviewChart = new ApexCharts($goalOverviewChart, goalOverviewChartOptions);
                goalOverviewChart.render();
            }


            /// Monthly

            getMonthlyUsageLimitReportWithPercentageCallApi();

            function getMonthlyUsageLimitReportWithPercentageCallApi() {

                let percentage = 0;
                $.ajax({
                    type: 'GET',
                    url: route('monthly-usages-report-data'),
                    success: function (data) {

                        $('.monthly-limit').html(data.data['total_limit']) ;
                        $('.monthly-usages').html(data.data['total_usages']) ;
                        percentage = data.data['percentage'];
                        renderChartMonthlyUsageLimitReportWithPercentage(percentage);
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            }

            var $goalOverviewChartMonthly = document.querySelector('#goal-overview-radial-bar-chart-monthly');
            var goalOverviewChartOptionsMonthly;
            var goalOverviewChartMonthly;
            var $strokeColorMonthly = '#ebe9f1';
            var $textHeadingColorMonthly = '#5e5873';
            var $goalStrokeColor2Monthly = '#51e5a8';
            //------------ Goal Overview Chart ------------
            //---------------------------------------------
            function renderChartMonthlyUsageLimitReportWithPercentage($percentage) {
                goalOverviewChartOptionsMonthly = {
                    chart: {
                        height: 245,
                        type: 'radialBar',
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            blur: 3,
                            left: 1,
                            top: 1,
                            opacity: 0.1
                        }
                    },
                    colors: [$goalStrokeColor2Monthly],
                    plotOptions: {
                        radialBar: {
                            offsetY: -10,
                            startAngle: -150,
                            endAngle: 150,
                            hollow: {
                                size: '77%'
                            },
                            track: {
                                background: $strokeColorMonthly,
                                strokeWidth: '50%'
                            },
                            dataLabels: {
                                name: {
                                    show: false
                                },
                                value: {
                                    color: $textHeadingColorMonthly,
                                    fontSize: '2.86rem',
                                    fontWeight: '600'
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'horizontal',
                            shadeIntensity: 0.5,
                            gradientToColors: [window.colors.solid.success],
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    series: [$percentage],
                    stroke: {
                        lineCap: 'round'
                    },
                    grid: {
                        padding: {
                            bottom: 30
                        }
                    }
                };
                goalOverviewChartMonthly = new ApexCharts($goalOverviewChartMonthly, goalOverviewChartOptionsMonthly);
                goalOverviewChartMonthly.render();
            }

        })
    </script>
@endsection
