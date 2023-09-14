<?php
require 'config.php';


session_start();


if (!isset($_SESSION['id'])) {
    echo "error";
    exit;
}


if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    try {
       
        $query = $db->prepare("DELETE FROM user_cart WHERE user_id = :user_id AND product_id = :product_id");
        $query->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
        $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($query->execute()) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    } catch (PDOException $e) {
        echo "error"; 
    }
} else {
    echo "missing_product_id"; 
}
?>
