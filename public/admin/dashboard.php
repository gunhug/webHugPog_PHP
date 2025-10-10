<?php
// File: project/public/admin/dashboard.php
require_once __DIR__ . '../../../includes/db_connect.php';
require_once __DIR__ . '../../../models/OrderModel.php';
require_once __DIR__ . '../../../models/ProductModel.php';
require_once __DIR__ . '../../../models/UserModel.php';
require_once __DIR__ . '../../../models/StaffModel.php';

// Tạo đối tượng Model
$order_model = new OrderModel();
$products = new ProductModel();
$user_model = new UserModel();
$staff_model = new StaffModel(); 

$total_orders = $order_model->getTotalOrders();
$total_products = $products->getTotalProducts();
$total_users = $user_model->getTotalUsers(); 
$total_staff = $staff_model->getTotalStaff();
$total_revenue_today = $order_model->getTotalRevenueToday();
$total_revenue_month = $order_model->getTotalRevenueMonth();

$recent_orders = $order_model->getRecentOrders(5);
$recent_products = $products->getRecentProducts(5);

$revenue_chart_data = $order_model->getRevenueDataLast30Days();


function display_order_status($status)
{
    $status = strtolower($status);
    $badges = [
        'chờ xác nhận' => 'badge bg-warning',
        'đang xử lý' => 'badge bg-info',
        'đang vận chuyển' => 'badge bg-primary',
        'đã hoàn thành' => 'badge bg-success',
        'đã hủy' => 'badge bg-danger',
    ];
    $display_status = $status;
    $badge_class = $badges[$status] ?? 'badge bg-secondary';

    // Cập nhật tên hiển thị
    if ($status === 'chờ xác nhận') $display_status = 'Chờ Xác nhận';
    if ($status === 'đang xử lý') $display_status = 'Đang Xử lý';
    if ($status === 'đang vận chuyển') $display_status = 'Đang Vận chuyển';
    if ($status === 'đã hoàn thành') $display_status = 'Đã Hoàn thành';
    if ($status === 'đã hủy') $display_status = 'Đã Hủy';

    return "<span class=\"$badge_class\">$display_status</span>";
}
include '../../view/admin/dashboard.php';
?>
?>