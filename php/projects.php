<?php require_once 'app.php'; ?>

<!-- Navbar -->
<a href="/" class="nav-link close">
	<svg><use xlink:href="assets/images/sprite.svg#back" /></svg>
</a>
<header>
	<nav>
		<div class="collapse navbar-toggleable" id="navbar-header">
			<ul>
				<li><a href="#ariston" class="active nav-link">2019</a></li>
				<li><a href="#mineority" class="nav-link">2018</a></li>
				<li><a href="#festy" class=" nav-link">2017</a></li>
				<li><a href="#horizon" class=" nav-link">2016</a></li>
				<li><a href="#wallogram" class="nav-link">2015</a></li>
				<li><a href="#proggame" class="nav-link">2014</a></li>
				<li><a href="#stalker" class="nav-link">2013</a></li>
				<li><a href="#wegas" class="nav-link">2012</a></li>
				<li><a href="#mjte" class="nav-link">2010</a></li>
				<li><a href="#3dblogosphere" class="nav-link">2009</a></li>
				<li><a href="#redcms" class="nav-link">2008</a></li>
			</ul>
		</div>
		<form class="form-inline pull-xs-right hidden-md-down">
			<svg><use xlink:href="assets/images/sprite.svg#search" /></svg>
			<input class="form-control" type="text" placeholder="Search" />
		</form>
		<!-- <button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">&#9776;</button> -->
	</nav>
</header>

<main>

		<!-- Ariston  -->
		<article id="ariston">
			<div>
				<?php gallery('projects/ariston', '', false); ?>
				<!-- <img class="img-fluid center-block" src="assets/images/projects/ariston.jpg" /> -->
			</div>
			<div>
				<h1>Ariston Timepieces</h1>
				<h2>July 2019 - Lausannne, Switzerland</h2>
				<p>
					Ariston is the first luxury watch that encompass crypto wallet. A physical encryption key is embedded in the case and allows the customer to access his assets (Bitcoin, Ether, etc.).
				</p>
				<ul class="objectives">
					<li>Development the iOS and Android apps</li>
					<li>Industrialization of the coin</li>
					<li>Project management</li>
				</ul>
				<div class="details">
					<div class="links">
						<a href="https://ariston-timepieces.com" target="_blank" rel="noreferrer">Website</a>
						<a href="https://play.google.com/store/apps/details?id=com.ariston.Ariston" target="_blank" rel="noreferrer">Playstore</a>
						<!--						<a href data-slick-open>Screenshots</a>-->
						<!-- <a href="https://github.com/fxaeberhard/Wallogram" target="_blank">Sources</a> -->
					</div>
					<div class="techno">
						<div class="icon" data-toggle="tooltip" title="React Native">
							<svg><use xlink:href="assets/images/sprite.svg#react" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Bitcoin">
							<svg><use xlink:href="assets/images/sprite.svg#bitcoin" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Ethereum, Solidity">
							<svg><use xlink:href="assets/images/sprite.svg#ethereum" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Node.js">
							<svg><use xlink:href="assets/images/sprite.svg#nodejs" /></svg>
						</div>
						<!-- <div class="icon" data-toggle="tooltip" title="PostgreSQL">
							<svg><use xlink:href="assets/images/sprite.svg#postgres" /></svg>
						</div> -->
					</div>
				</div>
			</div>
		</article>

		<!-- Mineority  -->
		<article id="mineority">
			<div>
				<?php gallery('projects/mineority', '', false); ?>
				<!-- <img class="img-fluid center-block" src="assets/images/projects/Mineority.png" /> -->
			</div>
			<div>
				<h1>Mineority</h1>
				<h2>June 2018 - Lausanne, Suisse</h2>
				<p>
					Mineority.io allows you to buy graphic cards to mine crypto currencies using a smart contract <em>(Solidity)</em>. The goal is to allow full control on the cards for the users and full traceability for the manufacturer.
				</p>
				<ul class="objectives">
					<li>Develop the frontend and backend interacting with the Ethereum smart contract</li>
					<li>Team Management</li>
				</ul>
				<div class="details">
					<div class="links">
						<!-- <a href="http://wallogram.ch/" target="_blank" rel="noreferrer">Website</a> -->
						<!-- <a href data-slick-open>Screenshots</a> -->
						<!-- <a href="https://github.com/fxaeberhard/Wallogram" target="_blank">Sources</a> -->
					</div>
					<div class="techno">
						<div class="icon" data-toggle="tooltip" title="React, Redux">
							<svg><use xlink:href="assets/images/sprite.svg#react" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Ethereum, Solidity">
							<svg><use xlink:href="assets/images/sprite.svg#ethereum" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Node.js">
							<svg><use xlink:href="assets/images/sprite.svg#nodejs" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="PostgreSQL">
							<svg><use xlink:href="assets/images/sprite.svg#postgres" /></svg>
						</div>
					</div>
				</div>
			</div>
		</article>

		<!-- Festy -->
		<article id="festy">
			<div>
				<div>
					<!-- <img class="img-fluid center-block" src="assets/images/projects/festy/festy-app-demo-small.gif" /> -->
					<video autoplay loop muted playsinline>
					  <source src="assets/images/projects/festy/festy-app-demo.webm" type="video/webm">
					  <source src="assets/images/projects/festy/festy-app-demo.mp4" type="video/mp4">
					</video>
				</div>
				<!-- <a href="https://www.youtube.com/watch?v=2Qn_0ODwN2U" class="embed-responsive embed-responsive-16by9" data-youtube-id="2Qn_0ODwN2U">
					<img class="img-fluid" src="http://img.youtube.com/vi/2Qn_0ODwN2U/maxresdefault.jpg" srcset="http://img.youtube.com/vi/2Qn_0ODwN2U/maxresdefault.jpg" alt="Festy" />
					<svg><use xlink:href="assets/images/sprite.svg#youtube" /></svg>
				</a> -->
			</div>
			<div>
				<h1>Festy</h1>
				<h2>December 2017 - Cork, Ireland</h2>
				<p>
					Festy is a payment system that leverages the use of both cryptocurrencies and blockchain data structure to lower fees and improve security for shop owners.
				</p>
				<ul class="objectives">
					<li>Secured a 594 Dash (200'00USD) funding from Dash community (<a href="https://www.dashcentral.org/p/Bring-Festy-to-Irish-Pubs-Global-Market" rel="noreferrer">link</a>)</li>
					<li>Architectured backend and mobile app allowing to pay with multiple cryptocurrencies (Bitcoin, Dash, Ether, Litecoin)</li>
					<li>Led a team of five developers</li>
				</ul>
				<div class="details">
					<div class="links">
						<a href="https://festy.ie" target="_blank" rel="noreferrer">Website</a>
						<!-- <a href data-slick-open>Screenshots</a> -->
						<!-- <a href="https://github.com/fxaeberhard/Wallogram" target="_blank">Sources</a> -->
					</div>
					<div class="techno">
						<div class="icon" data-toggle="tooltip" title="Bitcoin">
							<svg><use xlink:href="assets/images/sprite.svg#bitcoin" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Ethereum, Solidity">
							<svg><use xlink:href="assets/images/sprite.svg#ethereum" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Dash">
							<svg><use xlink:href="assets/images/sprite.svg#dash" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Tendermint">
							<svg><use xlink:href="assets/images/sprite.svg#tendermint" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Node.js">
							<svg><use xlink:href="assets/images/sprite.svg#nodejs" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="React, Redux, React Native">
							<svg><use xlink:href="assets/images/sprite.svg#react" /></svg>
						</div>
						<!-- <div class="icon" data-toggle="tooltip" title="MongoDB">
							<svg><use xlink:href="assets/images/sprite.svg#mongodb" /></svg>
						</div> -->
					</div>
				</div>
			</div>
		</article>

		<!-- Horizon -->
		<article id="horizon">
			<div>
				<?php gallery('projects/horizon', '', false); ?>
			</div>
			<div>
				<h1>Horizon</h1>
				<h2>July 2016 - Social Media Lab at EPFL</h2>
				<p>
					The Horizon project aims at gathering and analyzing data from social network (Facebook, Tweeter, YouTube ...) in order to create emotional indicators linked to specific topics and questions. My role was to industrialize the different steps of the process and create a SAAS platform.
				</p>
				<ul class="objectives">
					<li>Audit the existing architecture and emit recommendations</li>
					<li>Automate  time-consuming operation and optimize the architecture</li>
					<li>Participate in daily operations (bug fixing, client support)</li>
				</ul>
				<div class="details">
					<div class="links">
						<!-- <a href="http://wallogram.ch/" target="_blank">Website</a> -->
						<a href data-slick-open>Screenshots</a>
						<!-- <a href="https://github.com/fxaeberhard/Wallogram" target="_blank">Sources</a> -->
					</div>
					<div class="techno">
						<div class="icon" data-toggle="tooltip" title="Node.js">
							<svg><use xlink:href="assets/images/sprite.svg#nodejs" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Python">
							<svg><use xlink:href="assets/images/sprite.svg#python" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="RabbitMQ">
							<svg><use xlink:href="assets/images/sprite.svg#rabbitmq" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Docker">
							<svg><use xlink:href="assets/images/sprite.svg#docker" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="MongoDB">
							<svg><use xlink:href="assets/images/sprite.svg#mongodb" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Neo4j">
							<svg><use xlink:href="assets/images/sprite.svg#neo4j" /></svg>
						</div>
					</div>
				</div>
			</div>
		</article>

		<!-- Wallogram -->
		<article id="wallogram">
			<div>
				<a href="https://www.youtube.com/watch?v=W1kdVlAAzcQ" class="embed-responsive embed-responsive-16by9" data-youtube-id="W1kdVlAAzcQ" rel="noreferrer">
					<!-- <picture> -->
					<!-- <source srcset="imgpp/projects/wallogram/teaser.jpg?w=522" media="(max-width:543px)" /> -->
					<!-- <source srcset="imgpp/projects/wallogram/teaser.jpg?w=480, imgpp/projects/wallogram/teaser.jpg?w=950 x2" media="(min-width:544px) AND (max-width:894px)" /> -->
					<img class="img-fluid" src="i/projects/wallogram/teaser.jpg?w=526" srcset="i/projects/wallogram/teaser.jpg?w=526, i/projects/wallogram/teaser.jpg?w=789 1.5x, i/projects/wallogram/teaser.jpg?w=1052 2x" alt="Wallogram" />
					<!-- <img src="assets/images/projects/wallogram/teaser.jpg" /> -->
					<!-- </picture> -->
					<svg><use xlink:href="assets/images/sprite.svg#youtube" /></svg>
				</a>
			</div>
			<div>
				<h1>Wallogram</h1>
				<h2>January 2015 - Interactive video mapping at Maison d'ailleurs Museum, Yverdon</h2>
				<ul class="objectives">
					<li>Turn a wall into a game playground</li>
					<li>Let player use his mobile phone as a gamepad</li>
					<li>Present the project during <em>Portrait Robot</em> exhibit at Maison d'ailleurs</li>
				</ul>
				<div class="details">
					<div class="links">
						<a href="http://wallogram.ch/" target="_blank" rel="noreferrer">Website</a>
						<?php hiddenGallery('projects/wallogram'); ?>
						<a href data-slick-open>Pictures</a>
						<a href="https://github.com/fxaeberhard/Wallogram" target="_blank" rel="noreferrer">Github</a>
					</div>
					<div class="techno">
						<div class="icon" data-toggle="tooltip" title="Node.js">
							<svg><use xlink:href="assets/images/sprite.svg#nodejs" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="MongoDB">
							<svg><use xlink:href="assets/images/sprite.svg#mongodb" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Javascript">
							<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
						</div>
						<div class="icon" data-toggle="tooltip" title="Websocket">
							<svg><use xlink:href="assets/images/sprite.svg#websocket" /></svg>
						</div>
					</div>
				</div>
			</div>
		</article>

	<!-- Programming game -->
	<article id="proggame">
		<div>
			<?php gallery('projects/proggame', '', false); ?>
		</div>
		<div>
			<h1>Programming game</h1>
			<h2>March 2014 - UX Engineer at School for Business & Engineering Vaud (Heig)</h2>

			<ul class="objectives">
				<li>Teach javascript with fun</li>
				<li>Get funded by the E-Creation grant from HES-SO Cyberlearn unit</li>
			</ul>

			<div class="details">
				<div class="links">
					<!-- <a href="http://wegas.red-agent.com/game.html?token=proggame&al=1" target="_blank">Play online</a> -->
					<!-- <a href="http://wegas.albasim.ch/#/play/proggamedem-oh" target="_blank">Play online</a> -->
					<a href="https://wegas.albasim.ch/#/play/pact-demo" target="_blank" rel="noreferrer">Play online</a>
					<a href data-slick-open>Screenshots</a>
					<a href="https://github.com/Heigvd/Wegas" target="_blank" rel="noreferrer">Github</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Java EE (Glassfish)">
						<svg><use xlink:href="assets/images/sprite.svg#java" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Javascript (YUI 3)">
						<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Canvas (Crafty)">
						<svg><use xlink:href="assets/images/sprite.svg#html" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>


	<!-- Stalker -->
	<article id="stalker">
		<div>
			<?php gallery("projects/stalker", "ar=3:2&crop-to-fit"); ?>
		</div>
		<div>
			<h1>Stalker - Experimenting the Zone</h1>
			<h2>September 2013 - Exhibit design at Maison d'Ailleurs Museum, Yverdon</h2>

			<ul class="objectives">
				<li>Make the visitor experiment the secret room present in Tarkovski's movie</li>
				<li>Let the visitor draw his wish on a tangible surface and project it among other's on a cloud of wires</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://www.ailleurs.ch/en/expositions/archives/exposition-stalker-experimenter-la-zone/#" target="_blank" rel="noreferrer">Website</a>
					<a href data-slick-open>Pictures</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Javascript">
						<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Websocket">
						<svg><use xlink:href="assets/images/sprite.svg#websocket" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="WebGL">
						<svg><use xlink:href="assets/images/sprite.svg#webgl" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<!-- Wegas -->
	<article id="wegas">
		<div>
			<?php gallery("projects/wegas", "ar=1.83&crop-to-fit"); ?>
		</div>
		<div>
			<h1>Wegas</h1>
			<h2>January 2012 - UX Engineer at School for Business & Engineering Vaud (Heig-vd)</h2>

			<ul class="objectives">
				<li>Create a Web Game Authoring System for rapid development of serious games</li>
				<li>Allow teachers to create games without programming skills</li>
				<li>Get funding from RCSO, Western Switzerland School for Applied Science</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="https://wegas.albasim.ch" target="_blank" rel="noreferrer">Try online</a>
					<a href data-slick-open>Screenshots</a>
					<a href="https://github.com/Heigvd/Wegas" target="_blank" rel="noreferrer">Github</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="JavaEE <em>(Glassfish 3)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#java" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="PostgreSQL">
						<svg><use xlink:href="assets/images/sprite.svg#postgres" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="JavaScript <em>(YUI 3)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Selenium">
						<svg><use xlink:href="assets/images/sprite.svg#selenium" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<!-- MJ -->
	<article id="mjte">
		<div>
			<a href="https://www.youtube.com/watch?v=EKI3U_uFv7Y" data-youtube-id="EKI3U_uFv7Y" rel="noreferrer">
				<?php lazypicture('projects/mjte.jpg') ?>
				<!-- <img class="img-fluid" data-lazy-srcset="i/?w=526, i/?w=789 1.5x, i/?w=1052 2x" data-lazy-src="i/projects/mjte_720.jpg" /> -->
				<svg><use xlink:href="assets/images/sprite.svg#youtube" /></svg>
			</a>
		</div>
		<div>
			<h1>Michael Jackson: The Experience - Wii</h1>
			<h2>August 2010 - User Interface Engineer at Ubisoft</h2>

			<ul class="objectives">
				<li>Design and implement the in-game user interface on Nintendo Wii</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://www.nintendo.com/games/detail/smpbynnlvHGr3gN6PTn9kNc2htjE6apS" target="_blank" rel="noreferrer">Official website</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="C++">
						<svg><use xlink:href="assets/images/sprite.svg#cplusplus" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Nintendo Revolution SDK <em>(Wii)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#nintendo" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Actionscript 2.0 <em>(in-game interfaces)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#flash" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<!--  MJTE Web game-->
	<article id="mjteweb">
		<div>
			<a href="http://apps.facebook.com/mjte_minigame/" target="_blank" rel="noreferrer">
				<?php lazypicture('projects/mjte_minigame.jpg') ?>
				<!-- <img class="img-fluid" data-lazy-src="assets/images/projects/mjte_minigame_720.jpg" /> -->
				<!-- <div class="play-button"></div> -->
			</a>
		</div>
		<div>
			<h1>Michael Jackson: The Exerience - Web</h1>
			<h2>August 2010 - User Interface Engineer at Ubisoft</h2>

			<ul class="objectives">
				<li>Create a rhythm game where player uses keyboard to mimic Michael</li>
				<li>Implement in a Facebook app</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://apps.facebook.com/mjte_minigame/" target="_blank" rel="noreferrer">Play online</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Actionscript 3.0">
						<svg><use xlink:href="assets/images/sprite.svg#flash" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Facebook SDK">
						<svg><use xlink:href="assets/images/sprite.svg#facebook2" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<!-- Just Dance 2 -->
	<article id="jd2">
		<div>
			<a href="https://www.youtube.com/watch?v=H0_dL5w_3WA" data-youtube-id="H0_dL5w_3WA" rel="noreferrer">
				<?php lazypicture('projects/justdance2.jpg') ?>
				<!-- <img class="img-fluid" data-lazy-src="//i.ytimg.com/vi/S6FgI2CR9I4/maxresdefault.jpg" /> -->
				<svg><use xlink:href="assets/images/sprite.svg#youtube" /></svg>
			</a>
		</div>
		<div>
			<h1>Just Dance 2 - Wii & PS3</h1>
			<h2>February 2010 - Gameplay Programmer at Ubisoft</h2>

			<ul class="objectives">
				<li>Design and implement the connection between the game (PS3 and Wii) and Social Networks (Facebook & iPhone applications)</li>
				<!-- <li>Call for project E-Creation 8, HES-SO Cyberlearn Grant</li> -->
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://www.nintendo.com/games/detail/2EC398vHy15QEeuA2gp2AqlCpANwFMYL" target="_blank" rel="noreferrer">Official website</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="C++">
						<svg><use xlink:href="assets/images/sprite.svg#cplusplus" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Objective C <em>(iPhone application)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#csharp" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="OpenGL">
						<svg><use xlink:href="assets/images/sprite.svg#opengl" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="PS3 SDK">
						<svg><use xlink:href="assets/images/sprite.svg#playstation" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Nintendo Wii Revolution SDK">
						<svg><use xlink:href="assets/images/sprite.svg#nintendo" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Actionscript 2.0 <em>(in-game interfaces)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#flash" /></svg>
					</div>
					<!-- <div class="icon" data-toggle="tooltip" title="Python">
						<svg><use xlink:href="assets/images/sprite.svg#python" /></svg>
					</div> -->
					<!-- <div class="icon" data-toggle="tooltip" title="PHP <em>(web-server for Facebook Application)</em>"><svg><use xlink:href="assets/images/sprite.svg#php"/></svg></div> -->
				</div>
			</div>
		</div>
	</article>

	<!--  3D  Blogosphere-->
	<article id="3dblogosphere">
		<div>
			<?php gallery("projects/3DBlogosphere", "ff&ar=3:2"); ?>
		</div>
		<div>
			<h1>3DBlogosphere</h1>
			<h2>October 2009 - Knowledge Management Engineer at Siemens Corporate Research</h2>

			<ul class="objectives">
				<li>Use virtual worlds to enhance collaboration in a company</li>
				<li>Publish the result in a recognized conference</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://www.iaeng.org/publication/WCECS2009/WCECS2009_pp764-767.pdf" target="_blank" rel="noreferrer">“3DBlogosphere: A Multisynchronous Approach of Virtual Worlds to Sustain Company Wide Communication”</a>Aeberhard Francois-Xavier, Steve Russell, ICIMT 2009, ACM
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Java <em>(J2EE, J2SE, Project Wonderland, JMonkey & Glassfish)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#java" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="XSLT">
						<svg><use xlink:href="assets/images/sprite.svg#xml" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="JavaScript">
						<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<!--  DTouch -->
	<article id="dtouch">
		<div>
			<a href="https://www.youtube.com/watch?v=tPcI2RbFaSM" data-youtube-id="tPcI2RbFaSM" rel="noreferrer">
				<?php lazypicture('projects/dtouch.jpg') ?>
				<!-- <img class="img-fluid"  src="//i.ytimg.com/vi/tPcI2RbFaSM/mqdefault.jpg" /> -->
				<!-- <img class="img-fluid" data-lazy-src="assets/images/projects/dtouch_720.jpg" /> -->
				<svg><use xlink:href="assets/images/sprite.svg#youtube" /></svg>
			</a>
		</div>
		<div>
			<h1>Audio D-Touch</h1>
			<h2>June 2009 - Research project at Design and Media Laboratory (LDM, EPFL)</h2>

			<ul class="objectives">
				<li>Design and implement a tangible user interface (TUI) for audio sequencing</li>
				<li>Conduct a user study to validate this work</li>
			</ul>

			<div class="details">
				<div class="links">
					<!-- <a href="http://www.d-touch.org/audio/" target="_blank" rel="noreferrer">Website</a> -->
					<a href="https://www.youtube.com/watch?v=cKd8NXWwvKI" target="_blank" rel="noreferrer">Website</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="C++">
						<svg><use xlink:href="assets/images/sprite.svg#cplusplus" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<!-- Webdesign -->
	<article id="webdesign">
		<div>
			<?php gallery("projects/webdesign", "ar=4:3&ff"); ?>
		</div>
		<div>
			<h1>Web design</h1>
			<h2>February 2009 - Lausanne, Switzerland</h2>

			<ul class="objectives">
				<li>Create websites and e-commerce platforms for small businesses</li>
				<li>Get some money while being a student</li>
			</ul>

			<div class="details">
				<div class="links">
					<a target="_blank" href="https://www.juliecampiche.com/" rel="noreferrer">juliecampiche.com</a>
					<a target="_blank" href="https://samiralaoui.ch" rel="noreferrer">samiralaoui.ch</a>
					<a target="_blank" href="http://www.marisolimage.ch" rel="noreferrer">marisolimage.ch</a>
					<a target="_blank" href="http://www.smagonline.ch" rel="noreferrer">smagonline.ch</a>
					<a target="_blank" href="http://www.swissdesignnetwork.org" rel="noreferrer">swissdesignnetwork.org</a>
					<a target="_blank" href="http://www.velo-migrateur.com" rel="noreferrer">velo-migrateur.com</a>
					<a target="_blank" href="http://www.hopiclowns.ch" rel="noreferrer">hopiclowns.ch</a>
					<a href data-slick-open data-index="12">espace-est-ouest.com</a>
					<a href data-slick-open data-index="13">freshprod.com</a>
					<a href data-slick-open data-index="14">fiduswiss.ch</a>
					<a href data-slick-open data-index="8">one-appointment.com</a>
					<a href data-slick-open data-index="7">micronarc.ch</a>
					<a href data-slick-open data-index="5">timetotime.com</a>
					<a target="_blank" href="http://www.ultra-son.ch/" rel="noreferrer">ultra-son.ch</a>
					<a target="_blank" href="http://www.fag.ch/" rel="noreferrer">fag-avenches.ch</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Php">
						<svg><use xlink:href="assets/images/sprite.svg#php" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Laravel">
						<svg><use xlink:href="assets/images/sprite.svg#laravel" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Ruby On Rails">
						<svg><use xlink:href="assets/images/sprite.svg#ruby" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Python">
						<svg><use xlink:href="assets/images/sprite.svg#python" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="RabbitMQ">
						<svg><use xlink:href="assets/images/sprite.svg#rabbitmq" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="MySql">
						<svg><use xlink:href="assets/images/sprite.svg#mysql" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="MongoDB">
						<svg><use xlink:href="assets/images/sprite.svg#mongodb" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Neo4j">
						<svg><use xlink:href="assets/images/sprite.svg#neo4j" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="JavaScript">
						<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Docker">
						<svg><use xlink:href="assets/images/sprite.svg#docker" /></svg>
					</div>
					<!-- <div class="icon" data-toggle="tooltip" title="Html"><svg><use xlink:href="assets/images/sprite.svg#html"/></svg></div> -->
					<!-- <div class="icon" data-toggle="tooltip" title="CSS"><svg><use xlink:href="assets/images/sprite.svg#css"/></svg></div> -->
				</div>
			</div>
		</div>
	</article>

	<!-- Redcms -->
	<article id="redcms">
		<div>
			<img class="img-fluid center-block" data-lazy-src="assets/images/projects/redcms-logo.jpg" />
		</div>
		<div>
			<h1>RedCMS</h1>
			<h2>February 2009 - Open source project</h2>

			<ul class="objectives">
				<li>Create a lightweight CMS designed with AJAX in mind</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://redcms.red-agent.com" target="_blank" rel="noreferrer">Website</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Php">
						<svg><use xlink:href="assets/images/sprite.svg#php" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="MySql">
						<svg><use xlink:href="assets/images/sprite.svg#mysql" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="JavaScript <em>(YUI 3)</em>">
						<svg><use xlink:href="assets/images/sprite.svg#javascript" /></svg>
					</div>
					<div class="icon" data-toggle="tooltip" title="Smarty">
						<svg><use xlink:href="assets/images/sprite.svg#smarty" /></svg>
					</div>
					<!-- <div class="icon" data-toggle="tooltip" title="Html"><svg><use xlink:href="assets/images/sprite.svg#html"/></svg></div> -->
					<!-- <div class="icon" data-toggle="tooltip" title="CSS"><svg><use xlink:href="assets/images/sprite.svg#css"/></svg></div> -->
				</div>
			</div>
		</div>
	</article>

	<!-- EyeKidz -->
	<article id="eyekidz">
		<div>
			<?php gallery("projects/eyekidz", "cf&ar=4:3"); ?>
		</div>

		<div>
			<h1>EyeKidz</h1>
			<h2>August 2008 - User interface designer at EverMore Innovation</h2>

			<ul class="objectives">
				<li>Design and implement the interface of EyeKidz, a browser for children</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="http://www.commentcamarche.net/download/telecharger-34055037-eye-kidz" target="_blank" rel="noreferrer">Download</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="ActionScript">
						<svg><use xlink:href="assets/images/sprite.svg#flash" /></svg>
					</div>
				</div>
			</div>
		</div>

	</article>

	<!-- Schlempf -->
	<article id="schlempf">
		<div>
			<!--<iframe src="http://www.slideshare.net/slideshow/embed_code/4800011?rel=0" width="420" height="350" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px 1px 0; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>-->
			<?php gallery("projects/schlempf"); ?>
		</div>

		<div>
			<h1>Schlempf</h1>
			<h2>January 2008 - Student game contest</h2>

			<ul class="objectives">
				<li>Create a mobile game mixing life simulation and adventure</li>
				<li>Participate to the Logiquest programming contest sponsored by Sun and Swisscom</li>
			</ul>

			<div class="details">
				<div class="links">
					<a href="https://red-agent.com/schlempf/" target="_blank" rel="noreferrer">Website</a>
				</div>
				<div class="techno">
					<div class="icon" data-toggle="tooltip" title="Java Mobile">
						<svg><use xlink:href="assets/images/sprite.svg#java" /></svg>
					</div>
				</div>
			</div>
		</div>
	</article>

	<?php footer('projects'); ?>

</main>
