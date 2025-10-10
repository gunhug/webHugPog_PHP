<?php
require_once '../includes/controllers/UserController.php';

$userController = new UserController();

$errors = $userController->handleLogin();

include '../view/user/login.php';
?>