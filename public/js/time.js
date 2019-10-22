function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    m = checkTime(m);
    document.getElementById('rolex').innerHTML =
    h + ":" + m;
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
      millisTill10 += 86400000; // it's after 10am, try 10am tomorrow.
  }
  setTimeout(function(){ window.location.replace('/session-builder') }, millisTill10);
}

startKnockOut(10, 38);
startKnockOut(13, 08);
startKnockOut(15, 08);