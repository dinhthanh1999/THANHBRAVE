<?php
    require "../connectdb.php";

    $categorys = $connect -> query("SELECT *FROM danhmuc") -> fetchAll();
    
    $maHangHoa = $_GET["maSanPham"];
    $product = $connect -> query("SELECT *FROM sanpham WHERE maHangHoa = $maHangHoa") -> fetch();

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
<link rel="stylesheet" href="../assests/css/pages/chitietsanpham.css">


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
                    <a href="../pages/sanpham.php" class="page-bar_link">Sản phẩm</a> >
                    <a href="#!" class="page-bar_link page-bar_link--active">Chi tiết sản phẩm</a>
                </div>
            </div>
            <div class="product-detal">
                <div class="grid wide">
                    <div class="row">
                        
                        <div class="col l-5">
                            <div class="product-img">
                                <div class="product-img_small-wrap">
                                    <div class="row">
                                        <div class="col l-12">
                                            <div class="product-img_small product-img_small--avtive" style="background-image: url('../assests/img/product/<?php echo $product["hinh"] ?>');">
                                            </div>
                                        </div>
                                        <div class="col l-12">
                                            <div class="product-img_small" style="background-image: url('../assests/img/product/<?php echo $product["hinhSau"]?>');">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-img_main-wrap">
                                    <div class="product-img_main" style="background-image: url('../assests/img/product/<?php echo $product["hinh"] ?>');">
                                    </div>
                                </div>
                            </div>
                            <div class="product-description">
                                <h2 class="product-description_title">Mô tả sản phẩm</h2>
                                <h4 class="product-description_text">
                                    <?php echo $product["moTa"] ?>
                                </h4>
                            </div>
                        </div>

                        <div class="col l-7">
                            <div class="product-content">
                                <h2 class="product-content_title"><?php echo $product["tenHangHoa"]?></h2>
                                <h2 class="product-content_price"><?php echo $product["gia"] ?> đ</h2>
                                <div class="product-content_service">
                                    <h3 class="product-content_service-text">Màu sắc</h3>
                                    <div class="product-content_color-wrap">
                                        <div class="product-content_color product-content_color--avtive"></div>
                                        <div class="product-content_color"></div>
                                        <div class="product-content_color"></div>
                                    </div>
                                </div>
                                <div class="product-content_service">
                                    <h3 class="product-content_service-text">Số lượng trong kho</h3>
                                    <div class="product-content_quantity"><?php echo $product["soLuong"] ?></div>
                                </div>
                                <div class="product-content_buy">
                                    <div class="product-content_buy-quantity-wrap">
                                        <span class="product-content_buy-operator-more">-</span>
                                        <div class="product-content_buy-quantity">1</div>
                                        <span class="product-content_buy-operator-less">+</span>
                                    </div>
                                    <div class="product-content_buy-btn">Thêm vào giỏ hàng</div>
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
</body>

</html>