<?php include "../inc/header.php" ?>

<div id="settings-sidebar">
  <a class="option" style="border: none" onclick="alert('You will be able to change your profile picture.')"><div class="pic"></div></a>
  <a class="option selected" onclick="toggle(this); switchView('account')">Account Overview</a>
  <a class="option" onclick="toggle(this); switchView('notifications')">Notifications</a>
  <a class="option" onclick="toggle(this); switchView('banking')">Banking</a>
  <a class="option" onclick="toggle(this); switchView('history')">History</a>
  <a class="option" onclick="toggle(this); switchView('help')">Help</a>
  <a class="option" href="/logout/" style="border: none">Logout</a>
</div>

<div id="settings-body"></div>

<script type='text/javascript'>
  switchView("account")

  function switchView(view) {
    var body = document.getElementById("settings-body")
    if (view == "account") {
      body.innerHTML = " \
      <h1>Account Overview</h1> \
      <p>Edit your account information here.</p>"
    } else if (view == "notifications") {
      body.innerHTML = " \
      <h1>Notifications</h1> \
      <p>Edit your alerts here.</p>"
    } else if (view == "banking") {
      body.innerHTML = " \
      <h1>Banking</h1> \
      <p>Edit your banking information here.</p>"
    } else if (view == "history") {
      body.innerHTML = " \
      <h1>History</h1> \
      <p>View your bet history here.</p>"
    } else if (view == "help") {
      body.innerHTML = " \
      <h1>Help</h1> \
      <p>Ask your questions here.</p>"
    }
  }
</script>

<?php include "../inc/footer.php" ?>
