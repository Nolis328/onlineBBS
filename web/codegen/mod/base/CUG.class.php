<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CUG {

	private static $root_admin_id = null;

	private static function loadRootAdminId() {
		$cfg = CEnv::config( "user/root-admin" );
		self::$root_admin_id = $cfg["root-admin-id"];
	}

	public static function rootAdminId() {
		if ( is_null(self::$root_admin_id) ) {
			self::loadRootAdminId();
		}
		return self::$root_admin_id;
	}

	public static function isRootAdminId( $user_id ) {
		if ( is_null(self::$root_admin_id) ) {
			self::loadRootAdminId();
		}
		return $user_id == self::$root_admin_id;
	}

	public static function isAdmin() {
		return ( CSess::getUserInfo("b_admin") == 1 );
	}
}

?>