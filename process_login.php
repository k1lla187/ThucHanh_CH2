<?php
/*
 Họ tên: [Ghi họ tên của bạn ở đây]
 Lớp: [Ghi lớp]
 Mục tiêu: Xử lý đăng nhập, tạo session, set cookie remember_email, redirect
*/
session_start();

// Chỉ chấp nhận POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// Lấy dữ liệu
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Kiểm tra rỗng
if ($email === '' || $password === '') {
    // redirect về login với mã lỗi
    header('Location: login.php?err=1');
    exit;
}

// Tài khoản demo tạm thời
$demo_email = 'admin@example.com';
$demo_password = '123456';

if (mb_strtolower($email) === mb_strtolower($demo_email) && $password === $demo_password) {
    // Đăng nhập thành công
    $_SESSION['user'] = [
        'email' => $email,
        'role' => 'admin'
    ];
    // Lưu thời điểm login
    $_SESSION['login_time'] = time();

    // Xử lý remember email (cookie)
    if (!empty($_POST['remember'])) {
        // Lưu cookie 30 ngày
        setcookie('remember_email', $email, time() + 30*24*3600, '/');
    } else {
        // Xóa nếu tồn tại
        if (!empty($_COOKIE['remember_email'])) {
            setcookie('remember_email', '', time() - 3600, '/');
        }
    }

    header('Location: dashboard.php');
    exit;
} else {
    // Sai thông tin -> redirect về login và gửi email để prefill (an toàn hơn)
    $qs_email = urlencode($email);
    header("Location: login.php?err=1&email={$qs_email}");
    exit;
}
?>