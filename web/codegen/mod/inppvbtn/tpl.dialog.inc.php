<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
	$lca = CEnv::locale("inppvbtn/dlgpvbtn");
?>
<div class="dlg dlgpvbtn">

<div class="dlg-heading"><?php echo $lca["title"]; ?>
	<button type="button" class="close btn-close" aria-label="Close"
		title="<?php echo $lca["alt:close"]; ?>">
		<span aria-hidden="true">&times;</span></button>
</div>

<div class="dlg-body">
	<div class="dlgpvbtn-tpllist">
<?php
	CTpl::getAllTplNames( $tpls );
	foreach( $tpls as $tid => $val ) {
		$tpl = CTpl::tpl($tid);
		$tpl = str_replace("%cy%","999",$tpl);
?>
<div class="dlgpvbtn-tplbox" data-tid="<?php echo $tid; ?>">
	<?php if (0): ?>
	<div class="dlgpvbtn-tplbox-header">
		<div><?php echo $tid; ?></div>
	</div>
	<?php endif; ?>
	<div class="dlgpvbtn-tplbox-body" tabindex="0">
		<style>
		<?php echo CTpl::css($tid,""); ?>
		</style>
		<?php echo $tpl; ?>
	</div>
</div><br/>
<?php }	?>
	</div>
</div>

<div class="dlg-footer">
	<button type="button" class="btn btn-default btn-cancel"><?php echo $lca["label:cancel"]; ?></button>
	<div class="clear:both"></div>
</div>

</div>
<?php // ?>