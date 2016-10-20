<?php

defined('_EXEC') or die;

Class directoriesController {
	
	public function __construct(){}
	
	private function getDirectories($path = 'images', $level = 0){
		
		$p = explode("/",$path);
		$directory = new directoriesModel($path, end($p), $level++);
		
		if($dir = opendir(BASE_PATH .'/'. $directory->path)){
			while ($file = readdir($dir)){
				if (is_dir(BASE_PATH .'/'. $directory->path .'/'. $file)){
					if ($file != "." & $file != ".."){
						$directory->subDir[] = $this->getDirectories($path .'/'. $file, $level);
					}
				} 
			}
		}
		closedir($dir);
		
		return $directory;
	}
	
	private function renderDirectories($directory){
		$content = "";
		foreach($directory as $dir){
			if($dir->level != 0){
				if(!empty($dir->subDir)){
					$content .= '<div class="mdl-collapse">
						<a class="mdl-navigation__link mdl-collapse__button">
							<i class="material-icons mdl-collapse__icon mdl-animation--default">expand_more</i>'. str_repeat("&nbsp;", $dir->level-1) .' '.$dir->name .'
						</a>';
					$content .= '<div class="mdl-collapse__content-wrapper">
						<div class="mdl-collapse__content mdl-animation--default">';
					$content .= $this->renderDirectories($dir->subDir);
					$content .= '</div>
						</div>
					</div>';
				} else {
					$content .= '<a class="mdl-navigation__link" href="javascript:void(0);" onclick="getFileFromDir(\''. $dir->path .'\', this);">'. str_repeat("&nbsp;", $dir->level-1) .' '.$dir->name.'</a>';
				}
			} else {				
				if(!empty($dir->subDir)){
					$content .= $this->renderDirectories($dir->subDir);
				}
			}
		}
		return $content;
	}
	
	public function render($path = 'images'){
		$dirs = array($this->getDirectories($path));
		$content = $this->renderDirectories($dirs);
		return $content;
	}
	
}


?>