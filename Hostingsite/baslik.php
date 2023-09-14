<?php
require_once 'config.php';
require_once 'xtemplate.class.php';


session_start();

$userLoggedIn = false; 
$username = ''; 

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

    $userLoggedIn = true;
    $username = $_SESSION['username'];
}


$siteName = 'Hostit';
$phoneNumber = '+01 123455678990';



$xtemplate = new XTemplate('baslik.xtpl');
$xtemplate->assign('siteName', $siteName);
$xtemplate->assign('phoneNumber', $phoneNumber);
$xtemplate->assign('userLoggedIn', $userLoggedIn); 
$xtemplate->assign('username', $username);




if ($userLoggedIn) {
    $xtemplate->assign('username', $username);
    $xtemplate->parse('main.logged_in');
    $xtemplate->parse('main.logout_button');
} else {
    $xtemplate->parse('main.login_button');
}

$xtemplate->parse('main');
$xtemplate->out('main');
?>
