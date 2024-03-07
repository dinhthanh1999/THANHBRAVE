<?php
require "../connectdb.php";

$products = $connect -> query("SELECT *FROM sanpham") -> fetchAll();
$categorys = $connect -> query("SELECT *FROM danhmuc") -> fetchAll();


$arrayFilted = [];
$arrayChecked = [];
$errors = [];
$isAllChecked = false;

// Kiểm tra nếu người dùng bấm vào danh mục ở header thì phải lọc danh mục
if(isset($_GET["maDanhMuc"])) {
    $maDanhMuc = $_GET["maDanhMuc"];

    $sanpham = $connect -> query("SELECT * FROM danhmuc A JOIN sanpham B ON A.maDanhMuc = B.maLoai WHERE A.maDanhMuc = $maDanhMuc") -> fetchAll();
    foreach($sanpham as $sp) {
        array_push($arrayFilted, $sp);
    }
    array_push($arrayChecked, $maDanhMuc);
} //Còn không thì mặc định vào trang này để hiển thị full sản phẩm
else {
    $isAllChecked = true;
    $arrayFilted = $products;
}

// Khi người dùng bấm Lọc thì sẽ lọt vào đây
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filters = $_POST["filters"] ?? [];
    $arrayChecked = [];

    if(!empty($filters)) {
        $arrayFilted = [];
        
        // Lọc Sản Phẩm
        foreach($filters as $stringMaDanhMuc) {
            $maDanhMuc = (int)$stringMaDanhMuc;

            // Mã bằng 0 thì truy vấn all sản phẩm rồi ngưng vòng lặp
            if($maDanhMuc == 0) {
                $sanpham = $connect -> query("SELECT * FROM danhmuc A JOIN sanpham B ON A.maDanhMuc = B.maLoai") -> fetchAll();
                foreach($sanpham as $sp) {
                    array_push($arrayFilted, $sp);
                }
                break;
            }
            
            // Còn không thì select theo where rồi đẩy sản phẩm vào $arrayFilted
            $sanpham = $connect -> query("SELECT * FROM danhmuc A JOIN sanpham B ON A.maDanhMuc = B.maLoai WHERE A.maDanhMuc = $maDanhMuc") -> fetchAll();
            foreach($sanpham as $sp) {
                array_push($arrayFilted, $sp);
            }
        }

        //Xử lý lưu form ghi nhấn Lọc
        foreach($filters as $stringMaDanhMuc) {
            $maDanhMuc = (int)$stringMaDanhMuc;

            if($maDanhMuc == 0) {
                $isAllChecked = true;
                break;
            }
            else {
                $isAllChecked = false;
                array_push($arrayChecked, $maDanhMuc);
            }
        }

    }
    else {
        $errors["error_form-filters"] = "Lỗi: Bạn chưa chọn Danh Mục !";
        $isAllChecked = false;
        $arrayFilted = [];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assests/css/grid.css">
<link rel="stylesheet" href="../assests/css/styles.css">
<link rel="stylesheet" href="../assests/css/pages/sanpham.css">


<body>
    <div class="main grid">
        <header class="header">
            <div class="grid wide">
                <div class="header_above">
                    <div class="header_logo-wrap">
                        <a href="../" class="header_logo-link">
                            <div class="header_logo" style="background-image: url('../assests/img/logo.png');"></div>
                        </a>
                    </div>
                    <div class="header_items">
                        <div class="header_items-left">
                            <?php foreach($categorys as $category) { ?>
                                <a href="./sanpham.php?maDanhMuc=<?php echo $category["maDanhMuc"]?>" class="header_item"><?php echo $category["tenDanhMuc"] ?></a>
                            <?php } ?>
                        </div>
                        <div class="header_items-right">
                            <a href="./admin/login.php" class="header_item">
                                <i class="fa-solid fa-user header_item-icon"></i>
                                Đăng nhập
                            </a>
                            <a href="#" class="header_item">
                                <i class="fa-solid fa-user-plus header_item-icon"></i>
                                Đăng ký
                            </a>
                            <a href="#" class="header_item">
                                <i class="fa-solid fa-cart-shopping header_item-icon"></i>
                                Giỏ hàng
                            </a>
                        </div>

                    </div>
                </div>
                <div class="header_input-wrap">
                    <input type="text" name="sanPhamTimKiem" id="" class="header_input" placeholder="Tìm kiếm sản phẩm">
                    <i class="fa-solid fa-magnifying-glass header_search-icon"></i>
                </div>
            </div>
        </header>
        <div class="body">
            <div class="page-bar">
                <div class="grid wide">
                    <a href="../" class="page-bar_link">Trang chủ</a> >
                    <a href="#!" class="page-bar_link page-bar_link--active">Sản Phẩm</a>
                </div>
            </div>
            <div class="products-content-wrap">
                <div class="grid wide">
                    <div class="products-content">
                        <div class="row">
                            <div class="filter col l-3">
                                <h2 class="filter-title">
                                    <i class="fa-solid fa-filter"></i>
                                    Filter
                                </h2>
                                <form action="" method="post" class="filter-form">
                                    <div class="filter-form_category">
                                        <h3 class="filter-form_category-title">Danh mục</h3>
                                        <div class="row">
                                            <div class="col l-6">
                                                <div class="filter-form_input">
                                                    <input type="checkbox" name="filters[]" value="0" class="filter-form_input-value" id="all"
                                                    <?php echo $isAllChecked ? 'checked' : '' ?>
                                                    >
                                                    <label for="all" onclick="unsetCheckbox(<?php echo count($categorys)?>)">Tất cả</label>
                                                </div>
                                            </div>
                                            <?php foreach($categorys as $category) :?>
                                                <div class="col l-6">
                                                    <div class="filter-form_input">
                                                        <input
                                                            type="checkbox"
                                                            name="filters[]"
                                                            value="<?php echo $category["maDanhMuc"]?>" 
                                                            class="filter-form_input-value" 
                                                            id="danhmuc<?php echo $category["maDanhMuc"]?>"
                                                            <?php foreach($arrayChecked as $index) :?>
                                                                <?php echo $index == $category["maDanhMuc"] ? 'checked' : '' ?>
                                                            <?php endforeach ?>
                                                        >
                                                        <label for="danhmuc<?php echo $category["maDanhMuc"]?>"><?php echo $category["tenDanhMuc"]?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div style="color: red;margin-top: 8px;height: 25px;"><?php echo $errors["error_form-filters"] ?? ''?></div>
                                    <button type="submit" class="filter-form_submit">
                                        <i class="fa-solid fa-vials"></i>
                                        Lọc
                                    </button>
                                </form>
                            </div>
                            <div class="products-wrap col l-9">
                                <h2 class="products-title">
                                    <div class="products-sub-title">(<?php echo count($arrayFilted)?> sản phẩm)</div>
                                </h2>
                                <div class="products">
                                    <div class="row">
                                        <?php foreach ($arrayFilted as $product) : ?>
                                            <div class="col l-4">
                                                <div class="product">
                                                    <div class="product_img1" style="background-image: url('../assests/img/product/<?php echo $product["hinh"] ?>');">
                                                    </div>
                                                    <div class="product_img2" style="background-image: url('../assests/img/product/<?php echo $product["hinhSau"] ?>');">
                                                    </div>
                                                    <h2 class="product_name"><?php echo $product["tenHangHoa"] ?></h2>
                                                    <div class="product_price"><?php echo $product["gia"] ?>đ</div>
                                                    <a href="#!" class="product_add-cart">Thêm vào giỏ hàng</a>
                                                    <a href="./chitietsanpham.php?maSanPham=<?php echo $product["maHangHoa"]?>" class="product_view">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <footer class="footer">
            <div class="grid wide">
                <div class="footer_content">
                    <div class="footer_logo-wrap">
                        <a href="../" class="footer_logo" style="background-image: url(../assests/img/logo.png);"></a>
                        <div class="footer_location">
                            Số 240 đường Nhuệ Giang, cụm 7, thôn Thúy Hội, xã Tân Hội, huyện Đan Phượng, TP. Hà Nội,
                            <br>
                            Việt Nam
                        </div>
                    </div>
                    <div class="footer_items">
                        <div class="footer_item">
                            <h1 class="footer_item-title">Về chúng tôi</h1>
                            <a href="#!" class="footer_item-link">Giới thiệu</a>
                            <a href="#!" class="footer_item-link">Điều khoản & Điều kiện</a>
                            <a href="#!" class="footer_item-link">Chính sách bảo mật</a>
                            <a href="#!" class="footer_item-link">Chính sách Cookies</a>
                        </div>
                        <div class="footer_item">
                            <h1 class="footer_item-title">Hỗ trợ</h1>
                            <a href="#!" class="footer_item-link">Mua hàng bằng cách nào</a>
                            <a href="#!" class="footer_item-link">Các lựa chọn thanh toán</a>
                            <a href="#!" class="footer_item-link">Câu hỏi thường gặp</a>
                        </div>
                        <div class="footer_item">
                            <h1 class="footer_item-title">Liên hệ</h1>
                            <div class="footer_item-contact">
                                Email: <a href="mailto:huymamicoi@mail.com" class="footer_item-link">huymamicoi@gmail.com</a>
                            </div>
                            <div class="footer_item-contact">
                                Số điện thoại: <a href="tel:0943619586" class="footer_item-link">+84 943 619 586</a>
                            </div>
                            <div class="footer_item-contact">
                                Mạng xã hội:
                                <div class="footer_item-socials">
                                    <a href="https://www.facebook.com/huuhuy.jqk" class="footer_item-social">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                    <a href="https://www.instagram.com/huyme.27" class="footer_item-social">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                    <a href="https://www.tiktok.com/@huyme.27" class="footer_item-social">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer_end">@Copyright by Nguyen Huu Huy PH46090</div>
            </div>
        </footer>

    </div>

    <script src="../assests/js/pages/sanphammm.js" ></script>
</body>

</html>

