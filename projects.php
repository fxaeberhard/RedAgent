<?php require_once 'php/Tools.php'; ?>

<!-- Navbar -->
<header>
  <nav>
    <a href="/" class="nav-link close">
      <svg><use xlink:href="images/sprite.svg#back" /></svg>
    </a>
    <div class="collapse navbar-toggleable" id="navbar-header">
      <ul>
        <li><a href="#wallogram" class="active nav-link">2015</a></li>
        <li><a href="#proggame" class="nav-link">2014</a></li>
        <li><a href="#stalker" class="nav-link">2013</a></li>
        <li><a href="#wegas" class="nav-link">2011</a></li>
        <li><a href="#mjte" class="nav-link">2010</a></li>
        <li><a href="#3dblogosphere" class="nav-link">2009</a></li>
        <li><a href="#redcms" class="nav-link">2006</a></li>
        <li><a href="#schlempf" class="nav-link">2005</a></li>
      </ul>
    </div>
    <form class="form-inline pull-xs-right hidden-md-down">
      <svg><use xlink:href="images/sprite.svg#search" /></svg>
      <input class="form-control" type="text" placeholder="Search" />
    </form>
    <!-- <button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">&#9776;</button> -->
  </nav>
</header>

<main>

  <!-- Wallogram -->
  <article id="wallogram">
    <div>
      <a href="https://www.youtube.com/watch?v=W1kdVlAAzcQ" class="embed-responsive embed-responsive-16by9" data-youtube-id="W1kdVlAAzcQ">
        <!-- <picture> -->
        <!-- <source srcset="imgpp/projects/wallogram/teaser.jpg?w=522" media="(max-width:543px)" /> -->
        <!-- <source srcset="imgpp/projects/wallogram/teaser.jpg?w=480, imgpp/projects/wallogram/teaser.jpg?w=950 x2" media="(min-width:544px) AND (max-width:894px)" /> -->
        <img class="img-fluid" src="i/projects/wallogram/teaser.jpg?w=526" srcset="i/projects/wallogram/teaser.jpg?w=526, i/projects/wallogram/teaser.jpg?w=789 1.5x, i/projects/wallogram/teaser.jpg?w=1052 2x" alt="Wallogram" />
        <!-- <img src="images/projects/wallogram/teaser.jpg" /> -->
        <!-- </picture> -->
        <svg><use xlink:href="images/sprite.svg#youtube" /></svg>
      </a>
    </div>
    <div>
      <h1>Wallogram</h1>
      <h2>January 2015 - Interactive video mapping</h2>
      <ul class="objectives">
        <li>Turn a wall into a game playground</li>
        <li>Let player use his mobile phone as a gamepad</li>
        <li>Present the project during <em>Portrait Robot</em> exhibit at Maison d'ailleurs</li>
      </ul>
      <div class="details">
        <div class="links">
          <a href="http://www.wallogram.ch/" target="_blank">Website</a>
          <?php hiddenGallery('projects/wallogram'); ?>
          <a href data-slick-open>Pictures</a>
          <a href="https://github.com/fxaeberhard/Wallogram" target="_blank">Sources</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Node.js">
            <svg><use xlink:href="images/sprite.svg#nodejs" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="MongoDB">
            <svg><use xlink:href="images/sprite.svg#mongodb" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Javascript">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Websocket">
            <svg><use xlink:href="images/sprite.svg#websocket" /></svg>
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
      <h2>March 2014 - UX Engineer at School for Business & Engineering Vaud (Heig-vd)</h2>

      <ul class="objectives">
        <li>Teach javascript with fun</li>
        <li>Get funded by the E-Creation grant from HES-SO Cyberlearn unit</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://wegas.red-agent.com/game.html?token=proggame&al=1" target="_blank">Play online</a>
          <a href data-slick-open>Screenshots</a>
          <a href="https://github.com/Heigvd/Wegas" target="_blank">Sources</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Java EE (Glassfish)">
            <svg><use xlink:href="images/sprite.svg#java" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Javascript (YUI 3)">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Canvas (Crafty)">
            <svg><use xlink:href="images/sprite.svg#html" /></svg>
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
      <h2>September 2013 - Exhibit design at Maison d'Ailleurs museum, coproduced by Heig-vd</h2>

      <ul class="objectives">
        <li>Make the visitor experiment the secret room present in Tarkovski's movie</li>
        <li>Let the visitor draw his wish on a tangible surface and project it among other's on a cloud of wires</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://www.ailleurs.ch/en/expositions/archives/exposition-stalker-experimenter-la-zone/#" target="_blank">Website</a>
          <a href data-slick-open>Pictures</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Javascript">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Websocket">
            <svg><use xlink:href="images/sprite.svg#websocket" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="WebGL">
            <svg><use xlink:href="images/sprite.svg#webgl" /></svg>
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
      <h2>January 2012 - UX Engineer at School for Business & Engineering Vaud (HEIG-Vd)</h2>

      <ul class="objectives">
        <li>Create a Web Game Authoring System for rapid development of serious games</li>
        <li>Allow teachers to create games without programming skills</li>
        <li>Get funding from RCSO, Western Switzerland School for Applied Science</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://wegas.red-agent.com" target="_blank">Try online</a>
          <a href data-slick-open>Screenshots</a>
          <a href="https://github.com/Heigvd/Wegas" target="_blank">Sources</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="JavaEE <em>(Glassfish 3)</em>">
            <svg><use xlink:href="images/sprite.svg#java" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="PostgreSQL">
            <svg><use xlink:href="images/sprite.svg#postgres" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="JavaScript <em>(YUI 3)</em>">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
        </div>
      </div>
    </div>
  </article>

  <!-- MJ -->
  <article id="mjte">
    <div>
      <a href="https://www.youtube.com/watch?v=EKI3U_uFv7Y" data-youtube-id="EKI3U_uFv7Y">
        <?php lazypicture('projects/mjte.jpg') ?>
        <!-- <img class="img-fluid" data-lazy-srcset="i/?w=526, i/?w=789 1.5x, i/?w=1052 2x" data-lazy-src="i/projects/mjte_720.jpg" /> -->
        <svg><use xlink:href="images/sprite.svg#youtube" /></svg>
      </a>
    </div>
    <div>
      <h1>Michael Jackson: The Experience - Wii</h1>
      <h2>August 2010 - User Interface Programmer at Ubisoft</h2>

      <ul class="objectives">
        <li>Design and implement the in-game user interface on Nintendo Wii</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://www.nintendo.com/games/detail/smpbynnlvHGr3gN6PTn9kNc2htjE6apS" target="_blank">Official website</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="C++ <em>(Nintendo Revolution SDK)</em>">
            <svg><use xlink:href="images/sprite.svg#cplusplus" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Actionscript 2.0 <em>(in-game interfaces)</em>">
            <svg><use xlink:href="images/sprite.svg#flash" /></svg>
          </div>
        </div>
      </div>
    </div>
  </article>

  <!--  MJTE Web game-->
  <article id="mjteweb">
    <div>
      <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">
        <?php lazypicture('projects/mjte_minigame.jpg') ?>
        <!-- <img class="img-fluid" data-lazy-src="images/projects/mjte_minigame_720.jpg" /> -->
        <!-- <div class="play-button"></div> -->
      </a>
    </div>
    <div>
      <h1>Michael Jackson: The Exerience - Web</h1>
      <h2>August 2010 - User Interface Programmer at Ubisoft</h2>

      <ul class="objectives">
        <li>Create a rhythm game where player uses keyboard to mimic Michael</li>
        <li>Implement in a Facebook app</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">Play online</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Actionscript 3.0">
            <svg><use xlink:href="images/sprite.svg#flash" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Facebook SDK">
            <svg><use xlink:href="images/sprite.svg#facebook2" /></svg>
          </div>
        </div>
      </div>
    </div>
  </article>

  <!-- Just Dance 2 -->
  <article id="jd2">
    <div>
      <a href="https://www.youtube.com/watch?v=S6FgI2CR9I4" data-youtube-id="S6FgI2CR9I4">
        <?php lazypicture('projects/justdance2.jpg') ?>
        <!-- <img class="img-fluid" data-lazy-src="//i.ytimg.com/vi/S6FgI2CR9I4/maxresdefault.jpg" /> -->
        <svg><use xlink:href="images/sprite.svg#youtube" /></svg>
      </a>
    </div>
    <div>
      <h1>Just Dance 2 - Wii</h1>
      <h2>February 2010 - Gameplay Programmer at Ubisoft</h2>

      <ul class="objectives">
        <li>Design and implement the connection between the game (PS3 and Wii) and Social Networks (Facebook & iPhone applications)</li>
        <!-- <li>Call for project E-Creation 8, HES-SO Cyberlearn Grant</li> -->
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://just-dance-thegame.ubi.com/jd-portal/en-gb/just-dance-games/just-dance-2/index.aspx" target="_blank">Official website</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="C++ <em>(Nintendo SDK & PS3 SDK)</em>">
            <svg><use xlink:href="images/sprite.svg#cplusplus" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Objective C <em>(iPhone application)</em>">
            <svg><use xlink:href="images/sprite.svg#csharp" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Actionscript 2.0 <em>(in-game interfaces)</em>">
            <svg><use xlink:href="images/sprite.svg#flash" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Python">
            <svg><use xlink:href="images/sprite.svg#python" /></svg>
          </div>
          <!-- <div class="icon" data-toggle="tooltip" title="PHP <em>(web-server for Facebook Application)</em>"><svg><use xlink:href="images/sprite.svg#php"/></svg></div> -->
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
      <h2>August 2009 - Knowledge Management Engineer at Siemens Corporate Research</h2>

      <ul class="objectives">
        <li>Use virtual worlds to enhance collaboration in a company</li>
        <li>Publish the result in a recognized conference</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://www.iaeng.org/publication/WCECS2009/WCECS2009_pp764-767.pdf" target="_blank">“3DBlogosphere: A Multisynchronous Approach of Virtual Worlds to Sustain Company Wide Communication”</a>Aeberhard Francois-Xavier, Steve Russell, ICIMT 2009, ACM
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Java <em>(J2EE, J2SE, Project Wonderland, JMonkey & Glassfish)</em>">
            <svg><use xlink:href="images/sprite.svg#java" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="XSLT">
            <svg><use xlink:href="images/sprite.svg#xml" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="JavaScript">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
        </div>
      </div>
    </div>
  </article>

  <!--  DTouch -->
  <article id="dtouch">
    <div>
      <a href="https://www.youtube.com/watch?v=tPcI2RbFaSM" data-youtube-id="tPcI2RbFaSM">
        <?php lazypicture('projects/dtouch.jpg') ?>
        <!-- <img class="img-fluid"  src="//i.ytimg.com/vi/tPcI2RbFaSM/mqdefault.jpg" /> -->
        <!-- <img class="img-fluid" data-lazy-src="images/projects/dtouch_720.jpg" /> -->
        <svg><use xlink:href="images/sprite.svg#youtube" /></svg>
      </a>
    </div>
    <div>
      <h1>Audio D-Touch</h1>
      <h2>February 2009 - Semester project at Design and Media Laboratory (LDM, EPFL)</h2>

      <ul class="objectives">
        <li>Design and implement a tangible user interface (TUI) for audio sequencing</li>
        <li>Conduct a user study to validate this work</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://www.d-touch.org/audio/" target="_blank">Website</a>

        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="C++">
            <svg><use xlink:href="images/sprite.svg#cplusplus" /></svg>
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
      <h1>Independant web design</h1>
      <h2>January 2006 - August 2009</h2>

      <ul class="objectives">
        <li>Create websites and e-commerce platforms for small businesses</li>
        <li>Get some money while being a student</li>
      </ul>

      <div class="details">
        <div class="links">
          <a target="_blank" href="http://www.swissdesignnetwork.org">swissdesignnetwork.org</a>
          <a target="_blank" href="http://www.marisolimage.ch">marisolimage.ch</a>
          <a target="_blank" href="http://www.smagonline.ch">smagonline.ch</a>
          <a target="_blank" href="http://www.one-appointment.com">one-appointment.com</a>
          <a target="_blank" href="http://www.velo-migrateur.com">velo-migrateur.com</a>
          <a target="_blank" href="http://www.hopiclowns.ch">hopiclowns.ch</a>
          <a href data-slick-open data-index="10">espace-est-ouest.com</a>
          <a href data-slick-open data-index="9">freshprod.com</a>
          <a href data-slick-open data-index="11">fiduswiss.ch</a>
          <a href data-slick-open data-index="2">micronarc.ch</a>
          <a href data-slick-open data-index="8">timetotime.com</a>
          <a href="http://www.ultra-son.ch/">ultra-son.ch</a>
          <a href="http://www.fag.ch/">fag-avenches.ch</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Php">
            <svg><use xlink:href="images/sprite.svg#php" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="MySql">
            <svg><use xlink:href="images/sprite.svg#mysql" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="JavaScript <em>(YUI 3)</em>">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Smarty">
            <svg><use xlink:href="images/sprite.svg#smarty" /></svg>
          </div>
          <!-- <div class="icon" data-toggle="tooltip" title="Html"><svg><use xlink:href="images/sprite.svg#html"/></svg></div> -->
          <!-- <div class="icon" data-toggle="tooltip" title="CSS"><svg><use xlink:href="images/sprite.svg#css"/></svg></div> -->
        </div>
      </div>
    </div>
  </article>

  <!-- Redcms -->
  <article id="redcms">
    <div>
      <img class="img-fluid center-block" data-lazy-src="images/projects/redcms-logo-whitish.jpg" />
    </div>
    <div>
      <h1>RedCMS</h1>
      <h2>January 2006 - August 2009 - Open source project</h2>

      <ul class="objectives">
        <li>Create a lightweight CMS designed with AJAX in mind</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://redcms.red-agent.com" target="_blank">Website</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Php">
            <svg><use xlink:href="images/sprite.svg#php" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="MySql">
            <svg><use xlink:href="images/sprite.svg#mysql" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="JavaScript <em>(YUI 3)</em>">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Smarty">
            <svg><use xlink:href="images/sprite.svg#smarty" /></svg>
          </div>
          <!-- <div class="icon" data-toggle="tooltip" title="Html"><svg><use xlink:href="images/sprite.svg#html"/></svg></div> -->
          <!-- <div class="icon" data-toggle="tooltip" title="CSS"><svg><use xlink:href="images/sprite.svg#css"/></svg></div> -->
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
      <h2>June 2005 - Student game contest</h2>

      <ul class="objectives">
        <li>Create a mobile game mixing life simulation and adventure</li>
        <li>Participate to the Logiquest programming contest sponsored by Sun and Swisscom</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://red-agent.com/schlempf/" target="_blank">Website</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Java 2 Mobile Edition <em>(J2ME)</em>">
            <svg><use xlink:href="images/sprite.svg#java" /></svg>
          </div>
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
      <h2>March 2005 - User interface designer at EverMore Innovation</h2>

      <ul class="objectives">
        <li>Design and implement the interface of EyeKidz, a browser for children</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://www.commentcamarche.net/download/telecharger-34055037-eye-kidz" target="_blank">Download</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="ActionScript">
            <svg><use xlink:href="images/sprite.svg#flash" /></svg>
          </div>
        </div>
      </div>
    </div>
  </article>

  <!-- YUIMyAdmin -->
  <article id="yuimyadmin">
    <div>
      <img class="img-fluid center-block" data-lazy-src="images/projects/yuimyadmin.png" />
    </div>
    <div>
      <h1>YuiMyAdmin</h1>
      <h2>March 2003 - Open source project</h2>

      <ul class="objectives">
        <li>Create a web-based app to manage databases using Yahoo! User Interface (YUI) library</li>
      </ul>

      <div class="details">
        <div class="links">
          <a href="http://yuimyadmin.sourceforge.net/yuimyadmin/" target="_blank">Try online</a> <i class="spacer"></i>
          <a href="http://yuimyadmin.sourceforge.net/" target="_blank">Website</a> <i class="spacer"></i>
          <a href="https://sourceforge.net/projects/yuimyadmin/files/" target="_blank">Sources</a>
        </div>
        <div class="techno">
          <div class="icon" data-toggle="tooltip" title="Php">
            <svg><use xlink:href="images/sprite.svg#php" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="MySql">
            <svg><use xlink:href="images/sprite.svg#mysql" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="JavaScript <em>(YUI 2)</em>">
            <svg><use xlink:href="images/sprite.svg#javascript" /></svg>
          </div>
          <div class="icon" data-toggle="tooltip" title="Html">
            <svg><use xlink:href="images/sprite.svg#html" /></svg>
          </div>
          <!-- <div class="icon" data-toggle="tooltip" title="CSS"><svg><use xlink:href="images/sprite.svg#css"/></svg></div> -->
        </div>
      </div>
    </div>
  </article>

  <?php footer('projects'); ?>

</main>
