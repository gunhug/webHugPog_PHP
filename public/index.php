<?php
require_once '../includes/controllers/ProductController.php';
require_once '../models/OrderModel.php';     

$productController = new ProductController();
$order_model = new OrderModel();

$allProduct = $productController->getProductsForHomePage();

$bestSellers = array_slice($allProduct, 0, 4);

$productsPerBlock = ceil(count($bestSellers) / 4);
$productBlocks = array_chunk($bestSellers, 1);
$top_products = $order_model->getTopSellingProducts(4) ?? [];

include '../view/user/index.php';
?>