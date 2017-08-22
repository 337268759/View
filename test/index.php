<?php

include_once "../src/View.php";

$html = "abcd{cms:xxx name=\"Jun\" key='index'}{/cms:dj}";
$html .= "abcd{cms:aaa name=\"Jun\" key='index'}{/cms:novel}";

View::add_tpl_hook('xxx', ['field' => 'name,key,value']);
View::compile($html);