<?php include "../inc/header.php" ?>

<div id="center">
  <div style="width: 100%">
    <h1>New Bet</h1>
    <form onsubmit='return false' style='width: 350px'>
      <label>Title</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='60' id='bet-title'>
      <label>Outcomes<span style='float:right'><a onclick="addOutcome()" style='margin-right:3px'>More</a> or <a onclick="removeOutcome()" style='margin-right:3px'>Less</a></span></label>
      <div id="outcomes">
        <input type='text' spellcheck='false' autocomplete='off' maxlength='40'><input type='text' spellcheck='false' autocomplete='off' maxlength='40'>
      </div>
      <input type='submit' value='Create Bet'>
    </form>
  </div>
</div>

<script>
  var outcomes = document.getElementById("outcomes")

  function addOutcome() {
    outcomes.innerHTML += "<input type='text' spellcheck='false' autocomplete='off' maxlength='40'>"
  }

  function removeOutcome() {
    if (outcomes.children.length > 2) outcomes.removeChild(outcomes.lastChild)
  }

  function createBet() {
    post("/resources/ajax/functions.php", {"func": "transfer", "destination": toggleTransferDestination, "account": toggleTransferAccount, "amount": amount}, function(r) {
      r = JSON.parse(r)
      addAlert(r['message'])
      if (r['status'] == 'ok') {
        setTimeout(function() {
          location.reload()
        }, 1500)
      }
    })
  }
</script>

<?php include "../inc/footer.php" ?>
