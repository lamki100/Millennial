  </div>
  <div id="footer"></div>

  <script type='text/javascript'>
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

    function search() {
      var search = document.getElementById("header-search").value.trim()
      var results = document.getElementById("header-results")

      results.innerHTML = "Results: " + search
      if (search != "") {
        results.style.height = "300px"
        results.style.paddingTop = "20px"
        results.style.borderBottom = "2px solid rgba(255,255,255,.5)"
      } else {
        results.style.height = "0"
        results.style.paddingTop = "0"
        results.style.borderBottom = "0"
      }
    }

    function toggle(sender) {
      for (var i=0; i < sender.parentNode.children.length; i++) sender.parentNode.children[i].className='option';
      sender.className = 'option selected';
    }
  </script>
</body>
</html>
