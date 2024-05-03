<?php
// Nhận dữ liệu từ client
$id = $_POST['id'];

// Kiểm tra và xử lý dữ liệu đầu vào
if (!empty($id)) {
    // Kết nối đến cơ sở dữ liệu
    $connection = mysqli_connect("localhost", "root", "", "shop");

    // Kiểm tra kết nối
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Xoá bản ghi từ bảng products
    $query = "DELETE FROM products WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // Trả về phản hồi JSON
    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to delete record"));
    }

    // Đóng kết nối
    mysqli_close($connection);
} else {
    echo json_encode(array("success" => false, "message" => "ID is required"));
}
?>
