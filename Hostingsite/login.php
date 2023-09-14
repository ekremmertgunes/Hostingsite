<?php
require_once 'config.php';
require_once 'xtemplate.class.php';


$xtemplate = new XTemplate('login.xtpl');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

   
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $login_username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $login_password, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
       
        $_SESSION['id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];

        header('Location: anasayfa.php');
        exit;
    } else {
        $xtemplate->assign('message', 'Kullanıcı adı veya şifre hatalı.');
    }
}

$xtemplate->parse('login');
$xtemplate->out('login');

?>
