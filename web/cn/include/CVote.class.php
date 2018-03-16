<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CExtSig {

	public static function getVal() {
		return null;
	}

}

class CIpSig {

	public static function getVal() {
		$ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "";
		if ( filter_var($ip, FILTER_VALIDATE_IP) === false ) {
			$ip = null;
		}
		return $ip;
	}

}

class CCkSig {

	private static function createRandomString( $n ) {
		$s = "";
		for ( $i = 0; $i < $n; $i++ ) {
			if ( rand( 1, 2 ) == 1 ) {
				$s .= chr(rand(97, 122));
			} else {
				$s .= chr(rand(65, 90));
			}
		}
		return $s;
	}

	private static function createVal() {
		return self::createRandomString(20);
	}

	private static function getCookieKey() {
		$cfg = CEnv::config("poll/sig");
		return $cfg["voter-cookie-key"];
	}

	private static function getMaxCookieExpTime() {
		if ( PHP_INT_SIZE == 4 ) {// 32 bits PHP
			//-- 2147483647 = 2^31-1 = 2038-01-18 19:14:07
			return 2147483647;
		} else {// 64 bits PHP
			//-- 10 years
			return time() + (10 * 365 * 24 * 60 * 60);
		}
	}

	private static function getCookieUrl() {
		return dirname(dirname($_SERVER["SCRIPT_NAME"]));
	}
	
	private static function setVal( $val ) {
		$key = self::getCookieKey();
		$t = self::getMaxCookieExpTime();
		$url = self::getCookieUrl();
		setcookie( $key, $val, $t, $url );
		$_COOKIE[$key] = $val;
	}

	public static function getVal() {
		$key = self::getCookieKey();
		if ( isset($_COOKIE[$key]) ) {
			return $_COOKIE[$key];
		} else {
			$val = self::createVal();
			self::setVal( $val );
			return $val;
		}
	}

}

class CVote {

	const TBL_NAME = "vote";
	const ID_NAME = "vote_id";

	private static $vote_id = 0;
	private static $vote_info = null;
	private static $poll_id;
	private static $b_extsig;
	private static $b_ipsig;
	private static $b_cksig;

	private static function findVoteID( $fdname, $fdval ) {

		if ( empty($fdval) ) { return 0; }

		//-- build clauses
		$clx = array();

		//-- select clause
		$clx[] = CSql::clSelect(array(
			self::ID_NAME,
			"dt_create",
			"poll_id",
			"extsig",
			"ipsig",
			"cksig",
			"ans",
		));

		//-- from
		$clx[] = CSql::clFrom(self::TBL_NAME);

		//-- cond
		$cond = array();
		$cond[] = CSql::clCond( "poll_id", "=", self::$poll_id );
		$cond[] = CSql::clCond( $fdname, "=", $fdval );

		//-- where clause
		if ( !empty($cond)  ) {
			$clx[] = CSql::clWhere("AND",$cond);
		}

		//-- limite clause
		$clx[] = "LIMIT 1";

		//-- run query
		$result = CSql::query($clx);
		self::$vote_info = CDb::getRowA( $result );

		//-- free result
		CDb::freeResult( $result );

		if ( !self::$vote_info ) { return 0; }

		return self::$vote_info[self::ID_NAME];
	}

	private static function findVoteIDByExtSig() {
		return self::findVoteID( "extsig", CExtSig::getVal() );
	}

	private static function findVoteIDByIpSig() {
		return self::findVoteID( "ipsig", CIpSig::getVal() );
	}

	private static function findVoteIDByCkSig() {
		return self::findVoteID( "cksig", CCkSig::getVal() );
	}

	public static function getAns() {
		if ( self::$vote_id ) {
			$ans = self::$vote_info["ans"];
			if ( substr($ans,0,1) == "[" ) {
				return CJson::decode($ans);
			} else {
				return $ans;
			}
		} else {
			return null;
		}
	}

	public static function setAns( $ans ) {

		$vx = array();

		//-- if there is an existing sig already, do not overwrite it
		if ( self::$b_extsig) {
			if (!( self::$vote_info && self::$vote_info["extsig"] )) {
				$vx["extsig"] = CExtSig::getVal();
			}
		} else {
			if ( self::$b_ipsig ) {
				if (!( self::$vote_info && self::$vote_info["ipsig"] )) {
					$vx["ipsig"] = CIpSig::getVal();
				}
			}
			if ( self::$b_cksig ) {
				if (!( self::$vote_info && self::$vote_info["cksig"] )) {
					$vx["cksig"] = CCkSig::getVal();
				}
			}
		}

		if ( !self::$vote_id && !$vx ) { return; }

		if ( is_null($ans) ) {
			if ( self::$vote_id ) {
				CTable::deleteByID( self::TBL_NAME, self::ID_NAME, self::$vote_id );
			}
		} else {
			if ( is_array($ans) ) {
				$vx["ans"] = CJson::encode($ans);
			} else {
				$vx["ans"] = $ans;
			}

			if ( self::$vote_id ) {
				CTable::updateByID( self::TBL_NAME, self::ID_NAME, self::$vote_id, $vx );
			} else {
				$vx["dt_create"] = date("Y-m-d H:i:s");
				$vx["poll_id"] = self::$poll_id;
				self::$vote_id = CTable::insertRec( self::TBL_NAME, $vx );
			}

			self::$vote_info = CTable::findByID(
				self::TBL_NAME, self::ID_NAME, self::$vote_id, null );
		}
	}

	public static function init( $poll_id, $b_extsig, $b_ipsig, $b_cksig ) {
		self::$vote_id = 0; 
		self::$poll_id = $poll_id; 
		self::$b_extsig = $b_extsig; 
		self::$b_ipsig = $b_ipsig; 
		self::$b_cksig = $b_cksig;

		if ( self::$b_extsig) {
			self::$vote_id = self::findVoteIDByExtSig();
			return self::$vote_id;
		}

		if ( self::$b_ipsig ) {
			if ( self::$vote_id = self::findVoteIDByIpSig() ) {
				return self::$vote_id;
			}
		}

		if ( self::$b_cksig ) {
			if ( self::$vote_id = self::findVoteIDByCkSig() ) {
				return self::$vote_id;
			}
		}

		return self::$vote_id;
	}

}

?>