<?php include "../inc/header.php" ?>

<div id="center">
  <div style="width: 100%">
    <div class="toggle">
      <div class="option selected" onclick="toggle(this); toggleLogin(this)">Register</div><div class="option" onclick="toggle(this); toggleLogin(this)">Login</div>
    </div>

    <form onsubmit='login(); return false' id="login-form" style="height: 0px">
      <input type='text' placeholder='Email or Username' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'>
      <input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='login-password'>
      <a href="/forgot/">Can not access your account</a><input type='submit' value='Login'>
    </form>

    <form onsubmit='register(); return false' id="register-form" style="height: 290px">
      <input type='text' placeholder='Full Name' spellcheck='false' autocomplete='off' maxlength='40' id='register-fullname'>
      <input type='text' placeholder='Email' spellcheck='false' autocomplete='off' maxlength='40' id='register-email'>
      <input type='text' placeholder='Username' spellcheck='false' autocomplete='off' maxlength='40' id='register-username'>
      <input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='register-password'>
      <a href='/terms/'>The Terms & Conditions</a><input type='submit' value='Register'>
    </form>
  </div>
</div>

<script>
  document.getElementById("register-fullname").focus();

  function toggleLogin(sender) {
    if (sender.innerHTML == "Register") {
      document.getElementById("register-fullname").focus();
      document.getElementById("register-form").style.height = "290px"
      document.getElementById("login-form").style.height = "0px"
    } else if (sender.innerHTML == "Login") {
      document.getElementById("login-username").focus();
      document.getElementById("register-form").style.height = "0px"
      document.getElementById("login-form").style.height = "170px"
    }
  }

  function login() {
    var username = document.getElementById("login-username").value
    var password = document.getElementById("login-password").value
    post("/resources/ajax/functions.php", {"func": "login", "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r["status"] == "ok") window.location = "/"
      addAlert(r["message"])
    })
  }

  function register() {
    var email = document.getElementById("register-email").value
    var fullname = document.getElementById("register-fullname").value
    var username = document.getElementById("register-username").value
    var password = document.getElementById("register-password").value
    post("/resources/ajax/functions.php", {"func": "register", "email": email, "fullname": fullname, "username": username, "password": password}, function(r) {
      r = JSON.parse(r)
      if (r["status"] == "ok") window.location = "/"
      addAlert(r["message"])
    })
  }
</script>

<?php include "../inc/footer.php" ?>
