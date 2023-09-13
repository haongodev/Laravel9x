$('#registry').on('click', '.branch-question', function (e) {
    var this_choose = $(this);
    var isGetQuestion = true;
    var question_option_setting_id = this_choose.data('question-option-setting-id');
    var parent_question_id = this_choose.data('parent-question-id');
    if (this_choose.attr('type') == 'checkbox') {
        if (this_choose.is(':checked') == false) {
            removeAlertInputMethod9(question_option_setting_id);
            removeQuestion(this_choose)
            isGetQuestion = false;
        }
    }

    if (this_choose.attr('type') == 'radio') {
        var parent_div = this_choose.closest('div.input-group');
        $(parent_div).find('input[type="radio"]').each(function () {
            if ($(this).is(':checked') == false) {
                removeAlertInputMethod9(question_option_setting_id);
                removeQuestion($(this))
            }
        })
    }

    console.log(question_option_setting_id);
    if (isGetQuestion) {
        getQuestionBranch(this_choose, question_option_setting_id)
    }
})
$('#registry').on('change', '.select-branch-question', function (e) {
    var this_choose = $(this);
    var id = $(this).attr('id');
    $('#' + id + '>option').each(function (index) {
        var current_id = $(this).data('question-option-setting-id');

        if (!$(this).is(':selected')) {
            removeAlertInputMethod9(current_id);
            removeQuestion($(this))
        } else {
            if ($('#registry').find('.before-question-id-' + current_id).length == 0) {
                console.log('add', current_id);
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
    }else{
        $('#'+form_id).submit();
    }


})

function removeAlertInputMethod9(option_id){
    $('#checkbox'+option_id).removeClass('alert-input-method-9');
    $('#checkbox'+option_id).attr('alert-title','');
}

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

        console.log(question_id, required);
    });
    if(!validate){
        toastr.options.timeOut = 3000;
        toastr.info('未回答の項目があります。')
    }
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
                toastr.options.timeOut = 3000;
                toastr.info('（'+data.videoName+'）は既に視聴している動画です。')
                validate =  false;
            }else{
                validate = true;

            }

        },
    });
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
