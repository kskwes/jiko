<?php
  require_once('dbconnect.php');
  session_start();
  date_default_timezone_set('Asia/Tokyo');
  $today = date('Y年m月d日 H時i分');

  function getReleaseDate($post, $date) {
    $format_date = str_replace(array("T", ":"), array(" ", ":"), $post[$date]);
    return date('Y年m月d日 H時i分', strtotime($format_date));
  }
?>

<?php include("./component/pager_inc.php") ?>

<?php
  // 投稿
  if (!empty($_POST)) {
    try {
      if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
      }
  
      $post = $db->prepare('INSERT INTO posts SET post=?, created_by=?, release_date=?, release_flg=?, created=NOW()');
      $post->execute(array(
        $_POST['post'],
        $id,
        $_POST['release_date'],
        0
      ));

    //   header('Location: index.php');
    //   exit();
    } catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
  }

  $posts = $db->query('SELECT posts.post_id, users.name, posts.post, posts.created, posts.release_date, posts.release_flg, posts.reaction FROM posts LEFT JOIN users ON users.id = posts.created_by ORDER BY post_id DESC');
?>

<?php include("./inc/config.php") ?>
<?php include("./inc/header.php") ?>

<!-- コンテンツ -->
<div class="container-fluid">
  <div class="d-flex mb-5 w-50 mx-auto">
    <a href="index.php" class="text-dark ms-auto btn btn-lg btn-secondary fw-bold border-white bg-white btn btn-lg btn-primary btn-block w-100">投稿する &#x1F92B;</a>
  </div>

  <!-- 投稿一覧 -->
  <div>
    <?php foreach($data as $post): ?>
      <?php $release_date = getReleaseDate($post, 'release_date') ?>
      <?php if($today >= $release_date): ?>
        <?php
          // 公開予定日を過ぎたらフラグ（release_flg）を更新する
          $postId = $post['post_id'];

          $sql = "UPDATE posts SET release_flg = :flg WHERE post_id = :id";
          $flgStmt = $db->prepare($sql);
          $params = array(':flg' => 1, ':id' => $postId);
          $flgStmt->execute($params);
        ?>
        <!-- 公開済みの投稿 -->
        <div class="mb-4 card text-dark post-content">
          <div class="card-header">
            <!-- 投稿者 -->
            <div class="fs-6">
              投稿者：<?php echo $post['name'] ?>
            </div>
          </div>
          <div class="card-body">
            <!-- テキスト -->
            <div class="card-text fs-5">
              <?php echo $post['post'] ?>
            </div>
          </div>
          <div class="card-footer text-muted fs-small">
            <!-- 公開日時 -->
            <div>
              <?php if($today >= $release_date): ?>
                時効済み：
              <?php else: ?>
                時効前:
              <?php endif ?>
              <?php
                echo $release_date;
              ?>
            </div>
            <!-- 投稿日時 -->
            <div>
              投稿日時：
              <?php
                $created = date('Y-m-d H:i', strtotime($post['created']));
                // echo $created;
                echo date('Y年m月d日 H時i分', strtotime($created));;
              ?>
            </div>
          </div>
        </div>
      <?php else: ?>
        <!-- 公開前の投稿 -->
        <div class="mb-4 card text-dark post-content">
          <?php
              $f = str_replace(array("-", "T", ":"), array("/", " ", ":"), $post['release_date']);
              
              $datetime = new DateTime($f);
              $current = new DateTime('now');
              $diff = $current->diff($datetime);
            ?>
          <div class="card-header">
            <div class="fs-6">
              投稿者：<?php echo $post['name'] ?>
            </div>
          </div>
          <div class="card-body">
            <div class="card-text fs-5">
              時効まであと 
              <span class="fs-4 fw-bold">
                <?php if($diff->y > 0): ?>
                  <?php echo $diff->y ?> 年
                <?php endif ?>
                <?php if($diff->m > 0): ?>
                  <?php echo $diff->m ?> ヶ月
                <?php endif ?>
                <?php if($diff->d > 0): ?>
                  <?php echo $diff->d ?> 日
                <?php endif ?>
                <?php if($diff->h > 0): ?>
                  <?php echo $diff->h ?> 時間
                <?php endif ?>
                <?php if($diff->i > 0): ?>
                  <?php echo $diff->i ?> 分
                <?php endif ?>
                <?php if($diff->y == null && $diff->m == null && $diff->d == null && $diff->h == null && $diff->i == null): ?>
                  <span>1分以内</span>
                <?php endif ?>
              </span>
            </div>
          </div>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>

  <!-- ページャー -->
  <div>
    <?php include("./component/pager.php") ?>
  </div>
</div>

<?php include("./inc/footer.php") ?>