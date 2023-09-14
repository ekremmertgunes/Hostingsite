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
     
        $query = $db->prepare("SELECT * FROM plans WHERE id = :product_id");
        $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if ($product) {
        
            $insertQuery = $db->prepare("INSERT INTO user_cart (user_id, product_id, quantity, created_at) VALUES (:user_id, :product_id, 1, NOW())");
            $insertQuery->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
            $insertQuery->bindParam(':product_id', $product['id'], PDO::PARAM_INT);

            if ($insertQuery->execute()) {
                echo "success"; 
            } else {
                echo "error"; 
            }
        } else {
            echo "error"; 
        }
    } catch (PDOException $e) {
        echo "error3"; 
    }
} else {
    echo "success"; 
}
?>
