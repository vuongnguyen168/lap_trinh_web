<?php
// Kết nối cơ sở dữ liệu
include 'db_connect.php';

// Lấy ID sản phẩm từ yêu cầu GET
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Lấy dữ liệu sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM `foods` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form và cập nhật sản phẩm
    $name = $_POST['name'];
    $describe = $_POST['describe'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $sql = "UPDATE `foods` SET `tên` = ?, `mô tả` = ?, `giá` = ?, `loại` = ? , `hình ảnh`= ? WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsi", $name, $describe, $price, $category, $image, $productId);

    if ($stmt->execute()) {
        // Nếu cập nhật thành công, chuyển hướng về trang danh sách sản phẩm
        header("Location: admin.php?message=Cập nhật sản phẩm thành công");
        exit();
    } else {
        // Nếu có lỗi xảy ra
        echo 'Có lỗi khi cập nhật sản phẩm';
    }

    $stmt->close();
    $conn->close();
}
?>

<h3>Sửa sản phẩm</h3>

<form action="editfood.php?id=<?= $productId ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= isset($product['tên']) ? $product['tên'] : '' ?>">
    </div>
    <div class="mb-3">
        <label for="describe" class="form-label">Mô tả</label>
        <input type="text" class="form-control" id="describe" name="describe" value="<?= isset($product['mô tả']) ? $product['mô tả'] : '' ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= isset($product['giá']) ? $product['giá'] : '' ?>">
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Loại</label>
        <input type="text" class="form-control" id="category" name="category" value="<?= isset($product['loại']) ? $product['loại'] : '' ?>">
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Link hình ảnh</label>
        <input type="text" class="form-control" id="image   " name="image" value="<?= isset($product['hình ảnh']) ? $product['hình ảnh'] : '' ?>">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

