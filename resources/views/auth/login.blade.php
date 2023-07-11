@extends('layouts.web.main_without_login', ['pageSlug' => 'myPage'])

@section('content')

<div class="container-fluid mt-5">
    <div class="row d-flex align-items-center" style="height: 100%;">
        <div class="col-md-6 offset-md-3">
            <div class="">
                <div class="text-center">
                    <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
                </div>
                <form class="" action="/login" method="post">
                    @csrf
                    <div class="row no-gutters mt-4">
                        <label class="col-md-3 col-lg-2 col-sm-12 text-center" for="username">ID</label>
                        <div class=" col-md-9 col-lg-10 col-sm-12">
                        <input type="text" class="form-control" placeholder="" id="id" required
                               name="id">
                        </div>
                    </div>
                    <div class="row no-gutters mt-4">
                        <label class="col-md-3 col-lg-2 col-sm-12 text-center" for="password">パスワード</label>
                        <div class=" col-md-9 col-lg-10 col-sm-12" style="position: relative">
                        <input type="password" placeholder="" id="password" class="form-control"
                               name="password" required>
                            <div  id="show" class="show-password"></div>
                        </div>

                    </div>
                    @error('id')
                    <div class="row no-gutters mt-4">
                       <div class="col-md-9 offset-md-2"><span class="text-danger">{{$message}}</span></div>
                    </div>
                    @enderror
                    <div class="row no-gutters mt-4">
                        <div class="offset-lg-5 col-lg-12 col-md-7 offset-md-5 col-sm-7 offset-sm-5">
                            <input style="width: 150px" type="submit" value="ログイン" class="btn btn-block btn-primary m-auto">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#show').click(function(){
        var type = $('#password').attr('type');
        console.log(type);
        if (type === "password") {
            $('#password').attr('type','text')
            $(this).addClass('open')
        } else {
            $('#password').attr('type','password')
            $(this).removeClass('open')
        }
    })

</script>
</body>
</html>
@endsection
