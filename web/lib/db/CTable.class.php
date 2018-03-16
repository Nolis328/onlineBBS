<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CTable {

	public static function findByID( $tbl, $tbl_id, $tbl_id_val, $sx ) {

		//-- build clauses
		$clx = array();

		//-- select clause
		$clx[] = CSql::clSelect($sx);

		//-- from
		$clx[] = CSql::clFrom($tbl);

		//-- where clause
		$cond = array();
		$cond[] = CSql::clCond($tbl_id,"=",$tbl_id_val);
		if ( count($cond) > 0  ) {
			$clx[] = CSql::clWhere("AND",$cond);
		}

		//-- run query
		$result = CSql::query($clx);
		if (!( $rs = CDb::getRowA( $result ) )) {
			$rs = null;
		}

		//-- free result
		CDb::freeResult( $result );

		//-- return
		return $rs;
	}

	public static function selectByID( $tbl, $tbl_id, $tbl_id_val, $sx, $orderby = null ) {

		//-- build clauses
		$clx = array();

		//-- select clause
		$clx[] = CSql::clSelect($sx);

		//-- from
		$clx[] = CSql::clFrom($tbl);

		//-- where clause
		$cond = array();
		$cond[] = CSql::clCond($tbl_id,"=",$tbl_id_val);
		if ( count($cond) > 0  ) {
			$clx[] = CSql::clWhere("AND",$cond);
		}

		//-- order by
		if ( $orderby ) {
			$clx[] = $orderby;
		}

		//-- run query
		$rsx = array();
		$result = CSql::query($clx);
		while ( $rs = CDb::getRowA( $result ) ) {
			$rsx[] = $rs;
		}

		//-- free result
		CDb::freeResult( $result );

		//-- return
		return $rsx;
	}

	public static function selectRec( $tbl, $sx, $cond = null, $orderby = null ) {

		//-- build clauses
		$clx = array();

		//-- select clause
		$clx[] = CSql::clSelect($sx);

		//-- from
		$clx[] = CSql::clFrom($tbl);

		//-- where clause
		if ( !empty($cond)  ) {
			$clx[] = CSql::clWhere("AND",$cond);
		}

		//-- order by
		if ( $orderby ) {
			$clx[] = $orderby;
		}

		//-- run query
		$rsx = array();
		$result = CSql::query($clx);
		while ( $rs = CDb::getRowA( $result ) ) {
			$rsx[] = $rs;
		}

		//-- free result
		CDb::freeResult( $result );

		//-- return
		return $rsx;
	}

	public static function insertRec( $tbl, $vx ) {

		$clx = array();

		//-- insert clause
		$clx[] = CSql::clInsert($tbl, $vx);

		//-- run query
		CSql::query($clx);

		return CDb::getInsertID();
	}

	public static function updateByID( $tbl, $tbl_id, $tbl_id_val, $vx ) {

		//-- build clauses
		$clx = array();

		//-- update clause
		$clx[] = CSql::clUpdate($tbl,$vx);

		//-- where clause
		$cond = array();

		$cond[] = CSql::clCond($tbl_id,"=",$tbl_id_val);

		if ( count($cond) > 0  ) {
			$clx[] = CSql::clWhere("AND",$cond);
		}

		//-- run query
		CSql::query($clx);
	}

	public static function deleteByID( $tbl, $tbl_id, $tbl_id_val ) {
		$clx = array();
		$clx[] = CSql::clDelete($tbl);
		$cond = array();
		$cond[] = CSql::clCond($tbl_id,"=",$tbl_id_val);
		$clx[] = CSql::clWhere("AND",$cond);
		CSql::query($clx);
	}
}

?>