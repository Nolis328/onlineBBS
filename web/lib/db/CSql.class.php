<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CSql {

	public static function query( $sql ) {
		if ( is_array($sql) ) {
			$sql = implode(" ",$sql);
		}
		return CDb::query($sql);
	}

	public static function getTotalRec( $sql ) {
		if ( is_array($sql) ) {
			$sql = implode(" ",$sql);
		}
		$sql = "SELECT COUNT(*) AS _TOTAL_FIELD_ FROM ({$sql}) AS _TABLE_";
		$result = CDb::query($sql);
		$rs = CDb::getRowA( $result );
		$total = $rs["_TOTAL_FIELD_"];
		CDb::freeResult($result);
		return $total;
	}

	public static function rpTable( $sql, $tblx ) {
		foreach( $tblx as $tbl ) {
			$sql = str_replace("%{$tbl}%","`".CDb::tblname($tbl)."`",$sql);
		}
		return $sql;
	}

	public static function qtField( $f ) {
		$str = "";
		$fx = explode(".",$f);
		if ( count($fx) > 1 ) {
			$str .= "`". CDb::tblname($fx[0]) . "`.";
			$fn = $fx[1];
		} else {
			$fn = $fx[0];
		}
		if ( $fn == "*" ) {
			$str .= $fn;
		} else {
			$str .= "`". $fn . "`";
		}

		return $str;
	}

	public static function expOrderBy( $obx ) {
		$rx = array();
		foreach( $obx as $f => $dir ) {
			$rx[] = self::qtField($f) . " " . strtoupper($dir);
		}
		return implode(", ", $rx);
	}

	public static function clSelect( $sx ) {
		if ( !empty( $sx ) ) {
			$fx = array();
			foreach( $sx as $key => $field ) {
				if ( is_int( $key ) ) {
					$fx[] = self::qtField( $field );
				} else {
					$fx[] = $key . " AS `" . $field . "`";
				}
			}
			$ret = implode( ", ", $fx );
		} else {
			$ret = '*';
		}
		return "SELECT " . $ret;
	}

	public static function clFrom( $tbl, $alias=null ) {
		if ( strpos( $tbl, " " ) !== false ) {
			return "FROM " . $tbl;
		} else {
			return "FROM " . "`" . CDb::tblname($tbl) . "`"
				. ($alias ? " AS {$alias}" : "");
		}
	}

	public static function clLeftJoin( $tbl1, $key1, $tbl2, $key2 ) {
		$tbl1 = CDb::tblname($tbl1);
		$tbl2 = CDb::tblname($tbl2);
		return "LEFT JOIN `{$tbl1}` " .
			"ON `{$tbl1}`.`{$key1}` = `{$tbl2}`.`{$key2}`";
	}

	public static function clSubQuery( $field, $tbl1, $key1, $tbl2, $key2 ) {
		$tbl1 = CDb::tblname($tbl1);
		$tbl2 = CDb::tblname($tbl2);
		$f = ( strpos( $field, "(" ) !== false ) ? $field : "`{$field}`";
		return "(SELECT {$f} FROM `$tbl1` " .
			"WHERE `{$tbl1}`.`{$key1}` = `{$tbl2}`.`{$key1}`)";
	}

	public static function clCond( $f, $op, $v ) {
		$field = self::qtField( $f );
		if ( $op == 'L%%' ) {
			return "({$field} LIKE '%" . CDb::sani($v) . "%')";
		} else if ( $op == 'in' ) {
			$rx = array();
			foreach( $v as $vi ) {
				$rx[] = "'" . CDb::sani($vi) . "'";
			}
			return "({$field} IN (" . implode(",",$rx) . "))";
		} else {
			return "({$field} {$op} " .
				( is_null($v) ? 'NULL' : "'" . CDb::sani($v) . "'" )
				. ")";
		}
	}

	public static function clCondOp( $op, $cond ) {
		$len = count($cond);
		if ( $len == 0 ) {
			return "0";
		} else if ( $len == 1 ) {
			return $cond[0];
		} else {
			return "(" . implode(" {$op} ", $cond ) . ")";
		}
	}

	public static function clWhere( $op, $cond ) {
		$cond = self::clCondOp( $op, $cond );
		if ( !empty($cond) ) {
			return "WHERE " . $cond;
		} else {
			return "";
		}
	}

	public static function clInsert( $tbl, $dx ) {
		$fx = array();
		$vx = array();
		foreach( $dx as $key => $val ) {
			$fx[] = "`" . $key . "`";
			$vx[] = is_null($val) ? 'NULL' :
				"'" . CDb::sani($val) . "'";
		}
		return "INSERT INTO `" . CDb::tblname($tbl) . "` " .
			"(" . implode( ", ", $fx ) . ") VALUES " . 
			"(" . implode( ", ", $vx ) . ")";
	}

	public static function clUpdate( $tbl, $dx ) {
		$sx = array();
		foreach( $dx as $key => $val ) {
			if ( is_int( $key ) ) {
				$sx[] = $val;
			} else {
				$sx[] = "`" . $key . "`" . " = " .
					( is_null($val) ? 'NULL' :
					"'" . CDb::sani( $val ) . "'" );
			}
		}
		return "UPDATE `" . CDb::tblname($tbl) . "` " .
			"SET " . implode( ", ", $sx );
	}

	public static function clDelete( $tbl ) {
		return "DELETE FROM " . "`" . CDb::tblname($tbl) . "`";
	}
}

?>