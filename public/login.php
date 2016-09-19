<?php include "../inc/header.php" ?>

<div id="center"><div>
  <h1>Login with an existing Trended ID</h1>
  <form onsubmit='login(); return false'>
    <input type='text' placeholder='Username' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><input type='password' placeholder='Password' spellcheck='false' maxlength='40' id='login-password'><input type='submit' value='Login'><p id='auth-message' class='message'>
  </form>
  <a>I forgot my Trended ID</a>
</div></div>

<?php include "../inc/footer.php" ?>
