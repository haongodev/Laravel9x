<div class="popup-wrapper hidden popup_show_scoring_board">
    <div class="layout-popup" style="width: 30%">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="content">
                <button type="button" class="btn-title" style="background: #007FFF">研鑽スコアリングボードの表示期間</button>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <div class="date-group">
                            <input type="datetime-local" name="s_period"/>
                            <input type="datetime-local" name="e_period"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept" style="background: #007FFF;font-size: 12pt">スコアシートを表示</button>
        </div>
    </div>
</div>
