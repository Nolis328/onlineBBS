<?php
// １．データベースに接続する
  $dsn = 'mysql:dbname=LAA0943760-nolis328;host=mysql108.phy.lolipop.lan';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
  $user = 'LAA0943760';
  $password='piruro328';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
//dbに何を入れるか？送信情報＋送信識別子＋カラム数
?>
<?php
	// $dsn = 'mysql:dbname=oneline_bbs;host=localhost';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
	// $user = 'root';
	// $password='';
	// $dbh = new PDO($dsn, $user, $password);
	// $dbh->query('SET NAMES utf8');
?>