<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

require 'config.php'; 


$paymentSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  
    $paymentSuccess = true;

    if ($paymentSuccess && isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];

        
        $query = $db->prepare("SELECT product_id FROM user_cart WHERE user_id = :user_id");
        $query->bindParam(':user_id', $userId);
        $query->execute();
        $cartItems = $query->fetchAll(PDO::FETCH_COLUMN);

        
        foreach ($cartItems as $productId) {
            $insertQuery = $db->prepare("INSERT INTO orders (user_id, product_id) VALUES (:user_id, :product_id)");
            $insertQuery->bindParam(':user_id', $userId);
            $insertQuery->bindParam(':product_id', $productId);
            $insertQuery->execute();
        }

      
        $clearCartQuery = $db->prepare("DELETE FROM user_cart WHERE user_id = :user_id");
        $clearCartQuery->bindParam(':user_id', $userId);
        $clearCartQuery->execute();
    }
}


if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $query = $db->prepare("SELECT orders.*, plans.plan_name FROM orders
                           INNER JOIN plans ON orders.product_id = plans.id
                           WHERE orders.user_id = :user_id");
    $query->bindParam(':user_id', $userId);
    $query->execute();
    $userOrders = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Ekranı</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .payment-form {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Ödeme Ekranı</h2>
        <div class="payment-form">
            <?php if ($paymentSuccess): ?>
                <!-- Ödeme başarılı mesajı -->
                <div class="alert alert-success">
                    Ödeme işlemi başarıyla tamamlandı. Satın aldığınız ürünler <a href="profile.php">profilinizde</a> gösteriliyor.
                </div>
            <?php else: ?>
                <!-- Ödeme formu -->
                <form method="POST">
                    <div class="form-group">
                        <label for="card_name">İsim Soyisim:</label>
                        <input type="text" class="form-control" id="card_name" name="card_name" required>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Kredi Kartı Numarası:</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expiration_date">Son Kullanma Tarihi:</label>
                            <input type="text" class="form-control" id="expiration_date" name="expiration_date" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cvv">CVV:</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Ödeme Yap</button>
                </form>
            <?php endif; ?>
        </div>

        <!-- Kullanıcı Siparişleri -->
        <h2>Kullanıcı Siparişleri</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Sipariş ID</th>
                    <th>Ürün Adı</th>
                    <th>Sipariş Tarihi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userOrders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['plan_name']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS ve jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
