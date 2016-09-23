<?php include "../inc/header.php" ?>

<?php
  $username = isset($_GET["data"]) ? $_GET["data"] : null;
  $user = null;
  if ($username) {
    $user = $db->query("SELECT * FROM accounts WHERE username='$username'")->fetch();
    if (!$user) header("Location: /404/");
  }
?>

<div id="center">
  <div style="width: 100%">
    <h1><?php echo $user['username'] ?></h1>
    <p>This profile belongs to <?php echo ucwords($user['fullname']) ?>.</p>
  </div>
</div>

<?php include "../inc/footer.php" ?>
