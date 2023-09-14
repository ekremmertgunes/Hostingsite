<?php

$host = "localhost"; 
$port = "5432"; 
$dbname = "aboneliksite"; 
$username = "postgres"; 
$password = "Mertdeneme12"; 

try {
   
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    
   
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    $db->exec("SET NAMES 'utf8'");
    
    echo "";
} catch (PDOException $e) {
    die("Veritabanına bağlanırken bir hata oluştu: " . $e->getMessage());
}


?>
