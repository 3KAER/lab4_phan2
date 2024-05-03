<?php
// Kết nối đến cơ sở dữ liệu
require_once "database.php";

// Khởi tạo mảng JSON response
$response = array();

// Kiểm tra nếu form đã được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Kiểm tra và xử lý dữ liệu đầu vào
    if (!empty($id) && !empty($name) && !empty($price) && !empty($description)) {
        // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
        $query = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id=$id";
        $result = mysqli_query($connection, $query);

        // Kiểm tra kết quả cập nhật
        if ($result) {
            $response['success'] = true;
            $response['message'] = "Record updated successfully";
        } else {
            $response['success'] = false;
            $response['message'] = "Failed to update record";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "ID, name, price, and description are required";
    }

    // Trả về JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Dừng việc xử lý các mã HTML dưới đây
}

// Kiểm tra nếu có ID sản phẩm được truyền từ URL
if (isset($_GET['id'])) {
    // Lấy ID sản phẩm từ URL
    $id = $_GET['id'];

    // Truy vấn để lấy thông tin chi tiết của sản phẩm dựa trên ID
    $query = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // Kiểm tra xem sản phẩm có tồn tại không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];
        $description = $row['description'];
    } else {
        echo "Product not found";
        exit;
    }
} else {
    echo "Product ID is required";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form id="editProductForm" method="POST">
        <input type="hidden" id="productId" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $price; ?>"><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br><br>
        <button type="submit">Save</button>
    </form>
    <script src="script.js"></script>
</body>
</html>


