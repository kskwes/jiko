<?php
  require_once('dbconnect.php');

  //一ページに表示する記事の数をmax_viewに定数として定義
  define('max_view',5);

  //必要なページ数を求める
  $count = $db->prepare('SELECT COUNT(*) AS count FROM posts');
  $count->execute();
  $total_count = $count->fetch(PDO::FETCH_ASSOC);
  $pages = ceil($total_count['count'] / max_view);

  //現在いるページのページ番号を取得
  if(!isset($_GET['page_id'])) { 
    $now = 1;
  } else {
    $now = $_GET['page_id'];
  }

  //表示する記事を取得するSQLを準備
  $select = $db->prepare("SELECT posts.post_id, users.name, posts.post, posts.created, posts.release_date, posts.release_flg, posts.reaction FROM posts LEFT JOIN users ON users.id = posts.created_by ORDER BY post_id DESC LIMIT :start,:max");

  if ($now == 1) {
    //1ページ目の処理
    $select->bindValue(":start",$now -1,PDO::PARAM_INT);
    $select->bindValue(":max",max_view,PDO::PARAM_INT);
  } else {
    //1ページ目以外の処理
    $select->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
    $select->bindValue(":max",max_view,PDO::PARAM_INT);
  }
  //実行し結果を取り出しておく
  $select->execute();
  $data = $select->fetchAll(PDO::FETCH_ASSOC);
?>