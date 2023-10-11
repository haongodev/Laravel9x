// window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ':6001',
    client: io
});

var roomId = $('.room_id').attr('value');
if(roomId){
    window.Echo.private('sakura.'+roomId).listen('SakuraShare', (event) => {
        console.log(event);
        var base_url = $('.base_url').attr('value');
        if(event.sakura.hasOwnProperty('from') && event.sakura.from === 'teach'){
            if(event.sakura.class !== null){
                console.log(event);
                $('.'+event.sakura.popup).find('.table-manager-class-'+event.sakura.class).find('.sharing').parent('td').next().find('a').attr('href',base_url+'/'+event.sakura.url);
            }else{
                $('.'+event.sakura.popup).find('.sharing').parent('td').next().find('a').attr('href',base_url+'/'+event.sakura.url);
            }
        }else{
            var classRef = '';
            if(event.sakura.hasOwnProperty('class')){
                classRef = '6m';
                if(event.sakura.class == 1){
                    classRef = '12m'
                }else if(event.sakura.class == 2){
                    classRef = 'at';
                }
            }
            var fullPathpath = base_url+'/storage/upload/'+event.sakura.member_id+'/'+event.sakura.type+(classRef !== '' ? '/'+classRef+'/' :'/')+event.sakura.file_name;
            if($('.become-manager-screen').length){
                if(parseInt(event.sakura.share_flg ) > 0){
                    // change current url
                    if(event.sakura.type == 'reflectionsheet'){
                        $('.'+event.sakura.type+' .reflec_'+event.sakura.class).removeClass('hidden');
                        $('.'+event.sakura.type+' .reflec_'+event.sakura.class+' .confirmation').removeClass('disabled').attr('link',fullPathpath);
                    }else{
                        $('.'+event.sakura.type+' .confirmation').removeClass('disabled').attr('link',fullPathpath);
                        $('.'+event.sakura.type).removeClass('hidden');
                    }
                }else{
                    // disable url
                    if(event.sakura.type == 'reflectionsheet'){
                        $('.'+event.sakura.type+' .reflec_'+event.sakura.class).addClass('hidden');
                        $('.'+event.sakura.type+' .reflec_'+event.sakura.class+' .confirmation').addClass('disabled').removeAttr('link');
                    }else{
                        $('.'+event.sakura.type).addClass('hidden');
                        $('.'+event.sakura.type+' .confirmation').addClass('disabled').removeAttr('link');
                    }
                }
            }
        }
    });   
}