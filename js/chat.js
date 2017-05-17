var textarea = document.querySelector('.chat-typetext');
textarea.addEventListener('keydown', function(e){
	if(e.which == 13) {
		e.preventDefault();
		$('#message-chat').submit();
	}
	textarea.style.cssText = 'height:' + (textarea.scrollHeight + 2) + 'px';
});

function scrollDown() {
	var container = $("#message-container");
	var height = container[0].scrollHeight - container[0].clientHeight;
	console.log(height);
	container.scroll();
	container.animate({
		scrollTop: height
	}, 500);
}

function addMessageFromMe(date, text) {
	var container = $("#message-container");
	var child = '<article time="' + date + '" class="chat-message chat-user-2">' + text + '</article>';
	container.append(child);
}

function addMessageFromPartner(date, text) {
	var container = $("#message-container");
	var child = '<article time="' + date + '" class="chat-message chat-user-1">' + text + '</article>';
	container.append(child);
}

function sendMessage(user) {
	var text = $("#message-input").val();
	console.log("Sending: [" + text + "]");
	$("#message-input").val("");
	$.ajax({
	type: "POST",
	url: "/ajax/sendmessage.php",
	data: { user: user, text: text},
		success: function (msg) {
			console.log("Ok!");
			var response = JSON.parse(msg);
			addMessageFromMe(response.date, atob(response.text));
			scrollDown();
		}
	});
}

function checkMessages(user) {
	console.log("Checking...");
	$.ajax({
		type: "POST",
		url: "/ajax/checkmessages.php",
		data: { user: user, last_id: last_message_id },
		success: function (msg) {
			console.log("Ok!")
			var response = JSON.parse(msg);
			for (var i = 0; i < response.length; i++) {
				addMessageFromPartner(response[i].date, response[i].text);
				last_message_id = response[i].id;
			}
			if(response.length > 0) {
				scrollDown();
			}
		}
	});
}
