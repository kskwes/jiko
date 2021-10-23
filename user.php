<?php
  require_once('dbconnect.php');
  session_start();
?>

<?php
  if (!empty($_POST)) {
    try {
      if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
      }

      $sql = "UPDATE users SET name = :name WHERE id = :id";
      $flgStmt = $db->prepare($sql);
      $params = array(':name' => $_POST['name'], ':id' => $id);
      $flgStmt->execute($params);

      header('Location: user.php');
      exit();
    } catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
  }
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <?php if(isset($id)): ?>
    <?php foreach($userData as $u): ?>
      <?php if($u['id'] == $id): ?>
        <div>
          <div class="d-flex justify-content-between fs-4 mb-3">
            <span class="d-inline-block">ニックネーム：<?php echo $u['name'] ?></span>
            <a href="user_update.php" class="d-inline-block text-dark btn btn-secondary fw-bold border-white bg-white">
              編集
            </a>
          </div>
        </div>
        <div class="text-start fs-4 mb-3">
          メールアドレス：<?php echo $email ?>
        </div>
        <div class="text-start fs-4 mb-3">
          パスワード：********
        </div>
        <div class="text-start fs-4 mb-3">
          作成日：<?php echo $created ?>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  <?php else: ?>
    <div>ログインしていません</div>
  <?php endif ?>
</div>