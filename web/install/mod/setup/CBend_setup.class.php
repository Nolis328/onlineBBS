<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CBend_setup extends CBend_crud {

	public function init() {
		$this->bind("hd_goto_page2");
		$this->bind("hd_goto_page3");
	}

	public function hd_goto_page2( $data ) {

		self::obStart();
		include( $this->pathMod() . "tpl.page.db.inc.php" );
		$html = self::obEnd();

		//-- resp
		$data->resp["html"] = $html;
		$this->ret($data);
	}

	protected function validate( $data ) {

		//-- locale
		$lca = CEnv::locale( "install/validate" );

		//-- vali macro
		CValiMacro::setup($data, $lca);
		CValiMacro::vStr("db-hostname");
		CValiMacro::vStr("db-database");
		CValiMacro::vStr("db-username");
		CValiMacro::vStr("db-password");
	}

	private function setup( $data ) {

		//-- locale
		$lca = CEnv::locale( "install/validate" );

		if ( !CConfigDbFile::checkPermission() ) {
			CFRes::addEA( $lca["err:can-not-write-config-db-file"] );
			return false;
		}

		$px = array();
		if ( !CConfigDbFile::load($px) ) {
			CFRes::addEA( $lca["err:invalid-config-db-file"] );
			return false;
		}

		$px["db-hostname"] = $data->vx["db-hostname"];
		$px["db-database"] = $data->vx["db-database"];
		$px["db-username"] = $data->vx["db-username"];
		$px["db-password"] = $data->vx["db-password"];

		$path_sql = self::pathMod() . "sql/sql.txt";
		if ( !CDBInstaller::run( $px, $path_sql, $errmsg ) ) {
			CFRes::addEA( $errmsg );
			return false;
		}

		//-- sve config file
		CConfigDbFile::save($px);

		//-- application setup
		CAppSetup::run();

		return true;
	}

	public function hd_goto_page3( $data ) {
		$data->vx = array();
		$data->fm = $data->requ["form"];

		//-- validate
		$this->validate( $data );
		if ( !CFRes::isValidated() ) {
			$this->ret($data);
			return;
		}

		//-- setup
		if ( !$this->setup( $data ) ) {
			$this->ret($data);
			return;
		}

		//-- load template
		self::obStart();
		include( $this->pathMod() . "tpl.page.done.inc.php" );
		$html = self::obEnd();

		//-- resp
		$data->resp["html"] = $html;
		$this->ret($data);
	}

}

?>