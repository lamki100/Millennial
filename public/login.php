<?php include "../inc/header.php" ?>

<div id="center">
  <div style="width: 100%">
    <div class="toggle">
      <div class="toggle-option selected" onclick="toggle(this)">Register</div>
      <div class="toggle-option" onclick="toggle(this)">Login</div>
    </div>

    <form onsubmit='register(); return false' id="register-form" style="height: 165px">
      <input type='text' placeholder='Username' spellcheck='false' autocomplete='off' maxlength='40' id='register-username'>
      <input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='register-password'><br>
      <input type='text' placeholder='Full Name' spellcheck='false' autocomplete='off' maxlength='40' id='register-fullname'>
      <input type='text' placeholder='Email' spellcheck='false' autocomplete='off' maxlength='40' id='register-email'><br>
      <input type='submit' value='Register'><br>
      <a href='terms.php'>Terms & Conditions</a>
      <p id='register-message' class='message' style="display:block">&nbsp;</p>
    </form>
    
    <form onsubmit='login(); return false' id="login-form" style="height: 0px">
      <input type='text' placeholder='Username' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='login-password'>
      <input type='submit' value='Login'> <p id='login-message' class='message'></p><br>
      <a href="forgot.php">I can not access my account</a>
    </form>
  </div>
</div>

<script>
  document.getElementById("register-username").focus();

  function toggle(sender) {
    for (var i=0; i < sender.parentNode.children.length; i++) sender.parentNode.children[i].className='toggle-option';
    sender.className = 'toggle-option selected';

    if (sender.innerHTML == "Register") {
      document.getElementById("register-username").focus();
      document.getElementById("register-form").style.height = "165px"
      document.getElementById("login-form").style.height = "0px"
    } else if (sender.innerHTML == "Login") {
      document.getElementById("login-username").focus();
      document.getElementById("register-form").style.height = "0px"
      document.getElementById("login-form").style.height = "80px"
    }
  }

  function login() {
    var username = document.getElementById("login-username").value
    var password = document.getElementById("login-password").value
    post("/resources/ajax/login.php", {"username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r["status"] == "ok") window.location = "/"
      else {
        var message = document.getElementById("login-message")
        message.innerHTML = r["message"]
        message.className = "message error"
        setTimeout(function() { message.className = "message" }, 1500)
      }
    })
  }

  function register() {
    var email = document.getElementById("register-email").value
    var fullname = document.getElementById("register-fullname").value
    var username = document.getElementById("register-username").value
    var password = document.getElementById("register-password").value
    post("/resources/ajax/register.php", {"email": email, "fullname": fullname, "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r["status"] == "ok") {
        window.location = "/"
      } else {
        var message = document.getElementById("register-message")
        message.innerHTML = r["message"]
        message.className = "message error"
        setTimeout(function() { message.className = "message" }, 1500)
      }
    })
  }
</script>

<?php include "../inc/footer.php" ?>
