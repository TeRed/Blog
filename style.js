//Gets cookie of given name - otherwise empty string
function getCookie(cname) {
  var name = cname + '=';
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return '';
}

//Change style cookie
function changeStyleCookie(value, daysLeft) {
  var date = new Date();
  date.setTime(date.getTime() + (daysLeft * 24 * 60 * 60 * 1000));
  document.cookie = 'style=' + value + ';expires=' + date.toUTCString() + ';path=/';
}

//Check cookie at the beginning, to change style if necessary
function checkStyleCookie() {
  var cookieValue = getCookie('style');

  //If there is no cookie or default, nothing to change
  if(cookieValue === '' || cookieValue === 'Default') return;

  var links = document.getElementsByTagName('link');

  for(var i = 0; i < links.length; i++) {
    if(links[i].title === cookieValue) {
      links[i].disabled = false;
    }
    else {
      links[i].disabled = true;
    }
  }
}

//Generate links to change style
function generateStyleLinks() {
  var links = document.getElementsByTagName('link');
  var menu = document.createElement('ul');

  var header = document.createElement('h2');
  header.innerHTML = "Dostępne Style";
  document.getElementById('nav').appendChild(header);

  for(var i = 0; i < links.length; i++) {
    var link = document.createElement('li');
    link.innerHTML = links[i].title;

    link.addEventListener('click', function(e) {
      for(var j = 0; j < links.length; j++) {
        if(links[j].title === e.target.innerHTML) {
          links[j].disabled = false;
          changeStyleCookie(links[j].title, 365);
        }
        else {
          links[j].disabled = true;
        }
      }
    });

    menu.appendChild(link);
  }

  document.getElementById('nav').appendChild(menu);
}

//Generate style links and check cookie style
document.addEventListener("DOMContentLoaded", function(event) {
  generateStyleLinks();
  checkStyleCookie();
})
