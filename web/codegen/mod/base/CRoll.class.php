<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

//[!VT][2016-12-31][v2.0]
class CRoll {

	public static $rolls = null;

	public static function setup( $_rtc ) {
		$path = $_rtc["path-entity"] . "/roll.inc.php";
		if ( file_exists($path) ) {
			$rolls =& self::$rolls;
			include_once($path);
		}
	}

	public static function getAllRolls() {
		$rx = array("public");
		if ( !is_null(self::$rolls) ) {
			if ( CSess::userID() ) {
				array_push($rx,"regular");
				if ( CSess::getUserInfo("b_admin") ) {
					array_push($rx,"admin");
				}
			}
		}
		return $rx;
	}

	public static function hasRoll( $rolls ) {
		if ( !is_array($rolls) ) {
			$rolls = array($rolls);
		}
		$rx = self::getAllRolls();
		foreach( $rolls as $roll ) {
			if ( in_array($roll,$rx) ) {
				return true;
			}
		}
		return false;
	}

	public static function hasAccess( $mname ) {
		if ( is_null(self::$rolls) ) { return true; }

		$rx = self::getAllRolls();
		if ( in_array("admin",$rx) ){
			return true;
		}
		if ( in_array("regular",$rx) ){
			if ( !in_array($mname,array("user")) ) {
				return true;
			}
		}
		if ( in_array("public",$rx) ){
			if ( in_array($mname,array("","login","logout")) ) {
				return true;
			}
		}
		return false;
	}

	public static function checkAccess( $mname ) {
		if ( is_null(self::$rolls) ) { return; }

		if ( !self::hasAccess($mname) ) {
			CSess::exitSess();
		}
	}
}

?>