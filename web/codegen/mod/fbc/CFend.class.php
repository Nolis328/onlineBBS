<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CFend extends CObject {

	public function init() {
		$this->bind("hd_HtmlHead");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();
?>
<script>var url_be_entry = "<?php echo CApp::vself("_be=1"); ?>";</script>

<link href="<?php echo $url_mod; ?>css/CForm.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>js/CJMS.js"></script>
<script src="<?php echo $url_mod; ?>js/CUWait.js"></script>
<script src="<?php echo $url_mod; ?>js/CPageStack.js"></script>
<script src="<?php echo $url_mod; ?>js/CCAjax.js"></script>
<script src="<?php echo $url_mod; ?>js/CForm.js"></script>
<script src="<?php echo $url_mod; ?>js/CFRes.js"></script>


<?php }

}

?>