<script>
    toastr.options.timeOut = 6000;
    toastr.warning('本年度に同じ内容で単位登録されています。<br>同一年度内で同じ内容での登録はできません。');
    var current_input = '{{$current_input}}';
    if($('#checkbox'+current_input).length){
        $('#checkbox'+current_input).closest('.input-group > .group-control').children('label').addClass('text-danger');
    }
</script>
