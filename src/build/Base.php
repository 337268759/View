<?php

namespace view\build;

class Base
{
	public $dir_path = '';
	
	protected $html = '';
	
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
    	if(empty($text)) $text = $this->html;
		die($text);
        foreach ($this->label as $key => $value) {
        	$preg = "/{cms\:" . $key . "\s?([a-zA-Z=\"\'\s]*)?}.*{\/cms\:" . $key . "}/";
            if (preg_match($preg, $text, $arrs)) {
                $value[ 'field' ] = explode(',', $value[ 'field' ]);
                foreach ($value[ 'field' ] as $field) {
        			$preg = "/" . $field . "=[\'|\"]([a-zA-Z]*)?[\'|\"]/";
                    if (preg_match($preg, $arrs[ 1 ], $arr)) {
                        $value[ 'args' ][ $field ] = $arr[ 1 ];
                    }
                }
				$value['html'] = $arrs[0];
                $this->analyze[ $key ] = $value;
			
            }
        }
        $this->getFunc();
    }

    protected function getFunc()
    {
    	foreach($this->analyze as $item) {
    		
    	}
    }
	
	public function display($filename='') {
		$file =  $filename;
		die($file);
		if(is_file($file)) {
			$this->html = file_get_contents($file);
			$this->compile($this->html);
		} else {
			die("模板文件不存在！");
		}
		return $this->html;
	}

    protected function _dj($args)
    {
    	
    }
	
	protected __destruct() {
		$html = $this->html;
		return $html;
	}
}
