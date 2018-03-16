<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CFend_codegen extends CObject {

	public function init() {
		$this->bind("hd_HtmlHead");
		$this->bind("hd_Content");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();
?>
<link href="<?php echo $url_mod; ?>css/CCodeGen.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>js/CCodeGen.js"></script>
<?php }

	public function hd_Content() {
		include( dirname(__FILE__) . "/tpl.front.inc.php" );
?>
<?php }

}

?>