<div class="input-group">
    <div class="w-100 group-control">
        <label for="email" class="w-25">SV契約</label>
        <div class="w-75 date-group second">
            <input type="datetime-local" name="SV_contract"
                   value="{{ session('popup_confirm')['SV_contract'] ?? ''}}"/>
        </div>
    </div>
</div>
