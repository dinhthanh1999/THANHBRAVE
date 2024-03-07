<?php 
    require "../../../../connectdb.php";

    $maDanhMuc = $_GET["maDanhMuc"];
    $connect -> query("DELETE FROM danhmuc WHERE maDanhMuc = $maDanhMuc");

    $thongbao = "Xóa Danh Mục Thành Công !";
    header("Location: ./index.php?thongbao=$thongbao");
    die;
?>