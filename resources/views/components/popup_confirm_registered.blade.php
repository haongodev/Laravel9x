<?php

if (!empty($typeNativeId)) {
    if ($typeNativeId == 1) {
        $patternName = '研修・学会等';
    } else {
        $patternName = '社会的活動';
    }
} else {
    $typeNativeId = 0;
    $patternName = 'スーパービジョン（SV）';
}
$fileName = '単位登録_' . $patternName . '_' . date('Ymd') . '.pdf';
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
            <input type="hidden" name="file_name" value="{{$fileName}}">
            <div class="header-content">
                <span>{{$patternName}}</span>
                <button class="btn-export-pdf btn-eff-ora btn-hov">PDF</button>
            </div>
            <div class="content">
                <div class="table">
                    <?php $score = 0?>
                        @foreach($answerData as $answer)
                            <div class="column">
                                <?php $score += $answer->score?>
                                <div class="tb-left">{!!$answer->title!!}</div>
                                @if(in_array($answer->input_method,[2,3,6]))
                                    <div class="tb-right">{!! str_replace(',','<br>',$answer->answer) !!}</div>
                                @elseif($answer->input_method ==7)
                                    <div class="tb-right">{{date('Y年 m月 d日',strtotime($answer->answer))}}</div>
                                @elseif($answer->input_method == 8)
                                        @php
                                            $arrAnswer =explode(',',$answer->answer);
                                        @endphp
                                        <div class="tb-right">{{date('Y年 m月 d日',strtotime($arrAnswer[0]))}}~{{date('Y年 m月 d日',strtotime($arrAnswer[1]))}}</div>
                                    @else
                                        <div class="tb-right">{{$answer->answer}}{{$answer->input_method==10 ? '年度' :''}}</div>
                                @endif

                            </div>
                        @endforeach
                    <div class="column">
                        <div class="tb-left">登録できる単位数</div>
                        <div class="tb-right">{{$score}}単位</div>
                    </div>
                </div>
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
