<?php
require_once 'php/Tools.php';
?><div role="main" class="cf">

    <div style="height:.3em">.</div>

    <!-- Programming game -->
    <p class="redagent-cl " id="proggame"></p>
    <p class="redagent-spacer"></p>
    <p class="redagent-page-img">
        <span>
            <span class="slideshow" style="min-height: 229px;">
                <?php
                $dir = "images/projects/proggame";
                $files = listdir($dir);
                sort($files, SORT_LOCALE_STRING);

                foreach ($files as $entry) {
                    ?>
                    <a rel="shadowbox[proggame]" href="<?php echo $entry ?>">
                        <img src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>
                    </a>
                <?php } ?>
            </span>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">January 2014</p>
        <h1>Programming game</h1>
        <h2>UX Engineer at School for Business & Engineering Vaud (Heig-vd)</h2>

        <p class="redagent-content">
            Teach yourself Javascript programming with fun in this web game.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://wegas.albasim.ch/game.html?token=proggame&al=1" target="_blank">Demo</a>
                    | <a href="https://github.com/Heigvd/Wegas" target="_blank">Sources</a>
                    | <a rel="shadowbox[proggame]" href="images/projects/proggame/wegas-proggame-1.png">Screenshots</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>JavaEE <em>(Glassfish 3)</em>, Javascript<em>(YUI 3)</em>, Canvas <em>(Crafty)</em></td>
            </tr>
            <tr>
                <td class="colum-right">Grants</td>
                <td>Call for project E-Creation 8, HES-SO Cyberlearn</td>
            </tr>
        </table>
    </aside>


    <!-- Stalker -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="stalker"></p>

    <p class="redagent-page-img">
        <span>
            <span class="slideshow" style="min-height:280px;">
                <?php
                $dir = "images/projects/stalker";
                $files = listdir($dir);
                sort($files, SORT_LOCALE_STRING);

                foreach ($files as $entry) {
                    ?>
                    <a rel="shadowbox[stalker]" href="<?php echo $entry ?>">
                        <img src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>
                    </a>
                <?php } ?>
            </span>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">September 2013</p>
        <h1>Stalker - Experimenting the Zone</h1>
        <h2>Exhibit design at the museum Maison d'Ailleurs, coproduced by Heig-vd</h2>

        <p class="redagent-content">
            To experiment the secret room present in Tarkovski's movie, the visitor
            can draw it's wish on a tangible surface. The wish is then projected 
            among other's on a cloud of wires.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://www.ailleurs.ch/en/expositions/archives/exposition-stalker-experimenter-la-zone/#" target="_blank">Website</a>
                    | 
                    <a rel="shadowbox[stalker]" href="images/projects/stalker/IMG_4522RE.jpg">Pictures</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>Javascript, Websocket, WebGL</td>
            </tr>
        </table>
    </aside>

    <!-- Wegas -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="wegas"></p>

    <p class="redagent-page-img">
        <span>
            <span class="slideshow" style="min-height: 229px;">
                <?php
                $dir = "images/projects/wegas";
                $files = listdir($dir);
                sort($files, SORT_LOCALE_STRING);

                foreach ($files as $entry) {
                    ?>
                    <a rel="shadowbox[wegas]" href="<?php echo $entry ?>">
                        <img src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>
                    </a>
                <?php } ?>
            </span>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">July 2011 - present</p>
        <h1>Wegas</h1>
        <h2>UX Engineer at School for Business & Engineering Vaud (HEIG-Vd)</h2>

        <p class="redagent-content">
            A Web Game Authoring System for rapid development of serious games without programming skills.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://wegas.albasim.ch" target="_blank">Demo</a>
                    | <a href="https://github.com/Heigvd/Wegas" target="_blank">Sources</a>
                    | <a rel="shadowbox[wegas]" href="images/projects/wegas/wegas-14.05.22-1-Login.jpg">Screenshots</a>
                </td>
            </tr>
            <tr>
                <td class="colum-right">Technologies</td>
                <td>JavaEE <em>(Glassfish 3)</em>, Javascript<em>(YUI 3)</em></td>
            </tr>
            <tr>
                <td class="colum-right">Grants</td>
                <td>RCSO, Western Switzerland School for Applied Science</td>
            </tr>
        </table>
    </aside>

    <!-- Wallogram -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="wallogram"></p>

    <p class="redagent-page-img">
        <span>
            <span class="slideshow">
                <?php
                $dir = "images/projects/wallogram";
                $files = listdir($dir);
                sort($files, SORT_LOCALE_STRING);

                foreach ($files as $entry) {
                    ?>
                    <a rel="shadowbox[Blogo]" href="<?php echo $entry ?>">
                        <img src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>
                    </a>
                <?php } ?>
                <a rel="shadowbox[Blogo];width=720;height=404;player=flv;" href="wallogram/assets/screenshots/Wallogram-Montage.mp4">
                    <img src="images/projects/wallogram/mini/Wallogram-Montage.png"/>
                </a>
            </span>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">January 2011</p>
        <h1>Wallogram</h1>
        <h2>Interactive video mapping performance</h2>

        <p class="redagent-content">
            Wallogram turns our environment in a video game playground. To do so the game is projected on walls 
            and facades and several players use their mobile phone as a game controller.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://www.red-agent.com/wallogram/" target="_blank">Demo</a> | 
                    <a href="https://github.com/fxaeberhard/Wallogram" target="_blank">Sources</a> | 
                    <a rel="shadowbox[Blogo]" href="images/projects/wallogram/20140321_124232.jpg">Screenshots</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>Javascript, Websocket</td>
            </tr>
        </table>
    </aside>

    <!-- MJ -->
    <p class="redagent-cl "></p>
    <p class="redagent-spacer" id="mjte"></p>
    <p class="redagent-page-img">
        <iframe title="YouTube video player" width="420" height="266" src="http://www.youtube.com/embed/EKI3U_uFv7Y?rel=0&controls=1&autohide=1&color2=580000&showinfo=0&modestbranding=1&rel=0" frameborder="0" allowfullscreen="1"></iframe>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2010</p>
        <h1>Michael Jackson: The Exerience - Wii</h1>
        <h2>User Interface Programmer at Ubisoft</h2>

        <p class="redagent-content">
            Design and implementation of the in-game User Interface on Nintendo Wii.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://theexperience-thegame.ubi.com/michael-jackson/en-US/home/index.aspx" target="_blank">Official website</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>C++ <em>(Nintendo Revolution SDK)</em>, Actionscript 2.0 <em>(in-game interfaces)</em></td>
            </tr>
        </table>
    </aside>
    <p class="redagent-cl "></p>
    <p class="redagent-spacer"></p>

    <!--  MJTE Web game-->
    <p class="redagent-page-img">
        <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">
            <!--<img class="redagent-image" data-src="images/projects/mjte_minigame_420.jpg" />-->
            <img src="images/projects/mjte_minigame_420.jpg" />
        </a>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2010</p>
        <h1>
            <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">Michael Jackson: The Exerience - Web</a>
        </h1>
        <h2>User Interface Programmer at Ubisoft</h2>
        <p class="redagent-content">
            Design and implementation of a promotional application on Facebook: 
            a rhythm game where you use the keyboard to mimic Michael.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">Play online</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>Actionscript 3.0</td>
            </tr>
        </table>
    </aside>
    <p class="redagent-cl"></p>
    <p class="redagent-spacer"></p>

    <!-- Just Dance 2 -->
    <p class="redagent-page-img">
        <!--<iframe width="420" height="266" src="//www.youtube.com/embed/S6FgI2CR9I4" frameborder="0" allowfullscreen></iframe>-->
        <iframe title="YouTube video player" width="420" height="266" src="http://www.youtube.com/embed/S6FgI2CR9I4?rel=0&controls=1&autohide=1&color2=580000&showinfo=0&modestbranding=1&rel=0" frameborder="0" allowfullscreen></iframe>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">February 2010</p>
        <h1>Just Dance 2 - Wii</h1>
        <h2>Gameplay Programmer at Ubisoft</h2>

        <p class="redagent-content">
            Design and prototype the connection between the game consoles (PS3
            and Wii) and Social Networks (Facebook & iPhone applications).
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://just-dance-thegame.ubi.com/jd-portal/en-gb/just-dance-games/just-dance-2/index.aspx" target="_blank">Official website</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>C++ <em>(Nintendo SDK & PS3 SDK)</em>, Actionscript 2.0 <em>(in-game interfaces)</em>, Python, PHP <em>(web-server for Facebook Application)</em>, Objective C <em>(iPhone application)</em></td>
            </tr>
        </table>
    </aside>
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="3dblogosphere"></p>

    <!--  3D  Blogosphere-->
    <p class="redagent-page-img">
        <span>
            <span class="slideshow">
                <?php
                $dir = "images/projects/3DBlogosphere";
                $files = listdir($dir);
                sort($files, SORT_LOCALE_STRING);

                foreach ($files as $entry) {
                    ?>
                    <a rel="shadowbox[Blogo]" href="<?php echo $entry ?>">
                        <!--<img class="redagent-image" data-src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>-->
                        <img src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>
                    </a>
                <?php } ?>
            </span>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2009</p>
        <h1>3DBlogosphere</h1>
        <h2>Knowledge Management Engineer at Siemens Cororate Research</h2>
        <p class="redagent-content">
            Design and prototype of an application focused on the use of Virtual Worlds to enhance collaboration in a company.
        </p>
        <table>
            <tr>
                <td class="colum-right">Publication</td>
                <td style="font-style: normal">
                    Aeberhard Francois-Xavier, Steve Russell, PhD,
                    <a href="http://www.iaeng.org/publication/WCECS2009/WCECS2009_pp764-767.pdf" target="_blank" >“3DBlogosphere: A Multisynchronous Approach of Virtual Worlds to Sustain Company Wide Communication”</a>,<em>International Conference on Internet and Multimedia Technologies 2009 ( ICIMT ), ACM,London UK</em>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>J2SE <em>(JMonkey)</em>, J2EE <em>(Project Wonderland, Darkstar & Glassfish)</em>, XSLT, Javascript</td>
            </tr>
        </table>
    </aside>


    <!--  DTouch -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="dtouch"></p>
    <p class="redagent-page-img" >
        <!--<img class="redagent-image" data-src="images/projects/dtouch_420.jpg" />-->
        <img src="images/projects/dtouch_420.jpg" />
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">February 2009</p>
        <h1>Audio D-Touch</h1>
        <h2>Semester project at Design and Media Laboratory (LDM, EPFL)</h2>
        <p class="redagent-content">
            Design, prototype and user study on a tangible user interface 
            (TUI) for audio sequencing, D-Touch.
        </p>
        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://www.d-touch.org/audio/" target="_blank" href="dtouch">Project homepage</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>C++</td>
            </tr>
        </table>
    </aside>


    <!-- Redcms -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="redcms"></p>
    <p class="redagent-page-img" >
        <span>
            <span class="slideshow">
                <a href="http://redcms.red-agent.com" target="_blank">
                    <!--<img class="redagent-image" data-src="images/projects/redcms-logo.jpg" />-->
                    <img src="images/projects/redcms-logo.jpg" />
                </a>
                <?php
                $dir = "images/projects/webdesign";
                $files = listdir($dir);
                sort($files, SORT_LOCALE_STRING);

                foreach ($files as $entry) {
                    ?>
                    <a rel="shadowbox[Webdesign]" href="<?php echo $entry ?>">
                        <img src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>
                        <!--<img class="redagent-image" data-src="<?php echo str_replace($dir, $dir . "/mini", $entry) ?>"/>-->
                    </a>
                <?php } ?>
            </span>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">January 2005 - August 2009</p>
        <h1><a href="http://redcms.red-agent.com" target="_blank">RedCMS</a></h1>
        <h2>Freelance web designer</h2>

        <p class="redagent-content">
            RedCMS is a lightweight CMS designed with AJAX in mind. I used it to create websites 
            and e-commerce platforms for small businesses during my studies.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://redcms.red-agent.com" target="_blank" >Website</a> |
                    <a href="https://github.com/fxaeberhard/RedCMS" target="_blank">Sources</a> | 
                    <a rel="shadowbox[Webdesign]" href="images/projects/webdesign/Prodoli-04.jpg">Screenshots</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>Javascript <em>(YUI 3)</em>, PHP 5, Smarty, HTML, CSS</td>
            </tr>
            <tr>
                <td class="colum-right">Sites created</td>
                <td class="colum-right">
                    <a target="_blank" href="http://www.swissdesignnetwork.org">swissdesignnetwork.org</a>,
                    <a target="_blank" href="http://www.hopiclowns.ch">hopiclowns.ch</a>,
                    <a target="_blank" href="http://www.marisolimage.ch">marisolimage.ch</a>,
                    <a target="_blank" href="http://www.smagonline.ch">smagonline.ch</a>,
                    <a target="_blank" href="http://www.one-appointment.com">one-appointment.com</a>,
                    <a target="_blank" href="http://www.velo-migrateur.com">velo-migrateur.com</a>,
                    <a rel="shadowbox" href="images/projects/webdesign/wEspaceEstOuest--01.jpg">espace-est-ouest.com</a>,
                    <a rel="shadowbox" href="images/projects/webdesign/web-fresh.jpg">freshprod.com</a>,
                    <a rel="shadowbox" href="images/projects/webdesign/fiduswiss.png">fiduswiss.ch</a>,
                    <a href="#">ultra-son.ch</a>,
                    <a rel="shadowbox" href="images/projects/webdesign/micronarc.png">micronarc.ch</a>,
                    <a href="#">fag-avenches.ch</a>,
                    <a rel="shadowbox" href="images/projects/webdesign/Timetotime-v2-02.jpg" >timetotime.com</a>
            </tr>
        </table>
    </aside>

    <!-- Schlempf -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="schlempf"></p>
    <p class="redagent-page-img">
        <iframe src="http://www.slideshare.net/slideshow/embed_code/4800011?rel=0" width="420" height="350" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px 1px 0; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe> 
    </p>

    <aside class="redagent-page-text">
        <p class="redagent-date">June 2004</p>

        <h1>Schlempf</h1>
        <h2>Student game contest</h2>

        <p class="redagent-content">
            Participation Logiquest programming contest sponsored by Sun MicroSystem
            and Swisscom.Creation of a mobile game, Schlempf, a mix between a tamagochi
            and an adventure games.
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://www.red-agent.com/schlempf/" target="_blank">Website</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>Java 2 Mobile Edition <em>(J2ME)</em></td>
            </tr>
        </table>

    </aside>

    <!-- YUIMyAdmin -->
    <p class="redagent-cl"></p>
    <p class="redagent-spacer" id="yuimyadmin"></p>

    <p class="redagent-page-img">

        <a href="http://yuimyadmin.sourceforge.net/" target="_blank">
            <!--<img class="redagent-image" data-src="images/projects/yuimyadmin.png" />-->
            <img src="images/projects/yuimyadmin.png" />
        </a>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">March 2003</p>
        <h1><a href="http://yuimyadmin.sourceforge.net/" target="_blank">YuiMyAdmin</a></h1>
        <h2>Open source project</h2>

        <p class="redagent-content">
            YUIMyAdmin is an web-based front-end to manage databases using the 
            Yahoo! User Interface (YUI) javascript library. Written in php and using the ADOdb abstraction
            layer for the database. It is licensed under GNU General Public License V3.0
        </p>

        <table>
            <tr>
                <td  class="colum-right">Links</td>
                <td style="font-style: normal">
                    <a href="http://yuimyadmin.sourceforge.net/yuimyadmin/" target="_blank">Demo</a> |
                    <a href="http://yuimyadmin.sourceforge.net/" target="_blank">Website</a> |
                    <a href="https://sourceforge.net/projects/yuimyadmin/files/" target="_blank">Sources</a>
                </td>
            </tr>
            <tr>
                <td  class="colum-right">Technologies</td>
                <td>Javascript <em>(YUI 2)</em>, PHP, HTML, CSS</td>
            </tr>
        </table>
    </aside>


    <!--
        SDN
       <p class="redagent-page-img">
           <a href="http://www.swissdesignnetwork.org/" target="_blank">
               <img src="images/projects/sdn_420.jpg" />
           </a>
       </p>
       <aside class="redagent-page-text">
           <h1>
               <a href="http://www.swissdesignnetwork.org/" target="_blank">swissdesignnetwork.org</a>
           </h1>
           <span class="redagent-links">
               <a href="http://www.swissdesignnetwork.org/" target="_blank">website</a>
           </span>
           <span class="redagent-content">
               Website of the association of the swiss art schools.
           </span>
           <span class="redagent-footer">
               RedCMS, Javascript (YUI3 Framework), PHP, HTML, CSS
           </span>
       </aside>
       <p class="redagent-cl redagent-spacer"></p>-->
    <!--
    
      <div>
                        <div class="redagent-left">
                        <div class="redagent-right">   </div>
                    </div>
    
                    <div class>
                        <div class="redagent-left">
                            <a href="http://www.swissdesignnetwork.org/" target="_blank">
                                <img src="images/projects/sdn_420.jpg" />
                            </a>
                        </div>
                        <div class="redagent-right">
                            <h1>
                                <a href="http://www.swissdesignnetwork.org/" target="_blank">swissdesignnetwork.org</a>
                            </h1>
                            <div class="redagent-links">
                                <a href="http://www.swissdesignnetwork.org/" target="_blank">website</a>
                            </div>
                            <div class="redagent-content">
                                Website of the association of the swiss art schools.
                            </div>
                            <div class="redagent-footer">
                                RedCMS, Javascript (YUI3 Framework), PHP, HTML, CSS
                            </div>
                        </div>
                    </div>
    
                    <div>
                        <div class="redagent-left">
                            <a href="http://www.smagonline.ch/" target="_blank"><img src="images/projects/smag_420.jpg" /></a>
                        </div>
                        <div class="redagent-right">
                            <h1>
                                <a href="http://www.smagonline.ch/" target="_blank">smagonline.ch</a>
                            </h1>
                            <div class="redagent-links">
                                <a href="http://www.smagonline.ch/" target="_blank">website</a>
                            </div>
                            <div class="redagent-content">
                                Website for the Antesthesist's association of Geneva</div>
                            <div class="redagent-footer">
                                RedCMS, Javascript (YUI3 Framework), PHP, HTML, CSS
                            </div>
                        </div>
                    </div>
    
    
    
                    <div><div class="redagent-left"><div><a href="http://www.marisolimage.ch" target="_blank"><img src="images/projects/marisolimage_420.jpg" /></a></div></div><div class="redagent-right"><h1><a href="http://www.marisolimage.ch" target="_blank">MarisolImage.ch</a></h1><h2></h2><div class="redagent-links"><a href="http://www.marisolimage.ch" target="_blank">website</a><br /></div><div class="redagent-content">Website for a private Image consulting agency.</div><div class="redagent-footer">Javascript (YUI 3 Framework), PHP, Smarty, HTML, CSS</div></div></div>
    
                    <div><div class="redagent-left"><div><a href="http://www.hopiclowns.ch/" target="_blank"><img src="images/projects/hopiclowns_420.jpg" /></a></div></div><div class="redagent-right"><h1><a href="http://www.hopiclowns.ch/" target="_blank">Hopiclowns.ch</a></h1><div class="redagent-links"><a href="http://www.hopiclowns.ch/" target="_blank">website</a><br /></div><div class="redagent-content"></div><div class="redagent-footer">RedCMS, Javascript (YUI3 Framework), PHP, HTML, CSS</div></div></div>
    
    
    
                    <div><div class="redagent-left"><div style="text-align:center"><a href="http://www.velo-migrateur.com/" target="_blank"><img src="images/projects/velomigrateur_420.jpg" /></a></div></div><div class="redagent-right"><h1><a href="http://www.velo-migrateur.com/" target="_blank">Velo-Migrateur.com</a></h1><div class="redagent-links"><a href="http://www.velo-migrateur.com/" target="_blank">website</a><br /></div><div class="redagent-content"></div><div class="redagent-footer">RedCMS, Javascript (YUI3 Framework), PHP, HTML, CSS</div></div></div>
    
                    <div><div class="redagent-left"><div style="text-align:center"><a href="http://www.one-appointment.com/" target="_blank"><img src="images/projects/oneapointment_420.jpg" /></a></div></div><div class="redagent-right"><h1><a href="http://www.one-appointment.com/" target="_blank">one-appointment.com</a></h1><div class="redagent-links"><a href="http://www.one-appointment.com/" target="_blank">website</a><br /></div><div class="redagent-content"></div><div class="redagent-footer">Javascript (YUI3 Framework), PHP, HTML, CSS</div></div></div>
    
                    <div><div class="redagent-left"><div style="text-align:center"><a href="http://www.freshprod.com/" target="_blank"><img src="images/projects/web-fresh.jpg" /></a></div></div><div class="redagent-right"><h1><a href="http://www.freshprod.com/" target="_blank">FreshProd.com</a></h1><div class="redagent-links"><a href="http://www.freshprod.com/" target="_blank">website</a><br /></div><div class="redagent-content">Fresh Prod is a Filmmakers Collective.</div><div class="redagent-footer">Javascript (YUI3 Framework), PHP, HTML, CSS</div></div></div>
    -->

</div>
<footer class="cf" style="max-width:100%; margin: 5em 0 1em;">
    François-Xavier Aeberhard homepage
    <div style="float:right">
        ©2013 
        <a class="redagent-nav-projects" href="projects.html">Projects</a>
        | <a class="redagent-nav-contact" href="contact.html">Contact</a>
        | Created with <a target="_blank" href="http://redcms.red-agent.com">RedCMS</a>
    </div>
</footer>