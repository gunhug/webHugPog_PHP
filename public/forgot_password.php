<?php
session_start();

require_once '../models/UserModel.php';

$userModel = new UserModel();
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');

  // 1. Kiểm tra định dạng Email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = 'Địa chỉ Email không hợp lệ.';
  } else {
    // 2. Kiểm tra Email tồn tại trong hệ thống
    $user = $userModel->getUserByEmail($email);

    if ($user) {
      // --- XỬ LÝ ĐẶT LẠI MẬT KHẨU ---

      // 3. TẠO MẬT KHẨU MỚI TẠM THỜI (8 ký tự ngẫu nhiên)
      $temp_password = substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789'), 0, 8);

      // 4. HASH MẬT KHẨU MỚI (Luôn phải hash trước khi lưu)
      $new_hashed_password = password_hash($temp_password, PASSWORD_DEFAULT);

      // 5. CẬP NHẬT MẬT KHẨU VÀO DATABASE
      if ($userModel->resetPasswordByEmail($email, $new_hashed_password)) {


        // Thay thế thông báo thành công (chỉ dùng khi TEST):
        $success_message = 'Mật khẩu mới đã được cập nhật trong database! Mật khẩu tạm thời (CHỈ DÀNH CHO BẠN TEST) là: <strong>' . htmlspecialchars($temp_password) . '</strong>. Vui lòng thử đăng nhập.';
      } else {
        $error_message = 'Đã xảy ra lỗi khi cập nhật mật khẩu. Vui lòng thử lại.';
      }
    } else {
      $error_message = 'Địa chỉ email này không tồn tại trong hệ thống.';
    }
  }
}

include '../view/user/forgot_password.php';

?>