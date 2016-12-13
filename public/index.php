<?php include "../inc/header.php" ?>

<h5 style='margin-top:50px; margin-bottom: 30px;'>Recently Created Bets</h5>
<div class='padding box' style="width:90%;margin:0 auto; padding: 20px">
  <?php
  $count = 0;

  $query = $db->query("SELECT fullname, title, bets.id FROM bets INNER JOIN accounts ON bets.accountid = accounts.id LIMIT 7");
  while ($row = $query->fetch()) {
    $count += 1;
    echo "<a href='/bet/".$row['id']."' class='activity'><i>".$row['fullname']."</i> created <i>".$row['title']."</i></a>";
  }

  if ($count == 0) {
    echo "<a class='activity'>No Activity Yet</a>";
  }
  ?>
</div>

<h5 style='margin-top:50px; margin-bottom: 30px;'>Recently Placed Bets</h5>
<div class='padding box' style="width:90%;margin:0 auto; padding: 20px">
  <?php
  $count = 0;

  $query = $db->query("SELECT fullname, amount, outcome, betid FROM participants INNER JOIN accounts ON participants.accountid = accounts.id LIMIT 7");
  while ($row = $query->fetch()) {
    $count += 1;
    echo "<a href='/bet/".$row['betid']."' class='activity'><i>".$row['fullname']."</i> placed a <i>$".$row['amount']."</i> bet on <i>".$row['outcome']."</i></a>";
  }

  if ($count == 0) {
    echo "<a class='activity'>No Activity Yet</a>";
  }
  ?>
</div>


<?php include "../inc/footer.php" ?>
