<tr class="initiativetable-id-{{$initiativetableManager->id}}">
    <td class="w-100px" >
        <div class="share-initiativetable manager title-popup btn-list {{$initiativetableManager->share_flg ? 'sharing btn-eff-pri' : 'none-share btn-eff-ora'}} btn-hov"
             data-current-share="{{$initiativetableManager->share_flg}}"
             data-id="{{$initiativetableManager->id}}"
             data-display-name="{{$initiativetableManager->display_name}}"
             data-popup="A015"
        >共有</div>
    </td>
    <td>
        <div class="manager btn-eff-ora btn-hov"><a download class="download" href="{{config('constants.path_upload').'/'.auth()->user()->user_add_info->login_id.'/initiative/'.$initiativetableManager->file_name}}">{{$initiativetableManager->display_name}}</a></div>
    </td>


    <td class="w-100px">
        <div class="remove" data-id="{{$initiativetableManager->id}}"
             data-display-name="{{$initiativetableManager->display_name}}"
        >
            @if(!$initiativetableManager->share_flg)<img src="{{ asset('assets') }}/images/icon/delete.png" alt="close icon">@endif
        </div>
    </td>
</tr>
