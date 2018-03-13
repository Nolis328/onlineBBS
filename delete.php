<?php
    session_start();

    // パラメータを取得
    if (!isset($_REQUEST['id'])) {
        header('Location: bbs_moc.html.php');
        exit();
    }

    // データベース接続・削除処理（DEELTE文）
  //DB接続
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
          //dbに何を入れるか？送信情報＋送信識別子＋カラム数

        $sql = 'DELETE FROM `posts` WHERE id=?';
        $data = array($_REQUEST['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);


    // timeline.phpに遷移
    header('Location: bbs_moc.html.php');
    exit();
?>
