<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <p class="text-center fs-2 ">Quản lý sản phẩm</p>
    </div>


    <?php
      session_start();

      // Nếu chưa đăng nhập, chuyển đến form đăng nhập
      if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
          header('Location: login.php?redirect=admin.php');
          exit;
      }
    ?>

    <div class="container justify-content-center d-flex">
        <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
    </div>

    <!-- Thêm sản phẩm -->
    <div class="d-grid gap-2 col-6 mx-auto">
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
            Thêm
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Sản phẩm mới</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="addfood.php" method="post">
                            <div class="mb-3">
                              <label for="name" class="form-label">Tên</label>
                              <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                            </div>
                            <div class="mb-3">
                              <label for="describe" class="form-label">Mô tả</label>
                              <input type="text" class="form-control" id="describe" name="describe">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Loại</label>
                                <input type="text" class="form-control" id="category" name="category">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Link sản phẩm</label>
                                <input type="text" class="form-control" id="image" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                          </form>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php
        // Bao gồm file kết nối cơ sở dữ liệu
        include 'db_connect.php';  // Đảm bảo đường dẫn đúng đến file db_connect.php

        // Lấy danh sách sản phẩm
        $sql = "SELECT id, tên FROM foods";
        $result = $conn->query($sql);
        ?>


        <h3>Danh sách sản phẩm</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
            Thêm món mới
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['tên'] ?></td>
                        <td>
                            <!-- Nút sửa -->
                            <a href="editfood.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                            <!-- Nút xóa -->
                            <a href="deletefood.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>