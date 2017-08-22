<?php

include_once "../src/View.php";

$html = "abcd{cms:dj name=\"Jun\" key='index'}{/cms:dj}";
$html .= "abcd{cms:novel name=\"Jun\" key='index'}{/cms:novel}";

View::add_tpl_hook('dj', ['field' => 'name,key,value']);
View::compile($html);