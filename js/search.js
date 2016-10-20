jQuery(function($){
	var typingTimer;
	$("#search-image").keyup(function(){
		clearTimeout(typingTimer);
		var val = $(this).val();
		typingTimer = setTimeout(function(){doneTyping(val)}, 300);
	}).keydown(function(){
		clearTimeout(typingTimer);
	});
});

function doneTyping(val){
	jQuery(function($){
		$("#loading").show();
		$("#content-file").html("");
		if($(".mdl-collapse__link-active").length)
			$(".mdl-collapse__link-active").removeClass("mdl-collapse__link-active");
		
		$.ajax({
			url: "",
			method: "POST",
			dataType: 'text',
			data: {
				t: "ajax",
				m: 'files',
				f: 'searchByName',
				n: val
			},
			success: function(value) {
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