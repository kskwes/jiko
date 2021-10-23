<?php
  require_once('dbconnect.php');
  session_start();
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<!-- コンテンツ -->
<div class="container-fluid h-100">
  <?php if(isset($id)): ?>
    <!-- ログイン状態 -->
    <!-- 投稿フォーム -->
    <div class="mb-3 w-100">
      <!-- フォーム -->
      <h2 class="h4 fw-bold">&#x1f6a8; 時効掲示板 &#x1f6a8;</h2>
      <p class="mb-5">
        秘密にしておきたいことを書いてください。<br>
        時効だと思う日付を設定すれば、その日にちまで公開されません。
      </p>
      <form action="posts.php" method="POST">
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="h4 mb-3 fw-bold form-label">投稿フォーム &#x1F4DD;</label>
          <textarea name="post" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>

        <!-- 公開日時指定 -->
        <div class="mb-3 input-group">
          <input type="datetime-local" class="form-control" name="release_date" autocomplete="on" min="<?php echo date('Y-m-d\TH:i') ?>" required>
        </div>

        <!-- ボタン -->
        <div class="d-flex">
          <input class="text-dark ms-auto btn btn-lg btn-secondary fw-bold border-white bg-white" type="submit" value="投稿 &#x1F92B;">
        </div>
      </form>
    </div>
    <div>
      <a href="posts.php" class="text-white h4 fw-bold">投稿一覧 &#x23f1;</a>
    </div>
  <?php else: ?>
    <!-- 未ログイン状態 -->
    <p>
      ログインして投稿しよう
    </p>
  <?php endif ?>
</div>

<?php include("./inc/footer.php") ?>