function getFileFromDir(dir, element){
	jQuery(function($){
		if($(".mdl-collapse__link-active").length)
			$(".mdl-collapse__link-active").removeClass("mdl-collapse__link-active");
		
		$(element).toggleClass("mdl-collapse__link-active");
		$("#loading").show();
		$("#content-file").html("");
		$.ajax({
			url: "",
			method: "POST",
			dataType: 'text',
			data: {
				t: "ajax",
				f: 'getFileFromDir',
				d: dir
			},
			success: function(value) {
				// reset search input
				$("#search-image").val("");
				$("#search-image").closest(".mdl-js-textfield").removeClass("is-dirty").removeClass("is-focused");
				
				$("#loading").hide();
				$("#content-file").html(value);
				componentHandler.upgradeElements($('.mdl-tooltip').get());
			},
			error: function () {
				var message = new Message("Errore nel recupero dei file!", "error");
				message.show();
			}
		});
	});
}

function copyFileUrl(url){
	var fakeElem = document.createElement('textarea');
	// Prevent zooming on iOS
	fakeElem.style.fontSize = '12pt';
	// Reset box model
	fakeElem.style.border = '0';
	fakeElem.style.padding = '0';
	fakeElem.style.margin = '0';
	// Move element out of screen horizontally
	fakeElem.style.position = 'absolute';
	fakeElem.style.right = '-9999px';
	// Move element to the same position vertically
	fakeElem.style.top = (window.pageYOffset || document.documentElement.scrollTop) + 'px';
	fakeElem.setAttribute('readonly', '');
	fakeElem.value = url;

	document.body.appendChild(fakeElem);
	fakeElem.select();
	try {
        // copy text
		document.execCommand('copy');
		fakeElem.blur();
		
		// show message
		var message = new Message("URL copiato negli appunti!");
		message.show();
		// delete fake textarea
		document.body.removeChild(fakeElem);	
	} catch (err) {
		
		// if command 'copy' not run, remove fake textarea
		document.body.removeChild(fakeElem);
		// select dialog 
		var dialog = document.querySelector('dialog#dialog-message');
		if (! dialog.showModal) {
		  dialogPolyfill.registerDialog(dialog);
		}
		dialog.showModal();
		// insert url in dialog content
		dialog.querySelector("#dialog-content").innerHTML = url;
		// select url
		var range = document.createRange();
		var selection = window.getSelection();
		range.selectNodeContents(document.getElementById('dialog-content'));    
		selection.removeAllRanges();
		selection.addRange(range);
		// add listener when click on close button 
		dialog.querySelector('.close-icon').addEventListener('click', function() {
			if(dialog.open){
				dialog.close();
				dialog.querySelector("#dialog-content").innerHTML = "";
				document.querySelector('.mdl-layout__content').style.overflowX = 'auto';
				document.querySelector('.mdl-layout__content').style.overflowX = '';
			}
		});
	}
}