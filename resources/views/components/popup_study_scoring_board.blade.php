<div class="popup-wrapper hidden popup_study_scoring_board">
    <input type="hidden" class="value_study_score_board"/>
    <div class="layout-popup" style="width: 97%;max-height: 94%;height:100%;">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-top">
            <div class="btn-title">
                <button type="button">2023年 7月 ～ 2028年 1月　研鑽スコアリングボード</button>
            </div>
            <button type="button" class="btn-export-pdf btn-eff-ora btn-hov">PDF</button>
            <div class="hidden btn-title-chart1">
                <button type="button">登録単位</button>
            </div>
            <div class="hidden btn-title-chart2">
                <button type="button">研鑽目的</button>
            </div>
        </div>
        <div class="popup-content">
            <div class="scoring_board_content">
                <div class="table-show-credit">
                    <table>
                        <tr>
                            <th></th>
                            <th>スーパービジョン</th>
                            <th>研修・学会等</th>
                            <th>社会的活動</th>
                        </tr>
                        {{-- <tr>
                            <td rowspan="3" class="col1" align="center">
                                2024 <br>
                                年度
                            </td>
                            <td class="col2">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                            <td class="col3">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                            <td class="col4">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                        </tr>
                        <tr>
                            <td class="col2">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                            <td class="col3">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                            <td class="col4">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                        </tr>
                        <tr>
                            <td class="col2">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                            <td class="col3">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                            <td class="col4">YYYY年M月D日<br>[内容]AAAAAAAAAAAAAAAAAAAA</td>
                        </tr> --}}
                    </table>
                </div>
                <div class="graph-show-credit">
                    <div class="table-graph">
                    </div>
                    <div class="radar-graph">
                        <button class="title-radar">研鑽目的</button>
                        <div>
                            <canvas width="1211" height="700" id="rardar_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('assets') }}/js-lib/cdn.jsdelivr.net_npm_chart.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var chartList = [];
    var chartStackList = [];
    var radarChart = null;
    function runRenderChart(){
        var value_study_scoring_board = JSON.parse($('.value_study_score_board').val());
        var tableData = value_study_scoring_board.scoreBwYearForPattern;
        renderTableData(tableData)
        var chartData = value_study_scoring_board.scoreBwYear;
        var radarData = value_study_scoring_board.scoreBwYearGoalStudy;

        const groupedDataChart = {};
        chartData.forEach(item => {
            const registrationYear = item.registration_year;
            if (!groupedDataChart[registrationYear]) {
                groupedDataChart[registrationYear] = [];
            }
            groupedDataChart[registrationYear].push(item);
        });
        var year = Object.keys(groupedDataChart);
        var widthChart = $('.table-graph').width();
        $('#rardar_chart').css('width',widthChart+'px');
        $('.table-graph').html('');
        year.forEach(function(val,index){
            // xử lý với trường hợp data sv trả về vói type_native_id [0,2] vì 1 không có data
            const existingIds = groupedDataChart[val].map(item => item.type_native_id);
            const defaultIds = [0, 1, 2].filter(id => !existingIds.includes(id)).map(id => ({
                type_native_id: id,
                total_score: "0",
                registration_year: year
            }));
            groupedDataChart[val] = groupedDataChart[val].concat(defaultIds);
            /// sắp xếp lại
            groupedDataChart[val].sort(function(a, b) {
                return a.type_native_id - b.type_native_id;
            });


            $('.table-graph').append('<div>'+
                    '<canvas id="column_chart_'+val+'_stack" width="1211" height="100"></canvas>'+
                '</div>'+
                '<div>'+
                    '<canvas id="column_chart_'+val+'" width="1211" height="200"></canvas>'+
                '</div>');
            $('#'+'column_chart_'+val).css('width',widthChart+'px');
            $('#'+'column_chart_'+val+'_stack').css('width',widthChart+'px');
            const ctx = document.getElementById('column_chart_'+val);
            const ctxStack = document.getElementById('column_chart_'+val+'_stack');
            const labels = ['SV','研修・学会等','社会的活動'];
            const labelsStack = [val+'年度'];
            var dataInitCore1 = groupedDataChart[val].map(item => item.total_score);
            const maxRange = dataInitCore1.reduce((partialSum, a) => parseInt(partialSum) + parseInt(a), 0);
            const data = {
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
                        size: 16,
                    },
                    borderWidth: 1,
                    barPercentage: 1,
                    categoryPercentage:1
                }]
            };
            const dataStackSets = [];
            groupedDataChart[val].forEach(function (item,nth) {
                dataStackSets.push(
                    {
                        axis: 'y',
                        label: labels[item.type_native_id],
                        data: [dataInitCore1[nth]],
                        backgroundColor: data.datasets[0].backgroundColor[item.type_native_id],
                        stack: 'Stack 0',
                        font: {
                            weight: 'bold',
                            size: 16,
                        },
                        categoryPercentage: 0.5,
                        barPercentage: 0.6,
                    }
                )
            })
            const dataStack = {
                labels: labelsStack,
                datasets: dataStackSets
            };
            initColumnChart(index,ctx,data,maxRange);
            initColumnChartStack(index,ctxStack,dataStack,maxRange);
        })
        initRardarChart(radarData);
    }
    function initColumnChart(index,ctx,data,maxRange){
        chartList[index] = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barThickness: 20,
                scales: {
                    y: {
                        beginAtZero: true,
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
                    },
                    x: {
                        max: parseInt(maxRange),
                        ticks: {
                            stepSize: 10
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
                responsive: false
            },
            plugins: [ChartDataLabels]
        });
    }
    function initColumnChartStack(index,ctx,data,maxRange){
        chartStackList[index] = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        ticks: {
                            font: {
                                size: 18,
                                weight:'bold'
                            },
                            crossAlign: "far",
                            color:'#3399FF'
                        },
                        afterFit: function(scaleInstance) {
                            scaleInstance.width = 120; // sets the width to 100px
                        },
                        stacked: true,
                    },
                    x: {
                        max: parseInt(maxRange),
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
                responsive: false
            },
            plugins: [ChartDataLabels]
        });
    }
    function initRardarChart(data){
        const dataSets = [];
        const dataGroup = {};
        // const titleList = data.map(item => item.title);
        const colorList = ['#b3ff6673','#66ffff80','#9999ff7a','#ff99ff82','#ffb36680']
        data.forEach(item => {
            const registrationYear = item.registration_year;
            if (!dataGroup[registrationYear]) {
                dataGroup[registrationYear] = [];
            }
            dataGroup[registrationYear].push(item);
        });
        let index = 0;
        for (const year in dataGroup) {
            dataSets.push({
                key: year,
                label: year+"年度",
                backgroundColor: colorList[index],
                data: [],
            });
            index++;
        }
        data.forEach((item1,index) => {
            const indexDts = dataSets.findIndex((item2) => parseInt(item2.key) === item1.registration_year);
            if(indexDts >= 0){
                if(indexDts > 0){
                    const lengthfront = dataSets[indexDts - 1].data.length;
                    for (let hk = 0; hk < lengthfront; hk++) {
                        dataSets[indexDts].data.push("0");
                    }
                }
                dataSets[indexDts].data.push(item1.total_score);
            }
        });
        var marksCanvas = document.getElementById("rardar_chart");
        var marksData = {
            labels: [
                "健康状態の自己管理",
                "仕事と家庭のバランス",
                "基本施設やマナー",
                "組織人としての役割遂行",
                ["専門的支援関係形成力","（個人、小集団、地域等）"],
                "アセスメント力",
                "支援・介入・調整力",
                "連携・協働・チーム形成力",
                "ソーシャルワーカーを育てる力",
                "専門性を養うために学び続ける力",
                ["コミュニティへのアプローチ・","ソーシャルアクションの力"],
                "研究、実践成果を示す力",
                ["ソーシャルワーカーアイデンティティ・","モチベーションを維持する力"],
            ],
            datasets:dataSets
        };
        radarChart = new Chart(marksCanvas, {
            type: 'radar',
            data: marksData,
            options: {
                scales: {
                    r: {
                        ticks:{
                            max: 60,
                        },
                        pointLabels: {
                            font: {
                                size: 15,
                                weight: 'bold',
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        align: 'center',
                    },
                },
                responsive: false
            },
        });
    }
    $('.btn-export-pdf').click(function(){
        var objChart = [];
        var file_name = 'graph-show-credit';
        var headPdf = '';
        var titleChart1 = '';
        var titleChart2 = '';
        var tableHtml = '';
        $('.popup-top .btn-title button').css('marginBottom','30px');
        html2canvas($('.popup-top .btn-title'),{
            onrendered: function (canvas) {
                headPdf = canvas.toDataURL();
                $('.popup-top .btn-title-chart1').removeClass('hidden');
                html2canvas($('.popup-top .btn-title-chart1'),{
                    onrendered: function (canvas) {
                        $('.popup-top .btn-title-chart1').addClass('hidden');
                        $('.popup-top .btn-title-chart2').removeClass('hidden');
                        titleChart1 = canvas.toDataURL();
                        html2canvas($('.popup-top .btn-title-chart2'),{
                            onrendered: function (canvas) {
                                $('.popup-top .btn-title-chart2').addClass('hidden');
                                $('.table-show-credit').css('overflowX','unset');
                                titleChart2 = canvas.toDataURL();
                                html2canvas($('.table-show-credit table'), {
                                    onrendered: function (canvas) {
                                        tableHtml = canvas.toDataURL();
                                        $('.table-show-credit').css('overflowX','auto');
                                        $('.popup-top .btn-title button').css('marginBottom','unset');
                                        exportPdfNow();
                                    }
                                });
                            }
                        })
                    }
                })
            }
        })


        function exportPdfNow(){
            objChart.push({
                image: headPdf,
                width: 500,
                alignment: "center"
            })
            objChart.push({
                image: titleChart1,
                width: 500,
                alignment: "center"
            })
            chartList.forEach(function(val,index){
                objChart.push({
                    image: chartStackList[index].toBase64Image(),
                    width: 500,
                    alignment: "center"
                })
                objChart.push({
                    image: val.toBase64Image(),
                    width: 500,
                    alignment: "center"
                })
            })
            objChart.push({
                image: titleChart2,
                width: 500,
                alignment: "center"
            })
            objChart.push({
                image: radarChart.toBase64Image(),
                width: 380,
                alignment: "center"
            })
            objChart.push({
                image: headPdf,
                width: 500,
                alignment: "center"
            })
            objChart.push({
                image: tableHtml,
                width: 500,
                alignment: "center"
            })
            var docDefinition = {
                content:objChart
            };
            pdfMake.createPdf(docDefinition).download(file_name);
        }
    })
    function renderTableData(data){
        var html = '';
        const groupedData = {};
        data.forEach(item => {
            const registrationYear = item.registration_year;
            if (!groupedData[registrationYear]) {
                groupedData[registrationYear] = [];
            }
            groupedData[registrationYear].push(item);
        });
        for(const year in groupedData) {
            groupedData[year].forEach((item,index) => {
                html += '<tr>';
                if(index === 0){
                    html += '<td rowspan="'+lengHighest(groupedData[year])+'" class="col1" align="center">'+year+' <br> 年度</td>';
                    html += getTdByNativeId(groupedData[year],'col2',0);
                    html += getTdByNativeId(groupedData[year],'col3',1);
                    html += getTdByNativeId(groupedData[year],'col4',2);
                }else{
                    html += getTdByNativeId(groupedData[year],'col2',0);
                    html += getTdByNativeId(groupedData[year],'col3',1);
                    html += getTdByNativeId(groupedData[year],'col4',2);
                }
                html += '</tr>';
            });
        }
        $('.scoring_board_content .table-show-credit table').append(html);
        clearnupTable();
    }
    function getTdByNativeId(items,className,value){
        var htmlItem = items.findIndex((item) => item.type_native_id === value && !item.hasOwnProperty('map'));
        if(htmlItem >= 0){
            items[htmlItem]['map'] = true;
            return '<td class="'+className+'">'+(items[htmlItem].effective_date_flg !== null ? items[htmlItem].effective_date_flg : '')+'<br>[内容]<br>'+items[htmlItem].answer+'</td>';
        }else{
            return '<td class="'+className+'"></td>';
        }
    }
    function clearnupTable(){
        $('.table-show-credit table tr:gt(0)').each(function(i,e){
            var td = $(e).find('td');
            let found = 0;
            $(td).each(function(i1,e1){
                if($(e1).text() !== ''){
                    found++;
                }
            });
            if(found === 0){
                $(e).remove();
            }
        })
    }
    function lengHighest(data){
        var firstLength = 0;
        const countMap = {};

        // Đếm số lượng đối tượng cho từng type_native_id
        for (const item of data) {
            if (countMap[item.type_native_id]) {
                countMap[item.type_native_id]++;
            } else {
                countMap[item.type_native_id] = 1;
            }
        }
        // Tìm ra type_native_id có số lượng đối tượng lớn nhất
        let maxCount = 0;
        let maxCountType = null;
        for (const type in countMap) {
            if (countMap[type] > maxCount) {
                maxCount = countMap[type];
                maxCountType = type;
            }
        }
        return maxCount;
    }
    function destroyAllChart(){
        chartList.forEach(element => {
            element.destroy()
        });
        chartStackList.forEach(element => {
            element.destroy()
        });
        radarChart.destroy();
    }
    $('.close-icon').click(function (e){
        destroyAllChart();
    })
    $('.popup-wrapper').click(function (e){
        if(e.target.className.includes('popup-wrapper')){
            destroyAllChart();
        }
    })
</script>
@endpush
