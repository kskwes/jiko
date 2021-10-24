<?php
  $dsn = 'mysql:dbname=outputground_db;host=mysql1.php.xdomain.ne.jp';
  $user = 'outputground_db';
  $password = '5411235kpspg';

  // DBへ接続
  try {
    $db = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo "データベース接続エラー　：".$e->getMessage();
  }
?>