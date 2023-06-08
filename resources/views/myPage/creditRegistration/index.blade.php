@extends('layouts.web.main', ['pageSlug' => 'myPage.myPage'])

@section('content')
    {{ Breadcrumbs::render('creditRegistration') }}
    <div class="container">
        <div class="row" style="height: 800px; width:800px;margin: 0 auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets') }}/js-lib/cdn.jsdelivr.net_npm_chart.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['SV', '研修・学会等', '社会的活動'],
                datasets: [{
                    label: '# of Votes',
                    data: [22, 22, 22],
                    borderWidth: 1,
                    backgroundColor: ['#006AC7', '#FFBA00', '#009A51'],
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
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endpush
