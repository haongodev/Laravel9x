@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="breadcrumb-title">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <button class="btn-title btn-success">管理ユーザー詳細</button>
            </div>
            {{--            <div class="col-sm-12 col-md-6 text-end">--}}
            {{--                <button class="btn btn-white me-2"--}}
            {{--                        onclick="window.location.href='{{route('admin.member.user.edit',['user_id'=>$user->id])}}'">--}}
            {{--                    編集--}}
            {{--                </button>--}}
            {{--            </div>--}}
        </div>
    </div>
    <div class="container">
        <form action="{{route('admin.member.user.update',['user_id'=>$user->id ?? null])}}">
            <div class="row">
                <input type="hidden" name="id" value="{{$user->id ?? null}}">
                <table class="member">
                    <tr>
                        <th>ID</th>
                        <td colspan="2">{{$user->login_id}}</td>
                        <input type="hidden" name="login_id" value="{{$user->login_id}}">
                    </tr>
                    <tr>
                        <th>氏名</th>
                        <td colspan="2">{{$user->name}}</td>
                        <input type="hidden" name="name" value="{{$user->name}}">
                    </tr>
                    <tr>
                        <th>属性</th>
                        <td colspan="2">{{config('constants.userAttribute')[$user->attribute] ?? ''}}</td>
                        <input type="hidden" name="attribute" value="{{$user->attribute}}">
                    </tr>
                    <tr>
                        <th>管理者区分</th>
                        <td colspan="2">{{config('constants.userManagerClass')[$user->manager_class] ?? ''}}</td>
                        <input type="hidden" name="manager_class" value="{{$user->manager_class}}">
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td colspan="2">********</td>
                        <input type="hidden" name="password" value="{{$user->password}}">
                    </tr>
                </table>
                <div class="d-grid gap-2 col-2 mx-auto mt-3">
                    <button class="btn btn-white edit-user" type="button">更新</button>
                </div>

                <div class="table-footer row mt-3">
                    <div class="col-sm-12 md-3 col-md-2">
                        <div class="row">
                            <button class="btn btn-white" type="button"
                                    onclick="window.location.href='{{ isset($user->id) ? route('admin.member.user.edit',['user_id'=>$user->id]) : route('admin.member.user.create')}}'">
                                戻る
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @include('admin.components.edit_manager_user_success_popup')
    </div>
@endsection
@push('js')
    <script>
        $('.edit-user').click(function () {
            var form = $(this).closest('form');
            var data = form.serialize();
            var url = form.attr('action');
            var name = form.find('input[name="name"]').val();
            console.log(url);
            $.ajax({
                type: "post",
                url: url,
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                success: function (data) {
                    if (data.success) {
                        $('#changeUserSuccessModal').find('.content').html('管理ユーザー：' + name + '　を変更しました')
                        var myModal = new bootstrap.Modal(document.getElementById('changeUserSuccessModal'))
                        myModal.show();
                    }
                },
            });

        })
    </script>
@endpush
