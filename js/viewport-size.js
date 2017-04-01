(function(){
	var css = document.createElement("style");
	css.type = "text/css";
	css.innerHTML = "#vpsize {position: fixed; right: 0; bottom: 0; padding: 0 1em; line-height: 2; cursor: cursor; cursor: none; -webkit-user-select: none; transition: all 0.3s; color: black; background: rgba(104, 104, 104, 0.2); margin: 0;} #vpsize:hover {color: white; background: #686868;}";
	document.head.appendChild(css);
	var vpSizeWrapper = document.createElement('div');
	vpSizeWrapper.setAttribute('id', 'vpsize');
	document.body.appendChild(vpSizeWrapper);
	getSize();

	function getSize() {
		var vpWidth, vpHeight, vpSize;
		vpWidth = window.innerWidth;
		vpHeight = window.innerHeight;
		vpSize = vpWidth + " w:h " + vpHeight;
		vpSizeWrapper.innerHTML = vpSize;
	}

	window.addEventListener('resize', getSize);
}());
