<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CModule {
	public static $mods = null;
	private static $vrtp_mx = null;

	public static function setup( $_rtc ) {
		$mods =& self::$mods;
		$path = $_rtc["path-entity"] . "/mod.inc.php";
		include_once($path);
	}

	public static function getLastVrtpMatch() {
		return self::$vrtp_mx;
	}

	private static function matchVrtp( $pat, $vrtp ) {
		return preg_match( $pat, $vrtp, self::$vrtp_mx );
	}

	public static function findMod( $vrtp ) {
		self::$vrtp_mx = null;
		foreach( self::$mods as $name => &$mod ) {
			if ( isset($mod['vrtp']) ) {
				if ( is_array($mod['vrtp']) ) {
					foreach( $mod['vrtp'] as $pat ) {
						if ( self::matchVrtp($pat,$vrtp) ) {
							return $name;
						}
					}
				} else {
					if ( self::matchVrtp($mod['vrtp'],$vrtp) ) {
						return $name;
					}
				}
			} else {
				if ( $name == $vrtp ) {
					return $name;
				}
			}
		}
		return null;
	}

	public static function connect( $name ) {
		if ( !isset(self::$mods[$name]["dir"]) ) {
			self::$mods[$name]["dir"] = $name;
		}
		CAutoloader::connect(self::$mods[$name]["dir"]);
	}
}

?>