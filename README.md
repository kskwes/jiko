# 時効掲示板

## URL
http://outputground.php.xdomain.jp/jiko/

## 概要
- PHPとMySQLで作るWeb掲示板（MAMP環境）
- サーバーは無料レンタルサーバーのXFREEを使用
## 機能
- 会員登録
  - ニックネーム
  - Emailアドレス
  - パスワード
- ログイン・ログアウト
  - ログイン：Emailアドレス＋パスワード
- 投稿
  - ~~アクションボタン~~
## 特徴
- 過去に犯した小さな過ちを投稿する掲示板
- 投稿時に、公開日時を設定することができ、設定した日時が来るまで投稿は表示されない。（投稿者は「もう時効だからいいだろう」と思う日時を設定できる）
- 公開されるまで、投稿には「時効まであと〇〇日」とカウントダウンで残り時間が表示される。
- ~~公開後、投稿にはアクションボタンが表示され、1回押すごとに投稿に「悪い！」が付く。貯まった「悪い！」はカウントされ、総数はマイページで確認できる。~~
## 必要なページ
- TOP
  - 投稿フォーム
- 一覧ページ
  - 投稿一覧
  - ページャー
- 会員登録
  - 確認
  - 完了
- マイページ（会員情報）
  - ニックネーム変更画面
- ログイン
- ログアウト（完了）
## データベース
### データベース
- jiko
### テーブル
- users
  - id (INT)
  - name (TEXT)
  - email (TEXT)
  - password (VARCHAR(255))
  - created (DATETIME)
  - modified (TIMESTAMP)
  - reaction (INT)
- posts
  - post_id (INT)
  - post (TEXT)
  - created_by (INT)
  - created (DATETIME)
  - modified (TIMESTAMP)
  - release_date (DATETIME)
  - release_flg (TINYINT)
