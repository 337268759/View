<?php

use view\View;

include_once "../vendor/autoload.php";





View::add_tpl_hook('ren', ['field' => 'name,age,sex','func' => '\\view\\build\\Test.index']);
echo View::display(__DIR__ . '/html/test.html');
