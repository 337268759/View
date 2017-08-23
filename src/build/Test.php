<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 17-8-23
 * Time: 上午10:38
 */

namespace view\build;


class Test
{
    public function index($args)
    {
        $data = [
            ['name' => 'Jun', 'age' => 18, 'sex' => '男'],
            ['name' => '小明', 'age' => 20, 'sex' => '男'],
            ['name' => '小花', 'age' => 16, 'sex' => '女'],
        ];

        return $data;
    }
}