<?php
require_once 'baslik.php';
require_once 'config.php'; 
require_once 'xtemplate.class.php'; 


$xtemplate = new XTemplate('contact.xtpl');


$contactData = [
    'contact_title' => 'Get In Touch',
    'your_name' => 'Your Name',
    'your_email' => 'Your Email',
    'your_phone' => 'Your Phone',
    'message' => 'Message',
    'send_button' => 'SEND',
];


$xtemplate->assign('contact_title', $contactData['contact_title']);


$xtemplate->assign('your_name', $contactData['your_name']);
$xtemplate->assign('your_email', $contactData['your_email']);
$xtemplate->assign('your_phone', $contactData['your_phone']);
$xtemplate->assign('message', $contactData['message']);
$xtemplate->assign('send_button', $contactData['send_button']);


$xtemplate->parse('contact_section');
$xtemplate->out('contact_section');
require_once 'footer1.php';

?>
