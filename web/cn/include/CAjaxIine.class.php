<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CAjaxIine {

	public static function printLoader( $cfg ) { ?>

(function( cfg ){

	function getVerN( ver ){
		var vx = ver.split(".");
		var cof = 1.0;
		var total = 0.0;
		for( var i=0; i<vx.length; i++ ) {
			total += parseInt(vx[i]) * cof;
			cof = cof / 100;
		}
		return total;
	};

	function shouldLoadJq( cfg ) {
		var b_load_jq = true;
		if ( window.jQuery ) {
			b_load_jq = false;
			var jq_vn = getVerN(window.jQuery.fn.jquery);
			if ( cfg.jq_min_ver ) {
				if ( jq_vn < getVerN(cfg.jq_min_ver) ) {
					b_load_jq = true;
				}
			}
			if ( cfg.jq_max_ver ) {
				if ( jq_vn >= getVerN(cfg.jq_max_ver) ) {
					b_load_jq = true;
				}
			}
		}
		return b_load_jq;
	};

	function loadScript(url, callback){
		if ( !url ) {
			callback( false );
			return;
		}

		var script = document.createElement("script");
		script.type = "text/javascript";

		if (script.readyState){/*IE*/
			script.onreadystatechange = function(){
				if (script.readyState == "loaded" ||
					script.readyState == "complete"){
					script.onreadystatechange = null;
					callback( true );
				}
			};
		} else {/*Others*/
			script.onload = function(){
				callback( true );
			};
		}

		script.src = url;

		//-- document.head.appendChild(script);
		//-- document.head isn't available to IE<9. Just use
		document.getElementsByTagName("head")[0].appendChild(script);
	};

	function run( $, appcfg ){
<?php
	$path = dirname(dirname(__FILE__)) . "/js/CAjaxIine.min.js";
	if ( file_exists($path) ) {
		include($path);
	} else {
		$path = dirname(dirname(__FILE__)) . "/js/CAjaxIine.js";
		include($path);
	}
?>
	};

	var loader = {
		jQuery:null,
		cnt:0
	};
	function onLoad() {
		loader.cnt++;
		if ( loader.cnt < 1 ) { return; }
		run(loader.jQuery,cfg.appcfg);
	};

	var url_js1 = shouldLoadJq( cfg ) ? cfg.url_js1 : null;
	loadScript(url_js1,function( b_loaded ){
		loader.jQuery = window.jQuery;
		if ( b_loaded ) {
			window.jQuery.noConflict( true );
		}
		onLoad();
	});

}(<?php CAjaxTool::printConfig($cfg); ?>));

<?php }

	public static function run() {
		$info = isset( $_REQUEST["info"] ) ? intval($_REQUEST["info"]) : 0;
		$cfg = CEnv::config("client/ajax");

		//-- build params for appcfg
		$cfg["appcfg"] = array(
			"info"=>$info,
			"url_server"=>CEnv::urlClient() . "server.php",
			"cls_selector"=>$cfg["cls_selector"],
		);

		CAjaxTool::printHeader();
		self::printLoader($cfg);
	}
}

?>