<?php
/*
 Họ tên: [Ghi họ tên của bạn ở đây]
 Lớp: [Ghi lớp]
 Mục tiêu: Kiểm tra session và chặn trang nếu chưa login
 Lưu ý: File này KHÔNG in HTML, chỉ redirect nếu chưa login
*/
session_start();

// Nếu chưa có user trong session -> trả về login
if (!isset($_SESSION['user']) || empty($_SESSION['user']['email'])) {
    header('Location: login.php');
    exit;
}

// (Tùy chọn) kiểm tra role
// if ($_SESSION['user']['role'] !== 'admin') {
//     header('Location: login.php');
//     exit;
// }
?>