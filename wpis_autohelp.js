//Number of the next file send to server with form
//First already added
var filesIndex = 1;

//Button that adds next file input
function addChooser(number) {
  var newFileInput = document.createElement('input');
  newFileInput.type = 'file';
  filesIndex++;
  newFileInput.name = 'fileToUpload' + filesIndex;
  // newFileInput.id = 'fileToUpload' + filesIndex;
  newFileInput.setAttribute("onchange", "addChooser("+filesIndex+")");

  document.getElementsByTagName('form')[0].insertBefore(newFileInput, document.getElementById('submit'));

  document.getElementsByTagName('form')[0].insertBefore(document.createElement('br'), document.getElementById('submit'));
}

//Adds to form actual date
function actualDate() {
  var date = new Date();

  var formatedDate = (date.getFullYear()) +
              '-' + ((date.getMonth()+1)<10?'0'+(date.getMonth()+1):(date.getMonth()+1)) +
              '-' + (date.getDate()<10?'0'+date.getDate():date.getDate());

  document.getElementById('date').value = formatedDate;
}

//Adds to form actual time
function actualTime() {
  var date = new Date();

  var formatedTime = (date.getHours()<10?'0'+date.getHours():date.getHours()) +
              ':' + (date.getMinutes()<10?'0'+date.getMinutes():date.getMinutes());

  document.getElementById('time').value = formatedTime;
}

//Check on blur if date is valid
document.getElementById('date').addEventListener('blur', function() {
  var date = document.getElementById('date').value;

  var pattern = /((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8]))))/;

  if(!pattern.test(date)) actualDate();
});

//Check on blur if time is valid
document.getElementById('time').addEventListener('blur', function() {
  var time = document.getElementById('time').value;

  var pattern = new RegExp("^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$");

  if(!pattern.test(time)) actualTime();
});

//Actual date and time on start
document.addEventListener('DOMContentLoaded', function(event) {
  actualDate();
  actualTime();
})
