<?php
    require "../../../../connectdb.php";

    $categorys = $connect -> query("SELECT *FROM danhmuc");
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $masp = $_POST["maSanPham"];
        $tenSanPham = $_POST["tenSanPham"];
        $anhTruoc = $_FILES["anhTruoc"];
        $anhSau = $_FILES["anhSau"];
        $gia = $_POST["gia"];
        $soLuong = $_POST["soLuong"];
        $moTa = $_POST["moTa"];
        $danhMuc = (int)$_POST["danhMuc"];
        $ngayTao = $_POST["ngayTao"];
        $ngaySua = $_POST["ngaySua"];

        if($tenSanPham == '') {
            $errors["tenSanPham"] = "Vui lòng nhập tên sản phẩm";
        }
        if($anhTruoc["error"] !== 0) {
            $errors["anhTruoc"] = "Vui lòng chọn ảnh trước";
        }
        if($anhSau["error"] !== 0) {
            $errors["anhSau"] = "Vui lòng chọn ảnh sau";
        }
        if($gia == '') {
            $errors["gia"] = "Vui lòng nhập giá";
        }
        else {
            if($gia < 0) {
                $errors["gia"] = "Sai định dạng giá";
            }
        }
        if($soLuong == '') {
            $errors["soLuong"] = "Vui lòng nhập số lượng";
        }
        else {
            if($soLuong < 0) {
                $errors["soLuong"] = "Sai định dạng số lượng";
            }
        }
        if($moTa == '') {
            $errors["moTa"] = "Vui lòng nhập mô tả";
        }
        if($ngayTao == '') {
            $errors["ngayTao"] = "Vui lòng chọn ngày tạo";
        }

        if($ngaySua == '') {
            $errors["ngaySua"] = "Vui lòng chọn ngày sửa";
        }


        if(empty($errors)) {
            // strstr dùng để cắt chuỗi đến vị trí quy định ở đối số truyền vào thứ 2
            $folderImage = strstr($anhTruoc["name"],'.',true);

            // mkdir để tạo thư mục
            $path = "../../../../assests/img/product/$folderImage";
            if(!file_exists($path)) {
                mkdir($path);
            }

            move_uploaded_file($anhTruoc["tmp_name"], "$path/front.jpg");
            move_uploaded_file($anhSau["tmp_name"], "$path/back-side.jpg");

            $connect -> query(
                "UPDATE sanpham 
                 SET
                 tenHangHoa = '$tenSanPham',
                 gia = $gia,
                 soLuong = $soLuong,
                 hinh = '$folderImage/front.jpg',
                 moTa = '$moTa',
                 maLoai = $danhMuc,
                 ngayTao = '$ngayTao',
                 ngaySua = '$ngaySua',
                 hinhSau = '$folderImage/back-side.jpg'
                 WHERE
                 maHangHoa = $masp
                "
            );
            $thongbao = "Sửa Sản Phẩm Thành Công !";
        }

    }

    $maSanPham = $_GET["maSanPham"];
    $sanPham = $connect -> query("SELECT *FROM sanpham WHERE maHangHoa = $maSanPham") ->fetch();

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

    textarea {
        padding: 8px;
    }

    .back {
        margin-top: 12px;
        display: block;
    }
    .thongbao {
        height: 20px;
        margin-bottom: 4px;
    }
</style>
<body>
    <div class="main">
        <div class="form">
            <h1 class="title">Sửa Sản Phẩm</h1>
            <div class="thongbao"><?php echo $thongbao ?? ''?></div>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="maSanPham" value="<?php echo $sanPham["maHangHoa"]?>">
                <div class="input-form">
                    <label for="tenSanPham">Tên Sản Phẩm:</label>
                    <input type="text" name="tenSanPham" id="tenSanPham" value="<?php echo $sanPham["tenHangHoa"]?>">
                    <div class="error">
                        <?php echo $errors["tenSanPham"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="anhTruoc">Ảnh Trước:</label>
                    <input type="file" name="anhTruoc" id="anhTruoc">
                    <img src="../../../../assests/img/product/<?php echo $sanPham["hinh"]?>" alt="" style="width: 60px;">
                    <div class="error">
                        <?php echo $errors["anhTruoc"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="anhSau">Ảnh Sau:</label>
                    <input type="file" name="anhSau" id="anhSau">
                    <img src="../../../../assests/img/product/<?php echo $sanPham["hinhSau"]?>" alt="" style="width: 60px;">
                    <div class="error">
                        <?php echo $errors["anhSau"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="gia">Giá:</label>
                    <input type="number" name="gia" id="gia" value="<?php echo $sanPham["gia"]?>">
                    <div class="error">
                        <?php echo $errors["gia"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="soLuong">Số Lượng:</label>
                    <input type="number" name="soLuong" id="soLuong" value="<?php echo $sanPham["soLuong"]?>">
                    <div class="error">
                        <?php echo $errors["soLuong"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="moTa" style="display: block;">Mô Tả:</label>
                    <textarea name="moTa" id="moTa" cols="30" rows="10"><?php echo $sanPham["moTa"]?></textarea>
                    <div class="error">
                        <?php echo $errors["moTa"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="danhMuc">Danh Mục:</label>
                    <select name="danhMuc" id="danhMuc">
                        <?php foreach($categorys as $category) :?>
                            <option 
                                value="<?php echo $category["maDanhMuc"]?>"
                                <?php echo $sanPham["maLoai"] == $category["maDanhMuc"] ? 'selected' : '' ?>
                            >
                            <?php echo $category["tenDanhMuc"]?>
                            </option>
                        <?php endforeach?>
                    </select>
                    <div class="error">
                        <?php echo $errors["danhMuc"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="ngayTao">Ngày Tạo:</label>
                    <input type="date" name="ngayTao" id="ngayTao" value="<?php echo $sanPham["ngayTao"]?>">
                    <div class="error">
                        <?php echo $errors["ngayTao"] ?? ''?>
                    </div>
                </div>
                <div class="input-form">
                    <label for="ngaySua">Ngày Sửa:</label>
                    <input type="date" name="ngaySua" id="ngaySua" value="<?php echo $sanPham["ngaySua"]?>">
                    <div class="error">
                        <?php echo $errors["ngaySua"] ?? ''?>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Sửa</button>
            </form>
            <a href="./" class="back">Về trang quản lý sản phẩm</a>
        </div>
    </div>
</body>
</html>