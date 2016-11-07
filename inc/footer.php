  </div>
  <div id="footer"></div>
  <div id="alerts"></div>
  <script type='text/javascript'>
    function addAlert(message) {
      var newAlert = document.createElement('div')
      newAlert.className = "alert-container"
      newAlert.innerHTML = "<div class='alert' onclick='dismiss(this.parentElement)' onmousedown=\"this.style.backgroundColor='#eee'\">"+message+"</div>"
      document.getElementById("alerts").insertBefore(newAlert, document.getElementById("alerts").firstChild)

      setTimeout(function() {
        newAlert.style.height = "76px"
        newAlert.children[0].style.boxShadow = "0px 1px 2px rgba(0,0,0,.2)"
        newAlert.children[0].style.backgroundColor = "rgba(40,130,255,1)"
      }, 1)

      if (document.getElementById("alerts").children.length == 1) {
        setTimeout(function() {
          dismiss(newAlert)
        }, 2500)
      }
    }

    function dismiss(e) {
      if (document.body.contains(e)) {
        e.style.height = "0"
        e.children[0].style.backgroundColor = "rgba(255,255,255,0)"
        e.children[0].style.boxShadow = "none"
        setTimeout(function() {
          document.getElementById("alerts").removeChild(e)
          setTimeout(function() {
            dismiss(document.getElementById("alerts").lastChild)
          }, 2000)
        }, 600)
      }
    }
  </script>
</body>
</html>
