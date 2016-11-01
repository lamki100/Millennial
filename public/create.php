<?php include "../inc/header.php" ?>

<div id="flat">
  <h1>Create a Bet</h1>
  <div class='inline'>
    <label>Title</label>
    <label># Outcomes</label>
  </div>
  <div class='inline'>
    <input type='text' value='<?php echo $my_account['fullname'] ?>' placeholder='<?php echo $my_account['fullname'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br>
    <input type='text' value='<?php echo $my_account['username'] ?>' placeholder='<?php echo $my_account['username'] ?>' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br>
    <input type='text' value='' placeholder='' spellcheck='false' autocomplete='off' maxlength='40' id='login-username'><br>
    <input type='submit' value='Create Bet'><br>
  </div>
</div>

<?php include "../inc/footer.php" ?>
