<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('../global.inc.php');
$Template->page_title = 'Quote Database';
$Template->activelink = 'quotes';
error_reporting(E_ALL ^ E_NOTICE);

$Quote = new qdb();

$stats = $Quote->GetStats();

$prevPage = "";
$nextPage = "";

if (array_key_exists('s', $_GET )) {
	$Quote->setStart( (int) $DB->escape_string($_GET['s']) );
}

$viewType = $_GET['view'];
switch($_GET['view']) {

	case "latest":
		$Template->page_title = "Latest Quotes";
		$quotes = $Quote->GetQuotes("latest");
		break;

	case "top":
		$Template->page_title = "Top Rated Quotes";
		$quotes = $Quote->GetQuotes("top");
		break;

	case "bottom":
		$Template->page_title = "Lowest Rated Quotes";
		$quotes = $Quote->GetQuotes("bottom");
		break;

	case "quote":
		$id = intval($_GET['id']);
		$Template->page_title = "Quote #{$id}";
		$quotes = $Quote->GetQuotes("id", $id);
		break;

	case "queue":
		$Template->page_title = "Queued Quotes";
		$quotes = $Quote->GetQuotes("queue");
		break;

	case "random":
		$Template->page_title = "Random Quotes";
		$quotes = $Quote->GetQuotes("random");
		break;

	case "search":
		$Template->page_title = "Search Quotes";
		$quotes = $Quote->SearchQuotes($DB->escape_string($_GET['query']), $DB->escape_string($_GET['searchnotes']));
		break;

	default:
		$Template->page_title = "Random Quotes";
		$quotes = $Quote->GetQuotes("random");
		$viewType = 'random';
		break;
}


?>

<div id="punwrap">
	<div id="punindex" class="pun">
		<div id="brdheader" class="block">
			<div class="box">
				<div id="brdmenu" class="inbox" style="overflow: auto; text-align: center">
					<ul style="float: left">
						<li><a href="/quotes/latest">Latest</a></li>
						<li><a href="/quotes/random">Random</a></li>
						<li><a href="/quotes/top">Top</a></li>
						<li><a href="/quotes/bottom">Bottom</a></li>
						<li><a href="/quotes/search">Search</a></li>
						<li><a href="/quotes/submit">Submit</a></li>
					</ul>
					
					<span>
						<? echo $stats['approved'] ?> quotes,
						<? echo $stats['queued'] ?> queued,
						<? echo $stats['flagged'] ?> flagged
					</span>
					
					<? if (($viewType != 'random') && ($Quote->prevPage > -1 || $Quote->nextPage > -1)) { ?>
					<ul style=" float: right">
						<? if ($Quote->prevPage > -1) { ?><li><a href="/quotes/<? echo $viewType ?>/<? echo $Quote->prevPage ?>">Previous <? echo $Quote->limit ?></a></li><? } ?>
						<? if ($Quote->nextPage > -1) { ?><li><a href="/quotes/<? echo $viewType ?>/<? echo $Quote->nextPage ?>">Next <? echo $Quote->limit ?></a></li><? } ?>
					</ul>
					<? } ?>
				</div>
			</div>
		</div>
		
		<style>
		.bl { color: #53C8DD; }
		.or { color: #FFA500; }
		.pun > br {
			
		}
		</style>
		
<?php

if(count($quotes) === 0) {
	$Template->page_title = "No Quotes Found";
	echo '
		<div class="qdb_err">
			No quotes found matching your query. If you used the search page, please try a different keyword.
		</div>
	';
}
else {
	$csrf = csrf::getCSRF();

	foreach($quotes as $currquote) {

		$q_id  = $currquote['id'];			// Quote ID
		$q_rt  = $currquote['rating'];		// Rating
		$q_dt  = $currquote['date'];		// Date submitted
		$q_txt = $currquote['text'];		// Quote text
		$q_nts = $currquote['notes'];		// Quote notes
		
		$q_txt = htmlentities($q_txt);
		$q_txt = preg_replace('/^\* /m','<span class="or">*</span> ', $q_txt);
		$q_txt = preg_replace('/^&lt;(.+?)&gt;/m','<span class="bl">&lt;</span>\1<span class="bl">&gt;</span>', $q_txt);
		$q_txt = nl2br($q_txt);

		$q_nts = htmlentities($q_nts);
		$q_nts = nl2br($q_nts);
		
		
		if($currquote['status'] === 'approved') {
			$q_flagged = "<a href=\"./vote/2{$q_id}{$csrf->getKey()}\">flag</a>";
		}
		elseif($currquote['status'] === 'new') {
			$q_flagged = "queued";
		}
		else {
			$q_flagged = "flagged";
		}
	
		if(!empty($q_nts)) {
			$q_nts = "<div class=\"quote_notes\"><strong>Notes:</strong> {$q_nts}</div>";
		}

		echo <<<HTML
<div class="quote_container">
	<div class="quote_header">
		Quote <a href="./{$q_id}">#{$q_id}</a> - Score: {$q_rt} - [<a href="./vote/1{$q_id}{$csrf->getKey()}">+</a>/<a href="./vote/0{$q_id}{$csrf->getKey()}">-</a>] - {$q_dt} - [{$q_flagged}]
	</div>

	<div class="quote_text">
		{$q_txt}
	</div>
	{$q_nts}
</div><br />

HTML;
	}
}

?>

	</div>
</div>
