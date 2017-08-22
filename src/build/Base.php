<?php

namespace view\build;

class Base
{
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

    public function compile($text = '')
    {
        var_dump($this);
        die();
        foreach ($this->label as $key => $value) {
            if (preg_match("/{cms\:" . $key . "\s?([a-zA-Z=\"\'\s]*)?}.*{\/cms\:" . $key . "}/", $text, $arrs)) {
                $value[ 'field' ] = explode(',', $value[ 'field' ]);
                foreach ($value[ 'field' ] as $field) {
                    if (preg_match("/" . $field . "=[\'|\"]([a-zA-Z]*)?[\'|\"]/", $arrs[ 1 ], $arr)) {
                        $value[ 'args' ][ $field ] = $arr[ 1 ];
                    }
                }
                $this->analyze[ $key ] = $value;
            }
        }
        self::getFunc();
    }

    protected function getFunc()
    {
        print_r($this->analyze);
    }

    protected function _dj($args)
    {

    }
}