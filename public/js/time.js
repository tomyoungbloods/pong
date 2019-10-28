function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    document.getElementById('rolex').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }

function startTimeAction(h, m, redirect) {
  var now = new Date();
  var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m, 0, 0) - now;
  if (millisTill10 < 0) {
      millisTill10 += 86400000; // Check Tommorow
  }
  setTimeout(function(){ window.location.replace(redirect) }, millisTill10);
}

// Set Time for start
startTimeAction(10, 23, '/session-builder');
startTimeAction(10, 38, '/session-builder');
startTimeAction(13, 08, '/session-builder');
startTimeAction(15, 08, '/session-builder');

// Set time for showing competitie
startTimeAction(10, 48, '/');
startTimeAction(13, 18, '/');
startTimeAction(15, 18, '/');