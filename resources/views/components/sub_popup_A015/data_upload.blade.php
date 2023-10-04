<div class="initiativetable-id-{{$initiativetableManager->id}}">
    <button class="share-initiativetable title-popup btn-list {{$initiativetableManager->share_flg ? 'sharing btn-eff-pri' : 'none-share btn-eff-ora'}} btn-hov" data-current-share="{{$initiativetableManager->share_flg}}" data-id="{{$initiativetableManager->id}}" data-display-name="{{$initiativetableManager->display_name}}" data-popup="A015">共有</button>
    <button class="title-popup btn-list btn-eff-ora btn-hov" data-popup="A015"><a download class="download" href="{{config('constants.path_upload').'/'.auth()->user()->user_add_info->login_id.'/initiative/'.$initiativetableManager->file_name}}">{{$initiativetableManager->display_name}}</a></button>
    @if(!$initiativetableManager->share_flg)<img src="{{ asset('assets') }}/images/icon/delete.png" class="remove" data-id="{{$initiativetableManager->id}}" data-display-name="{{$initiativetableManager->display_name}}" alt="close icon">
    @else
    <div style="width:50px"></div>
    @endif
</div>
