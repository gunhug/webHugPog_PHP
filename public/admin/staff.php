<?php

require_once '../../includes/config.php';
require_once '../../includes/controllers/StaffController.php'; // Chứa StaffController

$staff_controller = new StaffController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_staff':
                $staff_controller->handleCreateStaff();
                break;
            case 'update_staff':
                $staff_controller->handleUpdateStaff();
                break;
            case 'delete_staff':
                $staff_controller->handleDeleteStaff();
                break;
            case 'change_status':
                $staff_controller->handleUpdateStaffStatus();
                break;
        }
    }
}

// Lấy danh sách nhân viên
$list_staff = $staff_controller->listStaff();



$success_message = $_SESSION['success_message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;
unset($_SESSION['success_message'], $_SESSION['error_message']);
include '../../view/admin/staff_management.php';
?>