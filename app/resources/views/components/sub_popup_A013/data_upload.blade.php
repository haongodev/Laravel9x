<tr class="facesheet-id-{{$faceSheetManager->id}}">
    <td class="w-100px" >
        <div class="share-facesheet manager {{$faceSheetManager->share_flg ? 'sharing btn-eff-pri' : 'btn-eff-ora'}} btn-hov"
             data-current-share="{{$faceSheetManager->share_flg}}"
             data-id="{{$faceSheetManager->id}}"
             data-display-name="{{$faceSheetManager->display_name}}"
             style=""
        >共有</div>
    </td>
    <td>
        <div class="manager btn-eff-ora btn-hov"><a download class="download" href="{{config('constants.path_upload').'/'.auth()->user()->user_add_info->login_id.'/facesheet/'.$faceSheetManager->file_name}}">{{$faceSheetManager->display_name}}</a></div>
    </td>


    <td class="w-100px">
        <div class="remove" data-id="{{$faceSheetManager->id}}"
             data-display-name="{{$faceSheetManager->display_name}}"
        >
            @if(!$faceSheetManager->share_flg)<img src="{{ asset('assets') }}/images/icon/delete.png" alt="close icon">@endif
        </div>
    </td>
</tr>
