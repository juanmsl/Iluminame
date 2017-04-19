function scrollDown()
{
  var container = $("#message-container");
  container.scroll();
  container.animate({
    scrollTop: 1000
  }, 2000);
}

function addMessageFromMe(date, text)
{
  var container = $("#message-container");
  var child = '<article time="' + date + '" class="chat-message chat-user-2">' + text + '</article>';
  container.append(child);
  scrollDown();
}

function addMessageFromPartner(date, text)
{
  var container = $("#message-container");
  var child = '<article time="' + date + '" class="chat-message chat-user-1">' + text + '</article>';
  container.append(child);
  scrollDown();
}

function sendMessage(user)
{
  console.log("Sending...");
  var text = $("#message-input").val();

  $.ajax({
    type: "POST",
    url: "/ajax/sendmessage.php",
    data: { user: user, text: text},
      success: function (msg) {
        console.log("Ok!");
        var response = JSON.parse(msg);
        addMessageFromMe(response.date, response.text);
        $("#message-input").val("");
      }
  });
}

function checkMessages(user)
{
  console.log("Checking...");
  $.ajax({
    type: "POST",
    url: "/ajax/checkmessages.php",
    data: { user: user },
      success: function (msg) {
        console.log("Ok!")
        var response = JSON.parse(msg);
        for (var i = 0; i < response.length; i++)
        {
          addMessageFromPartner(response[i].date, response[i].text);
        }
      }
  });
}
