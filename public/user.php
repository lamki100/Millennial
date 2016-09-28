<?php include "../inc/header.php" ?>

<?php
  $username = isset($_GET["data"]) ? $_GET["data"] : null;
  $account = null;
  if ($username) {
    $account = $db->query("SELECT * FROM accounts WHERE username='$username'")->fetch();
    if (!$account) header("Location: /404/");
  }
?>

<div id="sidebar">
  <a class="option" style="border: none"><div class="pic"></div></a>
  <a class="option" onclick="history.pushState('', '', '/user/<?php echo $account['username'] ?>/activity/'); switchView();" id="o-activity">Activity</a>
  <a class="option" onclick="history.pushState('', '', '/user/<?php echo $account['username'] ?>/activity/'); switchView();" id="o-activity">Current Bets</a>
  <a class="option" onclick="history.pushState('', '', '/user/<?php echo $account['username'] ?>/activity/'); switchView();" id="o-activity">Past Bets</a>
  <a class="option" onclick="history.pushState('', '', '/user/<?php echo $account['username'] ?>/activity/'); switchView();" id="o-activity">Ideas</a>
  <a class="option" onclick="history.pushState('', '', '/user/<?php echo $account['username'] ?>/message/'); switchView();" id="o-message">Message</a>
</div>

<div id="sidebar-body">
  <div id='profile-header-text'>
    <h1><?php echo $account["username"] ?></h1>
  </div>
  <div id='profile-header-follow'>Follow</div>
  <p><?php echo ucwords($account["fullname"]) ?></p>

  <div id="body"></div>
</div>

<script type='text/javascript'>
  switchView()

  function switchView(view) {
    var body = document.getElementById("body")
    view = window.location.pathname.split("/")[3]

    if (view == "message") {
      toggle(document.getElementById('o-message'))
      // body.innerHTML = " \
      // <h1>Message</h1> \
      // <p>Ask your questions here.</p>"
    } else {
      toggle(document.getElementById('o-activity'))
      // body.innerHTML = " \
      // <h2>Activity</h2>"
    }
  }

  window.onpopstate = function(event) {
    switchView()
  }
</script>

<?php include "../inc/footer.php" ?>
