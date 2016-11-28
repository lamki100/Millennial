<?php include "../inc/header.php" ?>

<div id="center">
  <div style="width: 100%">
    <h1>New Bet</h1>
    <form><label>Type</label></form>
    <div class='toggle' style='margin-bottom: 0'>
      <div class='option selected' onclick='toggle(this); toggleBet(this)'>Optional</div><div class='option' onclick='toggle(this); toggleBet(this)'>Numerical</div>
    </div>

    <form onsubmit='return false' id="numerical-form" style="height: 0px">
      <label>Title</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <label>Link To Instagram Account</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <label>Duration</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <input type='submit' value='Create Bet'>
    </form>
    <form onsubmit='return false' id="optional-form" style="height: 290px">
      <label>Title</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <label>Outcomes</label> <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <label style='margin-bottom:0'><a>+ Outcome</a></label>
      <input type='submit' value='Create Bet' style='margin-top: -20px'>
    </form>
  </div>
</div>

<script>
function toggleBet(sender) {
  if (sender.innerHTML == "Optional") {
    document.getElementById("optional-form").style.height = "290px"
    document.getElementById("numerical-form").style.height = "0px"
  } else if (sender.innerHTML == "Numerical") {
    document.getElementById("optional-form").style.height = "0px"
    document.getElementById("numerical-form").style.height = "320px"
  }
}
</script>

<?php include "../inc/footer.php" ?>
