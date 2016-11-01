<?php include "../inc/header.php" ?>

<?php
  $username = isset($_GET["data"]) ? $_GET["data"] : null;
  $account = null;
  if ($username) {
    $account = $db->query("SELECT * FROM accounts WHERE username='$username'")->fetch();
    if (!$account) header("Location: /404/");
  }
?>

<style>
#follow {
  display: inline-block;
  position: relative;
  top: -9px;
  padding: 12px 17px;
  margin-left: 22px;
  margin-bottom: 0px;
  font-size: 13px;
  letter-spacing: 0px;
}

.user-picture {
  border: none !important;
  display: inline-block !important;
  vertical-align: middle;
  margin: 0 !important;
}

.user-text {
  display: inline-block !important;
  vertical-align: middle;
  margin-left: 45px;
  text-align: left;
  max-width: 40%;
}
</style>

<div class='bottom'>
  <img src='/resources/images/profile.png' class='user-picture picture box'>
  <div class='user-text'>
    <h1>
      <?php
      echo $account["username"];
      if ($my_account) {
        if ($my_account['id'] == $account['id']) echo "<input type='submit' value='Edit Account' id='follow' onclick=\"window.location='/settings/'\">";
        else echo "<input type='submit' value='Follow' id='follow' onclick='follow()'>";
      } else echo "<input type='submit' value='Follow' id='follow' onclick=\"window.location='/login/'\">";
      ?>
      <h3><?php echo "<b>".$account['fullname']."</b> - ".$account['bio'] ?></h3>
    </h1>
  </div>
</div>

<div class='toggle' style='margin-bottom:0px;'>
  <div class='option selected' onclick='toggle(this); toggleAccount(this)'>All</div><div class='option' onclick='toggle(this); toggleAccount(this)'>Ideas</div><div class='option' onclick='toggle(this); toggleAccount(this)'>Bets</div>
</div>
<div class='padding box'>
  User activity will go here.
</div>
    <!-- <div style='display:block'>
      <div class='inline'>
        <p><b>Matthew Helms</b></p>
      </div>
      <div class='inline' style="width:350px; margin-left: 0px">
        <p style="text-align:left">Software Engineer | Chapman Unv. I'm a total troll don't believe me.</p>
      </div>
    </div> -->

<script>
  function follow() {
    alert("You will follow this account soon.")
  }
</script>

<?php include "../inc/footer.php" ?>
