<?php
  include "../inc/db.php";
  $betid = isset($_GET["data"]) ? $_GET["data"] : null;
  $bet = null;
  if ($betid) {
    $bet = $db->query("SELECT * FROM bets WHERE id='$betid'")->fetch();
    if (!$bet) header("Location: /404/");
  }
?>

<?php include "../inc/header.php" ?>

<div id="center">
  <div style="width: 100%">
    <h5><?php echo $bet['title']; ?></h5>
    <h4>
      <b>$<?php echo number_format((float)$db->query("SELECT SUM(amount) as jackpot FROM participants WHERE betid='$betid'")->fetch()['jackpot'], 2, '.', '') ?></b> jackpot with <b><?php echo $db->query("SELECT COUNT(*) FROM participants WHERE betid='$betid'")->fetch()[0] ?></b> participants
    </h4>
    <form onsubmit='placeBet(); return false'>
      <div class='toggle' id='transfer-type' style='display:block'>
        <?php
        $outcomes = explode(":", $bet['outcomes']);
        foreach ($outcomes as $outcome) {
          echo "<div class='option' onclick='outcome=\"".$outcome."\"; toggle(this)'>".$outcome."</div>";
        }
        ?>
      </div>
      <label style='margin-top:25px'>Place a Bet</label> <input type='text' placeholder='$0.00' style='text-align:center' spellcheck='false' autocomplete='off' maxlength='40' id='bet-amount'>
      <input type='submit' value='Place Bet'>
    </form>
  </div>
</div>

<script>

var outcome = null

function placeBet() {
  var amount = document.getElementById("bet-amount").value

  post("/resources/ajax/functions.php", {"func": "placeBet", "betid": <?php echo $betid ?>, "outcome": outcome, "amount": amount}, function(r) {
    r = JSON.parse(r)
    addAlert(r['message'])
    if (r['status'] == 'ok') {
      setTimeout(function() {
        location.reload()
      }, 1500)
    }
  })
}

</script>

<?php include "../inc/footer.php" ?>
