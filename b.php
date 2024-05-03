<?php
// Kết nối đến cơ sở dữ liệu
require_once "database.php";

// Kiểm tra nếu form đã được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image']; // Thêm dòng này

    // Kiểm tra và xử lý dữ liệu đầu vào
    if (!empty($name) && !empty($price) && !empty($description)&& !empty($image)) { // Sửa dòng này
        // Thêm sản phẩm mới vào cơ sở dữ liệu
        $query = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$description', '$image' )"; // Sửa dòng này
        $result = mysqli_query($connection, $query);

        // Kiểm tra kết quả thêm mới
        if ($result) {
            echo "Record added successfully";
        } else {
            echo "Failed to add new record";
        }
    } else {
        echo "Name, price, and description are required"; // Sửa dòng này
    }
}
?>
