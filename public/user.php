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
#activity {
  background-color: white;
  border: 1px solid #f2f2f2;
  width: 70%;
  height: 100px;
  margin: 0 auto;
}
#follow {
  display: inline-block;
  position: relative;
  top: -9px;
  margin-left: 22px;
  margin-bottom: 13px;
  font-size: 13px;
  /*letter-spacing: 0px;*/
  font-family: "Gotham";
}
</style>

<div id="flat">
  <h1>
    <?php
    echo $account["username"];
    if ($my_account) {
      if ($my_account['id'] == $account['id']) echo "<input type='submit' value='Edit Account' id='follow' onclick=\"window.location='/settings/'\">";
      else echo "<input type='submit' value='Follow' id='follow' onclick='follow()'>";
    } else echo "<input type='submit' value='Follow' id='follow' onclick=\"window.location='/login/'\">";
    ?>
  </h1>
  <!-- <p style="text-align:left">Software Engineer | Chapman Unv. I'm a total troll don't believe me.</p> -->
  <div class='toggle' style='margin-bottom:0px;'>
    <div class='option selected' onclick='toggle(this); toggleAccount(this)'>All</div>
    <div class='option' onclick='toggle(this); toggleAccount(this)'>Ideas</div>
    <div class='option' onclick='toggle(this); toggleAccount(this)'>Bets</div>
  </div>
  <div id="activity"></div>
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
