<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CDb {

	public static $conn = null;
	public static $tbl_prefix = null;
	public static $b_mysqli;

	public static function open( $dbs = null ) {
		$ret = 0;

		if ( self::$conn ) { return $ret; }

		if ( function_exists( 'mysqli_connect' ) ) { 
			self::$b_mysqli = true;
		} else if ( function_exists( 'mysql_connect' ) ) { 
			self::$b_mysqli = false;
		} else {
			echo "missing database interface: " . 
				"no mysqli_connect/mysql_connect";
			exit;
		}

		if ( !$dbs ) {
			$dbs = CEnv::config("db");
		}

		if ( self::$b_mysqli ) {
			self::$conn = @mysqli_connect(
				$dbs[ 'db-hostname' ],
				$dbs[ 'db-username' ],
				$dbs[ 'db-password' ],
				$dbs[ 'db-database' ]
			);
			if ( !self::$conn ) {
				$ret = mysqli_connect_errno();
			}

		} else {
			self::$conn = @mysql_connect(
				$dbs[ 'db-hostname' ],
				$dbs[ 'db-username' ],
				$dbs[ 'db-password' ]
			);
			if ( !self::$conn ) {
				$ret = -1;
			} else {
				@mysql_select_db( $dbs[ 'db-database' ], self::$conn );
				$ret = mysql_errno( self::$conn );
			}
		}

		self::$tbl_prefix = $dbs['db-tbl-prefix'];

		if ( $ret == 0 ) {
			self::query("SET NAMES utf8");
		}

		return $ret;
	}

	public static function close() {
		if ( self::$b_mysqli ) {
			mysqli_close( self::$conn );
		} else {
			mysql_close( self::$conn );
		}
	}

	public static function tblname( $name ) {
		return self::$tbl_prefix . $name;
	}

	public static function query( $sql ) {
		if ( function_exists("_alog") ) {
			_alog($sql);
		}

		if ( self::$b_mysqli ) {
			return mysqli_query( self::$conn, $sql );
		} else {
			return mysql_query( $sql, self::$conn );
		}
	}

	public static function connectError() {
		if ( self::$b_mysqli ) {
			return mysqli_connect_error();
		} else {
			return mysql_error();
		}
	}

	public static function error() {
		if ( self::$b_mysqli ) {
			return mysqli_error( self::$conn );
		} else {
			return mysql_error( self::$conn );
		}
	}

	public static function errno() {
		if ( self::$b_mysqli ) {
			return mysqli_errno( self::$conn );
		} else {
			return mysql_errno( self::$conn );
		}
	}

	public static function affectedRows() {
		if ( self::$b_mysqli ) {
			return mysqli_affected_rows( self::$conn );
		} else {
			return mysql_affected_rows( self::$conn );
		}
	}

	public static function getRowCount( $result ) {
		if ( self::$b_mysqli ) {
			return mysqli_num_rows( $result );
		} else {
			return mysql_num_rows( $result );
		}
	}

	public static function getRowA( $result ) {
		if ( self::$b_mysqli ) {
			return mysqli_fetch_array( $result, MYSQLI_ASSOC );
		} else {
			return mysql_fetch_array( $result, MYSQL_ASSOC );
		}
	}

	public static function getInsertID() {
		if ( self::$b_mysqli ) {
			return mysqli_insert_id( self::$conn );
		} else {
			return mysql_insert_id( self::$conn );
		}
	}

	public static function freeResult( $result ) {
		if ( self::$b_mysqli ) {
			return mysqli_free_result( $result );
		} else {
			return mysql_free_result( $result );
		}
	}

	public static function sani( $s ) {
		if ( self::$b_mysqli ) {
			return mysqli_real_escape_string( self::$conn, $s );
		} else {
			return mysql_real_escape_string( $s, self::$conn );
		}
	}

}

?>