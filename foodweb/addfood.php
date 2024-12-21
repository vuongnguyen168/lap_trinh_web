<?php
include 'db_connect.php';
// Nhận dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $describe = $_POST['describe'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    // Chuẩn bị và thực thi câu lệnh SQL
    $sql = "INSERT INTO `foods` (`tên`, `mô tả`, `giá`, `loại` ,`hình ảnh`) VALUES (?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $name, $describe, $price, $category,$image);

    // Kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Thêm sản phẩm thành công!";
        header("Location: admin.php"); // Điều hướng về trang chính sau khi thêm thành công
        exit();
    } else {
        echo "Có lỗi xảy ra: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
