<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CJson {

	private static function dq( $txt ) {
		# \b  Backspace (ascii code 08)
		# \f  Form feed (ascii code 0C)
		# \n  New line
		# \r  Carriage return
		# \t  Tab
		# \"  Double quote
		# \\  Backslash character
		$conv = array(
			"\\"=>"\\\\",
			"\b"=>"\\b",
			"\f"=>"\\f",
			"\r"=>"\\r",
			"\n"=>"\\n",
			"\t"=>"\\t",
			"\""=>"\\\"",
		);
		foreach( $conv as $key => $val ) {	
			$txt = str_replace( $key, $val, $txt );
		}

		return '"' . $txt . '"';
	}

	public static function isList( $ax ) {
		$i = 0;
		foreach( $ax as $key => $val ) {
			if ( is_int( $key ) && ( $key == $i ) ) {
				$i++;
			} else {
				return false;
			}
		}
		return true;
	}

	private static function json_encode_uu( $ax ) {

		$b_list = self::isList( $ax );

		$rx = array();
		foreach( $ax as $key => $val ) {
			$s = $b_list ? "" : ( self::dq( $key ) . ":" );
			if ( is_array( $val ) ) {
				$s .= self::json_encode_uu( $val );
			} else if ( is_int( $val ) || is_float( $val ) ) {
				$s .= $val;
			} else if ( is_bool( $val ) ) {
				$s .= $val ? "true" : "false";
			} else {
				$s .= self::dq( $val );
			}
			$rx[] = $s;
		}

		$s = implode( ",", $rx );
		if ( $b_list ) {
			$s = "[" . $s . "]";
		} else {
			$s = "{" . $s . "}";
		}

		return $s;
	}

	public static function encode( $x ) {
		if ( defined( 'JSON_UNESCAPED_UNICODE' ) ) {
			return json_encode( $x, JSON_UNESCAPED_UNICODE );
		} else {
			return self::json_encode_uu( $x );
		}
	}

	public static function decode( $json ) {
		return json_decode( $json, true );
	}

	/*
		restore the original type which was converted to string
		during HTTP post procedure. (mostly for checkboxes)

		(e.g)
		CJson::reqTypeConv(
			array(
				"form"=>array(
					"idata"=>array(
						"b-reset-block"=>"int",
						"b-multiple"=>"int",
						"b-enable-block"=>"int",
					),
				),
			)
		);

	public static function reqTypeConv( $spx ) {
		self::arrTypeConv( $_REQUEST, $spx );
	}

	public static function arrTypeConv( &$arr, $spx ) {
		if ( is_array( $spx ) ) {
			foreach( $spx as $key => $val ) {
				self::arrTypeConv( $arr[$key], $val );
			}
		} else {
			switch ( $spx ) {
			case "int":
				$arr = intval($arr);
				break;
			case "bool":
				$arr = ( $arr == "true" );
				break;
			case "float":
				$arr = floatval($arr);
				break;
			case "double":
				$arr = doubleval($arr);
				break;
			}
		}
	}
	*/
}

?>