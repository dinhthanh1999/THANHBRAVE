<?php
    $host = 'localhost';
    $database = 'shoppingcart';
    $username = 'root';
    $password = '';

    try {
        $connect = new PDO("mysql:host=$host; dbname=$database; charset=utf8", $username, $password);

        $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        echo "Loi ket noi den database: " . $e -> getMessage();
        die;
    }

?>