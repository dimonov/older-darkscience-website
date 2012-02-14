<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('../global.inc.php');

define('PUN_ROOT', '../forums/');
require PUN_ROOT.'include/common.php';

$Template->page_title = 'Submit Quote';
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

if($pun_user['is_guest'] == '1') {
	echo '<b>You must <a href="/forums/login.php">log in</a> to submit a quote!</b>';
}
else{
if(!empty($_POST)) {
	$csrf = csrf::getCSRF();

	if($csrf->checkKey($_POST['k'])) {
		// So we have a good security code, do we have a quote?
		if($Quote->AddQuote($_POST['quote'], $_POST['notes'])) {
			$msg  = "<strong>Thank you,</strong> your quote has been submitted. It will be reviewed (and hopefully approved) by a moderator shortly.<br />\n";
			$msg .= "Click <a href='./'>here</a> to return to the QDB homepage.";
		}
		else {
			$msg  = "Sorry, your quote could not be added. Check to make sure you didn't leave the field blank and try again.";
		}

		unset($_SESSION['security_code']);
	}
	else {
		$msg  = "<strong>An error occured!</strong><br />\nClick <a href=\"./submit\">here</a> to try again.";
	}
}

if(!empty($msg)) {
	echo("<div class=\"forminfo\">{$msg}</div>");
}
else
{
	$csrf = csrf::getCSRF();
?>

		<div class="blockform">

		<h2><span>Submit A Quote</span></h2>
		<div class="box">
			<form method="post" action="">
				<div class="inform">
					<fieldset>
						<legend>Submit A Quote</legend>
						<div class="infldset">
							<div class="forminfo">
								<strong>Please remove</strong> all timestamps, hosts, and irrelevant lines, and try to avoid trailing laughs and inside jokes whenever possible.
							</div>

							Quote text:<br />
							<textarea name="quote" class="textarea" rows="8" cols="100"></textarea><br /><br />

							Info about the quote: (not required)<br />
							<textarea name="notes" class="textarea" rows="3" cols="100"></textarea><br /><br />

							<input type="hidden" name="k" value="<?php echo $csrf->getKey(); ?>" />
						</div>
					</fieldset>
				</div>
				<p><input type="submit" class="button" value="Submit Quote" /></p>
			</form>
		</div>

		</div>
<?php } } ?>
	</div>
</div>
