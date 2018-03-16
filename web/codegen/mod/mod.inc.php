<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

$mods = array();

//-- default entry
$mods["main"] = array(
	"vrtp"=>"/^$/",
);

//-- bootstrap template
$mods["btpl"] = null;

//-- application pages
$mods["codegen"] = null;
$mods["run-demo"] = array(
	"dir"=>"codegen"
);
$mods["inppvbtn"] = null;

?>