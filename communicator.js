//AJAX - push comment to server
function pushChatData() {
  if(document.getElementById('activated').checked) {
    var xmlhttp = new XMLHttpRequest();
    var userName = document.getElementById('user_name').value;
    var commentContent = document.getElementById('content').value;

    xmlhttp.open('GET', 'poll_add.php?user_name='+userName+'&content='+commentContent, true);
    xmlhttp.send();
  }
}

//AJAX - long poll from server
function pullChatData(timestamp) {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200 && document.getElementById('activated').checked) {
      var responseObject = JSON.parse(this.responseText);

      document.getElementById("communicatorText").innerHTML = responseObject.data;
      if(document.getElementById('activated').checked) {
        pullChatData(responseObject.timestamp);
      }
    }
  }

  xmlhttp.open('GET', 'poll.php?timestamp=' + timestamp, true);
  xmlhttp.send();
}

//Activate communicator
document.getElementById('activated').onchange = function(e) {
  if(e.target.checked === true) {
    pullChatData();
  }
}

//Push comment to server
document.getElementById('communicator').onsubmit = function(event) {
  event.preventDefault();
  if(document.getElementById('activated').checked) {
    pushChatData();
  }
  else alert("Czat nieaktywny");
  document.getElementById('content').value = '';
}
