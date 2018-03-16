<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CSPage extends CObject {

	public function init() {
		$this->trigger("hd_HtmlBegin"); ?>
<?php $this->trigger("hd_DocType"); ?>
<html>

<head>

<?php $this->trigger("hd_HtmlHead"); ?>

</head>

<body>

<?php $this->trigger("hd_BodyHeader"); ?>

<main>

<?php $this->trigger("hd_Body"); ?>

</main>

<?php $this->trigger("hd_BodyFooter"); ?>

</body>

</html>
<?php $this->trigger("hd_HtmlEnd");
	}

} ?>