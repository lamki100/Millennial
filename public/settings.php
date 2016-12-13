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
          <h2>Manage Accounts</h2> \
          <form onsubmit='addBank(); return false'> \
            <label>Account Number</label><input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='bank-account'> \
            <label>Routing Number</label><input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='bank-routing'> \
            <input type='submit' value='Link Account'> \
          </form> \
          <form onsubmit='removeBank(); return false'> \
            <label>Linked Accounts</label><div class='toggle' id='transfer-type'>" +
            <?php
            echo "\"";
            $accountid = $my_account['id'];
            $banks = $db->query("SELECT * FROM banks WHERE accountid='$accountid' LIMIT 2");
            $count = 0;
            while ($row = $banks->fetch()) {
              echo "<div class='option' onclick='toggleRemoveAccount=".$row['id']."; toggle(this)'>**** ".substr($row['bankaccount'], strlen($row['bankaccount'])-4, strlen($row['bankaccount']))."</div>";
              $count += 1;
            }
            if ($count == 0) {
              echo "<div class='option'>No Accounts Yet</div>";
            }
            echo "\"+";
            ?>
            "</div> \
            <input type='submit' value='Unlink Account'> \
          </form> \
        </div> \
      </div> \
      <div class='cell spacer'></div> \
      <div class='cell'> \
        <div class='box padding'> \
          <form onsubmit='transfer(); return false'> \
            <h2>Transfer Funds</h2> \
            <label>Bank Account</label><div class='toggle' id='transfer-type'>" +
            <?php
            echo "\"";
            $accountid = $my_account['id'];
            $banks = $db->query("SELECT * FROM banks WHERE accountid='$accountid' LIMIT 2");
            $count = 0;
            while ($row = $banks->fetch()) {
              echo "<div class='option' onclick='toggleTransferAccount=".$row['id']."; toggle(this)'>**** ".substr($row['bankaccount'], strlen($row['bankaccount'])-4, strlen($row['bankaccount']))."</div>";
              $count += 1;
            }
            if ($count == 0) {
              echo "<div class='option'>No Accounts Yet</div>";
            }
            echo "\"+";
            ?>
            "</div> \
            <label>Destination</label><div class='toggle' id='transfer-type'> \
              <div class='option' onclick='toggleTransferDestination=1; toggle(this)'>Trended</div><div class='option' onclick='toggleTransferDestination=2; toggle(this)'>Bank</div> \
            </div> \
            <label>Amount</label><input type='text' placeholder='$0.00' style='text-align:center' spellcheck='false' autocomplete='off' maxlength='40' id='transfer-amount'> \
            <input type='submit' value='Initiate'> \
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
      if (r['status'] == "ok") {
        document.getElementById("header-account").href = "/user/" + r['username'] + "/"
      }
      addAlert(r['message'])
    })
  }

  function addBank() {
    var routing = document.getElementById("bank-routing").value
    var account = document.getElementById("bank-account").value

    post("/resources/ajax/functions.php", {"func": "addBank", "routing": routing, "account": account}, function(r) {
      r = JSON.parse(r)
      addAlert(r['message'])
      if (r['status'] == 'ok') {
        setTimeout(function() {
          location.reload()
        }, 1500)
      }
    })
  }

  var toggleRemoveAccount = 0
  function removeBank() {
    var routing = document.getElementById("bank-routing").value
    var account = document.getElementById("bank-account").value

    post("/resources/ajax/functions.php", {"func": "removeBank", "account": toggleRemoveAccount}, function(r) {
      r = JSON.parse(r)
      addAlert(r['message'])
      if (r['status'] == 'ok') {
        setTimeout(function() {
          location.reload()
        }, 1500)
      }
    })
  }

  var toggleTransferDestination = 0
  var toggleTransferAccount = 0
  function transfer() {
    var amount = document.getElementById("transfer-amount").value

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
