//Number of the next file send to server with form
//First already added
var filesIndex = 2;

//Button that adds next file input
document.getElementById('nextFile').addEventListener('click', function(event) {
  var newFileInput = document.createElement('input');
  newFileInput.type = 'file';
  newFileInput.name = 'fileToUpload' + filesIndex;
  filesIndex++;

  document.getElementsByTagName('form')[0].insertBefore(newFileInput, document.getElementById('nextFile'));

  document.getElementsByTagName('form')[0].insertBefore(document.createElement('br'), document.getElementById('nextFile'));
});

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
  date = date.split('-');

  if(date.length !== 3 ||
    date[0].length !== 4 ||
    date[1].length !== 2 ||
    date[2].length !== 2 ||
    parseInt(date[0]) <= 0 ||
    parseInt(date[1]) <= 0 ||
    parseInt(date[1]) > 12 ||
    parseInt(date[2]) <= 0 ||
    parseInt(date[2]) > 31) {
      actualDate();
    }
});

//Check on blur if time is valid
document.getElementById('time').addEventListener('blur', function() {
  var time = document.getElementById('time').value;
  time = time.split(':');

  if(time.length !== 2 ||
    time[0].length !== 2 ||
    time[1].length !== 2 ||
    parseInt(time[0]) < 0 ||
    parseInt(time[0]) > 23 ||
    parseInt(time[1]) < 0 ||
    parseInt(time[1]) > 59) {
      actualTime();
    }
});

//Actual date and time on start
document.addEventListener('DOMContentLoaded', function(event) {
  actualDate();
  actualTime();
})
