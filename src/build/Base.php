<?php

namespace view\build;

class Base
{
    public $dir_path = '';

    protected $html = '';
    protected $newHtml = '';
    protected $vals = [];

    protected $label = [
        'foreach' => 'this._foreach',
        'dj' => [
            'field' => 'name,key,value',
            'func' => 'this._dj'
        ]
    ];

    protected $analyze = [];


    public function add_tpl_hook($tab = '', $values = [])
    {
        $this->label[ $tab ] = $values;
    }

    public function getPreg($text = '')
    {
        if (empty($text)) {
            $text = $this->html;
        }

        foreach ($this->label as $key => $value) {
            $preg = "/{cms\:" . $key . "\s?([0-9a-zA-Z=\"\'\s]*){0,}}([\s\S]{0,}){\/cms\:" . $key . "}/";
            if (preg_match($preg, $text, $arrs)) {
                $value[ 'label' ] = $key;
                $value[ 'field' ] = explode(',', $value[ 'field' ]);
                $value[ 'args' ] = [];
                foreach ($value[ 'field' ] as $field) {
                    $preg = "/" . $field . "=[\'|\"]([0-9a-zA-Z]*)?[\'|\"]/";
                    if (preg_match($preg, $arrs[ 1 ], $arr)) {
                        $value[ 'args' ][ $field ] = $arr[ 1 ];
                    }
                }
                $value[ 'oldhtml' ] = $arrs[ 0 ];
                $value[ 'newhtml' ] = $arrs[ 2 ];
                $this->analyze[ $key ] = $value;
            }
        }
        $this->getFunc();
    }

    protected function getFunc()
    {
        foreach ($this->analyze as $item) {
            $tmp = explode('.', $item[ 'func' ]);
            if (in_array($tmp[ 0 ], ['this', '$this', '_this'])) {
                $act = $this;
            } else {
                $act = $tmp[ 0 ];
                $act = new $act();
            }

            if (method_exists($act, $func = $tmp[ 1 ])) {
                $item[ 'data' ] = $act->$func($item[ 'args' ]);
                $this->newHtml = self::compile($item);
            } else {
                die("该函数不存在");
            }
        }
    }

    public function compile($data)
    {
        $text = $data[ 'newhtml' ];
        $newhtml = '';
        foreach ($data[ 'data' ] as $value) {
            $tmp = $text;
            foreach ($value as $key => $value) {
                $search = "[{$data['label']}.{$key}]";
                $tmp = str_replace($search, $value, $tmp);
            }
            $newhtml .= $tmp;
        }
        $data[ 'newhtml' ] = $newhtml;
        return $this->newHtml = str_replace($data[ 'oldhtml' ], $newhtml, $this->newHtml);
    }

    public function display($filename = '', $vals = [])
    {
        $file = $filename;
        if (is_file($file)) {
            $this->html = $this->newHtml = file_get_contents($file);
            $this->getPreg();
        } else {
            die("模板文件不存在！");
        }
        if (! empty($vals)) {
            self::assign($vals);
        }

        echo $this->newHtml;
    }

    protected function _dj($args)
    {
        return [
            ['name' => '小红', 'age' => 15, 'sex' => '女'],
            ['name' => 'Jun', 'age' => 18, 'sex' => '男'],
            ['name' => '小花', 'age' => 16, 'sex' => '女'],
        ];
    }

    public function assign($val = '', $value = '')
    {
        if (empty($val)) {
            return false;
        }

        if (is_array($val)) {
            foreach ($val as $k => $item) {
                $this->vals[ $k ] = $item;
            }
        } else {
            $this->vals[ $val ] = $this->vals;
        }
    }
}
