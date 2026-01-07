<?php
/*
 Họ tên: [Ghi họ tên của bạn ở đây]
 Lớp: [Ghi lớp]
 Mục tiêu: Form đăng nhập (login) + hiển thị lỗi + prefilling email từ cookie remember_email
*/
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Đăng nhập</title>
  <style>
    body { font-family: Arial, sans-serif; max-width:480px; margin:40px auto; }
    .box { border:1px solid #ddd; padding:20px; border-radius:6px; }
    .error { background:#ffe6e6; color:#900; padding:8px; margin-bottom:12px; border-radius:4px; }
    .info { background:#e6f4ff; color:#025; padding:8px; margin-bottom:12px; border-radius:4px; }
    label { display:block; margin-top:10px; }
    input[type="text"], input[type="password"] { width:100%; padding:8px; box-sizing:border-box; }
    .actions { margin-top:16px; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Đăng nhập</h2>

    <?php
    // Hiển thị thông báo lỗi dựa trên query string ?err=1
    if (isset($_GET['err']) && $_GET['err'] == '1') {
        echo '<div class="error">Thông tin đăng nhập không đúng hoặc trường rỗng.</div>';
    }

    // Thông báo khi vừa logout (tùy chọn)
    if (isset($_GET['loggedout']) && $_GET['loggedout'] == '1') {
        echo '<div class="info">Bạn đã đăng xuất thành công.</div>';
    }

    // Prefill email: ưu tiên cookie remember_email, nếu không có lấy từ ?email
    $prefill_email = '';
    if (!empty($_COOKIE['remember_email'])) {
        $prefill_email = $_COOKIE['remember_email'];
    } elseif (!empty($_GET['email'])) {
        $prefill_email = $_GET['email'];
    }

    // Đảm bảo an toàn khi in vào value
    $safe_email = htmlspecialchars($prefill_email, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8');
    ?>

    <form method="post" action="process_login.php" autocomplete="off">
      <label for="email">Email</label>
      <input id="email" type="text" name="email" value="<?php echo $safe_email; ?>" required>

      <label for="password">Mật khẩu</label>
      <input id="password" type="password" name="password" required>

      <label style="margin-top:8px;">
        <input type="checkbox" name="remember" <?php echo (!empty($_COOKIE['remember_email']) ? 'checked' : ''); ?>>
        Ghi nhớ email
      </label>

      <div class="actions">
        <button type="submit">Đăng nhập</button>
      </div>
    </form>

    <p style="margin-top:12px; font-size:90%; color:#555;">
      Tài khoản demo: <strong>admin@example.com</strong> / <strong>123456</strong>
    </p>
  </div>
</body>
</html>