<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CAction_run_demo extends CAction {

	public function main() {
		$iid = isset($_REQUEST["iid"]) ? $_REQUEST["iid"] : 0;
		$tid = isset($_REQUEST["tid"]) ? $_REQUEST["tid"] : 0;
		CInstCode::setup( $iid, $tid );
		$txt = CInstCode::getDemoSrc();
		echo $txt;
	}

}

?>