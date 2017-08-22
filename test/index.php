<?php

use view\View;

include_once "../vendor/autoload.php";

$html = "abcd{cms:xxx name=\"Jun\" key='index'}{/cms:dj}";
$html .= "abcd{cms:aaa name=\"Jun\" key='index'}{/cms:novel}";

View::add_tpl_hook('xxx', ['field' => 'name,key,value']);
View::compile($html);