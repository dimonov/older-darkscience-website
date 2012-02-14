<?php
/**
 * WarGaming.org
 * mysql.class.php - MySQL Database Abstraction Object
 *
 * @package		WarGaming Website
 * @author		dimonov, Goga[OEP], fiftysixer <fiftysixer@gmail.com>
 *
 *
 * Some new stuff (56):
 * DB config is set via the __contruct, and no longer uses a seperate config file.
 * Also some minor code changes and a escape_string function was added.
 */
class mysql {
	private $link;
	private $result;
	private $query;

	public function __construct($db_host, $db_user, $db_pass, $db_name) {

		$this->link = @mysql_connect($db_host, $db_user, $db_pass);

		if ($this->link && ($db_name !== '')) {
			@mysql_select_db($db_name, $this->link);
		}

		// Get rid of sensitive info
		unset($db_host, $db_user, $db_pass, $db_name);
	}

	public function __destruct() {
		if ($this->result) {
			@mysql_free_result($this->result);
			unset($this->result);
		}

		if ($this->link) {
			@mysql_close($this->link);
			unset($this->link);
		}
	}

	public function query($sql = false) {
		if ($sql !== false) {
			if ($this->result) {
				@mysql_free_result($this->result);
			}
			$this->result = @mysql_query($sql, $this->link);

			return $this->result;
		}

		return false;
	}

	public function fetch_row($num = false) {
		if ($this->result) {
			if ((is_int($num)) && ($num >= 0)) {
				@mysql_data_seek($this->result, $num);
			}

			return @mysql_fetch_assoc($this->result);
		}

		return false;
	}

	public function fetch_row_set($start = false, $num = false) {
		if ($this->result) {
			$set = array();

			if ((is_int($start)) && (is_int($num)) && ($start >= 0) && ($num > 0)) {
				for ($i = $start; $i < ($start + $num); $i++) {
					$set[] = $this->fetch_row($i);
				}
			}
			else {
				while ($row = $this->fetch_row()) {
					$set[] = $row;
				}
			}

			return $set;
		}

		return false;
	}

	public function fetch_num_rows() {
		if ($this->result) {
			return @mysql_num_rows($this->result);
		}

		return false;
	}

	public function str_sanitize($string) { /* TODO: Add more entries as needed here */
		return str_replace(array('\\', ';', '\n', '\r', '\t', '\0', '=', '*', '%', '-'),
			" ", $string);
	}

	public function escape_string($string) {
	/*	if($this->link) { */
			return str_sanitize(@mysql_real_escape_string($string, $this->link));
	/*	}
		return false; */
	}

	public function error() {
		if ($this->link) {
			return array(
				'error_msg'	=> @mysql_error($this->link),
				'error_no'	=> @mysql_errno($this->link)
			);
		}

		return array(
			'error_msg'	=> @mysql_error(),
			'error_no'	=> @mysql_errno()
		);
	}
}
?>
