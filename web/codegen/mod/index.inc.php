<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CAutoloader {

	//-- use addon
	public static function connect( $dir ) {
		include_once( dirname(__FILE__) . '/' . $dir . '/index.inc.php' );
	}

	//-- proc_autoloader
	public static function autoloader( $class, $path_dir ) {
		$path = "{$path_dir}/{$class}.class.php";
		if ( is_file( $path ) ) {
			require_once( $path );
		}
	}

}

CAutoloader::connect("base");
CModule::setup($_rtc);
CRoll::setup($_rtc);
CApp::run($_rtc);

?>