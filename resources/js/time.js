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

  var now = new Date();
  var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 14, 34, 0, 0) - now;
  if (millisTill10 < 0) {
       millisTill10 += 86400000; // it's after 10am, try 10am tomorrow.
  }
  setTimeout(function(){alert("It's 10am!")}, millisTill10);