<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Registration Form</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="login form">
            <header>ĐĂNG NHẬP TÀI KHOẢN ADMIN</header>
            <form action="#">
                <input type="text" id="username" name="username" placeholder="Tên đăng nhập:">
                <input type="password" id="password" name="password" placeholder="Mật khẩu:">
                <input type="button" class="button" id="dangnhap" value="Đăng nhập">
                <span id="message" style="color: red;"></span>
            </form>
        </div>
    </div>
    <!-- <label for="username">Tên đăng nhập:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="button" id="dangnhap">Đăng nhập</button>
    <span id="message" style="color: red;"></span>
    <a href="../../du_an1/admin/index.php" id="login_success" >12</a> -->
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dangnhap').click(function() {
            console.log("OK");
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: 'POST',
                url: './login.php',
                data: {
                    username: username,
                    password: password
                },
                dataType: "json",
                success: function(result) {
                    const firstMessage = 0;
                    if (result[firstMessage].status === "success") {
                        location.href = `../../du_an1/admin/index.php`;
                        console.log(result);
                    } else {
                        $("#message").text(result[firstMessage].message);
                    }
                },
                error: function(error) {
                    console.log("lỗi", error);
                },
            });
        });
    });
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:'Roboto Condensed','Arial', sans-serif;
}

body {
    min-height: 100vh;
    width: 100%;
    background: ghostwhite;
}

.container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 530px;
    width: 100%;
    background: #fff;
    border-radius: 7px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
}

.container .registration {
    display: none;
}

#check:checked~.registration {
    display: block;
}

#check:checked~.login {
    display: none;
}

#check {
    display: none;
}

.container .form {
    padding: 2rem;
}

.form header {
    font-size: 2rem;
    font-weight: 500;
    text-align: center;
    margin-bottom: 1.5rem;
}

.form input {
    height: 60px;
    width: 100%;
    padding: 0 15px;
    font-size: 17px;
    margin-bottom: 1.3rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
}

.form input:focus {
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
}

.form a {
    font-size: 16px;
    color: blue;
    text-decoration: none;
}

.form a:hover {
    text-decoration: underline;
}

.form input.button {
    color: #fff;
    background: #000;
    font-size: 1.2rem;
    font-weight: 500;
    letter-spacing: 1px;
    margin-top: 1.7rem;
    cursor: pointer;
    transition: 0.4s;
}

.form input.button:hover {
   opacity: 0.8;
}

.signup {
    font-size: 17px;
    text-align: center;
}

.signup label {
    color: blue;
    cursor: pointer;
}

.signup label:hover {
    text-decoration: underline;
}
</style>