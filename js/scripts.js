var textarea = document.querySelector('.chat-typetext');
textarea.addEventListener('keydown', autosize);

function autosize(){
	var el = this;
	setTimeout(function(){
		el.style.cssText = 'height:' + (el.scrollHeight + 2) + 'px';
	},0);
}
