<?php
/**
 * WarGaming.org
 * news.class.php - Front-page news system
 *
 * @package		WarGaming Website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
class news {
	public  $Error;
	private $news_forum = 2;

	public function get_news($limit = 5) {
		global $config, $DB;

		$return = array();
		$limit  = intval($limit) ? intval($limit) : 5;
		$DB->query("SELECT * FROM " . $DB->escape_string($config['db_prefix']) . "topics WHERE forum_id=" . $DB->escape_string($this->news_forum) . " ORDER BY posted DESC LIMIT " . $DB->escape_string($limit));
		$results = $DB->fetch_row_set();

		foreach($results as $news) {
			$DB->query("SELECT * FROM " . $DB->escape_string($config['db_prefix']) . "posts WHERE topic_id=\'" . $DB->escape_string($news['id']) . "\' ORDER BY posted ASC LIMIT 1");
			$result = $DB->fetch_row();

			$item = array();

			// Grab essential items:
			$item['author']   = $result['poster'];
			$item['date']     = $result['posted'];
			$item['news']     = $result['message'];
			$item['title']    = $news['subject'];
			$item['comments'] = $news['num_replies'];
			$item['url']      = $config['site_url'] . "forums/viewtopic.php?id={$result['topic_id']}";

			$return[] = $item;
		}

		if(is_array($return)) {
			return $return;
		}
		else {
			$this->Error = 'No news posts found!';
			return false;
		}
	}

}
?>
