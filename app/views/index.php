<?php

defined('_EXEC') or die;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php 
			echo Html::setTitle("CDN - Omnigraf"); 
			echo Html::addMeta("robots", "noindex, nofollow");
			echo Html::addMeta("viewport", "width=device-width, initial-scale=1.0, minimum-scale=1.0"); 
			echo Html::addStyle("material.min.css", "stylesheet"); 
			echo Html::addStyle("style.css", "stylesheet"); 
			echo Html::addStyle("mdl-collapse.css", "stylesheet"); 
			echo Html::addStyleURL("https://fonts.googleapis.com/icon?family=Material+Icons", "stylesheet"); 
			echo Html::addScript("jquery-3.1.1.js"); 
			echo Html::addScript("material.min.js"); 
			echo Html::addScript("script.js"); 			
			echo Html::addScript("mdl-collapse.js"); 			
			echo Html::addScript("message.js"); 			
			echo Html::addScript("search.js"); 			
		?>
	</head>
	
	<?php echo $this->body(); ?>
	
</html>