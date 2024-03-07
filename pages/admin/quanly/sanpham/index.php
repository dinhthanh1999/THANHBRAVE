<?php
    require "../../../../connectdb.php";

    if(isset($_COOKIE["username"])) {
        $tenDangNhap = $_COOKIE["username"];
    }
    else {
        header("Location: ../../login.php");
        die;
    }

    $products = $connect -> query("SELECT *FROM sanpham A JOIN danhmuc B ON A.maLoai = B.maDanhMuc ORDER BY A.maHangHoa ASC") -> fetchAll();
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
            min-height: 100vh;
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

        .table td,
        .table th {
            padding: 0 6px;
        }
        
        .img-product {
            width: 55px;
        }

        .mota {
            font-size: 1.2rem;
            text-align: justify;
        }

        .tenSanPham {
            text-align: justify;
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
        <h1>Quản Lý Sản Phẩm</h1>
        <div class="thongbao"><?php echo isset($_GET["thongbao"]) ? $_GET["thongbao"] : ''?></div>
        <table border="1" class="table">  
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Ảnh Trước</th>
                <th>Ảnh Sau</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Mô Tả</th>
                <th>Tên Danh Mục</th>
                <th>Ngày Tạo</th>
                <th>Ngày Sửa</th>
                <th>
                    Chức năng
                    <a href="./them.php">Thêm</a>
                </th>
            </tr>
            <?php foreach($products as $product) :?>
                <tr>
                    <td><?php echo $product["maHangHoa"]?></td>
                    <td class="tenSanPham"><?php echo $product["tenHangHoa"]?></td>
                    <td><img class="img-product" src="../../../../assests/img/product/<?php echo $product["hinh"]?>" alt="Ảnh Trước Sản Phẩm"></td>
                    <td><img class="img-product" src="../../../../assests/img/product/<?php echo $product["hinhSau"]?>" alt="Ảnh Sau Sản Phẩm"></td>
                    <td><?php echo $product["gia"]?></td>
                    <td><?php echo $product["soLuong"]?></td>
                    <td class="mota"><?php echo $product["moTa"]?></td>
                    <td><?php echo $product["tenDanhMuc"]?></td>
                    <td><?php echo $product["ngayTao"]?></td>
                    <td><?php echo $product["ngaySua"]?></td>
                    <td>
                        <a href="./sua.php?maSanPham=<?php echo $product["maHangHoa"]?>">Sửa</a>
                        <a 
                            href="./xoa.php?maSanPham=<?php echo $product["maHangHoa"]?>" 
                            onclick="return confirm('Bạn có muốn xóa <?php echo $product['tenHangHoa'] ?> không ?')"
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