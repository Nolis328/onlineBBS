<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

$lca = CEnv::locale("app/info");

$items1 = array();

$items1["phpkobo"] = array(
	"rtp"=>$lca["app:home:url"] . "?pid=" . $lca["app:pid"],
	"target"=>"_blank",
	"title"=>"<span class='glyphicon glyphicon-home'></span> " .
		"ホーム",
	"roll"=>array("public"),
);

//-- doc
$doc = array(
	"items"=>$items1,
);

?>