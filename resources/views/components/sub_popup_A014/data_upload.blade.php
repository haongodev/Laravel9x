<tr class="reflectionsheet-id-{{$reflectionSheetManager->id}}">
    <td style="width: 100px">
        <div
            class="share-reflectionsheet manager {{$reflectionSheetManager->share_flg ? 'share btn-eff-pri' : 'btn-eff-ora'}}"
            data-current-share="{{$reflectionSheetManager->share_flg}}"
            data-id="{{$reflectionSheetManager->id}}"
            data-display-name="{{$reflectionSheetManager->display_name}}"
        >共有
        </div>
    </td>
    <td>
        <?php $pathClass = $reflectionSheetManager->class == 2 ? 'at' : ($reflectionSheetManager->class == 1 ? '12m' : '6m') ?>
        <div class="manager btn-eff-ora"><a download class="download" href="{{config('constants.path_upload').'/'.auth()->user()->user_add_info->login_id.'/reflectionsheet/'.$pathClass.'/'.$reflectionSheetManager->file_name}}">{{$reflectionSheetManager->display_name}}</a></div>
    </td>
    <td style="width: 100px">
        <div class="remove" data-id="{{$reflectionSheetManager->id}}"
             data-display-name="{{$reflectionSheetManager->display_name}}"
        >
            @if(!$reflectionSheetManager->share_flg)<img
                src="{{ asset('assets') }}/images/icon/delete.png" alt="close icon">@endif
        </div>
    </td>
</tr>
