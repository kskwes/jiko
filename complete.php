<?php 
  require_once('dbconnect.php');
  session_start();
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <p class="h4 mb-4">会員登録が完了しました</p>
  <div class="mb-3">
    <a href="login.php" class="text-white h4 fw-bold">ログイン</a>
  </div>
</div>

<?php include("./inc/footer.php") ?>