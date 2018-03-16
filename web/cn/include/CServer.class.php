<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CServer {
	private static $requ;
	private static $cmd;
	private static $rx;
	private static $iids;
	private static $tids;
	private static $iid;
	private static $ans;

	private static function readParams() {

		self::$requ = CJson::decode($_REQUEST["requ"]);

		if ( !isset( self::$requ["cmd"] ) ) {
			self::$rx["result"] = "empty cmd";
			return false;
		}
		self::$cmd = self::$requ["cmd"];

		if ( self::$cmd == "init" ) {
			if ( !isset( self::$requ["iids"] ) ) {
				self::$rx["result"] = "empty iids";
				return false;
			}
			self::$iids = self::$requ["iids"];

			if ( !isset( self::$requ["tids"] ) ) {
				self::$rx["result"] = "empty tids";
				return false;
			}
			self::$tids = self::$requ["tids"];
		}

		if ( self::$cmd == "vote" ) {
			if ( !isset( self::$requ["iid"] ) ) {
				self::$rx["result"] = "empty iid";
				return false;
			}
			self::$iid = self::$requ["iid"];

			if ( !isset( self::$requ["ans"] ) ) {
				self::$rx["result"] = "empty ans";
				return false;
			} else if ( self::$requ["ans"] != "y" ) {
				self::$rx["result"] = "wrong ans";
				return false;
			}
			self::$ans = self::$requ["ans"];
		}

		return true;
	}

	private static function ansToAction( $ans_db, &$vx ) {
		if ( $ans_db == null ) {
			if ( self::$ans == "y" ) {
				$vx[] = "cy=cy+1";
			} else if ( self::$ans == "n" ) {
				$vx[] = "cn=cn+1";
			}
		} else if (( $ans_db == "y" ) && ( self::$ans == "y" )) {
			$vx[] = "cy=GREATEST(0,cy-1)";
			self::$ans = null;
		} else if (( $ans_db == "y" ) && ( self::$ans == "n" )) {
			$vx[] = "cy=GREATEST(0,cy-1)";
			$vx[] = "cn=cn+1";
		} else if (( $ans_db == "n" ) && ( self::$ans == "y" )) {
			$vx[] = "cy=cy+1";
			$vx[] = "cn=GREATEST(0,cn-1)";
		} else if (( $ans_db == "n" ) && ( self::$ans == "n" )) {
			$vx[] = "cn=GREATEST(0,cn-1)";
			self::$ans = null;
		}
	}

	private static function vote( $poll_id, $vx ) {
		CTable::updateByID( "poll", "poll_id", $poll_id, $vx );
		return CTable::findByID( "poll", "poll_id", $poll_id, array(
			"cy" ) );
	}

	private static function getCnts( $iids ) {
		$rx = array();
		foreach( $iids as $iid ) {
			$rx[$iid] = null;
		}

		//-- build clauses
		$clx = array();
		$clx[] = CSql::clSelect(array("pkey","cy"));
		$clx[] = CSql::clFrom("poll");

		//-- where clause
		$cond = array();
		$cond[] = CSql::clCond("pkey","in",$iids);
		if ( count($cond) > 0  ) {
			$clx[] = CSql::clWhere("AND",$cond);
		}

		//-- run query
		$result = CSql::query($clx);
		while ( $rs = CDb::getRowA( $result ) ) {
			$rx[$rs["pkey"]] = array("cy"=>$rs["cy"]);
		}

		//-- free result
		CDb::freeResult( $result );

		//-- return
		return $rx;
	}

	private static function hd_init() {
		$tplx = array();
		$cssx = array();

		//-- css reset
		$cssx[""] = file_get_contents(CEnv::pathClient()."css/css-reset.css");

		foreach( self::$tids as $tid ) {
			$tplx[$tid] = CTpl::tpl($tid);
			$cssx[$tid] = CTpl::css($tid);
		}

		self::$rx["rsx"] = self::getCnts( self::$iids );
		self::$rx["tplx"] = $tplx;
		self::$rx["cssx"] = $cssx;
	}

	private static function hd_vote() {
		self::$rx["iid"] = self::$iid;

		if (!( $rs = CTable::findByID( "poll", "pkey", self::$iid, array("poll_id") ) ) ) {
			$rs = array(
				"dt_create"=>date("Y-m-d H:i:s"),
				"pkey"=>self::$iid,
				"cy"=>0,
			);
			$rs["poll_id"] = CTable::insertRec( "poll", $rs );
		}

		$cfg = CEnv::config("poll/block");

		$b_extsig = false;
		$b_ipsig = $cfg["b-ipsig"];
		$b_cksig = $cfg["b-cksig"];

		CVote::init( $rs["poll_id"], $b_extsig, $b_ipsig, $b_cksig );
		$vx = array();
		self::ansToAction( CVote::getAns(), $vx );
		CVote::setAns(self::$ans);
		$rs = self::vote( $rs["poll_id"], $vx );
		self::$rx["status"] = "success";
		self::$rx["rs"] = $rs;
	}

	private static function process() {

		CDb::open();

		switch( self::$cmd ) {
		case "init": self::hd_init(); break;
		case "vote": self::hd_vote(); break;
		default:
			self::$rx["result"] = "Invalid cmd : " . self::$cmd;
			return false;
		}

		return true;
	}

	public static function run() {

		self::$rx = array();
		self::$rx["result"] = "OK";

		if ( self::readParams() ) {
			self::process();
		}

		CAjaxTool::returnAjax(self::$rx);
	}
}

?>