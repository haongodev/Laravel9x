<div class="input-group">
    <div class="w-100 group-control">
        <label for="email" class="w-25">実施期間</label>
        <div class="w-75 date-group">
            <input type="datetime-local" name="question[{{$questionSetting->id}}][start]"
                   value="{{ session('popup_confirm')['s_period'] ?? ''}}"/>
            <span>~</span>
            <input type="datetime-local" name="question[{{$questionSetting->id}}][end]"
                   value="{{ session('popup_confirm')['e_period'] ?? ''}}"/>
        </div>
    </div>
</div>
