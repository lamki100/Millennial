<?php include "../inc/header.php" ?>

<style>
#sidebar {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin-top: 30px;
}

.cell {
  display: table-cell;
  vertical-align: top;
}

#sidebar #options {
  width: 180px;
}

#sidebar .option {
  -webkit-user-select: none;
  padding: 25px 20px;
  display: block;
  font-weight: 300;
  text-decoration: none;
  border-left: 3px solid transparent;
  transition: background-color .1s;
}

#sidebar .selected {
  background-color: #f6f6f6;
  border-color: #444;
  font-weight: 700;
}

#sidebar .option:active {
  background-color: #f0f0f0;
}

#sidebar #pic {
  width: 120px;
  height: 120px;
  border: 1px solid #eee !important;
  margin: 20px auto 35px;
  background: url("/resources/images/profile.png") center center no-repeat;
  background-size: contain;
  background-color: white;
  border-radius: 50%;
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
      <div class='block'> \
        <h1>Notifications</h1> \
        <p>Edit your alerts here.</p> \
      </div>"
    } else if (view == "banking") {
      toggle(document.getElementById('o-banking'))
      body.innerHTML = " \
      <div class='inline' style='text-align:center'> \
        <h2>Account Transfer</h2> \
        <div class='toggle'> \
          <div class='option selected' onclick='toggle(this); toggleAccount(this)'>Deposit</div> \
          <div class='option' onclick='toggle(this); toggleAccount(this)'>Withdraw</div> \
        </div> \
          <form> \
            <input type='text' placeholder='$0.00' style='text-align:center' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='submit' value='Transfer'><br> \
          </form> \
      </div> \
      <h2>Linked Accounts</h2> \
      "
    } else if (view == "help") {
      toggle(document.getElementById('o-help'))
      body.innerHTML = " \
      <h1>Help</h1> \
      <p>Ask your questions here.</p>"
    } else {
      toggle(document.getElementById('o-account'))
      body.innerHTML = " \
      <div class='box padding'> \
        <form onsubmit='updateAccount(); return false' id='account-form' class='bottom'> \
          <h2>Account Information</h2> \
          <img src='/resources/images/profile.png' class='picture'> \
          <div class='inline'> \
            <label>Name</label> \
            <label>Username</label> \
            <label>Bio</label> \
            <label>Email</label> \
            <label>Phone</label> \
          </div> \
          <div class='inline'> \
            <input type='text' value='<?php echo $my_account['fullname'] ?>' placeholder='<?php echo $my_account['fullname'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='text' value='<?php echo $my_account['username'] ?>' placeholder='<?php echo $my_account['username'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='text' value='' placeholder='' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='text' value='<?php echo $my_account['email'] ?>' placeholder='<?php echo $my_account['email'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='text' value='' placeholder='' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br> \
            <input type='submit' value='Save'><br> \
          </div> \
        </form> \
        <form onsubmit='updatePassword(); return false' id='password-form'> \
          <h2>Change Password</h2> \
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

  function toggleAccount(sender) {
    if (sender.innerHTML == "Edit Account") {
      document.getElementById("account-form").style.height = "310px"
      document.getElementById("password-form").style.height = "0px"
    } else if (sender.innerHTML == "Change Password") {
      document.getElementById("account-form").style.height = "0px"
      document.getElementById("password-form").style.height = "150px"
    }
  }

  window.onpopstate = function(event) {
    switchView()
  }
</script>

<?php include "../inc/footer.php" ?>
