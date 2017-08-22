<?php

use view\View;

include_once "../vendor/autoload.php";

echo "<pre>";

View::add_tpl_hook('aaa', ['field' => 'name,key,value','func' => 'this._dj']);
View::display(__DIR__ . '/html/test.html');
