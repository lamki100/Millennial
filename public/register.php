<?php include "../inc/header.php" ?>

<div id="center">
  <div>
    <h1>Register a new Trended ID</h1>
    <p>A Trended ID allows you to buy and/or subscribe to Trended products and services, shop in the Asset Store and participate in the Trended community.</p>
    <form onsubmit='register(); return false'>
      <input type='text' placeholder='Full Name' spellcheck='false' autocomplete='off' maxlength='40' id='register-fullname'><input type='text' placeholder='Email' spellcheck='false' autocomplete='off' maxlength='40' id='register-email'><br>
      <input type='text' placeholder='Username' spellcheck='false' autocomplete='off' maxlength='40' id='register-username'><input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='register-password'><br>
      <input type='submit' value='Register ID'><p id='register-message' class='message'></p>
    </form>
  </div>
</div>

<script>
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
        setTimeout(function() { message.className = "message" }, 1000)
      }
    })
  }
</script>

<?php include "../inc/footer.php" ?>
