<?php
session_start();

// Nếu đã đăng nhập, chuyển hướng về trang cần truy cập (mặc định là admin.php)
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $redirect = $_GET['redirect'] ?? 'admin.php';
    header("Location: $redirect");
    exit;
}

// Xử lý form đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập (thay bằng kiểm tra trong cơ sở dữ liệu)
    if ($username === 'admin' && $password === '123456') {
        $_SESSION['logged_in'] = true;
        $redirect = $_POST['redirect'] ?? 'admin.php';
        header("Location: $redirect");
        exit;
    } else {
        $error = "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Đăng nhập</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <!-- Truyền trang cần chuyển hướng sau khi đăng nhập -->
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_GET['redirect'] ?? 'admin.php'); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
