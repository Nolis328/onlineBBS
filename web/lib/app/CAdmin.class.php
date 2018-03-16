<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

function autoloader_admin_base( $class ) {
	$path = CEnv::pathAdmin() . "mod/base/{$class}.class.php";
	if ( is_file( $path ) ) {
		require_once( $path );
	}
}
spl_autoload_register( "autoloader_admin_base" );

class CAdmin {

	public static function isAdmin() {
		return CUG::isAdmin();
	}

}

?>