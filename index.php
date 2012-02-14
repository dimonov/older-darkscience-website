<?php
/**
 * darkscience.ws
 * index.php - Home Page
 *
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('./global.inc.php');
$Template->page_title = 'IRC Network & Community';
$Template->activelink = 'home';
?>

<div class='sec'>
	<h1>Welcome to DarkScience</h1>
	<h2></h2>
	<p>
		Welcome. Here you will find a group of enthusiasts with a shared interest in computer science. Our community thrives on IRC, and we highly 
		recommend that you point your favorite IRC client to <a href="irc://irc.darkscience.ws/darkscience">irc.darkscience.ws</a>. Please feel 
		free to explore and enjoy the services and features that our community has to offer.
	</p>
</div>
<br />
<br />
<?php
$News = new news();
$news = $News->get_news();

// Set up the parser:
$pun_config['p_message_bbcode'] = 1;

require './forums/cache/cache_config.php';
require './forums/include/parser.php';


foreach($news as $item) {

	$item['title'] = htmlentities($item['title'], ENT_QUOTES);
	$item['date']  = date($config['date_format'], $item['date']);
	$item['news']  = parse_message($item['news'], 0);


	echo <<<HTML

	<div class='sec'>
		<h1>{$item['title']}</h1>
		<h2>Posted by <b>{$item['author']}</b> on {$item['date']}</h2>

			{$item['news']}
			<small><a href="{$item['url']}">[{$item['comments']} Comments] - Read More</a></small>
	</div>

HTML;
}
?>
