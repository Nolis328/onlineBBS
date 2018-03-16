<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CPopHelp {

	public static function init() { ?>
<script>$(".pover").popover({container:"body",trigger:"click hover"});</script>
<?php }

	public static function show( $msg ) { ?>
<a tabindex="0" class="pover" data-toggle="popover" data-trigger="focus"
	data-content="<?php echo _hsc($msg); ?>"><span
	class="glyphicon glyphicon-question-sign"></span></a>
<?php }

}

?>