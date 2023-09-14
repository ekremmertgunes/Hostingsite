<?php
require_once 'config.php';
require_once 'xtemplate.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

  

        $checkQuery = "SELECT COUNT(*) FROM users WHERE username = :username";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->execute();
        $rowCount = $checkStmt->fetchColumn();

        if ($rowCount > 0) {
            echo "Bu kullanıcı adı zaten kullanılıyor. Lütfen başka bir kullanıcı adı seçin.";
        } else {
           
            $insertQuery = "INSERT INTO users (username, password, first_name, last_name) VALUES (:username, :password, :first_name, :last_name)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->bindParam(':username', $username);
            $insertStmt->bindParam(':password', $password);
            $insertStmt->bindParam(':first_name', $first_name);
            $insertStmt->bindParam(':last_name', $last_name);

            if ($insertStmt->execute()) {
                echo "Kayıt başarıyla tamamlandı.";
                header('Location: login.php');
            } else {
                echo "Kayıt sırasında bir hata oluştu. Lütfen tekrar deneyin.";
            }
        }
  
}


$xtemplate = new XTemplate('register.xtpl');


$xtemplate->parse('main.register');
   


$xtemplate->parse('main');
$xtemplate->out('main');
?>

