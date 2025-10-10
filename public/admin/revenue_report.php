<?php
session_start();

require_once '../../includes/config.php';
require_once '../../includes/db_connect.php';   
require_once '../../models/OrderModel.php';     
require_once '../../models/UserModel.php';
require_once '../../models/ProductModel.php';




$order_model = new OrderModel();
$user_model = new UserModel();
$products = new ProductModel();


$total_revenue = $order_model->getTotalRevenueMonth() ?? 0; 
$total_orders = $order_model->getTotalOrders() ?? 0;  
$total_users = $user_model->getTotalUsers(); 
$total_products = $products->getTotalProducts();

$revenue_chart_data = $order_model->getRevenueDataLast30Days();

$top_products = $order_model->getTopSellingProducts(4) ?? [];



$refund_rate = 0.5; 
$new_customers = 500; 

include '../../view/admin/revenue_report.php';
?>