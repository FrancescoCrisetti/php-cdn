<?php
defined('_EXEC') or die;

class Html {
	
	public static $baseURL = "";
	
	public static function baseURL(){
		if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')){
			$https = 's://';
		} else {
			$https = '://';
		}

		if (!empty($_SERVER['PHP_SELF']) && !empty($_SERVER['REQUEST_URI'])){
			$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		} else {
			$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

			if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])){
				$theURI .= '?' . $_SERVER['QUERY_STRING'];
			}
		}
		return static::$baseURL = str_replace(array("'", '"', '<', '>'), array("%27", "%22", "%3C", "%3E"), $theURI);
	}
	
	private static function getAttr($attr = array()){
		return implode(' ', array_map(
			function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
			$attr,
			array_keys($attr)
		));
	}
	
	public static function getBase(){
		return static::baseURL();
	}
	
	public static function setTitle($title){
		return "<title>$title</title>";
	}
	
	public static function addMeta($name, $content){
		return "<meta name='$name' content='$content'>";
	}
	
	public static function addStyle($name, $rel = ""){
		return "<link". ($rel? " rel='$rel' ":" ") ."href='". static::baseURL() . "css/$name'>";
	}
	
	public static function addScript($name, $type = ""){
		return "<script". ($type? " type='$type' ":" ") ."src='". static::baseURL() . "js/$name'></script>";
	}
	
	public static function addStyleURL($name, $rel = ""){
		return "<link". ($rel? " rel='$rel' ":" ") ."href='$name'>";
	}
	
	public static function addScriptURL($name, $type = ""){
		return "<script". ($type? " type='$type' ":" ") ."src='$name'></script>";
	}
	
	public static function linkTo($url, $txt, $attr = array()){
		return "<a href='". static::baseURL() . $url ."' ". static::getAttr($attr) .">$txt</a>";
	}
	
	public static function image($url, $attr = array()){
		return "<img src='". static::baseURL() . $url ."' ". static::getAttr($attr) .">";
	}
}
?>