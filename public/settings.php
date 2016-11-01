<?php include "../inc/header.php" ?>

<style>
#sidebar {
  display: table;
  table-layout: fixed;
  width: 100%;
}

.cell {
  display: table-cell;
  vertical-align: top;
}

#sidebar #options {
  width: 180px;
  text-align: left;
}

#sidebar #options .option {
  -webkit-user-select: none;
  padding: 23px 19px;
  display: block;
  font-weight: 300;
  text-decoration: none;
  border-left: 5px solid transparent;
}

#sidebar #options .selected {
  background-color: #fafafa;
  /*border-color: rgba(60,140,255,.8);*/
  border-color: #444;
  /*color: rgba(60,140,255,1);*/
  /*font-weight: 700;*/
}

#sidebar #options .option:active {
  background-color: #f8f8f8;
}

.spacer {
  width: 10px;
}

</style>

<div id="sidebar">
  <div class='cell' id="options">
    <div class='box'>
      <!-- <a class='option' id='pic'></a> -->
      <a class="option" onclick="history.pushState('', '', '/settings/'); switchView();" id="o-account">Account</a>
      <a class="option" onclick="history.pushState('', '', '/settings/banking/'); switchView();" id="o-banking">Banking</a>
      <a class="option" onclick="history.pushState('', '', '/settings/notifications/'); switchView();" id="o-notifications">Notifications</a>
      <a class="option" onclick="history.pushState('', '', '/settings/help/'); switchView();" id="o-help">Help</a>
      <a class="option" href="/logout/">Logout</a>
    </div>
  </div>
  <div class='cell spacer'></div>
  <div class='cell' id="sidebar-body"></div>
</div>

<script type='text/javascript'>
  switchView()

  function switchView() {
    var view = window.location.pathname.split("/")[2]
    var body = document.getElementById("sidebar-body")

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
      <div class='box padding'> \
        <form> \
          <h2>Linked Accounts</h2> \
          <div class='inline'> \
            <label>Account #</label> \
            <label>Routing #</label> \
          </div> \
          <div class='inline'> \
            <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='account-fullname'><br> \
            <input type='text' spellcheck='false' autocomplete='off' maxlength='40' id='account-email'><br> \
            <input type='submit' value='Add Account'><br> \
          </div> \
        </form> \
      </div> \
      <div class='box padding'> \
        <form> \
          <div class='toggle'> \
            <div class='option selected' onclick='toggle(this); toggleAccount(this)'>Deposit</div><div class='option' onclick='toggle(this); toggleAccount(this)'>Withdraw</div> \
          </div> \
          <input type='text' placeholder='$0.00' style='text-align:center' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
          <input type='submit' value='Transfer'><br> \
        </form> \
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
      <div class='box padding'> \
        <form onsubmit='updateAccount(); return false'> \
          <img src='/resources/images/profile.png' class='picture box'> \
          <div class='inline'> \
            <label>Name</label> \
            <label>Username</label> \
            <label>Email</label> \
            <label>Bio</label> \
          </div> \
          <div class='inline'> \
            <input type='text' value='<?php echo $my_account['fullname'] ?>' placeholder='<?php echo $my_account['fullname'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='account-fullname'><br> \
            <input type='text' value='<?php echo $my_account['username'] ?>' placeholder='<?php echo $my_account['username'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='account-username'><br> \
            <input type='text' value='<?php echo $my_account['email'] ?>' placeholder='<?php echo $my_account['email'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='account-email'><br> \
            <textarea id='account-bio' rows='2' spellcheck='false' autocomplete='off' maxlength='64'><?php echo $my_account['bio'] ?></textarea><br> \
            <input type='submit' value='Save'><br> \
          </div> \
        </form> \
      </div> \
      <div class='box padding'> \
        <form onsubmit='updatePassword(); return false' id='password-form'> \
          <h2>Change Your Password</h2> \
          <div class='inline'> \
            <label>Old Password</label> \
            <label>New Password</label> \
            <label>New Password</label> \
          </div> \
          <div class='inline'> \
            <input type='password' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='password' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='password' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='submit' value='Save'><br> \
          </div> \
        </form> \
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
      if (r["status"] == "ok") {
        alert("Updated")
      } else {
        alert(r['message'])
        // var message = document.getElementById("account-message")
        // message.innerHTML = r["message"]
        // message.className = "message error"
        // setTimeout(function() { message.className = "message" }, 1100)
      }
    })
  }
</script>

<?php include "../inc/footer.php" ?>
