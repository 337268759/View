<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 17-8-22
 * Time: 下午5:51
 */
function V($filename = '') {
    return $filename;
}

function P($val = '') {
    echo "<pre>";
    if (is_array($val) || is_object($val)) {
        print_r($val);
    } else {
        var_dump($val);
    }
    die("</pre>");
}