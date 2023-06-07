<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>Ví dụ HTML đầu tiên - Chào mừng đến với Khóa học HTML cơ bản</title>
</head>
<style>
    /* Bảng điều khiển cho form */
    .form-control {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
    }

    /* Bao bọc cho label và form input */
    .form-group {
        width: 100%;
        margin-bottom: 15px; /* khoảng cách giữa các form input */
    }

    /* Thuộc tính của label */
    .form-label {
        display: inline-block;
        margin-bottom: 5px;
        font-size: 16px;
    }

    /* Thuộc tính của form input */
    .form-input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        font-size: 16px;
    }

    /* Hover state cho các form input */
    .form-input:focus {
        outline-color: #007bff;
    }

    /* Thuộc tính cho nút Đăng nhập */
    .form-submit-btn {
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #007bff;
        color: #fff;
        width: 100%;
        transition: background-color 0.3s ease-in-out;
    }

    /* Hover state cho nút Đăng nhập */
    .form-submit-btn:hover {
        background-color: #0062cc;
    }

    /* Dòng chân trên đáy của phần tử */
    hr {
        width: 100%;
        margin-bottom: 20px;
    }

</style>
<body>
<div style="width: 50%; align: center">
    @php@endphp
    @foreach($errors->all() as $error)
        {{$error}}
    @endforeach
    <form action="/login" method="post">
        @csrf
    <div class="form-control">
        <div class="form-group">
            <label for="username" class="form-label">Tên đăng nhập:</label>
            <input type="text" id="username" class="form-input" name="id" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" id="password" class="form-input" name="password" required>
            <span id="show-password" onclick="togglePassword()">Hiện mật khẩu</span>
        </div>
        <button type="submit" class="form-submit-btn">Đăng nhập</button>
        <hr>
    </div>
    </form>
</div>
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var showPasswordButton = document.getElementById("show-password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPasswordButton.innerHTML = "Ẩn mật khẩu";
        } else {
            passwordInput.type = "password";
            showPasswordButton.innerHTML = "Hiện mật khẩu";
        }
    }
</script>
</body>
</html>
