<?php
// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// Tạo kết nối đến cơ sở dữ liệu
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
