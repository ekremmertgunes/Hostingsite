<?php
require 'config.php';
require 'xtemplate.class.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$id = $_SESSION['id'];


try {

    $query = $db->prepare("SELECT plans.* FROM user_cart
    INNER JOIN plans ON user_cart.product_id = plans.id
    WHERE user_cart.user_id = :id");
$query->bindParam(':id', $id);
$query->execute();

    $query->bindParam(':id', $id);
    $query->execute();

    $sepet_urunler = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Veritabanı hatası: ' . $e->getMessage());
}


$xtemplate = new XTemplate('cart.xtpl');
$xtemplate->assign('title', 'Sepetim');

foreach ($sepet_urunler as $urun) {
    $xtemplate->assign('plan_name', $urun['plan_name']);
    $xtemplate->assign('price', $urun['price']);
    $xtemplate->assign('id', $urun['id']);
    $xtemplate->parse('main.sepet_urunler');
}
$totalPrice = 0; 

foreach ($sepet_urunler as $urun) {
    $totalPrice += $urun['price'];
}

$xtemplate->parse('main');
$xtemplate->out('main');

?>
