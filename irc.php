<?php
/**
 * @package		DarkScience website
 * @author		fiftysixer <fiftysixer@gmail.com>
 */
require_once('./global.inc.php');
$Template->page_title = 'IRC Network';
$Template->activelink = 'irc';
?>
<div class='sec'>
	<h1>How To Join DarkScience</h1>
	<h2></h2>
	<p>The Darkscience community is composed of several linked IRC servers. To join, follow these steps.</p>
	<br />
	<p>Step 1. Get an IRC client.</p>
	<br />
	<div class='irc'>
		<ul>
			<li>Recommended Windows Clients:</li>
		</ul>
		<ul class='padding'>
				<li><a href='http://www.xchat.org/' target='blank'>XChat</a></li>
				<li><a href='http://www.mirc.com/' target='blank'>mIRC</a></li>
				<li><a href='http://irssi.org/' target='blank'>irssi</a></li>
				<li><a href='http://www.pidgin.im/' target='blank'>Pidgin</a></li>
		</ul>
		<ul>
			<li>Recommended *nix Clients:</li>
		</ul>
		<ul class='padding'>
				<li><a href='http://www.xchat.org/' target='blank'>XChat</a></li>
				<li><a href='http://kchat.sourceforge.net/' target='blank'>kChat</a></li>
				<li><a href='http://irssi.org/' target='blank'>irssi</a></li>
				<li><a href='http://www.pidgin.im/' target='blank'>Pidgin</a></li>
		</ul>
		<ul>
			<li>Recommended Mac Clients:</li>
		</ul>
		<ul class='padding'>
				<li><a href='http://xchataqua.sourceforge.net/' target='blank'>XChat Aqua</a></li>
				<li><a href='http://colloquy.info/' target='blank'>Colloquy</a></li>
		</ul>
		<br />
		<p>*Pidgin is not recommended above any other IRC client.</p>
	</div>
	<br />
	<p>Step 2. Join the IRC server.</p>
	<br />
	<div class='irc'>
		<p>Once you have your IRC client, use the following commands to get connected to the server:</p>
		<ul>
			<li><div class='pop'>/server irc.darkscience.ws <span>To connect without SSL encryption.</span></div></li>
			<li><div class='pop'>/server irc.darkscience.ws +6697 <span>To connect with SSL encryption.</span></div></li>
			<li><div class='pop'>/join #channel <span>Where #channel can be any channel that is listed in the IRC Channels section below.</span></div></li>
		</ul>
		<br />
		<p>*Windows users will need the <a href='http://www.slproweb.com/products/Win32OpenSSL.html'>SSL binarys</a> installed to connect with SSL.</p>
		<br />
	</div>
	<p>Step 3. Getting comfortable.</p>
	<br />
	<div class='irc'>
		<p>There are several basic commands that can help you customize your IRC experience:</p>
		<ul>
			<li><div class='pop'>/nick nickname <span>Where nickname can be any name you'd like to go by (Cannot contain spaces or special characters).</span></div></li>
			<li><div class='pop'>/msg nickserv register password email <span>You can register your nickname to prevent it from being used by someone other than yourself. Once you have registered, you will recieve an email asking you to verify your account (Make sure to use a valid email address). </span></div></li>
			<li><div class='pop'>/msg nickserv identify password <span>Use this command to identify for the nick you previously registered when you return to the IRC network.</span></div></li>
		</ul>
		<br />
	</div>
	<p>Step 4. Being secure.</p>
	<br />
	<div class='irc'>
		<p>DarkScience has SSL on port 6697. If you are running the XChat IRC client, you must check the option "Allow invalid SSL Certificates" as Darkscience uses its own certificate authority.</p>
		<br />
		<p>In addion, feel free to take a look at the DarkNet page if you are interested in connecting to IRC through the Darkscience VPN.</p>
	</div>
</div>
<div class='sec'>
	<h1>IRC Servers</h1>
	<h2></h2>
	<p>DarkScience has several linked IRC servers. Some of them are operated by DarkScience, while some are maintained by linked communities.</p>
	<br />
	<ul>
		<li>irc.darkscience.ws : Central Hub -- Operated by DarkScience.</li>
		<li>cthulhu.darkscience.ws : Cthulhu Link -- Operated by DarkScience.</li>
		<li>carbon.darkscience.ws : Carbon Link -- Operated by DarkScience.</li>
		<li>neworder.darkscience.ws : NewOrder Link -- Operated by NewOrder.Box.Sk.</li>
	</ul>
</div>
<div class='sec'>
	<h1>IRC Channels</h1>
	<h2></h2>
	<p>Official Channels:</p>
	<ul>
		<li class='pop'><span>#Darkscience -- Main network community channel.</span></li>
		<li>#Help -- IRC help and support.</li>
		<li>#Bots -- For bot development and testing. No malicious bots!</li>
		<li>#Vhost -- Set up and activate custom hostmasks.</li>
		<li>#BBS -- The DarkScience BBS lives!</li>
		<li>#firehose -- Syndicated news - tech, politics, and more.</li>
	</ul>
	<br />
	<p>Community Channels:</p>
	<ul>
		<li class='pop'><span>#telconinja -- http://telconinja.net/ - Telconinja PBX and Conf project.</span></li>
		<li class='pop'><span>#wargaming -- http://wargaming.org / - WarGaming security challenge &amp; tech community</span></li>
		<li class='pop'><span>#netxs -- NetXS Phreaking community.</span></li>
		<li class='pop'><span>#neworder -- http://neworder.box.sk community</span></li>
		<li class='pop'><span>#hack-hound -- http://hackhound.org - Hacker community and forums.</span></li>
		<li>#w4ck1ng -- Web security and hacking community.</li>
		<li>#codeshock -- http://codeshock.org - Security/Coding/Tech</li>
		<li>#QSO -- Radio communications - HAM, CB. GMRS, etc.</li>
		<li>#intern0t -- http://intern0t.net - Hacker community and forums.</li>
		<li>#insilico -- Health science, biomedical research, and medicine.</li>
		<li>#forest -- Running GameServ - a L.O.R.D. themed RPG for IRC.</li>
		<li>#irpg -- Idler RPG game channel.</li>
		<li>#artoftheninja -- AOTN Self-defense community.</li>
	</ul>
	<br />
	<p>*To get your channel listed here, please contact a DarkScience Staff member.</p>
	<br />
	<p>*Popular channels are marked with a blue bullet.</p>
</div>
<div class='sec'>
	<h1>DarkScience Staff</h1>
	<h2></h2>
	<ul>
		<li class='pop'><span>Dijit - Network Administrator</span></li>
		<li>Arbiter - Server Admin - Carbon</li>
		<li>f0x90 - Server Admin - NewOrder</li>
		<li>fiftysixer - Server Admin - Cthulhu</li>
		<li>Omelette - Server Admin - Straylight</li>
		<li>Yusuke - Server Admin - Carbon</li>
		<li>Z - Server Admin - Cthulhu</li>
	</ul>
</div>
