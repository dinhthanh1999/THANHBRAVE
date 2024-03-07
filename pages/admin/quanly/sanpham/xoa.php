<?php
require "../../../../connectdb.php";

$maSanPham = $_GET["maSanPham"];
$sanpham = $connect -> query("SELECT * FROM sanpham WHERE maHangHoa = $maSanPham") -> fetch();

$folderImage = strstr($sanpham["hinh"], '/', true);
$path = "../../../../assests/img/product/";

// unlink: xóa file
unlink($path . $sanpham["hinh"]);
unlink($path . $sanpham["hinhSau"]);
// rmdir: xóa thư mục rỗng
rmdir($path . $folderImage);

$connect -> query("DELETE FROM sanpham WHERE maHangHoa = $maSanPham");

$thongbao = "Xóa Sản Phẩm Thành Công !";
header("Location: ./index.php?thongbao=$thongbao");
die;

?>