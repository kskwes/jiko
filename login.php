<?php
  require_once('dbconnect.php');
  session_start();

    if (!isset($error) && !empty($_POST)) {
        header('Location: index.php');
    }

  if(!empty($_POST)) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      try {
        $stmt = $db->prepare('select * from users where email = ?');
        $stmt->execute([$_POST['email']]);
        $users = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!isset($users['email'])) {
          echo 'メールアドレス又はパスワードが間違っています。';
          return false;
        }
    
        if (password_verify($_POST['password'], $users['password'])) {
          $_SESSION['id'] = $users['id'];
          $_SESSION['name'] = $users['name'];
          $_SESSION['email'] = $users['email'];
          $_SESSION['password'] = $users['password'];
          $_SESSION['created'] = $users['created'];
          $_SESSION['reaction'] = $users['reaction'];
          echo "ログイン認証に成功しました";
        } else {
          echo "ログイン認証に失敗しました";
        }
      } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
      }
    }

    
  } else {
    $error['login'] ='blank';
  }
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<div class="container-fluid">
  <form class="form-signin" method="POST">
    <div>
      <label for="email" class="sr-only">メールアドレス</label>
      <input type="email" name="email" class="form-control" placeholder="メールアドレス" value="" autofocus required>
    </div>
    <div>
      <label for="password" class="sr-only">パスワード</label>
      <input type="password" name="password" class="form-control" placeholder="パスワード" value="" required>
    </div>
    <div class="d-flex">
      <button class="text-dark ms-auto btn btn-lg btn-secondary fw-bold border-white bg-white btn btn-lg btn-primary btn-block w-100" type="submit">ログイン</button>
    </div>
  </form>
</div>

<?php include("./inc/footer.php") ?>