<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CAction_setup extends CAction {

	public function main() {

		if ( self::isFend() ) {
			self::load(array(
				'btpl/CBaseTpl',
				'fbc/CFend',
				'~/CFend_setup',
				'btpl/CSPage',
			));
		} else {
			self::load(array(
				'fbc',
				'~/CBend_setup',
				'fbc/CSAjax',
			));
		}
	}
}

?>