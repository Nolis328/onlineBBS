<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CJRLdr {

	public static function loadLocale( $key, $lca = null ) {
		if ( !$lca ) {
			$lca = CEnv::locale( $key );
		}
		echo "<script>";
		echo "CJRLdr.loadLocale('{$key}'," . 
			json_encode($lca) . ");";
		echo "</script>\r\n";
	}

	public static function loadConfig( $key, $cfg = null ) {
		if ( !$cfg ) {
			$cfg = CEnv::config( $key );
		}
		echo "<script>";
		echo "CJRLdr.loadConfig('{$key}'," . 
			json_encode($cfg) . ");";
		echo "</script>\r\n";
	}
}

?>