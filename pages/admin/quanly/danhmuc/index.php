<?php
    require "../../../../connectdb.php";

    if(isset($_COOKIE["username"])) {
        $tenDangNhap = $_COOKIE["username"];
    }
    else {
        header("Location: ../../login.php");
        die;
    }

    $categorys = $connect -> query("SELECT *FROM danhmuc") -> fetchAll();
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
        }

        .back-link {
            display: block;
            margin-top: 30px;
        }

        .thongbao {
            height: 20px;
            margin-top: 20px;
            margin-bottom: 6px;
            color: green;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1 class="admin">
            <img class="admin-img" src="../../../../assests/img/admin.jpg" alt="admin">
            <?php echo $tenDangNhap ?? ''?>
            <a href="../../logout.php" class="logout">Đăng xuất</a>
        </h1>
        <h1>Quản Lý Danh Mục</h1>
        <div class="thongbao"><?php echo isset($_GET["thongbao"]) ? $_GET["thongbao"] : ''?></div>
        <table border="1" class="table">  
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>
                    Chức Năng
                    <a href="./them.php">Thêm</a>
                </th>
            </tr>
            <?php foreach($categorys as $category) :?>
                <tr>
                    <td><?php echo $category["maDanhMuc"]?></td>
                    <td><?php echo $category["tenDanhMuc"]?></td>
                    <td>
                        <a href="./sua.php?maDanhMuc=<?php echo $category["maDanhMuc"]?>">Sửa</a>
                        <a 
                            href="./xoa.php?maDanhMuc=<?php echo $category["maDanhMuc"]?>" 
                            onclick="return confirm('Bạn có muốn xóa <?php echo $category['tenDanhMuc'] ?> không ?')"
                        >
                        Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <a href="../../quanly.php" class="back-link">Về trang quản lý</a>
    </div>
</body>
</html>