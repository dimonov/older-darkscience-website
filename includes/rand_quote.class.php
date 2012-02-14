<?php
class rand_quote {
	function quote() {
		// max per quote: 4 lines, 50 chars per line
		$q[] = "* Z sets mode: +b c0d3d";
		$q[] = "- be less obvious";
		$q[] = "- composed primarily of carbon and win";
		$q[] = "* brb, broke time";
		$q[] = "<Travis> the concept of 'popcorn' frightens and confuses me";
		$q[] = "<Cyrus> Ruby is/was just a flame! A fling! She meant nothing to me!";
		$q[] = "* This is madness.. ";
		$q[] = "<lolage> Three people constitutes a group. I have conducted experiments and this seems to 
			hold water. Until they are beaten. At which point they seem to lose water at a fast pace.";
		$q[]  = "\"I'd kill to join the Peace Corps\" --Cyrus";
		$q[]  = "<karasu> ya know when you say python, i always think 'penis'";
		

		$idx = rand(0,count($q)-1);

		$str = $q[$idx];
		$str = htmlspecialchars($str);
		$str = str_replace("\n", "<br>", $str);

		return "$str";
	}
}
?>
