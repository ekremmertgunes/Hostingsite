<?php
session_start(); // Oturumu başlat


if (isset($_SESSION['id'])) {
   
    session_unset(); 
    session_destroy(); 

    
    header('Location: anasayfa.php'); 
    exit;
}
?>
