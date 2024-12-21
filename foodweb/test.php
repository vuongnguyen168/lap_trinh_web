<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
      session_start();

      // Nếu chưa đăng nhập, chuyển đến form đăng nhập
      if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
          header('Location: login.php?redirect=admin.php');
          exit;
      }
    ?>
    <a href="logout.php" class="btn btn-danger mt-3">Đăng xuất</a>
    <div class="container ">
        <p class="text-center fs-2">Admin panel</p>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
      <a href="ctrlproduct.php" class="btn btn-primary" type="button">Quản lý sản phẩm</a>
      <a class="btn btn-secondary" type="button">Quản lý cửa hàng</a>
      <a class="btn btn-success" type="button">Quản lý đơn hàng</a>
      <a class="btn btn-danger" type="button">Quản lý bài đăng</a>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>