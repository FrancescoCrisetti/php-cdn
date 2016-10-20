<?php defined('_EXEC') or die; ?>

<body>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
		<header class="mdl-layout__header mdl-layout__header--waterfall">
			<!-- Top row, always visible -->
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title"><?php echo Html::linkTo("",'<i class="material-icons">home</i>'); ?></span>
				<div class="mdl-layout-spacer"></div>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-center">
					<label class="mdl-button mdl-js-button mdl-button--icon" for="search-image">
						<i class="material-icons">search</i>
					</label>
					<div class="mdl-textfield__expandable-holder">
						<input class="mdl-textfield__input" type="text" name="search-image" id="search-image" placeholder="Cerca immagine">
					</div>
				</div>
			</div>
		</header>

		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">Cartelle</span>
			<?php echo $this->partial("partials/_drawer.php"); ?>
		</div>

		<main class="mdl-layout__content mdl-color--grey-100 mdl-color-text--grey-700">
			<div style="text-align: center;margin-top: 15%;display:none;" id="loading">
				<div class="mdl-spinner mdl-js-spinner is-active"></div>
			</div>
			<div class="page-content" id="content-file">
			</div>
		</main>

		<!-- <footer class="mdl-mini-footer">
			<div class="mdl-mini-footer__left-section">
				<div class="mdl-logo">CDN Omnigraf</div>
			</div>
		</footer> -->
		
		<!-- Snackbar default - START -->
		<div id="message-toast-default" class="mdl-js-snackbar mdl-snackbar mdl-snackbar-default">
			<div class="mdl-snackbar__text"></div>
			<button class="mdl-snackbar__action" type="button"></button>
		</div>	
		<!-- Snackbar default - END -->
		
		<!-- Snackbar error - START -->
		<div id="message-toast-error" class="mdl-js-snackbar mdl-snackbar mdl-snackbar-error">
			<div class="mdl-snackbar__text"></div>
			<button class="mdl-snackbar__action" type="button"></button>
		</div>	
		<!-- Snackbar error - END -->

		<!-- Dialog box - START -->
		<dialog class="mdl-dialog" id="dialog-message">
			<h4 class="mdl-dialog__title">
				<button type="button" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect close-icon">
					<i class="material-icons">close</i>
				</button>		
			</h4>
			<div class="mdl-dialog__content">
				<span class="dialog-content-description">Per copiare l'URL dell'immagine premi CTRL+C.</span>
				<div id="dialog-content"></div>
			</div>
		</dialog>
		<!-- Dialog box - END -->
	</div>
</body>