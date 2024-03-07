<?php
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tenDangNhap = $_POST["username"];
        $matKhau = $_POST["password"];

        if($tenDangNhap == '') {
            $errors["username"] = "Vui lòng nhập tên đăng nhập";
        }

        if($matKhau == '') {
            $errors["password"] = "Vui lòng nhập mật khẩu";
        }

        if(empty($errors)) {
            if($tenDangNhap === "admin" && $matKhau === "123456") {
                setcookie("username", $tenDangNhap, time() + 60*30);
                setcookie("dangnhap", true, time() + 60*30);
                header("Location: ./quanly.php");
                die;
            }
            else {
                $errors["loiDangNhap"] = "Sai tên đăng nhập hoặc mật khẩu !";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/styles.css">

    <style>
        .main {
            min-height: 100vh;
            display: flex;
        }

        .form {
            margin: auto;
            padding: 32px;
            border: 1px solid #000;
            border-radius: 8px;
        }

        .input-form:nth-child(1) {
            margin-bottom: 10px;
        }

        .input-form:nth-child(2) {
            margin-bottom: 20px;
        }

        .input-form input {
            width: 100%;
            padding: 6px 4px;
            margin-top: 8px;
        }


        .btn-submit {
            width: 100%;
            font-size: 1.8rem;
            padding: 6px 16px;
            border: 1px solid var(--sub-color);
            border-radius: 8px;
            transition: all linear 0.06s;
        }

        .btn-submit:hover {
            background-color: var(--sub-color);
            color: #fff;
            cursor: pointer;
        }

        .error {
            height: 18px;
            color: red;
            margin-top: 4px;
        }

        .back {
            display: block;
            margin-top: 32px;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="form">
            <h1 style="text-align: center; margin-bottom: 40px;">Đăng Nhập</h1>
            <form action="" method="post">
                <div class="input-form">
                    <label for="username">Tên đăng nhập: </label>
                    <input type="text" name="username" id="username" value="<?php echo isset($tenDangNhap) ? $tenDangNhap : ''?>">
                    <div class="error"><?php echo $errors["username"] ?? ''?></div>
                </div>
                <div class="input-form">
                    <label for="password">Mật khẩu: </label>
                    <input type="password" name="password" id="password" value="<?php echo isset($matKhau) ? $matKhau : '' ?>">
                    <div class="error">
                        <?php echo $errors["password"] ?? ''?>
                        <?php echo $errors["loiDangNhap"] ?? ''?>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Đăng nhập</button>
                <a href="../../" class="back">Quay trở lại trang chủ</a>
            </form>
        </div>
    </div>
</body>
</html>