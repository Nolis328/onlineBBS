<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CSMsg {

	private static $binding = array();

	public static function bind( $obj, $ename ) {
		if ( !isset(self::$binding[$ename]) ) {
			self::$binding[$ename] = array();
		}
		self::$binding[$ename][] = $obj;
	}

	public static function unbind( $cname, $ename ) {
		if ( isset(self::$binding[$ename]) ) {
			if ( $cname == "*" ) {
				self::$binding[$ename] = array();
			} else {
				foreach( self::$binding[$ename] as $key => $obj ) {
					if ( get_class($obj) == $cname ) {
						unset(self::$binding[$ename][$key]);
						break;
					}
				}
			}
		}
	}

	public static function trigger( $obj, $ename, $data ) {
		if ( isset(self::$binding[$ename]) ) {
			foreach( self::$binding[$ename] as $obj ) {
				if ( method_exists( $obj, $ename ) ) {
					call_user_func_array(
						array( $obj, $ename ), array( $data ) );
				}
			}
		}
	}

}

?>