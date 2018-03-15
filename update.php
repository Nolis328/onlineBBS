<?php
    // ポスト送信チェック
    if (!isset($_POST['id'])) {
        header('Location: bbc_moc.html.php');
        exit();
    }
    require('dbconnect.php');
    // SQL
    $sql = 'UPDATE `posts` SET `comment`=?, `created`=NOW() WHERE `id`=?';
    $data = array($_POST['comment'], $_POST['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    // show.phpへ遷移
    header('Location: show.php?id='.$_POST['id']);//postをアドレスのように関数で入れることでリダイレクトに成功しているということ！
    exit();
?>