<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CAppUTC {

	private static $time_zone;

	public static function setup( $time_zone ) {
		self::$time_zone = $time_zone;
	}

	public static function toUTC( $local_tstr ) {
		$dt = new DateTime( $local_tstr, new DateTimeZone(self::$time_zone));
		$dt->setTimezone( new DateTimeZone("UTC") );
		return $dt->format("Y-m-d H:i:s");
	}

	public static function format( $patt, $utc_tstr ) {
		if ( $patt == "std" ) {
			$patt = "l, F j, Y h:ia (T)";
		}
		$dt = new DateTime( $utc_tstr, new DateTimeZone("UTC") );
		$dt->setTimezone( new DateTimeZone(self::$time_zone) );
		return $dt->format( $patt );
	}

	public static function utcTStrNow() {
		return gmdate("Y-m-d H:i:s");
	}

}

?>