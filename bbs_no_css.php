<!-- 送信 -->
<?php
  $nickname = $_POST['nickname'];
  $comment = $_POST['comment'];
  $created = $_POST['created'];



  // フォームからPOST送信で受け取った情報をサニタイズし変数へ代入
  $nickname = htmlspecialchars($_POST['nickname']);
  $comment = htmlspecialchars($_POST['comment']);
  $created = htmlspecialchars($_POST['created']);

  // １．データベースに接続する
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
          //dbに何を入れるか？送信情報＋送信識別子＋カラム数


  // ２．SQL文を実行する
  $sql = "INSERT INTO `posts` ( `nickname`, `comment`, `created`) VALUES ( ?, ?, ?);";
    //紫色になっているとエラー 全体をダブルクォートで囲えば解決。変数をぶち込む
    //SQLインジェクション（不正操作）を防ぐ


  //プリペアードステートメント
  $data=array($nickname,$comment,$created);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);//$dataを接続してEXECUTE（完成させて実行）

  // ３．データベースを切断する
  $dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
    </form>
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->

</body>
</html>