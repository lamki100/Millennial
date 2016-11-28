<?php include "../inc/header.php" ?>

<div id="sidebar">
  <div class='cell' id="options">
    <div class='box'>
      <a class="option" onclick="history.pushState('', '', '/settings/'); switchView();" id="o-account">Account</a>
      <a class="option" onclick="history.pushState('', '', '/settings/banking/'); switchView();" id="o-banking">Banking</a>
      <a class="option" onclick="history.pushState('', '', '/settings/notifications/'); switchView();" id="o-notifications">Notifications</a>
      <a class="option" onclick="history.pushState('', '', '/settings/help/'); switchView();" id="o-help">Help</a>
      <a class="option" href="/logout/">Logout</a>
    </div>
  </div>
  <div class='cell spacer'></div>
  <div class='cell' id="body"></div>
</div>

<script type='text/javascript'>
  switchView()

  function switchView() {
    var view = window.location.pathname.split("/")[2]
    var body = document.getElementById("body")

    if (view == "notifications") {
      toggle(document.getElementById('o-notifications'))
      body.innerHTML = " \
      <div class='box padding'> \
        <h1>Notifications</h1> \
        <p>Edit your alerts here.</p> \
      </div>"
    } else if (view == "banking") {
      toggle(document.getElementById('o-banking'))
      body.innerHTML = " \
      <div class='cell'> \
        <div class='box padding'> \
          <form onsubmit='addBank(); return false'> \
            <h2>Bank Accounts</h2> \
            <input type='text' placeholder='Account Number' spellcheck='false' autocomplete='off' maxlength='40' id='bank-account'> \
            <input type='text' placeholder='Routing Number' spellcheck='false' autocomplete='off' maxlength='40' id='bank-routing'> \
            <input type='submit' value='Add Account'> \
          </form> \
        </div> \
      </div> \
      <div class='cell spacer'></div> \
      <div class='cell'> \
        <div class='box padding'> \
          <form onsubmit='transfer(); return false'> \
            <h2>Make a Transfer</h2> \
            <label>Transfer To</label><div class='toggle' id='transfer-type'> \
              <div class='option selected' onclick='toggle(this); toggleAccount(this)'>Trended</div><div class='option' onclick='toggle(this); toggleAccount(this)'>Bank</div> \
            </div> \
            <label>Account</label><div class='toggle' id='transfer-type'>" +
            <?php
            echo "\"";
            $accountid = $my_account['id'];
            $banks = $db->query("SELECT * FROM banks WHERE accountid='$accountid' LIMIT 4");
            $first = true;
            while ($row = $banks->fetch()) {
              if ($first) echo "<div class='option selected' onclick='toggle(this); toggleAccount(this)'>****".substr($row['bankaccount'], 0, 4)."</div>";
              else echo "<div class='option' onclick='toggle(this); toggleAccount(this)'>****".substr($row['bankaccount'], 0, 4)."</div>";
              $first = false;
            }
            echo "\"+";
            ?>
            "</div> \
            <label>Amount</label><input type='text' placeholder='$0.00' style='text-align:center' spellcheck='false' autocomplete='off' maxlength='40' id='transfer-amount'> \
            <input type='submit' value='Transfer'> \
          </form> \
        </div> \
      </div> \
      "
    } else if (view == "help") {
      toggle(document.getElementById('o-help'))
      body.innerHTML = " \
      <div class='box padding'> \
        <h1>Help</h1> \
        <p>Ask your questions here.</p> \
      </div>"
    } else {
      toggle(document.getElementById('o-account'))
      body.innerHTML = " \
      <div class='cell'> \
        <div class='box padding'> \
          <form onsubmit='updateAccount(); return false'> \
            <h2>Account Information</h2> \
            <img src='/resources/images/profile.png' class='picture box'> \
            <label>Name</label> <input type='text' id='account-fullname' value='<?php echo $my_account['fullname'] ?>' spellcheck='false' autocomplete='off' maxlength='40'> \
            <label>Username</label> <input type='text' id='account-username' value='<?php echo $my_account['username'] ?>' spellcheck='false' autocomplete='off' maxlength='40'> \
            <label>Email</label> <input type='text' id='account-email' value='<?php echo $my_account['email'] ?>' spellcheck='false' autocomplete='off' maxlength='40'> \
            <label>Bio</label> <textarea id='account-bio' rows='2' spellcheck='false' autocomplete='off' maxlength='64'><?php echo $my_account['bio'] ?></textarea> \
            <input type='submit' value='Apply Changes'> \
          </form> \
        </div> \
      </div> \
      <div class='cell spacer'></div> \
      <div class='cell'> \
        <div class='box padding'> \
          <form onsubmit='updatePassword(); return false' id='password-form'> \
            <h2>Update Password</h2> \
            <label>Old Password</label> <input type='password' autocomplete='off' maxlength='40' id='login-username'> \
            <label>New Password</label> <input type='password' autocomplete='off' maxlength='40' id='login-username'> \
            <input type='submit' value='Apply Changes'> \
          </form> \
        </div> \
      </div> \
      "
    }
  }

  window.onpopstate = function(event) {
    switchView()
  }

  function updateAccount() {
    var email = document.getElementById("account-email").value
    var fullname = document.getElementById("account-fullname").value
    var username = document.getElementById("account-username").value
    var bio = document.getElementById("account-bio").value

    post("/resources/ajax/functions.php", {"func": "updateAccount", "email": email, "fullname": fullname, "username": username, "bio": bio}, function(r) {
      r = JSON.parse(r)
      addAlert(r['message'])
    })
  }

  function addBank() {
    var routing = document.getElementById("bank-routing").value
    var account = document.getElementById("bank-account").value

    post("/resources/ajax/functions.php", {"func": "addBank", "routing": routing, "account": account}, function(r) {
      r = JSON.parse(r)
      addAlert(r['message'])
    })
  }

  function transfer() {

  }
</script>

<?php include "../inc/footer.php" ?>
