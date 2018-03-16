<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CBend_codegen extends CBend_crud {

	public function init() {
		$this->bind("hd_gen_code");
	}

	protected function validate( $data ) {

		//-- locale
		$lca = CEnv::locale( "codegen/validate" );

		//-- vali macro
		CValiMacro::setup($data, $lca);
		CValiMacro::vStr("iid");
		CValiMacro::vStr("tid");
	}

	public function hd_gen_code( $data ) {
		$data->vx = array();
		$data->fm = $data->requ["form"];

		//-- validate
		$this->validate( $data );
		if ( !CFRes::isValidated() ) {
			$this->ret($data);
			return;
		}

		$iid = $data->vx["iid"];
		$tid = $data->vx["tid"];
		CInstCode::setup( $iid, $tid );

		self::obStart();
		CInstCode::printCss();
		include("tpl.code.inc.php");
		$html = self::obEnd();

		//-- resp
		$data->resp["html"] = $html;
		$this->ret($data);
	}

}

?>