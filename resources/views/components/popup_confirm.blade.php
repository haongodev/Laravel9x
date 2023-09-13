<?php
//dd(session('popup_confirm'),session('question_confirm'),session('question_option_confirm'));
$questionSettingRegistry = session('popup_confirm')['question'] ?? [];
$questionSettingData = session('question_confirm');
$questionOptionSettingData = session('question_option_confirm');
if(!empty(session('popup_confirm')['type_native_id'])){
    if(session('popup_confirm')['type_native_id'] ==1){
        $patternName = '研修・学会等';
    }else{
        $patternName = '社会的活動';
    }
}else{
    $patternName = 'スーパービジョン（SV）';
}
$fileName = '単位申請_'.$patternName.'_'.date('Ymd').'.pdf';
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
            <div class="content scroll">
                <table>
                    <?php $score = 0?>
                    @foreach($questionSettingRegistry as $questionSettingId => $answer)
                        @php $questionSetting = $questionSettingData[$questionSettingId] @endphp
                        <tr>
                            <th>{{$questionSetting->title}}</th>
                            <td>
                                {{--Answer input --}}
                                @if(!in_array($questionSetting->input_method,config('constants.questionBranching')))

                                    @if(in_array($questionSetting->input_method, [0,1]))
                                        {{$answer}}
                                    @elseif($questionSetting->input_method ==7)
                                        {{date('Y年 m月 d日',strtotime($answer))}}
                                    @elseif($questionSetting->input_method ==8)
                                        {{date('Y年 m月 d日',strtotime($answer['start']))}}
                                        ~ {{ date('Y年 m月 d日',strtotime($answer['end']))}}
                                    @endif
                                    @php $score += $questionSetting->score @endphp
                                    {{--Answer option --}}
                                @else
                                    {{--Answer multi option --}}
                                    @if(in_array($questionSetting->input_method,[2,3,6]))
                                        @foreach($answer as $key2 => $answer2)
                                            {{$questionOptionSettingData[$answer2]->option_name ?? ''}}<br>
                                            @php $score += $questionOptionSettingData[$answer2]->score @endphp
                                        @endforeach
                                        {{--Answer only option --}}
                                    @else
                                        {{$questionOptionSettingData[$answer]->option_name ?? ''}}
                                        @php $score += $questionOptionSettingData[$answer]->score @endphp
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <th>単位数</th>
                            <td>{{$score}}単位</td>

                        </tr>
                </table>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept btn-eff-pri btn-hov" register="true">単位登録を実行する</button>
            <button type="button" class="btn-popup-decline btn-eff-ora btn-hov">戻って修正する</button>
        </div>
    </div>
</div>
@php
    Illuminate\Support\Facades\Session::forget('show_popup_confirm');
@endphp
