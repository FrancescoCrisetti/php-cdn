<?php 

defined('_EXEC') or die;
$this->registerComponent("directories");
$ctrl = new directoriesController();

?>

<div class="mdl-navigation">
	<?php echo $ctrl->render(); ?>
</div>