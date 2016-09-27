<?php include "../inc/header.php" ?>

<div id="sidebar">
  <a class="option" style="border: none" onclick="alert('You will be able to change your profile picture.')"><div class="pic"></div></a>
  <a class="option" onclick="history.pushState('', '', '/settings/account/'); switchView();" id="o-account">Account</a>
  <a class="option" onclick="history.pushState('', '', '/settings/banking/'); switchView();" id="o-banking">Banking</a>
  <a class="option" onclick="history.pushState('', '', '/settings/notifications/'); switchView();" id="o-notifications">Notifications</a>
  <a class="option" onclick="history.pushState('', '', '/settings/history/'); switchView();" id="o-history">History</a>
  <a class="option" onclick="history.pushState('', '', '/settings/history/'); switchView();" id="o-history">History</a>
  <a class="option" onclick="history.pushState('', '', '/settings/help/'); switchView();" id="o-help">Help</a>
  <a class="option" href="/logout/">Logout</a>
</div>

<div id="sidebar-body"></div>

<script type='text/javascript'>
  switchView()

  function switchView(view) {
    var body = document.getElementById("sidebar-body")
    view = window.location.pathname.split("/")[2]

    if (view == "notifications") {
      toggle(document.getElementById('o-notifications'))
      body.innerHTML = " \
      <h1>Notifications</h1> \
      <p>Edit your alerts here.</p>"
    } else if (view == "banking") {
      toggle(document.getElementById('o-banking'))
      body.innerHTML = " \
      <h1>Banking</h1> \
      <p>Edit your banking information here.</p>"
    } else if (view == "history") {
      toggle(document.getElementById('o-history'))
      body.innerHTML = " \
      <h1>History</h1> \
      <p>View your bet history here.</p>"
    } else if (view == "help") {
      toggle(document.getElementById('o-help'))
      body.innerHTML = " \
      <h1>Help</h1> \
      <p>Ask your questions here.</p>"
    } else {
      toggle(document.getElementById('o-account'))
      body.innerHTML = " \
      <h1>Account Information</h1> \
      <p>Edit your account information here.</p>"
    }
  }

  window.onpopstate = function(event) {
    switchView()
  }
</script>

<?php include "../inc/footer.php" ?>
