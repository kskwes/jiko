<?php
  $dsn = 'mysql:dbname=jiko;host=localhost';
  $user = 'root';
  $password = 'root';

  // DBへ接続
  try {
    $db = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo "データベース接続エラー　：".$e->getMessage();
  }
?>