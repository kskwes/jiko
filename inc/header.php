<?php
  try {
    $stmt = $db->prepare('SELECT * FROM users');
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
      $password = $_SESSION['password'];
      $created = $_SESSION['created'];
      $reaction = $_SESSION['reaction'];
    }
  } catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

  $userData = $db->query('SELECT * FROM users');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?>時効掲示板</title>
  <meta name="description" content="<?php echo $description ?>">
  <link rel="stylesheet" href="/jiko/css/style.css">
  <link rel="stylesheet" href="/jiko/css/bootstrap/bootstrap.min.css">
</head>
<body class="text-center text-white d-flex min-vh-100">
  <main class="cover-container d-flex w-100 p-3 mx-auto flex-column">
    <!-- ヘッダー -->
    <header class="mb-5">
      <!-- メニュー -->
      <nav class="navbar nav-masthead navbar-expand-lg">
        <div class="container-fluid">
          <!-- タイトル -->
          <a class="navbar-brand text-white fw-bold" href="/jiko/">&#x1F46E;&#x200D;&#x2642; 時効掲示板 &#x1F575;&#x200D;&#x2642;</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <div class="nav-item">
                <a class="nav-link" href="./">TOP</a>
              </div>
              <?php if(isset($id)): ?>
                <!-- ログイン状態 -->
                <div class="nav-item">
                  <a class="nav-link" href="user.php">マイページ</a>
                </div>
                <div class="nav-item">
                  <a class="nav-link" href="logout.php">ログアウト</a>
                </div>
              <?php else: ?>
                <!-- 未ログイン状態 -->
                <div class="nav-item">
                  <a class="nav-link" href="entry.php">会員登録</a>
                </div>
                <div class="nav-item">
                  <a class="nav-link" href="login.php">ログイン</a>
                </div>
              <?php endif ?>
            </div>
          </div>
        </div>
      </nav>
    </header>