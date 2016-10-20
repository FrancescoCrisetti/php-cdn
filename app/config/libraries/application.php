<?php
defined('_EXEC') or die;

class Application {
	
	public function __construct(){}
	
	public function render(){
		if(isset($_POST["t"]) && $_POST["t"]=="ajax"){
			$this->registerController("ajax");
			if(isset($_POST["m"]))
				$this->registerModel($_POST["m"]);
			if(isset($_POST["h"]))
				$this->registerModel($_POST["h"]);		
			$f = strip_tags($_POST["f"]);
			$c = new ajaxController();
			echo $c->$f();
		} else {			
			ob_start();
			include VIEWS_PATH . "/index.php";
			return ob_get_clean();
		}
	}
	
	public function body($layout = ""){		
		ob_start();
		include VIEWS_PATH . "/layouts/" . ($layout ? $layout : "default.php");
		return ob_get_clean();
	}
	
	public function partial($file){
		ob_start();
		include VIEWS_PATH . $file;
		return ob_get_clean();
	}
	
	public function registerComponent($name){
		$this->registerController($name);
		$this->registerHelper($name);
		$this->registerModel($name);
	}
	
	public function registerController($file){
		if(file_exists(CONTROLLERS_PATH . $file .'Controller.php'))
			include CONTROLLERS_PATH . $file .'Controller.php';
	}
	
	public function registerHelper($file){
		if(file_exists(HELPERS_PATH . $file .'Helper.php'))
			include HELPERS_PATH . $file .'Helper.php';
	}
	
	public function registerModel($file){
		if(file_exists(MODELS_PATH . $file .'Model.php'))
			include MODELS_PATH . $file .'Model.php';
	}
}
?>