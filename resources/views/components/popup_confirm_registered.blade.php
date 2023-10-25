<?php

if (!empty($typeNativeId)) {
    if ($typeNativeId == 1) {
        $patternName = '単位登録_研修・学会等';
    } else {
        $patternName = '単位登録_社会的活動';
    }
} else {
    $typeNativeId = 0;
    $patternName = '単位登録_スーパービジョン（SV）';
}
$fileName = '単位申請_' . $patternName . '_' . date('Ymd') . '.pdf';
?>
<div class="popup-wrapper confirm-popup">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content" id="table-confirm-registry">
            <link href="{{ asset('assets') }}/css/components.css" rel="stylesheet">
            <input type="hidden" name="file_name" value="{{$fileName}}">
            <div class="header-content">
                <span>{{$patternName}}</span>
                <button class="btn-export-pdf btn-eff-ora btn-hov">PDF</button>
            </div>
            <div class="content">
                <table>
                    <?php $score = 0?>
                        @foreach($answerData as $answer)
                            <tr>
                                <?php $score += $answer->score?>
                                <th>{{$answer->title}}</th>
                                @if(in_array($answer->input_method,[2,3,6]))
                                    <td>{!! str_replace(',','<br>',$answer->answer) !!}</td>
                                @elseif($answer->input_method ==7)
                                    <td>{{date('Y年 m月 d日',strtotime($answer->answer))}}</td>
                                @elseif($answer->input_method == 8)
                                        @php
                                            $arrAnswer =explode(',',$answer->answer);
                                        @endphp
                                        <td>{{date('Y年 m月 d日',strtotime($arrAnswer[0]))}}~{{date('Y年 m月 d日',strtotime($arrAnswer[1]))}}</td>
                                    @else
                                        <td>{{$answer->answer}}{{$answer->input_method==10 ? '年度' :''}}</td>
                                @endif

                            </tr>
                        @endforeach
                    <tr>
                        <th>登録できる単位数</th>
                        <td>{{$score}}単位</td>

                    </tr>
                </table>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-next btn-eff-ora btn-hov" register="true"
                    onclick="window.location='{{Route('creditEdit',['answer_manage_id'=>$answerManageId, 'type_native_id' => $typeNativeId])}}'">
                修正する</button>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
    $(document).ready(function () {
        $('.close-icon,.btn-popup-decline').click(function (e) {
            $('.popup-wrapper .popup-content .content').html('');
            $('.popup-wrapper').addClass('hidden');
            $('.btn-popup-accept').removeAttr('last-confirm');
        })

        $('.btn-export-pdf').click(function () {
            $('.btn-export-pdf').addClass('hidden');
            var file_name = $('#table-confirm-registry').find('input[name="file_name"]').val()
            html2canvas($('#table-confirm-registry')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download(file_name);

                    $('.btn-export-pdf').removeClass('hidden');
                }
            });
        })

        $('.btn-next').click(function (){

        })
    })
</script>
