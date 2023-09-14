<?php
session_start();

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

   
    require 'config.php'; 
    $query = $db->prepare("SELECT COUNT(*) FROM user_cart WHERE user_id = :user_id");
    $query->bindParam(':user_id', $userId);
    $query->execute();
    $cartItemCount = $query->fetchColumn();

    echo $cartItemCount;
} else {
    echo '0'; 
}
?>
