<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CDebug {

	public static function printJson( $ax ) { ?>
<script>
$("body").append( "<pre>" + 
	JSON.stringify(<?php echo CJson::encode($ax); ?>,null,'\t') + 
	"</pre>" );
</script>
<?php }

}

?>