<?php
session_start();

require 'config.php'; 

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['id'];


$query = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$query->bindParam(':user_id', $userId);
$query->execute();
$userInfo = $query->fetch(PDO::FETCH_ASSOC);


$query = $db->prepare("SELECT orders.*, plans.plan_name AS product_name FROM orders
                       INNER JOIN plans ON orders.product_id = plans.id
                       WHERE orders.user_id = :user_id");
$query->bindParam(':user_id', $userId);
$query->execute();
$userOrders = $query->fetchAll(PDO::FETCH_ASSOC);


require 'xtemplate.class.php';
$xtemplate = new XTemplate('profile.xtpl');


$xtemplate->assign('page_title', 'Kullanıcı Profili');
$xtemplate->assign('username', $userInfo['username']);
$xtemplate->assign('full_name', $userInfo['first_name'] . ' ' . $userInfo['last_name']);


foreach ($userOrders as $order) {
    $xtemplate->assign('order_id', $order['id']);
    $xtemplate->assign('product_name', $order['product_name']);
    $xtemplate->assign('order_date', $order['order_date']);
    $xtemplate->parse('main.orders');
}


$xtemplate->parse('main');
$xtemplate->out('main');
?>
