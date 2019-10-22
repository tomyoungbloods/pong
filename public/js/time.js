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

function startKnockOut(h, m) {
  var now = new Date();
  var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m, 0, 0) - now;
  if (millisTill10 < 0) {
      millisTill10 += 86400000; // Check Tommorow
  }
  setTimeout(function(){ window.location.replace('/session-builder') }, millisTill10);
}

// Set Time for start
startKnockOut(10, 38);
startKnockOut(13, 08);
startKnockOut(15, 08);

function showCompetition(h, m) {
  var now = new Date();
  var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m, 0, 0) - now;
  if (millisTill10 < 0) {
      millisTill10 += 86400000; // Check Tommorow
  }
  setTimeout(function(){ window.location.replace('/') }, millisTill10);
}
// Set time for showing competiti
showCompetition(10, 48);
showCompetition(13, 18);
showCompetition(15, 18);