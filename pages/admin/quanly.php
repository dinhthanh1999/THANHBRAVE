<?php
    require "../../connectdb.php";

    if(isset($_COOKIE["username"])) {
        $tenDangNhap = $_COOKIE["username"];
    }
    else {
        header("Location: ./login.php");
        die;
    }

    $categorys = $connect -> query("SELECT * FROM danhmuc") -> fetchAll();
    $products = $connect -> query("SELECT * FROM sanpham") -> fetchAll();

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
            padding: 4px 16px;
        }
        .admin {
            display: flex;
            align-items: center;
            justify-content: right;
            font-size: 2rem;
        }
        .admin-img {
            width: 50px;
            border: 2px solid #ccc;
            margin-right: 8px;
        }
        .logout {
            margin-left: 16px;
            font-size: 1.6rem;
        }

        .table {
            text-align: center;
            min-width: 500px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1 class="admin">
            <img class="admin-img" src="../../assests/img/admin.jpg" alt="admin">
            <?php echo $tenDangNhap ?? ''?>
            <a href="./logout.php" class="logout">Đăng xuất</a>
        </h1>
        <h1>Quản Lý</h1>
        <table border="1" class="table">  
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Tổng</th>
                <th>Chức năng</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Danh mục sản phẩm</td>
                <td><?php echo count($categorys)?></td>
                <td>
                    <a href="./quanly/danhmuc">Chỉnh sửa</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Sản phẩm</td>
                <td><?php echo count($products)?></td>
                <td>
                    <a href="./quanly/sanpham">Chỉnh sửa</a>
                </td>
            </tr>
        </table>

    </div>
    
    
    <script>
        <?php echo isset($_COOKIE["dangnhap"]) ? "alert('Đăng Nhập Thành Công !')" : ''?>
        <?php setcookie("dangnhap", "", time())?>
    </script>
</body>
</html>