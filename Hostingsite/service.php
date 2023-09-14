<?php
require_once 'baslik.php';
require_once 'config.php'; 
require_once 'xtemplate.class.php'; 


$xtemplate = new XTemplate('service.xtpl');


$xtemplate->parse('main');
$xtemplate->out('main');
require_once 'footer1.php';
?>
