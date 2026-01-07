<?php
/*
 Họ tên: [Ghi họ tên của bạn ở đây]
 Lớp: [Ghi lớp]
 Mục tiêu: Trang sau khi đăng nhập, hiển thị email, thời điểm login, nút logout
*/
require_once 'require_login.php'; // Bảo vệ trang (phải include trước khi in HTML)
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <style>
    body { font-family: Arial, sans-serif; max-width:800px; margin:30px auto; }
    header { display:flex; justify-content:space-between; align-items:center; }
    nav a { margin-right:10px; }
    .card { border:1px solid #ddd; padding:16px; border-radius:6px; margin-top:18px; }
    .muted { color:#666; font-size:90%; }
  </style>
</head>
<body>
  <header>
    <h2>Trang quản trị</h2>
    <div>
      <a href="logout.php">Đăng xuất</a>
    </div>
  </header>

  <nav>
    <a href="dashboard.php">Home</a>
    <a href="#">Profile</a>
  </nav>

  <div class="card">
    <?php
      $email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '(không xác định)';
      echo '<p>Xin chào <strong>' . htmlspecialchars($email, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8') . '</strong></p>';

      if (!empty($_SESSION['login_time'])) {
          echo '<p class="muted">Thời điểm đăng nhập: ' . date('Y-m-d H:i:s', intval($_SESSION['login_time'])) . '</p>';
      }
    ?>
    <p>Đây là trang dashboard được bảo vệ bằng session. Bạn có thể thêm nội dung ở đây.</p>
    <p><a href="logout.php">Đăng xuất</a></p>
  </div>
</body>
</html>