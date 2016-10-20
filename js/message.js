var Message = function(message, type = 'default'){
	this.message = message;
	this.selector = document.querySelector("#message-toast-"+type);
}

Message.prototype.show = function(){
    'use strict';
	var data = {message: this.message};
	this.selector.MaterialSnackbar.showSnackbar(data);
}