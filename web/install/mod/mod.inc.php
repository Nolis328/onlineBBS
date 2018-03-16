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

$mods["setup"] = array(
	"vrtp"=>"/^$/",
);

$mods["btpl"] = array(
	"dir"=>"../../" . CEnv::get("dir-admin") . "/mod/btpl",
);

$mods["fbc"] = array(
	"dir"=>"../../" . CEnv::get("dir-admin") . "/mod/fbc",
);

?>