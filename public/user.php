<?php
  include "../inc/db.php";
  $username = isset($_GET["data"]) ? $_GET["data"] : null;
  $account = null;
  if ($username) {
    $account = $db->query("SELECT * FROM accounts WHERE username='$username'")->fetch();
    if (!$account) header("Location: /404/");
  }
?>

<?php include "../inc/header.php" ?>

<div class='bottom'>
  <img src='/resources/images/profile.png' class='user-picture picture box'>
  <div class='user-text'>
    <h1 style='text-align:left'>
      <?php
      echo $account["username"];
      if ($my_account) {
        $accountid = $my_account['id'];
        $accountid2 = $account['id'];
        $isFollowing = $db->query("SELECT COUNT(*) FROM follow WHERE accountid='$accountid' and accountid2='$accountid2'")->fetch()[0];
        if ($my_account['id'] == $account['id']) echo "<input type='submit' value='Edit Account' id='follow' onclick=\"window.location='/settings/'\">";
        else if ($isFollowing) echo "<input type='submit' value='Following' id='follow' onclick='follow(); this.value=\"Follow\"'>";
        else echo "<input type='submit' value='Follow' id='follow' onclick='follow(); this.value=\"Following\"'>";
      } else echo "<input type='submit' value='Follow' id='follow' onclick=\"window.location='/login/'\">";
      ?>
      <h3><?php echo "<b>".$account['fullname']."</b>"; if ($account['bio']) echo " <span style='font-weight:300'>-</span> ".$account['bio']; ?></h3>
    </h1>
  </div>
</div>

<div class='toggle' style='margin-bottom:0px; width:60%; margin: 0 auto'>
  <div class='option selected' onclick='toggle(this); toggleAccount(this)'>All</div>
  <div class='option' onclick='toggle(this); toggleAccount(this)'>Ideas</div>
  <div class='option' onclick='toggle(this); toggleAccount(this)'>Bets</div>
</div>
<div class='padding box' style="width:90%;margin:0 auto; padding: 20px">
  <?php
  $count = 0;

  $accountid = $account['id'];
  $query = $db->query("SELECT amount, outcome, betid FROM participants WHERE accountid='$accountid' ORDER BY time DESC");
  while ($row = $query->fetch()) {
    $count += 1;
    echo "<a href='/bet/".$row['betid']."' class='activity'>Placed a <i>$".$row['amount']."</i> bet on <i>".$row['outcome']."</i></a>";
  }

  $query = $db->query("SELECT title, id FROM bets WHERE accountid='$accountid' ORDER BY time DESC");
  while ($row = $query->fetch()) {
    $count += 1;
    echo "<a href='/bet/".$row['id']."' class='activity'>Created <i>".$row['title']."</i></a>";
  }

  if ($count == 0) {
    echo "<a class='activity'>No Activity Yet</a>";
  }
  ?>
</div>

<script>
  function follow() {
    post("/resources/ajax/functions.php", {"func": "follow", "accountid2": <?php echo $account['id'] ?>}, function(r) {
      r = JSON.parse(r)
      addAlert(r['message'])
    })
  }
</script>

<?php include "../inc/footer.php" ?>
