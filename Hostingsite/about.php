<?php
require 'baslik.php';
require_once 'config.php';
require_once 'xtemplate.class.php';


$xtemplate = new XTemplate('about.xtpl');


$aboutData = [
    'about_title' => 'About Us',
    'about_description' => 'Words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
    'about_link' => 'about-us.html',
    'about_image' => 'images/about-img.png',
];


$xtemplate->assign('about_title', $aboutData['about_title']);
$xtemplate->assign('about_description', $aboutData['about_description']);
$xtemplate->assign('about_link', $aboutData['about_link']);
$xtemplate->assign('about_image', $aboutData['about_image']);
$xtemplate->parse('about_section');
$xtemplate->out('about_section');
require 'footer1.php';
?>
