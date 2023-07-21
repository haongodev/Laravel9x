<?php
//dd(session('popup_confirm'),session('question_confirm'),session('question_option_confirm'));
$questionSettingRegistry = session('popup_confirm')['question'] ?? [];
$questionSettingData = session('question_confirm');
$questionOptionSettingData = session('question_option_confirm');
if(!empty(session('popup_confirm')['type_native_id'])){
    if(session('popup_confirm')['type_native_id'] ==1){
        $patternName = '学会・研修等、';
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
            <link href="https://cms-wot.local/assets/css/components.css" rel="stylesheet">
            <input type="hidden" name="file_name" value="{{$fileName}}">
            <div class="header-content">
                <span>{{$patternName}}</span>
                <button class="btn-export-pdf">PDF</button>
            </div>
            <div class="content scroll">
                <table>
                    <tbody>
                    <tr>
                        <th>cau hoi method 0</th>
                        <td>
                            dfvdfv
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 0</th>
                        <td>
                            wefwef
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 1</th>
                        <td>
                            wefwef
                            sfsdf
                            sfsdfsdf
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 7</th>
                        <td>
                            2023年 07月 07日
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 8</th>
                        <td>
                            2023年 07月 12日
                            ~ 2023年 07月 13日
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 2</th>
                        <td>
                            question_3_1<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 8</th>
                        <td>
                            question_14_1<br>
                            question_14_3<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 8</th>
                        <td>
                            question_15_2<br>
                            question_15_3<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 3</th>
                        <td>
                            question_4_3<br>
                            question_4_4<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 3</th>
                        <td>
                            question_16_2<br>
                            question_16_3<br>
                            question_16_4<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 3 method 3</th>
                        <td>
                            question_17_2<br>
                            question_17_3<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 4</th>
                        <td>
                            question_5_2
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 4</th>
                        <td>
                            question_18_3
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi con method 4</th>
                        <td>
                            question_19_3
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 5</th>
                        <td>
                            question_6_4
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method con method 5</th>
                        <td>
                            question_20_2
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method 6</th>
                        <td>
                            question_7_2<br>
                            question_7_4<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method con 6</th>
                        <td>
                            question_23_2<br>
                            question_23_3<br>
                        </td>
                    </tr>
                    <tr>
                        <th>cau hoi method con 6</th>
                        <td>
                            question_24_1<br>
                            question_24_2<br>
                            question_24_3<br>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept" register="true">単位登録を実行する</button>
            <button type="button" class="btn-popup-decline">戻って修正する</button>
        </div>
    </div>
</div>
