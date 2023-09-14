<?php
require_once 'baslik.php';
require_once 'config.php'; 
require_once 'xtemplate.class.php'; 

try {
    $query = "SELECT * FROM plans";
    $stmt = $db->prepare($query);
    $stmt->execute();

    
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

  
    $xtemplate = new XTemplate('price.xtpl');

   
    foreach ($data as $package) {
        $xtemplate->assign('pricing_title', 'Our Pricing');
        $xtemplate->assign('price', $package['price']);
        $xtemplate->assign('plan_name', $package['plan_name']);
        $xtemplate->assign('ram', $package['ram']);
        $xtemplate->assign('storage', $package['storage']);
        $xtemplate->assign('backups', $package['backups']);
        $xtemplate->assign('protection', $package['protection']);
        $xtemplate->assign('root_access', $package['root_access']);
        $xtemplate->assign('tech_support', $package['tech_support']);
        $xtemplate->assign('detail_link', $package['detail_link']);
        $xtemplate->assign('id', $package['id']);

        
        $xtemplate->parse('main.price_boxes');
    }
  
    $xtemplate->parse('main');
	$xtemplate->out('main');
    
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
require_once 'footer1.php';
?>
