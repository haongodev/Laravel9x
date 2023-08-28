<div class="popup-wrapper hidden popup-A015-choose_date">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A015-choose_date">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <input class="datepicker-a015" type="hidden"/>
                <div class="docs-datepicker-container"></div>
            </div>
        </div>
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept initiative-accept">はい</button>
            <button type="button" class="btn-popup-decline close-A015-choose_date">いいえ</button>
        </div>
    </div>
</div>
@push('styles')
    <link href="{{ asset('assets') }}/css/datepicker.css" rel="stylesheet" />
    <style>
        .docs-datepicker-container .datepicker-inline{
            min-width: 425pt;
        }
        .datepicker-inline{
            border-radius: 5px;
            border: 1px solid #999999;
            padding: 20px;
        }
        .datepicker-panel ul{
            width: 100%;
        }
        .datepicker-panel ul:nth-child(1){
            display: flex;
            justify-content: space-between;
        }
        .datepicker-panel ul:nth-child(1) > li:nth-child(1),.datepicker-panel ul:nth-child(1) li:nth-child(3){
            font-size: 19pt;
            border: 1px solid #9999;
            border-radius: 5px;
            color: #008CFF;
            height: 27pt;
            width: 40pt;
        }
        .datepicker-panel ul:nth-child(1) > li:nth-child(2){
            height: 37px;
            font-size: 12pt;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80%;
        }
        .datepicker-panel ul:nth-child(2) li{
            height: 67px;
            min-width: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12pt;
            color: #999999;
        }
        .datepicker-panel ul:nth-child(3) li{
            height: 67px;
            min-width: 78px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #9999;
            font-size: 12pt;
            color: #999999;
        }
        .datepicker-panel ul:nth-child(3) .muted{
            background: #DDEEFF;
        }
        .datepicker-panel ul:nth-child(3) .highlighted{
            color: #fff;
            background: #008CFF;
        }
        .datepicker-panel ul:nth-child(3) .picked{
            border:1pt solid #FF0000;
        }
    </style>
@endpush
@push('js')
    <script src="{{asset('assets/js/datepicker.js')}}"></script>
    <script>
        $('.close-A015-choose_date').click(function () {
            $('.popup-A015-save-share').removeClass('hidden');
            $('.popup-A015-choose_date').addClass('hidden');
        })
        $('.datepicker-a015').datepicker({
            container:'.docs-datepicker-container',
            inline:true
        });
        $('.initiative-accept').click(function(){
            var url = '{{ route("sakuraUpdateScheduled") }}';
            var date = new Date($('.datepicker-a015').datepicker('getDate'));
            var scheduledDate = date.getFullYear()+'年 '+((date.getMonth() + 1) < 10 ? '0'+(date.getMonth()+1): (date.getMonth()+1))+'月 '+(date.getDate() < 10 ? '0'+date.getDate(): date.getDate())+'日';
            date = date.getFullYear()+'-'+(date.getMonth() + 1)+'-'+date.getDate();
            $.ajax({
                url,
                data: {
                    scheduled:date
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('.popup-A015-choose_date').addClass('hidden');
                        $('.current-time').html(scheduledDate);
                        console.log(response);
                    }else{
                        alert(response.message);
                    }
                },
                error: function (xhr) {
                    alert('error')
                }
            });
        })
    </script>
@endpush
