@extends('layouts.web.main', ['pageSlug' => '現在の研鑽状況'])
@push('styles')
    <link href="{{ asset('assets') }}/css/cdnjs.cloudflare.com_ajax_libs_toastr.js_latest_toastr.min.css" rel="stylesheet" />
    <style>
        #toast-container>div{
            padding: 60px 150px 60px 150px!important;
        }
        #toast-container>.toast-info{
            background-image: unset!important;
        }
    </style>
@endpush
@section('content')
    {{ Breadcrumbs::render('cls') }}
    <div class="container">
        <div class="head-chart flex-between">
            <div class="side-left">
                <select>
                    <option>2023年度</option>
                </select>
                <span>の研鑽状況</span>
            </div>
            <div class="side-right">
                <button class="decline-btn show-scoring-board">研鑽スコア</button>
            </div>
        </div>
        <div class="row" style="height: 500px; width:100%;margin: 0 auto;">
            <canvas id="myChart1" style="width: 100%;"></canvas>
        </div>

        <div class="head-chart flex-between">
            <div class="side-left">
                <select>
                    <option>2027年度</option>
                </select>
                <span>認定期限までの研鑽状況</span>
            </div>
            <div class="side-right">
                <button class="decline-btn"><a href="{{ route('creditRegistration') }}">単位登録</a></button>
            </div>
        </div>
        <div class="row" style="height: 500px; width:100%;margin: 0 auto;display: flex;align-items: center">
            <canvas id="myChart2"></canvas>
            <div class="flags">
                <div class="blue-flag">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/blue-flag.png') }}">
                </div>
                <div class="yellow-flag">
                    <img width="40" src="{{ asset('assets/images/icon/yellow-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/yellow-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/yellow-flag.png') }}">

                </div>
                <div class="green-flag">
                    <img width="40" src="{{ asset('assets/images/icon/green-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/green-flag.png') }}">
                    <img width="40" src="{{ asset('assets/images/icon/green-flag.png') }}">
                </div>
            </div>
        </div>

        <div class="head-chart flex-between">

        </div>
        <div class="row" style="height: 500px; width:100%;margin: 0 auto;display: flex;align-items: center">
            <canvas id="myChart3"></canvas>
            <div>
                <h2>現在 <span style="color:#FF0000">300</span>単位</h2>
                <div class="flags-goal">
                    <div class="blue-flag">
                        <img width="40" src="{{ asset('assets/images/icon/goal-blue-flag.png') }}">
                    </div>
                    <div class="yellow-flag">
                        <img width="40" src="{{ asset('assets/images/icon/goal-yellow-flag.png') }}">
                    </div>
                    <div class="green-flag">
                        <img width="40" src="{{ asset('assets/images/icon/goal-green-flag.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.popup_show_scoring_board')
@endsection
@push('js')
    <script src="{{ asset('assets') }}/js-lib/cdn.jsdelivr.net_npm_chart.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="{{asset('assets/js-lib/toastr.min.js')}}"></script>
    <script>
        const ctx1 = document.getElementById('myChart1');
        const ctx2 = document.getElementById('myChart2');
        const ctx3 = document.getElementById('myChart3');
        const labels = ['SV','研修・学会等','社会的活動'];
        const labels3 = ['合計'];
        const data3 = {
            labels: labels3,
            datasets: [
                {
                    axis: 'y',
                    label: 'SV',
                    data: [15],
                    backgroundColor: '#006AC7',
                    stack: 'Stack 0',
                    font: {
                        weight: 'bold',
                        size: 16,
                    },
                    categoryPercentage: 0.5,
                    barPercentage: 0.5,
                },
                {
                    axis: 'y',
                    label: '研修・学会等',
                    data: [10],
                    backgroundColor: '#FFBA00',
                    stack: 'Stack 0',
                    font: {
                        weight: 'bold',
                        size: 16,
                    },
                    categoryPercentage: 0.5,
                    barPercentage: 0.5,
                },
                {
                    axis: 'y',
                    label: '社会的活動',
                    data: [75],
                    backgroundColor: '#009A51',
                    stack: 'Stack 0',
                    font: {
                        weight: 'bold',
                        size: 16,
                    },
                    categoryPercentage: 0.5,
                    barPercentage: 0.5,
                }
            ]
        };
        const data = {
            labels: labels,
            datasets: [{
                axis: 'y',
                data: [65, 59, 80],
                fill: false,
                backgroundColor: [
                    '#006AC7',
                    '#FFBA00',
                    '#009A51',
                ],
                font: {
                    weight: 'bold',
                    size: 16,
                },
                borderWidth: 1,
            }]
        };
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: data,
            options: {
                barThickness: 80,
                scales: {
                    y: {
                        ticks: {
                            font: {
                                size: 18,
                                weight:'bold'
                            },
                            crossAlign: "far",
                        },
                        afterFit: function(scaleInstance) {
                            scaleInstance.width = 120; // sets the width to 100px
                        },
                    }
                },
                plugins: {
                    legend: false,
                    datalabels: {
                        display: true,
                        color: 'white',
                        formatter: function(value) {
                            return value;
                        }
                    }
                },
                indexAxis: 'y',
            },
            plugins: [ChartDataLabels]
        });

        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: data,
            options: {
                barThickness: 80,
                scales: {
                    y: {
                        ticks: {
                            font: {
                                size: 18,
                                weight:'bold'
                            },
                            crossAlign: "far",
                        },
                        afterFit: function(scaleInstance) {
                            scaleInstance.width = 120; // sets the width to 100px
                        }
                    }
                },
                plugins: {
                    legend: false,
                    datalabels: {
                        display: true,
                        color: 'white',
                        formatter: function(value) {
                            return value;
                        }
                    }
                },
                indexAxis: 'y',
            },
            plugins: [ChartDataLabels]
        });

        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: data3,
            options: {
                scales: {
                    y: {
                        ticks: {
                            font: {
                                size: 18,
                                weight:'bold'
                            },
                            crossAlign: "far",
                        },
                        afterFit: function(scaleInstance) {
                            scaleInstance.width = 120; // sets the width to 100px
                        },
                        stacked: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        align: 'start',
                    },
                    datalabels: {
                        display: true,
                        color: 'white',
                        formatter: function(value) {
                            return value;
                        }
                    }
                },
                indexAxis: 'y',
                responsive: true
            },
            plugins: [ChartDataLabels]
        });
        $('.show-scoring-board').click(function (){
            $('.popup_show_scoring_board').removeClass('hidden');
        })
        $('.popup_show_scoring_board .btn-popup-accept').click(function (){
            // nếu from > to
            toastr.options.timeOut = 3000;
            toastr.info('範囲指定に誤りがあります。')
            // nếu Thời hạn chỉ định vượt quá 5 năm 11 tháng ở Chỉ định thời hạn
            setTimeout(() => {
                toastr.options.timeOut = 3000;
                toastr.info('指定範囲が長過ぎます。')
            },4000)
        })
    </script>
@endpush
