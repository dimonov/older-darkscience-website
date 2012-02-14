<?php

class template {
	public  $activelink;
	public  $page_title;

	private $content;
	private $page;
	private $template_web_dir;
	private $template_dir;
	private $disabled = false;

	public function __construct() {
		global $config;

		$this->template_dir = $config['site_root'] . 'template/';
		$this->template_web_dir = str_replace($_SERVER['DOCUMENT_ROOT'], '', $this->template_dir);

		ob_start();
	}
	
	public function __destruct() {
		global $start_execution_time;
		
		$this->content = ob_get_clean();

		if ($this->disabled === true) {
			print($this->content);
			return;
		}

		$this->populate();

		$execution_time = number_format(microtime(true) - $start_execution_time, 3);

		print("{$this->page}\n<!-- Page generated in {$execution_time} seconds. -->");
	}

	public function disable() {
		$this->disabled = true;
	}

	private function populate() {
		global $config;

		$title = !empty($this->page_title) ? $title = $config['site_name'] . ' | ' . $this->page_title : $title = $config['site_name'];
		$name  = empty($this->activelink) ? '' : " id='" . htmlentities($this->activelink) . "'";

		$Quote = new rand_quote();
		$rand_quote = $Quote->quote();

		// Get page data:
		$tmp = file_get_contents($this->template_dir . 'template.tpl');

		$tmp = str_replace('<!--PAGE_TITLE-->', htmlentities($title), $tmp);
		$tmp = str_replace('<!--PAGE_CONTENT-->', preg_replace("/([\r\n]+)/", "\\1" . preg_replace("/.*[\r\n]+(\t+)\<\!\-\-PAGE\_CONTENT\-\-\>.*/ms", "\\1", $tmp), $this->content), $tmp);
		//$tmp = str_replace('<!--PAGE_LINKS-->', preg_replace("/([\r\n]+)/", "\\1" . preg_replace("/.*[\r\n]+(\t+)\<\!\-\-PAGE\_LINKS\-\-\>.*/ms", "\\1", $tmp), $this->build_links()), $tmp);
		$tmp = str_replace('<!--TEMPLATE_PAGE_NAME-->', $name, $tmp);
		$tmp = str_replace('<!--TEMPLATE_WEB_PATH-->', htmlentities($this->template_web_dir), $tmp);
		$tmp = str_replace('<!--SITE_URL-->', htmlentities($config['site_url']), $tmp);
		$tmp = str_replace('<!--RANDOM_QUOTE-->', $rand_quote, $tmp);

		$this->page = $tmp;
		unset($tmp);
	}

	/* WE HAS NO LINKS.
	private function build_links() {
		global $config;

		$linkmask = '<a href="<!--LINK_URL-->"<!--LINK_ACTIVE_TAG-->><!--LINK_NAME--></a>';
		$links    = '';

		foreach(file($this->template_dir . '/links.tpl') as $line) {

			list($link['name'], $link['url']) = explode('::', $line, 2);

			$link['name'] = htmlentities(trim($link['name']));
			$link['url']  = htmlentities(trim($link['url']));

			if($links != '') $links .= " \n";
			
			$activelink = strtolower($link['name']) == strtolower($this->activelink) ? ' id="n_active"' : '';

			$links .= str_replace('<!--LINK_URL-->', $config['site_url'] . $link['url'], $linkmask);
			$links = str_replace('<!--LINK_NAME-->', htmlentities($link['name']), $links);
			$links = trim(str_replace('<!--LINK_ACTIVE_TAG-->', $activelink, $links));
		}

		return $links;
	}
	*/
}
?>