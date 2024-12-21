<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- header -->
    <div class="container py-3">
        <header class="navbar py-3 border-bottom">
          <a href="#" class="nav-brand">
              <img src="dining/VuongNguyen (1).png" alt="Logo" width="100" height="100">
          </a>

          <ul class="nav nav-pills justify-content-end">
              <li class="nav-item"><a href="http://localhost/foodweb/index.php" class="nav-link">Trang chủ</a></li>
              <li class="nav-item"><a href="#" class="nav-link active">Thực đơn</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Khuyến mãi</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Hệ thống cửa hàng</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Về chúng tôi</a></li>
          </ul>
        </header>   
    </div>


<!-- menu -->
<div class="container text-center">
    <div class="row">
        <?php
        // Kết nối đến cơ sở dữ liệu 
        $servername = "localhost";
        $username = "root"; // Thay đổi thành tên đăng nhập của bạn
        $password = ""; // Thay đổi thành mật khẩu của bạn
        $dbname = "food_menu"; // Thay đổi thành tên cơ sở dữ liệu của bạn

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Lấy dữ liệu từ bảng menu
        $sql = "SELECT `tên`, `mô tả`, `giá`, `loại` , `hình ảnh` FROM `foods`"; // Đảm bảo tên cột khớp với bảng
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">';
                echo '<div class="card h-100" style="width: 18rem;">';
                echo '<img src="' . htmlspecialchars($row["hình ảnh"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["hình ảnh"]) . '" style="width: 18rem; height: 15rem; object-fit:cover;">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row["tên"]) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($row["mô tả"]) . '</p>';
                echo '<p class="card-text">' . number_format($row["giá"], 2) . ' VNĐ</p>';
                echo '<a href="#" class="btn btn-primary">Đặt hàng</a>';
                echo '</div></div></div>';
                
            }
        } else {
            echo '<p>No items found.</p>';
        }

        $conn->close();
        ?>
    </div>
</div>

    <!-- footer -->
    <div class="container py-3">
    <footer class="container py-3 border-top">
        <p class="text-center">&copy; 2024 Company, Inc</p>

        <a href="#" class="d-block text-center">
            <img src="dining\VuongNguyen (1).png" alt="Logo" width="100" height="100">
        </a>

        <ul class="nav justify-content-center">
            <li class="nav-item"><a href="http://localhost/foodweb/index.php" class="nav-link">Trang chủ</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Thực đơn</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Khuyến mãi</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Hệ thống cửa hàng</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Về chúng tôi</a></li>
        </ul>
    </footer>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>