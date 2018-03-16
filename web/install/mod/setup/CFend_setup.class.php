<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CFend_setup extends CObject {

	public function init() {
		$this->unbind("CBaseTpl","hd_HtmlHeadCfgDb");
		$this->unbind("CBaseTpl","hd_BodyHeader");
		$this->unbind("CBaseTpl","hd_BodyFooter");
		$this->unbind("CBaseTpl","hd_Body");

		$this->bind("hd_HtmlHead");
		$this->bind("hd_BodyHeader");
		$this->bind("hd_BodyFooter");
		$this->bind("hd_Body");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();

		$lca_ai = CEnv::locale("app/info");
		$lca_inst = CEnv::locale("install/install");
		$this->title = $lca_ai["app:name-version"] . " " . $lca_inst["installation"];
?>
<link href="<?php echo $url_mod; ?>css/CSetup.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>js/CSetup.js"></script>
<script>
(function($){
	$(document).ready(function(){
		if ( !CDuan.isTouchDevice() ) {
			$(".homebtn").show();
		}
	});
}(jQuery));
</script>
<?php }

	public function hd_BodyHeader( $prt ) {
		$lca_ai = CEnv::locale("app/info");
		$lca = CEnv::locale("install/install");
		$title = $lca_ai["app:name"] . " " .
			'<span style="font-size:80%;">' . $lca_ai["app:version"] . "</span> " .
			$lca["installation"];
?>
<header>
<div class="title"><?php echo $title; ?></div>
</header>
<?php }

	public function hd_Body( $prt ) {
		if ( !CAppReq::check() ) {
			CAppReq::showErrMsgBox();
			exit;
		}
		include( dirname(__FILE__) . "/tpl.page.start.inc.php" );
	}

	public function hd_BodyFooter( $prt ) {
		$lca_ai = CEnv::locale("app/info");
?>

<!-- footer -->
<footer>
<?php if ( !empty($lca_ai[ "site:name" ]) ): ?>
<div class="site-name-container"><span class="site-name btn-a"
	data-href="<?php echo $lca_ai[ "site:url" ]; ?>"
	data-target="_blank"
	><?php echo $lca_ai[ "site:name" ]; ?></span></div>
<?php endif; ?>
</footer>
<!-- /footer -->

<?php }

}

?>