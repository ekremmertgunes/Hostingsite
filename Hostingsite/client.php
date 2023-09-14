<?php
require_once 'config.php'; 
require_once 'xtemplate.class.php'; 


$xtemplate = new XTemplate('client.xtpl');


$testimonialData = [
    'testimonial_title' => 'Testimonial',
    'testimonial_description' => 'Even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to',
    'testimonial_items' => [
        [
            'image' => 'images/client.jpg',
            'client_name' => 'Morojink',
            'client_type' => 'Customer',
            'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia',
        ],
        
    ],
];


$xtemplate->assign('testimonial_title', $testimonialData['testimonial_title']);
$xtemplate->assign('testimonial_description', $testimonialData['testimonial_description']);


foreach ($testimonialData['testimonial_items'] as $item) {
    $xtemplate->assign('testimonial_items.image', $item['image']);
    $xtemplate->assign('testimonial_items.client_name', $item['client_name']);
    $xtemplate->assign('testimonial_items.client_type', $item['client_type']);
    $xtemplate->assign('testimonial_items.testimonial_text', $item['testimonial_text']);
    $xtemplate->parse('client_section.testimonial_items');
}


$xtemplate->parse('client_section');
$xtemplate->out('client_section');

?>
