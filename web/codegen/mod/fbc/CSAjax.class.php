<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CSAjax extends CObject {

	public function init() {

		$data = new stdClass();
		if ( isset($_REQUEST["requ"]) ) {
			$data->requ = CJson::decode($_REQUEST["requ"]);
		} else {
			$data->requ = array();
			foreach( $_REQUEST as $key => $val ) {
				$data->requ[$key] = $val;
			}
		}
		$cmd = self::getCmd( $data );
		$data->resp = array();
		$this->trigger( "hd_" . $cmd, $data );
		if ( !empty( $data->cancel ) ) {// cancel
			exit;
		} elseif ( $data->resp['result'] == null ) {
			$data->resp['result'] = "Unknown Command ({$cmd})";
		}
		self::returnAjax( $data->resp );
		exit;
	}

	protected static function getCmd( $data ) {
		return isset($data->requ["cmd"]) ? $data->requ["cmd"] : "";
	}

	protected static function returnAjax( &$resp ) {
		echo json_encode( $resp );
	}

}

?>