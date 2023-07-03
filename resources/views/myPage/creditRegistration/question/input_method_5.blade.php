<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div
        class="input-group after-question-id-{{$questionSetting->id}}
            before-question-id-{{$questionSetting->parent_question_option_id}}"
        data-current-question-id="{{$questionSetting->id}}"
    >
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <select class="w-75 select-branch-question" id="question_select_{{$questionSetting->id}}"
                    name="own_position">
                <option value="">Choose Option</option>
                @foreach($questionSetting->question_option_setting as $questionOption)
                    <option
                        value="{{$questionOption->id}}"
                        data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <script>
        $('.select-branch-question').select2({
            placeholder: 'Select an option',
            minimumResultsForSearch: -1
        });
    </script>
</div>
