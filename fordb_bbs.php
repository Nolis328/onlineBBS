<!-- 送信 -->
<?php
  // $nickname = $_POST['nickname'];
  // $comment = $_POST['comment'];

  // // フォームからPOST送信で受け取った情報をサニタイズし変数へ代入
  $nickname = htmlspecialchars($_POST['nickname']);
  $comment = htmlspecialchars($_POST['comment']);
  // $created = htmlspecialchars($_POST['created']);

  // １．データベースに接続する
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';//コロンは「使いますよ」の意味,ローカルホストは自分のサーバーという意味別の場合はIP
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
          //dbに何を入れるか？送信情報＋送信識別子＋カラム数


  // ２．SQL文を実行する
  $sql = "INSERT INTO `posts` ( `nickname`, `comment`) VALUES ( ?, ?);";
    //紫色になっているとエラー 全体をダブルクォートで囲えば解決。変数をぶち込む
    //SQLインジェクション（不正操作）を防ぐ


  //プリペアードステートメント
  $data=array($nickname,$comment);
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

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- NoriCSS -->
  <link rel="stylesheet" href="./noliss.css">

</head>
<body>




  <!-- ナビゲーションバー -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll">

        <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-coffee"></i>そろそろごはん</span></a>

        <!-- NORI -->









      </div>
        <!-- NORI -->
                      <div class="dropdown">
                        <button class="btn btnori btn-default dropdown-toggle reset_style" type="button" data-toggle="dropdown">
                          <!-- <img class="humimg" src="http://flat-icon-design.com/f/f_health_37/s256_f_health_37_0bg.png" alt="#"> -->
            <!-- <span class="caret"></span> -->
                          </button>
                        <ul class="dropdown-menu newstyledb" role="menu">
                          <li role="presentation"><a href="./bbs_moc.html.php">会社</a></li>
                          <li role="presentation"><a href="./bbs_moc_school.html.php">学校</a></li>
                          <li role="presentation"><a href="./bbs_moc_circle.html.php">サークル</a></li>
                        </ul>
                      </div>

        <!-- ENDNORI -->


      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>





  <!-- Bootstrapのcontainer -->
  <div class="container">
    <!-- Bootstrapのrow -->
    <div class="row">

      <!-- 画面左側 -->
      <div class="col-md-4 content-margin-top">
        <!-- form部分 -->
        <!-- Nori --><a class="teamtag"><b>会社のページ</b></a>
        <br>

        <form action="fordb_bbs.php" method="POST">
          <!-- nickname -->
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="nickname" class="form-control" id="validate-text" value="匿名" required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- comment -->
          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="comment" id="validate-length" placeholder="comment" required>誰かご飯行きません？</textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- つぶやくボタン -->
          <button type="submit" class="btn btn-primary col-xs-12" disabled>つぶやく</button>
        </form>
      </div>

      <!-- 画面右側 -->
      <div class="col-md-8 content-margin-top">
        <div class="timeline-centered">
          <article class="timeline-entry">
            <div class="timeline-entry-inner">
              <div class="timeline-icon bg-success">
                <i class="entypo-feather"></i>
                <i class="fas fa-utensils"></i>
              </div>
              <div class="timeline-label">
                <h2><a href="#">のり@平社員</a> <span>2018-03-17 00:00:00</span></h2>
                <p>Jollibeeいきませんか</p>
              </div>

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


                  <?php
                // var_dump($survey_line);
                  foreach($survey_line as $oneline_bbs){
                    ?>
                  <div class="timeline-label">
                  <h2><a href="#"><?php echo $oneline_bbs["nickname"] ?></a> 
                  <a href="show.php"><?php echo $oneline_bbs["created"] ?></a></h2>
                  <p><?php echo $oneline_bbs["comment"] ?></p>
                  </div>
                  <?php
                  }?>


</div>
</article>

<article class="timeline-entry begin">
  <div class="timeline-entry-inner">
    <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
      <i class="entypo-flight"></i>+
    </div>
  </div>
</article>
</div>
</div>

</div>
</div>






  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>

