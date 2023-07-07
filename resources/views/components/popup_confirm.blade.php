<div class="popup-wrapper confirm-popup">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content" id="table-confirm-registry">
            <div class="header-content">
                <span>スーパービジョン（SV）</span>
                <button class="btn-export-pdf">PDF</button>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>自身の立場</th>
                            <td>{{ session('popup_confirm')['own_position'] ??''}}</td>
                    </tr>
                    <tr>
                        <th>SVRの属性</th>
                        <td>{{ session('popup_confirm')['SVR_attributes'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>相手の氏名</th>
                        <td>{{ session('popup_confirm')['TOPL'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>SVの種類</th>
                        <td>{{ session('popup_confirm')['type_SV'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>SVの頻度</th>
                        <td>{{ session('popup_confirm')['SV_frequency'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>実施期間</th>
                        <td>{{ session('popup_confirm')['s_period'] ?? ''}} ~ {{ session('popup_confirm')['e_period'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>SV契約</th>
                        <td>{{ session('popup_confirm')['SV_contract']  ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>登録できる単位数</th>
                        <td>1</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept" register="true">単位登録を実行する</button>
            <button type="button" class="btn-popup-decline">戻って修正する</button>
        </div>
    </div>
</div>
