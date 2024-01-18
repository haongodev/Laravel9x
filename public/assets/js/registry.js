$('#registry').on('click', '.branch-question', function (e) {
    var this_choose = $(this);
    var isGetQuestion = true;
    var question_option_setting_id = this_choose.data('question-option-setting-id');
    var parent_question_id = this_choose.data('parent-question-id');
    if (this_choose.attr('type') == 'checkbox') {
        if (this_choose.is(':checked') == false) {
            removeQuestion(this_choose)
            isGetQuestion = false;
        }
    }

    if (this_choose.attr('type') == 'radio') {
        var parent_div = this_choose.closest('div.input-group');
        $(parent_div).find('input[type="radio"]').each(function () {
            if ($(this).is(':checked') == false) {
                removeQuestion($(this))
            }
        })
    }
    $(this).closest('.input-group > .group-control').children('label').removeClass('text-danger');
    if (isGetQuestion) {
        getQuestionBranch(this_choose, question_option_setting_id)
    }
})
$('#registry').on('change', '.select-branch-question', function (e) {
    var this_choose = $(this);
    var id = $(this).attr('id');
    $(this).closest('.input-group > .group-control').children('label').removeClass('text-danger');
    $('#' + id + '>option').each(function (index) {
        var current_id = $(this).data('question-option-setting-id');

        if (!$(this).is(':selected')) {
            removeQuestion($(this))
        } else {
            if ($('#registry').find('.before-question-id-' + current_id).length == 0) {
                getQuestionBranch(this_choose, current_id)
            }

        }

    });

})

function getQuestionBranch(this_choose, question_option_setting_id) {
    $.ajax({
        type: "post",
        url: $('#urlGetQuestion').val(),
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {question_option_setting_id: question_option_setting_id},
        success: function (data) {
            nextQuestion(this_choose, data)
        },
    });
}

function nextQuestion(this_choose, data) {
    var current_question_id = this_choose.closest('div.input-group').data('current-question-id');
    if(data.html != ''){
        hiddenButton();
        $('.first-child-question-id-' + current_question_id).append(data.html)
    }

    //  this_choose.closest('div.input-group').after(data.html)
}

function removeQuestion(this_choose) {
    var current_question_id = this_choose.closest('div.input-group').data('current-question-id');
    var current_id = this_choose.data('question-option-setting-id');
    //if checkbox exist child when remove
    if ($('.first-child-question-id-' + current_question_id).find('.before-question-id-' + current_id).html()) {
        $('.first-child-question-id-' + current_question_id).find('.before-question-id-' + current_id).closest('.first-div').remove();
       //  $('.first-child-question-id-' + current_question_id).find('.first-div').each(function (index, obj) {
       //      $(this).remove();
       //  });
    }

}

$('#registry').on('keyup','.auto_grow', function (){
    var lineCount = this.value.split("\n").length;
    if (lineCount > 10) {
        this.rows = lineCount;
    }else{
        this.rows = 10;
    }
})

$('#registry').on('change','.date-register', function (){
    var question_setting_id = $(this).closest('div.input-group').data('current-question-id');
    var date_start = $('input[name="question['+question_setting_id+'][start]"]').val();
    var date_end = $('input[name="question['+question_setting_id+'][end]"]').val();
    if(date_start == ''){
        $('input[name="question['+question_setting_id+'][start]"]').val(date_end);
    }
    if(date_end == ''){
        $('input[name="question['+question_setting_id+'][end]"]').val(date_start);
    }
})

$(".select-chosen").chosen({
    no_results_text: "Oops, nothing found!",
    "disable_search": true
});

function getQuestionLink(current_id) {
    hiddenButton();
    $.ajax({
        type: "post",
        url: $('#urlGetLinkQuestion').val(),
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {question_setting_id: current_id},
        success: function (data) {

            if(data.isQuestionInput){
                $('.question-link-id-'+current_id).closest('.input-group').addClass('question-input')
            }
            if(data.html != ''){
                hiddenButton();
                $('.question-link-id-'+current_id).append(data.html)
            }

        },
    });
}

$('.submit-btn').click(function () {
    var form = $(this).closest('form');
    var form_id = form.attr('id');
   // var required = validate_required(form);
   // var not_view_video = validate_view_video(form)

    if(!validate_required(form)){
        return false;
    }else if(!validate_view_video(form)){
        return  false;
    }else if(!validate_date_system(form)){
        return  false;
    }else if(!check_duplicate_answer(form)){
        return  false;
    }else{
        window.onbeforeunload = null;
        localStorage.removeItem("myCredit");
        $('#'+form_id).submit();
    }
})


function validate_required(form)
{
    var validate = true;
    form.find('.title-required-1').each(function () {
        $(this).removeClass('text-danger');
        var required = true;
        var question_id = $(this).data('question-id');
        var this_input = $('input[name="question[' + question_id + ']"]');
        var this_checkbox = $('input[name="question[' + question_id + '][]"]');
        var this_textarea = $('textarea[name="question[' + question_id + ']"]');
        var this_select = $('select[name="question[' + question_id + ']"]');
        var this_date_start =  $('input[name="question[' + question_id + '][start]"]');
        var this_date_end =  $('input[name="question[' + question_id + '][end]"]');
        if (this_input.html() != undefined) {
            var this_type = this_input.attr('type');
            if (
                (this_type == 'text' && this_input.val().trim() == '') ||
                (this_type == 'input' && this_input.val().trim() == '') ||
                (this_type == 'radio' && !this_input.is(':checked')) ||
                (this_type == 'date' && this_input.val().trim() == '')
            ) {
                required = false;
                validate = false;
            }
        } else if (this_checkbox.html() != undefined) {
            if (!this_checkbox.is(':checked')) {
                required = false;
                validate = false;
            }
        } else if (this_textarea.html() != undefined) {
            if (this_textarea.val().trim() == '') {
                required = false;
                validate = false;
            }
        } else if (this_select.html() != undefined) {
            if (this_select.val() == '') {
                required = false;
                validate = false;
            }

        }else if(this_date_start.html() != undefined){
            if(this_date_start.val() == '' || this_date_end.val() == ''){
                required = false;
                validate = false;
            }
        }
        if(!required){
            $(this).addClass('text-danger');
        }
    });
    if(!validate){
        toastr.options.timeOut = 6000;
        toastr.info('未回答の項目があります。')
    }
    return validate
}
function check_duplicate_answer(form)
{
    var form_id = form.attr('id');
    var data = $('#'+form_id).serialize();

    $.ajax({
        'async': false,
        type: "post",
        url: $('#urlCheckDuplicateAnswer').val(),
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        success: function ({data}) {
            if(data.length > 0){
                if($('.is_duplicheck').length != data.length){
                    validate = true;
                }else{
                    toastr.options.timeOut = 6000;
                    toastr.warning('本年度に同じ内容で単位登録されています。<br>同一年度内で同じ内容での登録はできません。');
                    data.forEach(element => {
                        var current_input = element.input_method;
                        if($('#checkbox'+current_input).length){
                            $('#checkbox'+current_input).closest('.input-group > .group-control').children('label').addClass('text-danger');
                        }
                        if($('.input-method-'+current_input).length && !element.hasOwnProperty('id')){
                            $('.input-method-'+current_input).each(function (indexInArray, valueOfElement) { 
                                if($.trim($(valueOfElement).parents('.group-control').children('label').text()) === element.title){
                                    $(valueOfElement).parents('.group-control').children('label').addClass('text-danger');
                                    toastr.options.timeOut = 6000;
                                    toastr.warning('A（※'+element.title+'）との間隔はB（※'+element.interval_month+'月）以上空ける必要があります。');
                                }
                            });
                        }
                        if($('.select-branch-question-'+element.original_question_id).length){
                            $('.select-branch-question-'+element.original_question_id).each(function (indexInArray, valueOfElement) { 
                                if($.trim($(valueOfElement).parents('.group-control').children('label').text()) === element.title){
                                    $(valueOfElement).parents('.group-control').children('label').addClass('text-danger');
                                }
                            });
                        }
                    });
                    validate =  false;
                }
            }else{
                validate = true;
            }

        },
    });
    return validate
}

function validate_view_video(form)
{
    var form_id = form.attr('id');
    var data = $('#'+form_id).serialize();

    $.ajax({
        'async': false,
        type: "post",
        url: $('#urlValidateViewVideo').val(),
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        success: function (data) {
            if(data.isViewCheck){
                toastr.options.timeOut = 6000;
                // toastr.info('（'+data.videoName+'）は既に視聴している動画です。')
                toastr.info('本動画は今年度既に単位登録されています（１年度に１回のみ単位登録可）')
                validate =  false;
            }else{
                validate = true;

            }

        },
    });
    return validate
}

function validate_date_system(form)
{
    const now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth();
    var validate = true;
    form.find('.validate-date').each(function () {
        var value = $(this).val();
        if($(this).hasClass('input-method-10')){
            var year_system = month > 3 ? year : year-1
            if(value != '' && value > year_system){
                validate = false;
                $(this).closest('.group-control').find('.title').addClass('text-danger');
            }
        }else if(value != ''){
            var dateForm = new Date(value);
            if(dateForm > now){
                validate = false;
                $(this).closest('.group-control').find('.title').addClass('text-danger');
            }
        }

    })
    if(!validate){
        toastr.options.timeOut = 6000;
        toastr.info('未来日は登録できません。')
    }
    return validate
}


function showButton(){
    $('#registry').find('.submit-btn').removeClass('hidden');
}

function hiddenButton(){
    $('#registry').find('.submit-btn').addClass('hidden');
}


$('#registry').on('keyup','.count-length', function (){
    var value = $(this).val();
    $(this).closest('div').find('.input-length').find('.number').html(value.length);

})

$("body").on("click",".is_desc",function(){
    var desc = $(this).attr('data_desc');
    $('.popup-desc').removeClass('hidden');
    $('.popup-desc .content').html(desc);
})
$("body").on("click",".is_desc_blank",function(){
    var desc = $(this).attr('data_desc');
    var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;
    // Open a new window with full width and height
    var newWindow = window.open(desc, '_blank', 'width=' + screenWidth + ',height=' + screenHeight);
    if (newWindow) {
        newWindow.focus();
    }
})
$("body").on("click",".popup-desc",function(e){
    if(!$(e.target.parentElement).hasClass("popup-desc")){
        $('.popup-desc').addClass('hidden');
        $('.popup-desc .content').html('');
    }
})