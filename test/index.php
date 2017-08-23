<?php

use view\View;

include_once "../vendor/autoload.php";


function P($val = '') {
    echo "<pre>";
    if (is_array($val) || is_object($val)) {
        print_r($val);
    } else {
        var_dump($val);
    }
    die("</pre>");
}


View::add_tpl_hook('ren', ['field' => 'name,age,sex','func' => '\\view\\build\\Test.index']);
echo View::display(__DIR__ . '/html/test.html');
