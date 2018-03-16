<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
	$lca_appinfo = CEnv::locale( "app/info" );
?>

<div class="main">
<?php include("tpl.page-title.inc.php"); ?>

<div class="spage spage-front">
<?php include("tpl.front-intro.inc.php"); ?>

<div class="ctar-form">
<div class="ctar-falert"></div>
<?php include("tpl.enter-key.inc.php"); ?>
<?php include("tpl.select-tpl.inc.php"); ?>
<?php include("tpl.generate-code.inc.php"); ?>
</div>
</div>

</div>

<?php // ?>