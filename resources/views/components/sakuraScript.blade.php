@push('js')
    <script>
        var manager_scre = `@include('components.sakuraSet_manager')`;
        var globalBtn = '';
        $('.cancal-sharing').click(function (){
            if($(this).hasClass('had-change')){
                return false;
            }
            var member_id = $(this).data('id');
            $('.popup-wrapper .popup-content .content').html('振り返り担当者との共有を解除しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">確認</button>');
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-confirm_delete_sharing_from_pic');
            $('body').addClass('ovf-hidden');
            $('.btn-popup-accept').attr('data-id',member_id);
        })

        $('body').on('click','.reviewer',function (){
            var nth = $(this).attr('class');
            var classes = nth.split(' ');
            var lastClass = classes[classes.length - 1];
            var member_id = $(this).data('id');
            $('.popup-wrapper').removeClass('hidden');
            $('.popup-wrapper .popup-content .content').html('振り返り担当者の申請がありました。<br>承認しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">承認確認</button>')
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('body').addClass('ovf-hidden');
            $('.btn-popup-accept').attr('data-id',member_id);
            $('.btn-popup-accept').addClass('btn-popup-agree_to_register_pic');
            $('.btn-popup-agree_to_register_pic').attr('elm',lastClass);
        })
        $('body').on('click','.btn-popup-agree_to_register_pic',function(){
            var that = $('.'+$(this).attr('elm'));
            var member_id = $('.'+$(this).attr('elm')).data('id');
            $.ajax({
                url: '{{ route("sakuraUpdate") }}',
                data: {
                    reviewer_status : 2,
                    view:'agree_to_register_pic',
                    member_id
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function(response) {
                    if(response.success){
                        $('.popup-wrapper').addClass('hidden');
                        $('body').removeClass('ovf-hidden');
                        toastr.options.timeOut = 3000;
                        toastr.info('申請を承認しました');
                        $('.btn-popup-accept').removeClass().addClass('btn-popup-accept');
                        that.removeClass('reviewer').removeClass('btn-eff-gre').addClass('btn-eff-pri').addClass('sharing');
                        that.prev('span').addClass('become-manager');
                        that.html('共有中');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
        $('body').on('click','.sharing',function (){
            var member_id = $(this).data('id');
            globalBtn = $(this);
            $('.popup-wrapper .popup-content .content').html('振り返り担当者としての共有を解除しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">確認</button>')
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('body').addClass('ovf-hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-cancel_sharing_from_pic');
            $('.btn-popup-accept').attr('data-id',member_id);
        })

        $('body').on('click','.accept-cancel',function () {
            var member_id = $(this).data('id');
            $('.popup-wrapper .popup-content .content').html('実施者から振り返り担当者解除の申請がありました。承認しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">承認確認</button>')
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('body').addClass('ovf-hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-cancel_sharing_from_member');
            $('.btn-popup-accept').attr('data-id',member_id);
        })

        $('body').on('click','.become-manager',function () {
            var member_id = $(this).next().data('id');
            var nameMember = $(this).text();
            $.ajax({
                url: '{{ route("sakuraSheet") }}',
                data: {
                    member_id
                },
                type: 'GET',
                success: function(response) {
                    $('.become-manager-screen .title-manager .name-member').html(nameMember);
                    if(response.success){
                        for (const key in response.data) {
                            $('.'+key).removeClass('hidden');
                            var link = '';
                            if(response.data[key] !== null && response.data[key].hasOwnProperty('member_id')){
                                link = '/storage/upload/'+response.data[key].member_id+'/'+key.toLowerCase()+'/'+response.data[key].file_name;
                            }
                            var base_url = $('.base_url').attr('value');
                            if(link !== ''){
                                $('.'+key+' .confirmation').attr('link',base_url+link);
                                $('.'+key+' .'+key+'-upload').attr('member_id',response.data[key].member_id);
                            }else{
                                $('.'+key+' .confirmation').addClass('disabled');
                                $('.'+key+' .'+key+'-upload').attr('member_id',member_id);
                            }
                            if(key === 'reflectionsheet'){
                                var html = '';
                                response.data.reflectionsheet.forEach((element,i) => {
                                    var name = '6か月目';
                                    var name_folder = '6m';
                                    if(element.class == 1){
                                        name = '12か月目';
                                        name_folder = '12m'
                                    }else if(element.class == 2){
                                        name = '随時';
                                        name_folder = 'at';
                                    }
                                    if(element !== null){
                                        link = '/storage/upload/'+element.member_id+'/'+key.toLowerCase()+'/'+name_folder+'/'+element.file_name;
                                    }
                                    html += '<div class="flex-column">'+
                                                '<div class="sub-title">'+
                                                    '<button>'+name+'</button>'+
                                                    '</div>'+
                                                '<div class="flex-between">'+
                                                    '<button class="confirmation '+(link === '' ? 'disabled' : '')+'" link="'+base_url+link+'">確認</button>'+
                                                    '<button class="swp">実施者と共有</button>'+
                                                    '<input class="hidden reflectionsheet-upload" type="file" at="'+name_folder+'" member_id="'+element.member_id+'">'+
                                                '</div>'+
                                            '</div>';
                                });
                                $('.'+key).html(html);
                            }
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
            $('.popup-wrapper .popup-content .header-content').html('');
            $('.popup-wrapper .popup-footer').addClass('hidden');
            $('.popup-wrapper .popup-content .content').html(manager_scre);
            $('.popup-wrapper').removeClass('hidden');
            $('body').addClass('ovf-hidden');
        })
        
        $('body').on('click','.btn-popup-confirm_delete_sharing_from_pic',function (){
            const checkLast = $(this).attr('last-confirm');
            if(checkLast && checkLast === 'true'){
                $('.popup-wrapper .popup-content .content').html('');
                $('.popup-wrapper .popup-content .header-content').html('');
                $('.popup-wrapper').addClass('hidden');
                $(this).removeAttr('last-confirm');
                $('.btn-popup-accept').removeClass('btn-popup-confirm_delete_sharing_from_pic');
                var member_id = $(this).attr('data-id');
                var data = {
                    reviewer_status : 3,
                    view:'confirm_delete_sharing_from_pic',
                    member_id
                }
                $.ajax({
                    url: '{{ route("sakuraUpdate") }}',
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    success: function(response) {
                        if(response.success){
                            $('.pull-right button').html('解除依頼中').addClass('had-change');
                            $('.btn-popup-accept').removeClass().addClass('btn-popup-accept').removeAttr('last-confirm');
                            toastr.options.timeOut = 3000;
                            toastr.info('共有解除を申請しました');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
                $('body').removeClass('ovf-hidden');
            }else{
                $('.popup-wrapper .popup-content .content').html('本当に共有を解除しますか？');
                $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">最終確認</button>');
                $(this).attr('last-confirm',true);
            }
        })
        $('body').on('click','.btn-popup-cancel_sharing_from_member',function (){
            const checkLast = $(this).attr('last-confirm');
            if(checkLast && checkLast === 'true'){
                $('.popup-wrapper .popup-content .content').html('');
                $('.popup-wrapper .popup-content .header-content').html('');
                $('.popup-wrapper').addClass('hidden');
                $(this).removeAttr('last-confirm');
                $('.btn-popup-accept').removeClass('btn-popup-cancel_sharing_from_member');
                var isload = false;
                var member_id = $(this).attr('data-id');
                var data = {
                    view:'cancel_sharing_from_member',
                    member_id
                }
                $.ajax({
                    url: '{{ route("sakuraDelete") }}',
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    success: function(response) {
                        if(response.success){
                            toastr.options.timeOut = 3000;
                            toastr.info('共有解除申請を承認しました');
                            $('.sakuraSet-sideBar ul').remove();
                            $('.botton-navigate .pull-left ul li:nth-child(1)').html('')
                            $('.botton-navigate .pull-left ul li:nth-child(2)').html('未申請')
                            $('.botton-navigate .pull-right').html('')
                            $('.btn-popup-accept').removeClass().addClass('btn-popup-accept').removeAttr('last-confirm');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
                $('body').removeClass('ovf-hidden');
            }else{
                $('.popup-wrapper .popup-content .content').html('本当に承認しますか？');
                $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">最終確認</button>');
                $(this).attr('last-confirm',true);
            }
        })
        $('body').on('click','.btn-popup-cancel_sharing_from_pic',function (){
            const checkLast = $(this).attr('last-confirm');
            if(checkLast && checkLast === 'true'){
                $('.popup-wrapper .popup-content .content').html('');
                $('.popup-wrapper .popup-content .header-content').html('');
                $('.popup-wrapper').addClass('hidden');
                $(this).removeAttr('last-confirm');
                $('.btn-popup-accept').removeClass('btn-popup-cancel_sharing_from_pic');
                var isload = false;
                var member_id = $(this).attr('data-id');
                var data = {
                    reviewer_status : 4,
                    view:'cancel_sharing_from_pic',
                    member_id
                }
                $.ajax({
                    url: '{{ route("sakuraUpdate") }}',
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    success: function(response) {
                        if(response.success){
                            globalBtn.removeClass('sharing').removeClass('btn-eff-pri').addClass('btn-eff-red').addClass('cancel');
                            globalBtn.html('解除申請');
                            $('.btn-popup-accept').removeClass().addClass('btn-popup-accept').removeAttr('last-confirm');
                            toastr.options.timeOut = 3000;
                            toastr.info('共有解除を申請しました');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
                $('body').removeClass('ovf-hidden');
            }else{
                $('.popup-wrapper .popup-content .content').html('本当に共有を解除しますか？');
                $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">最終確認</button>');
                $(this).attr('last-confirm',true);
            }
        })
        $('body').on('click','.btn-off-popup',function (e){
            $('.popup-wrapper .popup-content .header-content').html('');
            $('.popup-wrapper .popup-content .content').html('');
            $('.popup-wrapper').addClass('hidden');
            $('.btn-popup-accept').removeAttr('last-confirm');
            $('body').removeClass('ovf-hidden');
        })
        $('body').on('click','.facesheet .confirmation',function (e) {
            var url = $(this).attr('link');
            var name = url.substring(url.lastIndexOf('/')+1);
            downloadFile(url,name);
        })
        $('body').on('click','.initiative .confirmation',function (e) {
            var url = $(this).attr('link');
            var name = url.substring(url.lastIndexOf('/')+1);
            downloadFile(url,name);
        })
        $('body').on('click','.reflectionsheet .confirmation',function (e) {
            var url = $(this).attr('link');
            var name = url.substring(url.lastIndexOf('/')+1);
            downloadFile(url,name);
        })
        $('body').on('click','.facesheet .swp',function (e) {
            $('.facesheet-upload').click();
        })
        $('body').on('click','.initiative .swp',function (e) {
            $('.initiative-upload').click();
        })
        $('body').on('change', '.facesheet-upload',function(e){
            var url = '{{ route("sakuraBackup") }}';
            var files = $(this)[0].files;
            var fd = new FormData();
            fd.append('file',files[0]);
            fd.append('member_id',$(this).attr('member_id'));
            fd.append('backup_type','facesheet');
            backupWithNewSWP(url,fd);
        })
        $('body').on('change','.initiative-upload',function (e) {
            var url = '{{ route("sakuraBackup") }}';
            var files = $(this)[0].files;
            var fd = new FormData();
            fd.append('file',files[0]);
            fd.append('member_id',$(this).attr('member_id'));
            fd.append('backup_type','initiative');
            backupWithNewSWP(url,fd);
        })
        $('body').on('click','.reflectionsheet .swp',function (e) {
            $(this).next('input').click();
        })
        $('body').on('change','.reflectionsheet-upload',function (e) {
            var url = '{{ route("sakuraBackup") }}';
            var files = $(this)[0].files;
            var fd = new FormData();
            fd.append('file',files[0]);
            fd.append('member_id',$(this).attr('member_id'));
            fd.append('at',$(this).attr('at'));
            fd.append('backup_type','reflectionsheet');
            backupWithNewSWP(url,fd);
        })
        function downloadFile(url,name){
            var link = document.createElement("a");
            link.download = name;
            link.href = url;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
        }
        function backupWithNewSWP(url,data){
            $.ajax({
                url,
                data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if(response.success){

                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
        $('.registerReviewerForm form').submit(function(e){
            e.preventDefault();
            var form = $(this).parents('.registerReviewerForm').find('form');
            var login_id = form.find('.login_id').val();
            var first_name = form.find('.first_name').val();
            var last_name = form.find('.last_name').val();
            var url = form.attr('action');
            $.ajax({
                url, 
                data: {
                    login_id,
                    first_name,
                    last_name
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function(response) {
                    if(response.success){
                        var res = response.data[0];
                        var fullName = res.name1+' '+res.name2;
                        $('.result_search').val(fullName).attr('member_id',res.login_id).attr('email',res.email);
                        $('.resultReviewerInfo .apply').removeClass('disabled');
                    }else{
                        toastr.options.timeOut = 3000;
                        toastr.info('振り返り担当者が見つかりません。');
                        $('.result_search').val('').removeAttr('member_id').removeAttr('email');
                        $('.resultReviewerInfo .apply').addClass('disabled');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
        $('.resultReviewerInfo .apply').click(function(e){
            var name_reviewer = $('.result_search').val();
            var member_id = $('.result_search').attr('member_id');
            var email = $('.result_search').attr('email');
            var url = '{{ route("addMemberToReview") }}';
            $.ajax({
                url,
                data: {
                    member_id,
                    email
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function(response) {
                    if(response.success){
                        $('.result_search').val();
                        $('.result_search').removeAttr('member_id');
                        $('.result_search').removeAttr('email');
                        $('.resultReviewerInfo .apply').addClass('disabled');
                        toastr.options.timeOut = 3000;
                        toastr.info(name_reviewer+' に振り返り担当を申請しました。');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
    </script>
@endpush
