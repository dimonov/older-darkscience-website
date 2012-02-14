<?php
/**
 * Cross Site Request Forgery prevention class
 * This class is a singleton
 * To use this class do: $csrf = csrf::getCSRF();
 * @license Public License (GPL) Version 3
 * @copyright Sid Karunaratne <sakaru@gmail.com>
*/
class CSRF {
	
	private $key;
	private static $instance;
	
	private function __construct()
	{
		@$_SESSION['old_csrf'] = @$_SESSION['csrf'];
		$chars = range('a', 'z');
		$key = '';
		do
		{
			$key .= $chars[array_rand($chars)];
		} while (strlen($key) < 12);
		$_SESSION['csrf'] = $key;
		$this->key = $key;
	}
	
	public static function getCSRF()
	{
		if (!isset(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}
	
	/**
	 * Returns the current key
	 * This key will most likely be needed when creating link and the recipient page needs to match the key up
	 * @return string
	*/
	public function getKey()
	{
		return $this->key;
	}
	
	/**
	 * Checks if the key matches the old one
	 * @return TRUE if the keys match, otherwise FALSE
	*/
	public function checkKey($user_key)
	{
		return $user_key === $_SESSION['old_csrf'];
	}
}
?>
