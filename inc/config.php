<?php

/*開いているファイル名を取得
---------------------------------------*/
$dir = basename($_SERVER['SCRIPT_NAME']);

/* ページごとのtitleとdescriptionの変更
-------------------------------------*/
if($dir == "index.php"){
  $title = "TOP | ";
  $description = "トップページの説明文です。";
} elseif($dir == "entry.php" || $dir == "check.php"){
  $title = "会員登録 | ";
  $description = "entryの説明文です。";
} elseif ($dir == "login.php") {
  $title = "ログイン | ";
  $description = "loginページの説明文です。";
} elseif ($dir == "logout.php") {
  $title = "ログアウト | ";
  $description = "logoutページの説明文です。";
} elseif ($dir == "complete.php") {
  $title = "会員登録完了 | ";
  $description = "completeページの説明文です。";
} elseif ($dir == "user.php") {
  $title = "マイページ | ";
} elseif ($dir == "posts.php") {
  $title = "投稿一覧 | ";
} elseif ($dir == "user_update.php") {
  $title = "ニックネーム編集 | ";
}
?>