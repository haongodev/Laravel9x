<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',',$answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div
        class="input-group  before-question-id-{{$questionSetting->parent_question_option_id}}"
        data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <select class="w-75 select-branch-question select-branch-question-{{$questionSetting->id}} select-chosen" multiple id="question_select_{{$questionSetting->id}}"
                    name="question[{{$questionSetting->id}}][]">
                <option value="">Choose Option</option>
                @foreach($questionSetting->question_option_setting as $questionOption)
                    <option
                        value="{{$questionOption->id}}"
                        {{in_array($questionOption->option_name, $arrAnswer) ? 'selected' : ''}}
                        data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <script>

        $(".select-chosen").chosen({no_results_text: "Oops, nothing found!"});
    </script>

</div>
<script>
    $(document).ready(function(){
        $('#registry').find('.select-branch-question-{{$questionSetting->id}}').each(function (){
            var this_choose = $(this);
            var id = $(this).attr('id');
            $('#' + id + '>option').each(function (index) {
                var current_id = $(this).data('question-option-setting-id');

                if (!$(this).is(':selected')) {
                    removeQuestion($(this))
                } else {
                    if ($('#registry').find('.before-question-id-' + current_id).length == 0) {
                        console.log('add', current_id);
                        getQuestionBranch(this_choose, current_id)
                    }

                }

            });
        })
    });
</script>
