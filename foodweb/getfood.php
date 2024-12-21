<?php
// Kết nối lại cơ sở dữ liệu để lấy thông tin sản phẩm chi tiết
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_menu";

// Mở kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$productId = $_GET['id']; // Lấy id từ tham số URL

// Truy vấn lấy thông tin chi tiết của sản phẩm
$sql = "SELECT * FROM foods WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra kết quả
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode($product); // Trả về thông tin sản phẩm dưới dạng JSON
} else {
    echo json_encode(["error" => "Không tìm thấy sản phẩm."]);
}

$stmt->close();
$conn->close();
?>
