<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('./global.inc.php');
$Template->page_title = 'Network Status';
$Template->activelink = 'status';
?>
<div class='sec'>
				<h1>IRC Status</h1>
				<h2></h2>
				<br />
				
				<table cellspacing='0' cellpadding='0' class='status left'>
					<tr class='bold'>
						<td class='top' colspan='4'><h1>Network Status</h1><h2></h2></td>
					</tr>
					<tr class='bold'>
						<td class='border border2'>&nbsp;</td>
						<td class='border'>Current</td>
						<td class='border'>Max</td>
					</tr>
					<tr>
						<td class='left'>Users</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr class='alt'>
						<td class='left'>Channels</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr>
						<td class='left'>Opers</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<tr class='alt'>
						<td class='left'>Servers</td>
						<td>-</td>
						<td>-</td>
					</tr>
				</table>
				<table cellspacing='0' cellpadding='0' class='status'>
					<tr class='bold'>
						<td class='top' colspan='4'><h1>Server List</h1><h2></h2></td>
					</tr>
					<tr class='bold'>
						<td class='border border2'>Server</td>
						<td class='border'>Users</td>
						<td class='border'>Max</td>
						<td class='border'>Status</td>
					</tr>
					<tr>
						<td class='left'>serpent.darkscience.ws</td>
						<td>-</td>
						<td>-</td>
						<td class='running'>Online</td>
					</tr>
					<tr class="alt">
						<td class='left'>cthulhu.darkscience.ws</td>
						<td>-</td>
						<td>-</td>
						<td class='running'>Online</td>
					</tr>
					<tr>
						<td class='left'>carbon.darkscience.ws</td>
						<td>-</td>
						<td>-</td>
						<td class='running'>Online</td>
					</tr>
					<tr class="alt">
						<td class='left'>neworder.darkscience.ws</td>
						<td>-</td>
						<td>-</td>
						<td class='running'>Online</td>
					</tr>
				</table>
			</div>
