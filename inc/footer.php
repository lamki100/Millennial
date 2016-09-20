  </div>
  <div id="footer"></div>

  <script type='text/javascript'>
    account = {}

    // function setCookie(name, value) {
    //   var d = new Date()
    //   if (value == "") d.setTime(d.getTime()-1000)
    //   else d.setTime(d.getTime()+1000*60*60*24*100)
    //   var expires = "expires="+ d.toUTCString()
    //   document.cookie = name + "=" + value + ";" + expires + "; path=/"
    // }
    //
    // function getCookie(name) {
    //   var cookies = document.cookie.split(";")
    //   for (var i = 0; i < cookies.length; i++) {
    //     var cookie = cookies[i].trim().split("=")
    //     if (cookie[0] == name) return cookie[1]
    //   }
    //   return null
    // }

    function post(url, data, callback) {
      var r = new XMLHttpRequest()
      var postString = ""
      for (var key in data) postString += key + "=" + data[key] + "&"
      r.open("POST", url, true)
      r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      r.onreadystatechange = function() {
        if (r.readyState == 4) callback(r.responseText)
      }
      r.send(postString)
    }
  </script>
</body>
</html>
