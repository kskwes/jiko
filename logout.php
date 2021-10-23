<?php
  require_once('dbconnect.php');

  session_start();
  $_SESSION = array(); //セッションの中身をすべて削除
  session_destroy(); //セッションを破壊
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <p class="h4 mb-4">ログアウトしました</p>
  <div class="mb-3">
    <a href="/jiko/" class="text-white h4 fw-bold">TOP</a>
  </div>
  <div>
    <a href="login.php" class="text-white h4 fw-bold">ログイン</a>
  </div>
</div>

<?php include("./inc/footer.php") ?>