<?php
// Kết nối cơ sở dữ liệu
include 'db_connect.php';

// Lấy ID sản phẩm từ yêu cầu GET
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    $sql = "DELETE FROM foods WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách sản phẩm
        header("Location: admin.php?message=Xóa sản phẩm thành công");
        exit();
    } else {
        // Nếu có lỗi xảy ra
        echo 'Có lỗi khi xóa sản phẩm';
    }

    $stmt->close();
    $conn->close();
}
?>
