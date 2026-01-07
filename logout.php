<?php
/*
 Họ tên: [Ghi họ tên của bạn ở đây]
 Lớp: [Ghi lớp]
 Mục tiêu: Hủy session, xóa cookie session, redirect về login.php
*/
session_start();

// Xóa tất cả biến session
$_SESSION = [];

// Xóa cookie session nếu dùng cookie để lưu session id
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hủy session
session_destroy();

// Redirect về login (có thể truyền thông báo)
header('Location: login.php?loggedout=1');
exit;
?>