<?php
    setcookie("username", "", time());
    header("Location: ./login.php");
    die;
?>