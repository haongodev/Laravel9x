<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="changeUserSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-center m-auto fw-bold"></h5>
                <button type="button" class="close"
                        onclick="window.location.href='{{route('admin.member.user.manage')}}'" data-bs-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <p class="content">管理ユーザー：XXXXXX　XXXX　を変更しました。</p>

                                <div class="d-grid gap-2 d-md-block">
                                    <button class="btn btn-white"
                                            onclick="window.location.href='{{route('admin.member.user.manage')}}'"
                                            type="button">はい
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

