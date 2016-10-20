<?php 

defined('_EXEC') or die;

Class filesModel {
	
	public $path;
	
	public $name;
	
	public $width;
	
	public $height;
	
	public $type;
	
	public function __construct($p = "", $n = "", $w = "", $h = "", $t = ""){
		$this->path 		= $p;
		$this->name 		= $n;
		$this->width 		= $w;
		$this->height 		= $h;
		$this->type 		= $t;
	}
	
}

?>