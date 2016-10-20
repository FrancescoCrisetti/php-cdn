<?php 

class ajaxController {
	
	public function __construct(){}

	public function getFileFromDir(){
		$path = strip_tags($_POST['d']);
		$directory = BASE_PATH .'/'. $path;
		$content = '<div class="mdl-grid">';
		$i = 0;
		if ($handle = opendir($directory)){
			while ($file = readdir($handle)){
				if (is_dir("{$directory}/{$file}")){
					if ($file != "." & $file != ".."){
						$content .= '<div class="mdl-cell mdl-cell--2-col mdl-cell--2-col-tablet mdl-cell--2-col-phone">
							<div class="mdl-card mdl-shadow--2dp omni-card">
								<div class="mdl-card__title mdl-card--expand">
									<i class="material-icons">folder</i>
								</div>
								<div class="mdl-card__actions mdl-card--border">
									<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="javascript:void(0);" onclick="getFileFromDir(\''. $path.'/'.$file .'\');">
										'. $file .'
									</a>
								</div>
							</div>
						</div>';
					}
				} else {
					if ($file != "." & $file != ".."){
						list($width, $height, $type, $attr) = getimagesize($directory.'/'.$file);
						if(in_array($type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
							$style = "";
							$imgStyle = "";
							if($height <= 150)
								$style = 'margin-top:'. ((150 - $height)/2) .'px;';
							else
								$imgStyle = 'height:150px;';
							$content .= '<div class="mdl-cell mdl-cell--2-col mdl-cell--2-col-tablet mdl-cell--2-col-phone">
								<div class="mdl-card mdl-shadow--2dp omni-card">
									<div class="mdl-card__media mdl-card--expand omni-card__media" style="'.$style.'">'.
										Html::image($path.'/'.$file, ["alt" => $file, "style" => $imgStyle])
									.'</div>
									<div class="mdl-card__actions mdl-card--border">
										<span id="omni-file-name-'. $i .'">'. (strlen($file) > 17 ?  substr($file,0,14)."..." : $file)  .'</span>
										'. (strlen($file) > 17 ?  '<div class="mdl-tooltip" data-mdl-for="omni-file-name-'. $i .'">
											'. $file .'
										</div>' : '') .'
										<div class="mdl-layout-spacer"></div>
										<a class="mdl-button mdl-js-button mdl-button--icon" href="javascript:void(0);" id="copy-action-'.$i.'" onclick="copyFileUrl(\''. Html::$baseURL .''. $path.'/'.$file .'\');">
											<i class="material-icons">content_copy</i>
										</a>
										<div class="mdl-tooltip" data-mdl-for="copy-action-'. ($i++) .'">
											Copia URL
										</div>
									</div>
								</div>
							</div>';
						}
					}
				}
			}
		}
		closedir($handle);
		$content .= '</div>';
		return $content;
	}
	
	public function searchByName(){
		$name = strip_tags($_POST['n']);
		$files = $this->getFilesFromDir($name);
		$content = '<div class="mdl-grid">';
		$i=0;
		foreach($files as $file){
			if(in_array($file->type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
				$style = "";
				$imgStyle = "";
				if($file->height <= 150)
					$style = 'margin-top:'. ((150 - $file->height)/2) .'px;';
				else
					$imgStyle = 'height:150px;';
				$content .= '<div class="mdl-cell mdl-cell--2-col mdl-cell--2-col-tablet mdl-cell--2-col-phone">
					<div class="mdl-card mdl-shadow--2dp omni-card">
						<div class="mdl-card__media mdl-card--expand omni-card__media" style="'.$style.'">'.
							Html::image($file->path, ["alt" => $file->name, "style" => $imgStyle])
						.'</div>
						<div class="mdl-card__actions mdl-card--border">
							<span id="information-'. $i .'">'. $file->name .'</span>
							<div class="mdl-tooltip" data-mdl-for="information-'. ($i++) .'">
								'. $file->width.'x'.$file->height.'
							</div>
							<a class="mdl-button mdl-js-button mdl-button--icon" href="javascript:void(0);" onclick="copyFileUrl(\''. Html::$baseURL .''. $file->path .'\');">
								<i class="material-icons">content_copy</i>
							</a>
						</div>
					</div>
				</div>';
			}
		}
		$content .= '</div>';
		return $content;
		
	}
	
	private function getFilesFromDir($name, $path = 'images'){
		
		$files = array();
		
		if($dir = opendir(BASE_PATH .'/'. $path)){
			while ($file = readdir($dir)){
				if (is_dir(BASE_PATH .'/'. $path .'/'. $file)){
					if ($file != "." & $file != ".."){
						$a2 = $this->getFilesFromDir($name, $path .'/'. $file);
						$files = array_merge($files,$a2);
					}
				} else {
					if(stripos($file,$name)!==false){						
						list($width, $height, $type, $attr) = getimagesize(BASE_PATH .'/'. $path.'/'.$file);
						$files[] = new filesModel(Html::$baseURL .''. $path.'/'.$file, $file, $width, $height, $type);
					}
				}
			}
		}
		closedir($dir);
		
		return $files;
	}
}

?>