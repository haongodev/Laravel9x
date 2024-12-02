@extends('layouts.web.main', [
    'pageSlug' => '研鑽を記録する (単位登録)',
    'button_unit_guidelines' => true,
    'button_qa_unit' => true,
    'button_operation_manual' => true,
    'button_central_study' => true
    ])

@section('content')
    {{ Breadcrumbs::render('creditRegistration') }}
    <div>
        @if(!empty($guidanceData[1]))
            @if($guidanceData[1]->sentence_class)
                {!! $guidanceData[1]->guidance !!}
            @else
                {!! $guidanceData[1]->guidance !!}
            @endif
        @endif
    </div>
    <div class="container">
        <div class="row chart-wrp" style="margin: 0 auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div>
        @if(!empty($guidanceData[2]))
            @if($guidanceData[2]->sentence_class)
                {!! $guidanceData[2]->guidance !!}
            @else
                {!! $guidanceData[2]->guidance !!}
            @endif
        @endif
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets') }}/js-lib/cdn.jsdelivr.net_npm_chart.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        const ctx = document.getElementById('myChart');
        var width = $(window).width();
        var wCans = 613;
        var textFont = 32;
        if(width < 500){
            wCans = 400;
            textFont = 20;
        }
        $('.chart-wrp').css('width', wCans+'px');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['研修・学会等', '社会的活動','スーパービジョン'],
                datasets: [{
                    label: '# of Votes',
                    data: [22, 22, 22],
                    borderWidth: 1,
                    backgroundColor: ['#006AC7', '#009A51','#FF8000'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        enabled: false
                    },
                    legend: false,
                    title: false,
                    datalabels: {
                        display: true,
                        color: 'white',
                        formatter: function(value, context) {
                            return context.chart.data.labels[context.dataIndex];
                        },
                        font: {
                            size: textFont,
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
        ctx.onclick = function (e){
            var activePoints = myChart.getElementsAtEventForMode(e, 'point', myChart.options);
            var firstPoint = activePoints[0];
            var label = myChart.data.labels[firstPoint.index];
            var type_native_id = 0;
            if(label=='社会的活動'){
                type_native_id = 2
            }else if(label=='スーパービジョン'){
                type_native_id = 0
            }else{
                type_native_id = 1;
            }
            var url = '{{route('typeSelected')}}?type_native_id='+type_native_id;
            window.location.href=url;
        }

    </script>
@endpush
