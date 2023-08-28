@extends('layouts.web.main', [
    'pageSlug' => '現在の研鑽状況',
    'guidanceInclude' => count($guidance) > 0 ? $guidance : null
    ])
@push('styles')
    <link href="{{ asset('assets') }}/css/cdnjs.cloudflare.com_ajax_libs_toastr.js_latest_toastr.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/datepicker.css" rel="stylesheet" />

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
                <select class="update-score-chart">
                    @foreach($year_list as $year)
                        <option value="{{$year}}">{{$year}}年度</option>
                    @endforeach
                </select>
                <span>の研鑽状況</span>
            </div>
            <div class="side-right">
                <button class="decline-btn show-scoring-board btn-eff-ora btn-hov">研鑽スコア</button>
            </div>
        </div>
        <div class="row" style="height: 500px; width:100%;margin: 0 auto;">
            <canvas id="myChart1" style="width: 100%;"></canvas>
        </div>

        @if(auth()->user()->user_add_info->membership_type == '認定保健福祉士')
            <div class="head-chart flex-between">
                <div class="side-left">
                    <span>{{getCertificationYear()}}年度 認定期限までの研鑽状況</span>
                </div>
                <div class="side-right">
                    <button class="decline-btn btn-eff-ora btn-hov"><a href="{{ route('creditRegistration') }}">単位登録</a></button>
                </div>
            </div>
            <div class="row" style="height: 500px; width:100%;margin: 0 auto;display: flex;align-items: center;position: relative;">
                <canvas id="myChart2"></canvas>
                <div class="flags">
                    <div class="blue-flag flag_0">
                    </div>
                    <div class="yellow-flag flag_1">

                    </div>
                    <div class="green-flag flag_2">
                    </div>
                </div>
            </div>

            <div class="head-chart flex-between">

            </div>
            <div class="row" style="margin: 0 auto;display: flex;align-items: center;position: relative;">
                <canvas id="myChart3" width="1211" height="300"></canvas>
                <div class="flags" style="justify-content: center;">
                    <h2>現在 <span style="color:#FF0000" class="total-score">300</span>単位</h2>
                    <div class="flags-goal">
                        <div class="blue-flag flags-goal0">
                        </div>
                        <div class="yellow-flag flags-goal1">
                        </div>
                        <div class="green-flag flags-goal2">
                        </div>
                        <div class="red-flag flags-goal3 hidden">
                            <img width="61" src="{{ asset('assets/images/icon/goal_flag3.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('components.popup_filter_scoring_board')
    @include('components.popup_study_scoring_board')
@endsection
@push('js')
    <script src="{{asset('assets/js-lib/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/datepicker.js')}}"></script>

    <script>
        var initCoreChart1Data = JSON.parse(`{!! json_encode($sumCoreByInitYear) !!}`);
        var initCoreChart2Data = JSON.parse(`{!! json_encode($sumCoreByInitYearRange) !!}`);
        var maxScales1 = 0;
        var dataInitCore1 = [];
        var textInfoScore2 = [];
        var textInfoScore3 = [];
        var maxScales2 = 0;
        var dataInitCore2 = [];

        // xử lý với trường hợp data sv trả về vói type_native_id [0,2] vì 1 không có data
        const existingIds1 = initCoreChart1Data.map(item => item.type_native_id);
        const defaultIds1 = [0, 1, 2].filter(id => !existingIds1.includes(id)).map(id => ({
            type_native_id: id,
            total_score: "0"
        }));
        initCoreChart1Data = initCoreChart1Data.concat(defaultIds1);
        /// sắp xếp lại
        initCoreChart1Data.sort(function(a, b) {
            return a.type_native_id - b.type_native_id;
        });

        // xử lý với trường hợp data sv trả về vói type_native_id [0,2] vì 1 không có data
        const existingIds2 = initCoreChart2Data.map(item => item.type_native_id);
        const defaultIds2 = [0, 1, 2].filter(id => !existingIds2.includes(id)).map(id => ({
            type_native_id: id,
            total_score: "0"
        }));
        initCoreChart2Data = initCoreChart2Data.concat(defaultIds2);
        /// sắp xếp lại
        initCoreChart2Data.sort(function(a, b) {
            return a.type_native_id - b.type_native_id;
        });
        updateScaleMax1(initCoreChart1Data);
        updateScaleMax2(initCoreChart2Data);
        var AmountScore = dataInitCore2.reduce((accumulator, currentValue) => parseInt(accumulator) + parseInt(currentValue), 0);
        $('.total-score').html(AmountScore);
        if(AmountScore > 100){
            $('.flags-goal3').removeClass('hidden');
        }
        const allScoresGreaterThan20 = initCoreChart2Data.every(item => parseInt(item.total_score) > 20);
        if(allScoresGreaterThan20){
            $('.flags-goal3').removeClass('hidden');
        }
        $('.date-group input').datepicker({
            format: 'yyyy年  mm月',
        });
        const ctx1 = document.getElementById('myChart1');
        const ctx2 = document.getElementById('myChart2');
        const ctx3 = document.getElementById('myChart3');
        const labels = ['スーパービジョン','研修・学会等','社会的活動'];
        const labels3 = ['合計'];
        const data1 = {
            labels: labels,
            datasets: [{
                axis: 'y',
                data: dataInitCore1,
                fill: false,
                backgroundColor: [
                    '#FF8000',
                    '#006AC7',
                    '#009A51',
                ],
                font: {
                    weight: 'bold',
                    size: 20,
                },
                borderWidth: 2,
                borderColor: '#000'
            }]
        };
        const data2 = {
            labels: labels,
            datasets: [{
                axis: 'y',
                data: dataInitCore2,
                fill: false,
                backgroundColor: [
                    '#FF8000',
                    '#006AC7',
                    '#009A51',
                ],
                font: {
                    weight: 'bold',
                    size: 20,
                },
                borderWidth: 2,
                borderColor: '#000'
            }]
        };
        const data3 = {
            labels: labels3,
            datasets: [
                {
                    axis: 'y',
                    label: 'スーパービジョン',
                    data: [dataInitCore2[0]],
                    backgroundColor: '#FF8000',
                    stack: 'Stack 0',
                    font: {
                        weight: 'bold',
                        size: 20,
                    },
                    categoryPercentage: 0.5,
                    barPercentage: 0.5,
                    borderWidth: 2,
                    borderColor: '#000'
                },
                {
                    axis: 'y',
                    label: '研修・学会等',
                    data: [dataInitCore2[1]],
                    backgroundColor: '#006AC7',
                    stack: 'Stack 0',
                    font: {
                        weight: 'bold',
                        size: 20,
                    },
                    categoryPercentage: 0.5,
                    barPercentage: 0.5,
                    borderWidth: 2,
                    borderColor: '#000'
                },
                {
                    axis: 'y',
                    label: '社会的活動',
                    data: [dataInitCore2[2]],
                    backgroundColor: '#009A51',
                    stack: 'Stack 0',
                    font: {
                        weight: 'bold',
                        size: 20,
                    },
                    categoryPercentage: 0.5,
                    barPercentage: 0.5,
                    borderWidth: 2,
                    borderColor: '#000'
                }
            ]
        };
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: data1,
            options: {
                barThickness: 50,
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
                            scaleInstance.width = 150; // sets the width to 100px
                        },
                    },
                    x: {
                        max: maxScales1,
                    }
                },
                plugins: {
                    legend: false,
                    datalabels: {
                        display: true,
                        color: 'white',
                        formatter: function(value) {
                            return value;
                        },
                        font: {
                            size: 20,
                        }
                    }
                },
                indexAxis: 'y',
            },
            plugins: [ChartDataLabels]
        });
        if(ctx2) {
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: data2,
                options: {
                    barThickness: 50,
                    scales: {
                        y: {
                            ticks: {
                                font: {
                                    size: 18,
                                    weight: 'bold'
                                },
                                crossAlign: "far",
                            },
                            afterFit: function (scaleInstance) {
                                scaleInstance.width = 150; // sets the width to 100px
                            }
                        },
                        x: {
                            max: maxScales2,
                        }
                    },
                    plugins: {
                        legend: false,
                        datalabels: {
                            display: true,
                            color: 'white',
                            formatter: function (value) {
                                return value;
                            },
                            font: {
                                size: 20,
                            }
                        }
                    },
                    indexAxis: 'y',
                },
                plugins: [ChartDataLabels]
            });
        }
        if(ctx3){
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
                            scaleInstance.width = 150; // sets the width to 100px
                        },
                        stacked: true
                    },
                    x: {
                        max: AmountScore,
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
                        },
                        font: {
                            size: 20,
                        }
                    }
                },
                indexAxis: 'y',
            },
            plugins: [ChartDataLabels]
        });
        }
        $('.show-scoring-board').click(function (){
            $('.popup_filter_scoring_board').removeClass('hidden');
            $('body').addClass('ovf-hidden');
        })
        $('.popup_filter_scoring_board .btn-popup-accept').click(function (){
            var timeInput = $('.popup_filter_scoring_board .date-group input');
            var from = $(timeInput[0]).datepicker('getDate');
            var to = $(timeInput[1]).datepicker('getDate');
            from = new Date(from);
            to = new Date(to);
            // 2023年 7月 ～ 2028年 1月　
            var titleBoard = from.getFullYear()+'年 '+(from.getMonth()+1)+'月 ~ '+to.getFullYear()+'年 '+(to.getMonth()+1)+'月 '+'研鑽スコアリングボード';
            toastr.options.timeOut = 3000;
            if (from > to) {
                toastr.info('範囲指定に誤りがあります');
                return false;
            }
            // nếu Thời hạn chỉ định vượt quá 5 năm 11 tháng ở Chỉ định thời hạn
            var exceeds5Years11Months = checkTimeDifferenceExceeds5Years11Months(from,to);
            if (exceeds5Years11Months) {
                toastr.info('指定範囲が長過ぎます');
                return false;
            }
            var url = "{{ route('getStudyScoreBwMonth', ":from_:to") }}";
            var monthYear = from.getFullYear()+'-'+(from.getMonth()+1)+'_'+to.getFullYear()+'-'+(to.getMonth()+1);
            url = url.replace(':from_:to', monthYear);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('.popup_filter_scoring_board').addClass('hidden');
                    $('.popup_study_scoring_board').removeClass('hidden');
                    $('.value_study_score_board').val(JSON.stringify(response.data));
                    $('.popup_study_scoring_board .layout-popup .popup-top .btn-title button').html(titleBoard);
                    $('.scoring_board_content .table-show-credit table tr:gt(0)').remove();
                    runRenderChart();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
        function updateScaleMax1(coreList){
            maxScales1 = coreList.length ? parseInt(coreList[0].total_score) : 0;
            for (var i = 0; i < coreList.length; i++) {
                dataInitCore1.push(coreList[i].total_score);
                var currentTotalScore = Number(coreList[i].total_score);
                if (currentTotalScore > maxScales1) {
                    maxScales1 = parseInt(currentTotalScore);
                }
            }
            if(maxScales1 < 20){
                maxScales1 = 22;
            }else{
                maxScales1 += 5;
            }
        }
        function updateScaleMax2(coreList){
            maxScales2 = coreList.length ? parseInt(coreList[0].total_score) : 0;
            for (var i = 0; i < coreList.length; i++) {
                dataInitCore2.push(coreList[i].total_score);
                // handle text info score
                if(coreList[i].total_score < 20){
                    var remaining_score = 20 - coreList[i].total_score;
                    textInfoScore2[coreList[i].type_native_id] = '<p class="text-info-score">20単位まであと <span class="color_score'+coreList[i].type_native_id+'">'+remaining_score+'</span>単位</p>';
                }else{
                    var totalScore = 0;
                    var flagname = '';
                    var sizeImg = 32;
                    if(coreList[i].total_score < 100){
                        totalScore = parseInt(coreList[i].total_score / 10);
                        flagname = 'flag_score10_';
                    }else{
                        totalScore = parseInt(coreList[i].total_score / 100);
                        flagname = 'flag_score100_';
                        sizeImg = 46;
                    }
                    textInfoScore2[coreList[i].type_native_id] = [];
                    for (var j = 0; j < totalScore; j++) {
                        var image = '<img width="'+sizeImg+'" src="{{ asset('assets/images/icon/{nameImage}') }}">';
                        image = image.replace('{nameImage}', flagname+coreList[i].type_native_id+'.svg');
                        textInfoScore2[coreList[i].type_native_id].push(image);
                    }
                }
                var currentTotalScore = Number(coreList[i].total_score);
                if (currentTotalScore > maxScales2) {
                    maxScales2 = parseInt(currentTotalScore);
                }
                if(coreList[i].total_score > 20){
                    var imageGoal = '<img width="46" src="{{ asset('assets/images/icon/{nameImage}') }}">';
                    imageGoal = imageGoal.replace('{nameImage}', 'goal_flag'+coreList[i].type_native_id+'.svg');
                    textInfoScore3[coreList[i].type_native_id] = imageGoal;
                }
            }
            $.each($('.flags'), function (indexInArray, val) {
                textInfoScore2.forEach((element,ind) => {
                    if(typeof element === 'object'){
                        element.forEach((img) => {
                            $(val).find('.flag_'+ind).append(img);
                        })
                    }else{
                        $(val).find('.flag_'+ind).html(element);
                    }
                });
                textInfoScore3.forEach((element,ind) => {
                    $(val).find('.flags-goal'+ind).html(element);
                });
            });
        }
        function checkTimeDifferenceExceeds5Years11Months(timeString1, timeString2) {
            const date1 = new Date(timeString1);
            const date2 = new Date(timeString2);

            // Tính số milliseconds giữa hai thời gian
            const timeDifference = Math.abs(date2 - date1);

            // Chuyển đổi số milliseconds sang số năm và số tháng
            const yearsDifference = Math.floor(timeDifference / (365.25 * 24 * 60 * 60 * 1000));
            const monthsDifference = Math.floor((timeDifference % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 * 60 * 1000));

            // Kiểm tra nếu số năm vượt quá 5, thì cộng dồn số tháng
            let totalMonthsDifference = monthsDifference;
            if (yearsDifference >= 5) {
                const extraYears = yearsDifference - 5;
                totalMonthsDifference += extraYears * 12;
            }
            return totalMonthsDifference > 11;
        }
        $('.update-score-chart').change(function (e) {
            var year = $(this).val();
            var url = "{{ route('getSumCoreByYear', ":year") }}";
            url = url.replace(':year', year);
            $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        dataInitCore1 = [];
                        updateScaleMax1(response.data);
                        myChart1.data.datasets[0].data = dataInitCore1;
                        myChart1.config.options.scales.x.max = maxScales1;
                        myChart1.update();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
        });
    </script>
@endpush
