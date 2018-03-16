<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CBaseTpl extends CObject {

	public function init () {
		$this->bind("hd_DocType");
		$this->bind("hd_HtmlBegin");
		$this->bind("hd_HtmlHead");
		$this->bind("hd_BodyHeader");
		$this->bind("hd_Body");
		$this->bind("hd_BodyFooter");
	}

	public function hd_DocType() {
		echo "<!DOCTYPE html>\r\n";
	}

	public function hd_HtmlBegin( $data ) {
	}

	public function hd_HtmlHead( $data ) {
		$url_mod = $this->urlMod();

		//-- breadcrumbs
		$bx = array();

		$this->cfg_admin = CEnv::config("admin/app");

		$this->lca_app = CEnv::locale("app/info");
		if ( !empty($this->lca_app[ "app:name" ]) ) {
			$bx[] = htmlspecialchars($this->lca_app[ "app:name" ]);
		}

		$page_title = CApp::get( "page-title" );
		if ( !empty($page_title) ) {
			$bx[] = htmlspecialchars($page_title);
		}

		$this->breadcrumbs = implode(" : ",$bx);

		include( dirname(__FILE__) . "/tpl.html.head.inc.php" );

		$this->trigger("hd_HtmlHeadCfgDb");
	}

	public function hd_BodyHeader( $data ) {
		include( dirname(__FILE__) . "/tpl.body.header.inc.php" );
	}

	public function hd_Body( $data ) {
	}

	public function hd_BodyFooter() {
		include( dirname(__FILE__) . "/tpl.body.footer.inc.php" );
	}

}

?>