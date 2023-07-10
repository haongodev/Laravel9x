@extends('layouts.web.main', ['pageSlug' => '研鑽を積み上げる (単位登録)'])

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
        <div class="row" style="width:613px;margin: 0 auto;">
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

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['研修・学会等', '社会的活動','SV'],
                datasets: [{
                    label: '# of Votes',
                    data: [22, 22, 22],
                    borderWidth: 1,
                    backgroundColor: ['#FFBA00', '#009A51','#006AC7'],
                }]
            },
            options: {
                tooltips: {
                    enabled: false
                },
                responsive: true,
                plugins: {
                    legend: false,
                    title: false,
                    datalabels: {
                        display: true,
                        color: 'white',
                        formatter: function(value, context) {
                            return context.chart.data.labels[context.dataIndex];
                        },
                        font: {
                            size: 40,
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
            var url = '';
            switch (label) {
                case 'SV' :
                    url = '{{route('typeSelected')}}';
                    break;
                case '研修・学会等' :
                    url = '{{route('cls')}}';
                    break;
                case '社会的活動' :
                    url = '';
                    break;
            }
            if(url){
                window.location.href=url;
            }
        }

    </script>
@endpush
