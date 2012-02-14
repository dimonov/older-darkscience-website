<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('../global.inc.php');
$Template->page_title = 'Search Quotes';
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

		<div class="blockform">

		<h2><span>Search the QDB</span></h2>
		<div class="box">
			<form method="get" action="./index.php" id="searchform">
				<div class="inform">
					<fieldset>
						<legend>Enter a search term below</legend>
							<div class="infldset">
						<input type="text" name="query" value="" class="textbox" style="width:300px;" /><br /><br />

						<input type="checkbox" name="searchnotes" value="1" class="checkbox" /> Search the notes also?<br /><br />

						<input type="hidden" name="view" value="search" />
							</div>
							</fieldset>
						</div>
						<p><input type="submit" class="button" value="Search QDB" /></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>