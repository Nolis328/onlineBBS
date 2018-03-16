<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

$lca["err:empty:db-hostname"] = "<b>ホスト名</b>を入力してください";
$lca["err:empty:db-database"] = "<b>データベース名</b>を入力してください";
$lca["err:empty:db-username"] = "<b>ユーザー名</b>を入力してください";
$lca["err:empty:db-password"] = "<b>パスワード</b>を入力してください";

$lca["err:cannot-connect-to-db"] = "データベース・サーバーに接続できません [%hostname%]";
$lca["err:table-already-exists"] = "データベース内にテーブルが既に存在します";

$lca["err:can-not-write-config-db-file"] =<<<_EOM_
<b>config/config.db.inc.php</b>に読み込み・書き込みができませんでした。<br/>
<br/>
<b>config/config.db.inc.php</b>に読み込み・書き込みの許可を与えた後、もう一度、「次へ」のボタンをクリックしてください。
_EOM_;

$lca["err:invalid-config-db-file"] =
	"設定ファイルの書式が不正です : <b>config/config.db.inc.php</b><br/>" .
	"ファイルが破損している可能性があります。";

?>