<?php
  require_once('dbconnect.php');
  session_start();
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <?php if(isset($id)): ?>
    <div>
      <form action="user.php" method="post">
        <div class="d-flex justify-content-around align-items-center">
          <div class="w-50">
            <input type="text" name="name" value="" placeholder="ニックネーム" class="form-control" required>
          </div>
          <div class="d-flex">
            <input type="submit" value="更新" class="text-dark ms-auto btn fw-bold border-white bg-white btn-primary btn-block w-100">
          </div>
        </div>
      </form>
    </div>
  <?php else: ?>
    <div>ログインしていません</div>
  <?php endif ?>
</div>