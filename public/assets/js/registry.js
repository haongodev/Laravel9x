$('#registry').on('click', '.branch-question', function (e) {
    var this_choose = $(this);
    var isGetQuestion = true;
    var question_setting_id = this_choose.data('question-option-setting-id');
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


    if (isGetQuestion) {
        getQuestionBranch(this_choose, question_setting_id)
    }
})
$('#registry').on('change', '.select-branch-question', function (e) {
    var this_choose = $(this);
    var id = $(this).attr('id');
    $('#' + id + '>option').each(function (index) {
        var current_id = $(this).data('question-option-setting-id');

        if (!$(this).is(':selected')) {
            removeQuestion($(this))
        } else {
            if ($('#registry').find('.before-question-id-' + current_id).length == 0) {
                console.log('add', current_id);
                getQuestionBranch(this_choose, current_id)
            }

        }

    });

})

function getQuestionBranch(this_choose, question_setting_id) {
    $.ajax({
        type: "post",
        url: $('#urlGetQuestion').val(),
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {question_setting_id: question_setting_id},
        success: function (data) {
            console.log(data);
            nextQuestion(this_choose, data)
        },
    });
}

function nextQuestion(this_choose, data) {
    var current_question_id = this_choose.closest('div.input-group').data('current-question-id');

    $('.first-child-question-id-' + current_question_id).append(data.html)
    //  this_choose.closest('div.input-group').after(data.html)
}

function removeQuestion(this_choose) {
    var current_question_id = this_choose.closest('div.input-group').data('current-question-id');
    var current_id = this_choose.data('question-option-setting-id');
    //if checkbox exist child when remove
    if ($('.first-child-question-id-' + current_question_id).find('.before-question-id-' + current_id).html()) {
        $('.first-child-question-id-' + current_question_id).find('.first-div').each(function (index, obj) {
            $(this).remove();
        });
    }

}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}
$(".select-chosen").chosen({no_results_text: "Oops, nothing found!"});
