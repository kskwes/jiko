<?php
  require_once('dbconnect.php');
  session_start();

  if (!empty($_POST)) {
    // 入力情報の不備を検知
    if ($_POST['email'] === "") {
      $error['email'] = "blank";
    }
    if ($_POST['password'] === "") {
        $error['password'] = "blank";
    }

    // メールアドレスの重複を検知
    if (!isset($error)) {
      $user = $db->prepare('SELECT COUNT(*) as cnt FROM users WHERE email=?');
      $user->execute(array(
        $_POST['email']
      ));
      $record = $user->fetch();
      if ($record['cnt'] > 0) {
        $error['email'] = 'duplicate';
      }
    }

    // エラーがなければ次のページへ
    if (!isset($error)) {
      $_SESSION['join'] = $_POST; // フォームの内容をセッションで保存
      header('Location: check.php'); // check.phpへ移動
      exit();
    }
  }
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <form method="POST">
    <div class="mb-2">
      <label for="name" class="form-label d-block text-start">ニックネーム</label>
      <input id="name" type="text" name="name" class="form-control" value="" required>
    </div>

    <div class="mb-2">
      <label for="email" class="form-label d-block text-start">メールアドレス<span class="fs-small"> *必須</span></label>
      <input type="email" name="email" class="form-control" value="" required>
      <?php if(!empty($error["email"]) && $error['email'] === 'blank'): ?>
          <p class="error">＊メールアドレスを入力してください</p>
      <?php elseif(!empty($error["email"]) && $error['email'] === 'duplicate'): ?>
          <p class="error">＊このメールアドレスはすでに登録済みです</p>
      <?php endif ?>
    </div>

    <div class="mb-4">
      <label for="password" class="form-label d-block text-start">パスワード<span class="fs-small"> *必須</span></label>
      <input type="password" name="password" class="form-control" value="" required>
      <?php if (!empty($error["password"]) && $error['password'] === 'blank'): ?>
        <p>＊パスワードを入力してください</p>
      <?php endif ?>
    </div>

    <div class="d-flex w-50 mx-auto">
      <button class="text-dark ms-auto btn btn-lg btn-secondary fw-bold border-white bg-white btn btn-lg btn-primary btn-block w-100" type="submit">確認する</button>
    </div>
  </form>
</div>

<?php include("./inc/footer.php") ?>