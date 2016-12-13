  </div>
  <div id="footer"></div>
  <div id="alerts"></div>
  <div class='popup' id='create-bet' onclick="this.style.display='none'">
    <div class='popup-box' onclick="event.stopPropagation()">
      <h1>Create a Bet</h1>
      <form onsubmit='createBet(); return false;' style='width: 350px'>
        <label>Title</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='60' id='bet-title'>
        <label>Outcomes<span style='float:right'><a onclick="addOutcome()" style='margin-right:3px'>More</a> or <a onclick="removeOutcome()" style='margin-right:3px'>Less</a></span></label>
        <div id="outcomes">
          <input type='text' spellcheck='false' autocomplete='off' maxlength='40'><input type='text' spellcheck='false' autocomplete='off' maxlength='40'>
        </div>
        <input type='submit' value='Create Bet'>
      </form>
    </div>
  </div>
  <script type='text/javascript'>
    var outcomes = document.getElementById("outcomes")

    function addOutcome() {
      if (outcomes.children.length < 6) outcomes.innerHTML += "<input type='text' spellcheck='false' autocomplete='off' maxlength='40'>"
    }

    function removeOutcome() {
      if (outcomes.children.length > 2) outcomes.removeChild(outcomes.lastChild)
    }

    function createBet() {
      var title = document.getElementById("bet-title").value
      var outcomeValues = []
      for (var i = 0; i < outcomes.children.length; i++) outcomeValues.push(outcomes.children[i].value)

      post("/resources/ajax/functions.php", {"func": "createBet", "title": title, "outcomes": outcomeValues.join(":")}, function(r) {
        r = JSON.parse(r)
        if (r['status'] == 'ok') {
          window.location.href = r['path']
        }
        addAlert(r['message'])
      })
    }

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
