<?php
  require_once('dbconnect.php');
  session_start();

  // 会員登録の手続き以外のアクセスを飛ばす
  if (!isset($_SESSION['join'])) {
    header('Location: entry.php');
    exit();
  }

  if (!empty($_POST['check'])) {
    // 入力情報をデータベースに登録
    $stmt = $db->prepare('INSERT INTO users SET name=?, email=?, password=?, created=NOW()');
    $stmt->execute(array(
      $_SESSION['join']['name'],
      $_SESSION['join']['email'],
      password_hash($_SESSION['join']['password'],PASSWORD_DEFAULT)
    ));

    unset($_SESSION['join']); // セッションを破棄
    header('Location: complete.php'); // complete.phpへ移動
    exit();
  }
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <form method="POST">
    <input type="hidden" name="check" value="checked">
    <div>
      <div class="text-start fs-4 mb-3">
        ニックネーム：<?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>
      </div>
      <div class="text-start fs-4 mb-3">
        メールアドレス：<?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
      </div>
    </div>

    <a href="entry.php" class="d-inline-block text-dark btn btn-secondary fw-bold border-white bg-white">変更</a>
    <input type="submit" class="d-inline-block text-dark btn btn-secondary fw-bold border-white bg-white" value="登録">
  </form>
</div>

<?php include("./inc/footer.php") ?>