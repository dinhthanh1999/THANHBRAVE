<?php 
    require "../../../../connectdb.php";
    
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tenDanhMuc = $_POST["tenDanhMuc"];

        if($tenDanhMuc == '') {
            $errors["tenDanhMuc"] = "Vui lòng nhập tên danh mục";
        }

        if(empty($errors)) {
            $connect -> query("INSERT INTO danhmuc VALUES (NULL, '$tenDanhMuc')");
            $thongbao = "Thêm Danh Mục Thành Công !";
            header("Location: ./index.php?thongbao=$thongbao");
            die;
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
    <link rel="stylesheet" href="../../../../assests/css/styles.css">
</head>
<style>
    .main {
        padding: 4px 16px;
    }

    .title {
        margin-bottom: 38px;
    }

    .input-form input {
        padding: 2px 4px;
    }

    .input-form {
        margin-bottom: 12px;
    }

    .btn-submit {
        margin-top: 20px;
        font-size: 1.4rem;
        padding: 2px 12px;
        cursor: pointer;
    }

    .error {
        height: 18px;
        color: red;
    }
</style>
<body>
    <div class="main">
        <div class="form">
            <h1 class="title">Thêm Danh Mục</h1>
            <form action="" method="post">
                <div class="input-form">
                    <label for="tenDanhMuc">Tên Danh Mục</label>
                    <input type="text" name="tenDanhMuc" id="tenDanhMuc">
                    <div class="error">
                        <?php echo $errors["tenDanhMuc"] ?? ''?>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Thêm</button>
            </form>
        </div>
    </div>
</body>
</html>