<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CCfgDb {

	public static function get( $ckey ) {
		CDb::open();
		$rs = CTable::findById( "cfgdb", "ckey", $ckey, array("cval") );
		if ( $rs ) {
			$cval = $rs["cval"];
			if ( $cval ) {
				return CJson::decode($cval);
			}
		}
		return array();
	}

	public static function set( $ckey, $cval ) {
		CDb::open();
		CTable::updateById( "cfgdb", "ckey", $ckey, array(
			"cval"=>CJson::encode($cval) ) );
	}

}

?>