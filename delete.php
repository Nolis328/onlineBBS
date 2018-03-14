<?php
    // パラメータを取得
    if (!isset($_REQUEST['id'])){
    // header('Location: bbs_moc.html.php'); 開発環境
     header('Location: bbs_moc.html.php');
     exit();
    }
    //DB接続
  $dsn = 'mysql:dbname=LAA0943760-nolis328;host=mysql108.phy.lolipop.lan';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
  $user = 'LAA0943760';
  $password='piruro328';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
    //SQL削除文実行
        $sql = 'DELETE FROM `posts` WHERE id=?';
        $data = array($_REQUEST['id']);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    // 遷移
    // header('Location: bbs_moc.html.php'); 開発環境
    header('Location: bbs_moc.html.php');
    exit();
?>
<!-- JSで戻す -->

<!DOCTYPE html>
<html>
<head>
  <meta meta="charset-utf8">
  <title></title>
</head>
<body>
  <script>location.href="bbs_moc.html.php";</script>
</body>
</html>