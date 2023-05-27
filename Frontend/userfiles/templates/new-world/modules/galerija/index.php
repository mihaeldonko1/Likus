<?php
require_once(dirname(__FILE__) . DS . 'functions.php');

$id_skupine = get_option('id_skupine', $params['id']);
$text_galerije = get_option('text_galerije', $params['id']);

$items = getImages($id_skupine);

print_r($items);
?>