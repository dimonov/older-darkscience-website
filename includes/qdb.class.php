<?php
/**
 * darkscience.ws
 * qdb.class.php - Quote Database object
 *
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */

class qdb {

	public $start = 0;
	public $limit = 25;

	public $prevPage = -1;
	public $nextPage = -1;

	public function AddQuote($quote, $notes) {
		global $DB;
	
		if(empty($quote)) {
			// Not much of a quote, not even worth trying...
			return false;
		}
		
		// We're adding a quote to the QDB...prepare data first!
		$s_quote = $DB->escape_string($quote);
		$s_notes = $DB->escape_string($notes);
		
		$date    = time();
		$ip	  = $_SERVER['REMOTE_ADDR'];
		
		// Ready - let's save the quote...
		$DB->query("INSERT INTO qdb_quotes (text, notes, date, ip) VALUES ('{$s_quote}', '{$s_notes}', '{$date}', '{$ip}')");

		return true;
	}

	function setStart ($inStart = 0) {
		if ($inStart > -1)
			$this->start = $inStart;
	}
	
	function setLimit ($inLimit = 25) {
		if ($inLimit > -1)
			$this->limit = $inLimit;
	}
	
	function DelQuote($id) {
		global $DB;
		
		$id = intval($id);
		$DB->query("DELETE FROM qdb_quotes WHERE id = {$id} LIMIT 1");
	}
	
	function GetQuotes($type, $id = 0) {

		$limit   = $this->limit;
		$start   = $this->start;
		$id      = intval($id);

		$this->prevPage = -1;
		if ($start > 0) {
			$this->prevPage = $start - $limit;
			if ( $this->prevPage < 0 ) {
				$this->prevPage = 0;
			}
		}
		
		$this->nextPage = -1;
		$total = $this->GetCount($type);
		if ($total > ($start + $limit) ) {
			$this->nextPage = $start + $limit;
		}

		global $DB;

		switch($type) {
			case "id":
				$DB->query("SELECT * FROM qdb_quotes WHERE id = {$id}");
				break;

			case "latest":
				$DB->query("SELECT * FROM qdb_quotes WHERE status != 'new' ORDER BY id DESC LIMIT $start, $limit");
				break;

			case "random":
				$DB->query("SELECT * FROM qdb_quotes WHERE status != 'new' ORDER BY RAND() LIMIT {$limit}");
				break;

			case "top":
				$DB->query("SELECT * FROM qdb_quotes WHERE status != 'new' ORDER BY rating DESC LIMIT $start, $limit");
				break;

			case "bottom":
				$DB->query("SELECT * FROM qdb_quotes WHERE status != 'new' ORDER BY rating LIMIT $start, $limit");
				break;

			case "queue":
				$DB->query("SELECT * FROM qdb_quotes WHERE status = 'new' ORDER BY id DESC LIMIT $start, $limit");
				break;

			case "flagged":
				$DB->query("SELECT * FROM qdb_quotes WHERE status = 'flagged' ORDER BY id DESC LIMIT $start, $limit");
				break;

			case "all":
				$DB->query("SELECT * FROM qdb_quotes LIMIT $start, $limit");
				break;

			default:
				$DB->query("SELECT * FROM qdb_quotes WHERE status != 'new' ORDER BY RAND() LIMIT {$limit}");
				break;
		}

		$return = array();
		$result = $DB->fetch_row_set();

		foreach($result as $row) {
			$row['text']  = stripslashes($row['text']);
			$row['notes'] = stripslashes($row['notes']);
			$row['date']  = is_numeric($row['date']) ? $row['date']  : strtotime($row['date']);
			$row['date']  = date('M d Y', $row['date']);
			$return[] = $row;
		}

		return $return;
	}

	public function SearchQuotes($keyword, $notes = false) {
		global $DB;

		if (empty($keyword)) {
			return array();
		}
		
		$limit = $this->limit;

		$s_keyword = $DB->escape_string($keyword);

		if($notes != false) {
			$DB->query("SELECT * FROM qdb_quotes WHERE text LIKE \"%{$s_keyword}%\" OR notes like \"%{$s_keyword}%\" AND status != 'new' ORDER BY id DESC LIMIT {$limit}");
		}
		else {
			$DB->query("SELECT * FROM qdb_quotes WHERE text LIKE \"%{$s_keyword}%\" AND status != 'new' ORDER BY id DESC LIMIT {$limit}");
		}
		
		$return = array();
		$result = $DB->fetch_row_set();

		foreach($result as $row) {
			$row['text']  = stripslashes($row['text']);
			$row['notes'] = stripslashes($row['notes']);
			$return[] = $row;
		}

		return $return;
	}

	
	function RateUp($id) {
		global $DB;

		$id = intval($id);

		if(!$this->CanVote($id)) {
			return false;
		}

		$DB->query("UPDATE `qdb_quotes` SET `rating` = `rating`+1 WHERE id = {$id} LIMIT 1");

		$this->LogVote($id);

		return true;
	}
	
	function RateDown($id) {
		global $DB;

		$id = intval($id);

		if(!$this->CanVote($id)) {
			return false;
		}

		$DB->query("UPDATE qdb_quotes SET rating = `rating`-1 WHERE id = {$id} LIMIT 1");

		$this->LogVote($id);

		return true;
	}
	
	function FlagQuote($id) {
		global $DB;

		$DB->query("UPDATE qdb_quotes SET status = 'flagged' WHERE id = {$id} AND status = 'approved' LIMIT 1");

		return 1;
	}

	function LogVote($id) {
		global $DB;

		$ip = $_SERVER['REMOTE_ADDR'];

		$DB->query("INSERT INTO qdb_votes (ip, id) VALUES ('{$ip}', '{$id}')");
	}

	function CanVote($id) {
		global $DB;

		// TODO: Check if user is admin or mod (via fbb user sys)

		// Check if user has voted already
		$ip = $_SERVER['REMOTE_ADDR'];

		$DB->query("SELECT * FROM qdb_votes WHERE ip='{$ip}' AND id={$id} LIMIT 1");
		if($DB->fetch_num_rows() > 0) {
			return false;
		}

		// Check that we can vote on that quote
		// Note from fifty: I don't actually remember this..?
		 $DB->query("SELECT * FROM qdb_quotes WHERE id={$id} AND status != 'new' LIMIT 1");

		if($DB->fetch_num_rows() < 1) {
			return false;
		}

		// No problems?
		return true;
	}
	
	function ApproveQuote($id) {
		global $DB;

		$DB->query("UPDATE qdb_quotes SET status = 'approved' WHERE id = {$id} LIMIT 1");

		return 1;
	}

	function GetCount($type = "quote") {
		global $DB;

		switch($type) {

			case "queue":
				$DB->query("SELECT * FROM qdb_quotes WHERE status = 'new'");
				break;

			case "flagged":
				$DB->query("SELECT * FROM qdb_quotes WHERE status = 'flagged'");
				break;

			case "all":
				$DB->query("SELECT * FROM qdb_quotes");
				break;

			case "quote":
				$DB->query("SELECT * FROM qdb_quotes WHERE status = 'approved' OR status = 'flagged'");
				break;

			default:
				$DB->query("SELECT * FROM qdb_quotes WHERE status = 'approved'");
				break;

		}

		return $DB->fetch_num_rows();
	}
	
	function GetStats() {
		global $DB;


$query = "

	SELECT
		sum( if( status='approved',1,0)) as approved,
		sum( if( status='new',     1,0)) as queued, 
		sum( if( status='flagged', 1,0)) as flagged
	FROM
		qdb_quotes
";

		$DB->query($query);

		return $DB->fetch_row();
	}
}

?>
