<?php
if (isset($_REQUEST['id'])){
  $editid=$_REQUEST['id'];
//ないとバグ、さらにリクエストグローバル関数登場
//DB接続
 require('dbconnect.php');
  //dbに何を入れるか？送信情報＋送信識別子＋カラム数
  //２．SQL文を実行する
  $sql = 'SELECT * FROM `posts` WHERE id='.$editid;
  //紫色になっているとエラー 全体をダブルクォートで囲えば解決。変数をぶち込む
  //SQLインジェクション（不正操作）を防ぐ
  //プリペアードステートメント
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  //接続してEXECUTE（完成させて実行）
  //データ取得
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  // ３．データベースを切断する
  $dbh = null;
}?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timelineforedit.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- NoriCSS -->
  <link rel="stylesheet" href="./noliss.css">
</head>
<body style="margin-top: 60px">



<!-- ナビゲーションバー -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll">

        <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-coffee"></i>そろそろごはん</span></a>

      </div>
      <!-- NORI -->
      <div class="dropdown">
        <button class="btn btnori btn-default dropdown-toggle reset_style" type="button" data-toggle="dropdown">
          <!-- <img class="humimg" src="http://flat-icon-design.com/f/f_health_37/s256_f_health_37_0bg.png" alt="#"> -->
          <!-- <span class="caret"></span> -->
        </button>
        <ul class="dropdown-menu newstyledb" role="menu">
          <li role="presentation"><a href="./bbs_moc.html.php">会社</a></li>
      <!--  <li role="presentation"><a href="./bbs_moc_school.html.php">学校</a></li>
          <li role="presentation"><a href="./bbs_moc_circle.html.php">サークル</a></li> -->
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


  <div class="container">
    <div class="row">
      <!-- ここにコンテンツ -->
    <div id="senkeshi">
      <div class="col-md-6 col-md-offset-3 content-margin-top">
        <div class="timeline-centered senkeshi">
            <article class="timeline-entry">
            <div class="timeline-entry-inner">
                    <div class="timeline-icon bg-success">
                      <i class="entypo-feather"></i>
                      <i class="fas fa-utensils"></i>
                    </div>

      <div class="timeline-label">
        <form method="POST" action="update.php" class="form-group">
          <h5>
            <a><?php echo $rec['nickname']; ?><br></a>
            <a><?php echo $rec['created']; ?><br></a>
          </h5>
          <input type="hidden" name="id" value="<?php echo $rec['id']; ?>">
          <textarea name="comment" class="form-control"><?php echo $rec['comment']; ?></textarea>
          <input type="submit" value="更新" class="btn btn-warning btn-xs">
        </form>
            </div>
          </article>
        </div>
      </div>
     </div>
   </div>
 </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/noliss.js"></script>
</body>
</html>