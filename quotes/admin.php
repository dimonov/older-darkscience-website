<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('../global.inc.php');

define('PUN_ROOT', '../forums/');
require PUN_ROOT.'include/common.php';

$Template->page_title = 'QDB Admin';
$Template->activelink = 'quotes';

$Quote = new qdb();
?>

<div id="punwrap">
	<div id="punindex" class="pun">
		<div id="brdheader" class="block">
			<div class="box">
				<div id="brdmenu" class="inbox">
					<ul>
						<li><a href="/quotes/latest">Latest</a></li>
						<li><a href="/quotes/random">Random</a></li>
						<li><a href="/quotes/top">Top</a></li>
						<li><a href="/quotes/bottom">Bottom</a></li>
						<li><a href="/quotes/search">Search</a></li>
						<li><a href="/quotes/submit">Submit</a></li>
					</ul>
				</div>

			<?php if($pun_user['group_id'] == '1' || $pun_user['group_id'] == '2') { ?>
				<div id="brdwelcome" class="inbox">
					<ul class="conl">
						<li>Logged in as <strong><?php echo $pun_user['username']; ?></strong></li>
					</ul>

					<ul class="conr">
							<li><b>Administrate: </b><a href="/quotes/admin/">Queued</a> &bull; <a href="/quotes/admin/?view=flagged">Flagged</a></li>
					</ul>
					<div class="clearer"></div>
					<div style="text-align:center;">
						<b>Instructions: </b> Select '<b>+</b>' to approve or unflag a quote, or select '<b>-</b>' to permamently delete the quote.
					</div>
				</div>
			</div>
		</div>

		<form method="post" action="">
			<p style="text-align:center;"><input type="submit" class="button" value="Moderate Quotes" /></p>

<?php

if(!empty($_POST)) {
	foreach($_POST as $vote=>$value) {
		if($value == '1') {
			$Quote->ApproveQuote($vote);
		}
		elseif($value == '0') {
			$Quote->DelQuote($vote);
		}
	}
}

switch($_GET['view']) {
	case "flagged":
		$Template->page_title = "QDB Admin - Flagged Quotes";
		$quotes = $Quote->GetQuotes("flagged");
		break;

	case "queue":
	default:
		$Template->page_title = "QDB Admin - Queued Quotes";
		$quotes = $Quote->GetQuotes("queue");
		break;
}

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
		$q_txt = nl2br($q_txt);
		
		$q_nts = htmlentities($q_nts);
		$q_nts = nl2br($q_nts);
		
		if($currquote['status'] === 'new') {
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
		Quote <a href="/quotes/{$q_id}">#{$q_id}</a> - Score: {$q_rt} - [ + <input type="radio" name="{$q_id}" value="1" /> <input type="radio" name="{$q_id}" value="" checked="checked" /> <input type="radio" name="{$q_id}" value="0" /> - ] - {$q_dt} - [{$q_flagged}]
	</div>

	<div class="quote_text">
		{$q_txt}
	</div>
	{$q_nts}
</div>
HTML;
	}
}

} else {
	echo "You do not have permission to access this page!";
}

?>
		</form>
	</div>
</div>