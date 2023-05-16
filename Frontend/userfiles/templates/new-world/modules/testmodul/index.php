<?php
    require_once(dirname(__FILE__) . DS . 'functions.php');
    $RawItems = test();

    echo "<h1>Hello module</h1>";
    echo "<pre>";
    print_r($RawItems);
    echo "</pre>";
?>
