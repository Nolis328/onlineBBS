<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CCryptPass {

	private static function createRandomString( $n ) {
		$s = "";
		for ( $i = 0; $i < $n; $i++ ) {
			switch ( rand( 1, 3 )  ) {
			case 1: $ch = chr(rand(48, 57)); break;
			case 2: $ch = chr(rand(65, 90)); break;
			case 3: $ch = chr(rand(97, 122)); break;
			}
			$s .= $ch;
		}
		return $s;
	}

	private static function getCryptVer() {
		$ver_cur = phpversion();
		if ( version_compare( $ver_cur, "5.5" ) >= 0 ) { 
			return "V550:";
		} else if ( version_compare( $ver_cur, "5.3" ) >= 0 ) { 
			return "V530:";
		} else {
			return "V520:";
		}
	}

	public static function createPassKey( $password, $cver = "" ) {
		if ( empty($cver) ) {
			$cver = self::getCryptVer();
		}
		switch( $cver ) {
		case "V550:":
			$hash = password_hash( $password, PASSWORD_BCRYPT );
			break;
		case "V530:":
			$salt = '$2a$07$' . self::createRandomString( 22 );
			$hash = crypt($password, $salt);
			break;
		case "V520:":
			$hash = $password;
			break;
		}
		return $cver . $hash;
	}

	public static function test( $password, $passkey ) {
		if ( empty($passkey) ) {
			return false;
		}

		$ver_cur = phpversion();
		$cver = substr($passkey,0,5);
		$hash = substr($passkey,5);

		switch( $cver ) {
		case "V550:":
			if ( version_compare( $ver_cur, "5.5" ) >= 0 ) { 
				$b = password_verify( $password, $hash );
			} else {
				$b = false;
			}
			break;
		case "V530:":
			if ( version_compare( $ver_cur, "5.3" ) >= 0 ) { 
				$b = ( crypt( $password, $hash ) == $hash );
			} else {
				$b = false;
			}
			break;
		case "V520:":
			$b = ( $password == $hash );
			break;
		default:
			$b = ( $password == $passkey );
			break;
		}
		return $b;
	}

}

?>