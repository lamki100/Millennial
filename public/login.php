<?php include "../inc/header.php" ?>

<div id="center">
  <div style="width: 100%">
    <h1>Login with an existing Trended ID</h1>
    <form onsubmit='login(); return false'>
      <input type='text' placeholder='Username' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='login-password'><input type='submit' value='Login'><p id='login-message' class='message'>
    </form>
    <a>I forgot my Trended ID</a>
  </div>
</div>

<script>
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
        setTimeout(function() { message.className = "message" }, 1000)
      }
    })
  }
</script>

<?php include "../inc/footer.php" ?>
