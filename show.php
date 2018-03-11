<?php


                // １．データベースに接続する
                //fetchの動きに注目.上から順にとり、次の項目を取る準備をしてくれる
                              $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
                              $user = 'root';
                              $password = '';
                              $dbh = new PDO($dsn, $user, $password);
                              $dbh->query('SET NAMES utf8');

                // ２．SQL文を実行する
                $sql = 'SELECT * FROM `posts`';//これだけで取れる
                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                  //データを取得=fetchを実行
                  $survey_line=array();//array初期化
                  while(1){
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    //取得できるデータが何もなくなるまで繰り返す
                    if($rec==false){
                      break;
                    }
                    $survey_line[]=$rec;//これとpreタグの操作を繰り返すことで全ての値が取得できる（繰り返し）
                  }
                        // $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                        // $survey_line[]=$rec;


                // ３．データベースを切断する
                  $dbh = null;
                  //arrayをする意味は配列に一度保存してから切断し、あとから取り出すことができ、美しく効率的。
                  //資料のものよりデータ処理の手数が短く切ることができるということ。
                  ?>



?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Learn SNS</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
</head>
<body style="margin-top: 60px">
  <div class="container">
    <div class="row">
      <!-- ここにコンテンツ -->
      <div class="col-xs-6 col-xs-offset-3">
                <?php
                // var_dump($survey_line);
                  foreach($survey_line as $oneline_bbs){
                    ?>
                  <div class="timeline-label">
                  <h2><a href="#"><?php echo $oneline_bbs["nickname"] ?></a> 
                      <a href="show.php"><?php echo $oneline_bbs['created']; ?></a></h2>
                  <p><?php echo $oneline_bbs["comment"] ?></p>
                  </div>
                  <?php
                  }?>
        <br>
        <br>
        <a href="timeline.php">タイムラインへ</a>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>






