<?php

if (!defined('PUN')) exit;
define('PUN_QJ_LOADED', 1);

?>				<form id="qjump" method="get" action="viewforum.php">
					<div><label><?php echo $lang_common['Jump to'] ?>

					<br /><select name="id" onchange="window.location=('viewforum.php?id='+this.options[this.selectedIndex].value)">
						<optgroup label="Gatehouse">
							<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>Site News and Announcements</option>
							<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>Open Topic</option>
						</optgroup>
						<optgroup label="The Wards">
							<option value="13"<?php echo ($forum_id == 13) ? ' selected="selected"' : '' ?>>Privacy and Anonymity</option>
							<option value="14"<?php echo ($forum_id == 14) ? ' selected="selected"' : '' ?>>Cryptography</option>
						</optgroup>
						<optgroup label="The Lab">
							<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Security</option>
							<option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>Programming</option>
							<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>RCE</option>
						</optgroup>
						<optgroup label="The Keep">
							<option value="11"<?php echo ($forum_id == 11) ? ' selected="selected"' : '' ?>>Linux, FreeBSD, and Unix</option>
							<option value="12"<?php echo ($forum_id == 12) ? ' selected="selected"' : '' ?>>Windows</option>
						</optgroup>
						<optgroup label="Mezzanine">
							<option value="18"<?php echo ($forum_id == 18) ? ' selected="selected"' : '' ?>>Math and Physics</option>
							<option value="16"<?php echo ($forum_id == 16) ? ' selected="selected"' : '' ?>>Health and Science</option>
							<option value="15"<?php echo ($forum_id == 15) ? ' selected="selected"' : '' ?>>Politics and Law</option>
							<option value="17"<?php echo ($forum_id == 17) ? ' selected="selected"' : '' ?>>Humor and Entertainment</option>
						</optgroup>
						<optgroup label="The Basement">
							<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>Gaming</option>
							<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>Audio</option>
							<option value="10"<?php echo ($forum_id == 10) ? ' selected="selected"' : '' ?>>Video</option>
							<option value="9"<?php echo ($forum_id == 9) ? ' selected="selected"' : '' ?>>ANSI &amp; BBS</option>
					</optgroup>
					</select>
					<input type="submit" value="<?php echo $lang_common['Go'] ?>" accesskey="g" />
					</label></div>
				</form>
