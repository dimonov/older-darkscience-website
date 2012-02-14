<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('../global.inc.php');
$Template->page_title = 'Quote Database';
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
			</div>
		</div>
<?php

// ^quotes/vote/([012]{1})(\d+)(\w+)/?$ quotes/vote.php?id=$2&v=$1&k=$3 [L]

$path = explode("/", $_SERVER['PATH_INFO']);
array_shift($path);
preg_match('/([012]{1})(\d+)(\w+)/', $path[0], $matches);

$q_id = intval($matches[2]);
$vote = intval($matches[1]);
$csrf = csrf::getCSRF();

if (!$csrf->checkKey($matches[3])) {
	echo <<<HTML

        <div class="message">
                Your CSRF key is invalid.
        </div>
HTML;
}
else if($vote === 0) {
	if($Quote->RateDown($q_id)) {
		$msg = "You voted -1 for quote #{$q_id}";
	}
	else {
		$msg = "Error proccessing vote for quote #{$q_id}";
	}
	echo <<<HTML
	<div class="message">
		{$msg}
	</div>
HTML;
}
elseif($vote === 1) {
        if($Quote->RateUp($q_id)) {
                $msg = "You voted +1 for quote #{$q_id}";
        }
        else {
                $msg = "Error proccessing vote for quote #{$q_id}";
        }
        echo <<<HTML

        <div class="message">
                {$msg}
        </div>
HTML;

}

elseif($vote === 2) {

	$Quote->FlagQuote($q_id);

        echo <<<HTML

        <div class="message">
                You flagged quote #{$q_id}
        </div>
HTML;

}

else {

        echo <<<HTML
        <div class="message">
                There was an error proccessing your quote.
        </div>

HTML;
}
?>

	</div>
</div>