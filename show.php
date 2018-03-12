<?php

if (isset($_REQUEST['id'])){
  $editid=$_REQUEST['id'];


  //DB接続
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
          //dbに何を入れるか？送信情報＋送信識別子＋カラム数


  // ２．SQL文を実行する
  $sql = 'SELECT * FROM `posts` WHERE `id`='.$editid;
    //紫色になっているとエラー 全体をダブルクォートで囲えば解決。変数をぶち込む
    //SQLインジェクション（不正操作）を防ぐ


  //プリペアードステートメント
  $stmt = $dbh->prepare($sql);
  $stmt->execute();//接続してEXECUTE（完成させて実行）


  //データ取得
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);


  // ３．データベースを切断する
  $dbh = null;



}?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <title>検索ページ</title>
  <meta charset="utf-8">
</head>
<body>


  <?php echo $rec["id"] ?><br>
  <?php echo $rec["nickname"] ?><br>
  <?php echo $rec["comment"] ?><br>
  <?php echo $rec["created"] ?><br>

</body>
</html>