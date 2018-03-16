<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CInstCode {

	private static $url_script;
	private static $cls_selector;
	private static $iid;
	private static $tid;

	public static function setup( $iid, $tid ) {

		self::$url_script = CInsta::urlScript();

		$cfg = CEnv::config("client/ajax");
		self::$cls_selector = $cfg["cls_selector"];

		self::$iid = $iid;
		self::$tid = $tid;
	}

	private static function printSourceCode( $txt ) {
		$conv = array(
			"<"=>"&lt;",
			">"=>"&gt;",
			"["=>"<",
			"]"=>">",

		);
		foreach( $conv as $key => $val ) {
			$txt = str_replace( $key, $val, $txt );
		}
		echo "<pre class='code-box'>{$txt}</pre>";
	}

	public static function printCss() { ?>
<style>
.code-box {
	font-size:100%;
}
.code-body {
	color:#888;
}
.code-hl {
	font-weight:bold;
	color:#000;
	background-color:#ff8;
}
.label-big {
	font-size:100%;
}
</style>
<?php }

	public static function printScriptTag() {
		$url_script = self::$url_script;
		$txt=<<<_EOM_
[span class='code-hl']<script type="text/javascript" src="{$url_script}"></script>[/span]
_EOM_;
		self::printSourceCode( $txt );
	}

	public static function printScriptTagInHead() {
		$url_script = self::$url_script;
		$txt=<<<_EOM_
[span class='code-body']<head>
...
...
[span class='code-hl']<script type="text/javascript" src="{$url_script}"></script>[/span]
...
...
</head>[/span]
_EOM_;
		self::printSourceCode( $txt );
	}

	public static function printDivTag() {
		$cls_selector = self::$cls_selector;
		$iid = self::$iid;
		$tid = self::$tid;
		$txt=<<<_EOM_
[span class='code-hl']<div class="{$cls_selector}" data-iid="{$iid}" data-tid="{$tid}"></div>[/span]
_EOM_;
		self::printSourceCode( $txt );
	}

	public static function getDemoHtml() {
		$url_script = self::$url_script;
		$cls_selector = self::$cls_selector;
		$iid = self::$iid;
		$tid = self::$tid;
		$txt=<<<_EOM_
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
[span class='code-hl']<script type="text/javascript" src="{$url_script}"></script>[/span]
</head>
<body>
[span class='code-hl']<div class="{$cls_selector}" data-iid="{$iid}" data-tid="{$tid}"></div>[/span]
</body>
</html>
_EOM_;
		return $txt;
	}

	public static function printDemoHtml() {
		self::printSourceCode( self::getDemoHtml() );
	}

	public static function getDemoSrc() {
		$txt = self::getDemoHtml();
		$txt = str_replace( "[span class='code-hl']", "", $txt );
		$txt = str_replace( "[/span]", "", $txt );
		return $txt;
	}

}

?>