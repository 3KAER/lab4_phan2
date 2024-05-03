<?php
// Kết nối đến cơ sở dữ liệu
require_once "database.php";

// Truy vấn danh sách sản phẩm từ cơ sở dữ liệu
$query = "SELECT * FROM products";
$result = mysqli_query($connection, $query);

// Kiểm tra và xử lý kết quả trả về
if ($result) {
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(array());
}

// Đóng kết nối
mysqli_close($connection);
?>
