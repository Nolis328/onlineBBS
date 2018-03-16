<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CTpl {

	public static function pathTpl( $tid = null ) {
		$path = CEnv::pathRoot() . CEnv::get("dir-tpl") . "/";
		if ( !is_null( $tid ) ) {
			$path .= $tid . "/";
		}
		return $path;
	}

	public static function urlTpl( $tid = null ) {
		$url = CEnv::urlRoot() . CEnv::get("dir-tpl") . "/";
		if ( !is_null( $tid ) ) {
			$url .= $tid . "/";
		}
		return $url;
	}

	public static function tpl( $tid ) {
		$path_folder = self::pathTpl( $tid );
		$path = $path_folder . "tpl.inc.php";
		if ( !file_exists($path) ) {
			return "";
		}
		$txt = file_get_contents($path);
		$txt = str_replace("%tpl%",$tid,$txt);
		$txt = str_replace("%url-tpl%",self::urlTpl($tid),$txt);
		return $txt;
	}

	public static function css( $tid, $cls_prefix = ".ajax-iine " ) {
		$path_folder = self::pathTpl( $tid );
		$path = $path_folder . "css/style.css";
		if ( !file_exists($path) ) {
			return "";
		}
		$txt = file_get_contents($path);
		if ( !is_null($tid) ) {
			$txt = str_replace("%tpl%",$cls_prefix . ".".$tid,$txt);
		}
		$txt = preg_replace('/([\r\n\t]+)/',"",$txt);
		$txt = preg_replace('/(\/\*(.*)\*\/)/',"",$txt);
		return $txt;
	}

	public static function getAllTplNames( &$tpls ) {
		$path_tpl = self::pathTpl() . "/";
		$tpls = array();
		foreach (glob("{$path_tpl}*") as $path) {
			if ( is_dir($path) && ( substr($path,0,1) != "_" )) {
				$path_parts = pathinfo( $path );
				$bn = $path_parts["basename"];
				$tpls[$bn] = $bn;
			}
		}
		asort($tpls);
	}

}

?>