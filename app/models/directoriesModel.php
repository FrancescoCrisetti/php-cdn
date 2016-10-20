<?php 

defined('_EXEC') or die;

Class directoriesModel {
	
	public $path;
	
	public $name;
	
	public $level;
	
	public $subDir;	
	
	public function __construct($p = "", $n = "", $l = 0){
		$this->path 	= $p;
		$this->name 	= $n;
		$this->level 	= $l;
	}
	
}

?>