jQuery(function($){
	$('.mdl-collapse__content').each(function(){
		var content = $(this);
		content.css('margin-top', -content.height());
	});

	$(document.body).on('click', '.mdl-collapse__button', function(){
		$(this).toggleClass("mdl-collapse__button-opened");
		$(this).parent('.mdl-collapse').find(".mdl-collapse__content").first().toggleClass("mdl-collapse__content-opened");
		//$(this).parent('.mdl-collapse').toggleClass('mdl-collapse--opened');
	});
});