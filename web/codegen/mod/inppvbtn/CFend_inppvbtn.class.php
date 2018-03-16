<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CFend_inppvbtn extends CObject {

	public function init () {
		self::load(array(
			"fbc/CFend",
		));

		$this->bind("hd_HtmlHead");
		$this->bind("hd_Content");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();
?>
<?php CJRLdr::loadLocale("inppvbtn/dlgpvbtn"); ?>

<link rel="stylesheet" href="<?php echo $url_mod; ?>css/CDlgPvBtn.css">
<script src="<?php echo $url_mod; ?>js/CDlgPvBtn.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $url_mod; ?>css/CInpPvBtn.css" />
<script type="text/javascript" src="<?php echo $url_mod; ?>js/CInpPvBtn.js"></script>

<script type="text/javascript" src="<?php echo CEnv::urlClient(); ?>cn.php"></script>
<?php }

	public function hd_Content() {
		include( dirname(__FILE__) . "/tpl.dialog.inc.php" );
	}

}

?>