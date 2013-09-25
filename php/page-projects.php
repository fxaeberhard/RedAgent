<?php
require_once 'Tools.php';
?><div role="main" class="cf">

    <!-- MJ -->
    <p class="redagent-page-img">
        <iframe title="YouTube video player" width="420" height="266" src="http://www.youtube.com/embed/EKI3U_uFv7Y?rel=0&controls=0&autohide=1&color2=580000" frameborder="0" allowfullscreen="1"></iframe>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2011</p>
        <h1>Michael Jackson: The Exerience /Wii</h1>
        <h2>User Interface Programmer @Ubisoft</h2>
        <p class="redagent-links">
            <a href="http://theexperience-thegame.ubi.com/michael-jackson/en-US/home/index.aspx" target="_blank">website</a>
        </p>
        <p class="redagent-content">
            Design and implementation of the in-game User Interfaceon Nintendo Wii.
        </p>
        <p class="redagent-footer">
            C++ (Nintendo Revolution SDK), Actionscript 2.0 (in-game interfaces)
        </p>
    </aside>
    <p class="redagent-cl redagent-spacer"></p>


    <!--  -->
    <!--  <p class="redagent-page-img">

    </p>
    <aside class="redagent-page-text">

    </aside>
    <p class="redagent-cl redagent-spacer"></p>-->

    <!--  MJTE Minigame-->
    <p class="redagent-page-img">
        <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">
            <!--<img class="redagent-image" data-src="images/projects/mjte_minigame_420.jpg" />-->
            <img src="images/projects/mjte_minigame_420.jpg" />
        </a>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2011</p>
        <h1>
            <a href="http://apps.facebook.com/mjte_minigame/" target="_blank">Michael Jackson: The Exerience /WebGame</a>
        </h1>
        <h2>User Interface Programmer @Ubisoft</h2>
        <p class="redagent-links"><a href="http://apps.facebook.com/mjte_minigame/" target="_blank">play online</a></p>
        <p class="redagent-content">
            Design and imlementation of a promotionnal Facebook Application.
            A rythm game where you use the keyboard to mimic Michael.
        </p>
        <p class="redagent-footer">Actionscript 3.0</p>
    </aside>
    <p class="redagent-cl redagent-spacer"></p>

    <!-- Just Dance 2 -->
    <p class="redagent-page-img">
        <iframe title="YouTube video player" width="420" height="266" src="http://www.youtube.com/embed/hMxwwAxicck?rel=0&controls=0&autohide=1&color2=580000" frameborder="0" allowfullscreen></iframe>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">February 2011</p>
        <h1>Just Dance 2 /Wii</h1>
        <h2>Gameplay Programmer @Ubisoft</h2>
        <p class="redagent-links">
            <a href="http://justdancegame.uk.ubi.com/just_dance_2.php" target="_blank">website</a>
        </p>
        <p class="redagent-content">Design and prototype the connection between the game consoles (PS3 and Wii)and Social Networks (Facebook & iPhone applications).</p>
        <p class="redagent-footer">C++ (Nintendo SDK & PS3 SDK), Actionscript 2.0 (in-game interfaces), Python, PHP (web-server for Facebook Application), Objective C (iPhone application)</p>
    </aside>
    <p class="redagent-cl redagent-spacer"></p>

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
            <?php
            //<embed type="application/x-shockwave-flash" src="https://picasaweb.google.com/s/c/bin/slideshow.swf" width="420" height="267" flashvars="host=picasaweb.google.com&captions=1&hl=fr&feat=flashalbum&RGB=0x000000&feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2Ffrancois.aeberhard%2Falbumid%2F5582820136320777985%3Falt%3Drss%26kind%3Dphoto%26hl%3Dfr" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
            ?>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2010</p>
        <h1>3DBlogosphere</h1>
        <h2>Knowledge Management Engineer @Siemens Cororate Research</h2>
        <p class="redagent-links">
            <a href="http://www.iaeng.org/publication/WCECS2009/WCECS2009_pp764-767.pdf" target="_blank">publication</a>
        </p>
        <p class="redagent-content">
            Design and prototype of an application focused on the use of Virtual Worlds to enhancecollaboration in the company.
            <br /><br />
            Resulting paper: Aeberhard Francois-Xavier, Steve Russell, PhD, <a href=http://www.iaeng.org/publication/WCECS2009/WCECS2009_pp764-767.pdf" target="_blank">“3DBlogosphere: A Multisynchronous Approach of Virtual Worlds to Sustain Company Wide Communication”</a>,<em>International Conference on Internet and Multimedia Technologies 2009 ( ICIMT ), ACM,London UK</em>
        </p>
        <p class="redagent-footer">J2SE (JMonkey), J2EE (Project Wonderland, Darkstar & Glassfish), XSLT,Javascript</p>
    </aside>
    <p class="redagent-cl redagent-spacer"></p>



    <!-- Redcms -->
    <p class="redagent-page-img">
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
            <?php
            //<embed type="application/x-shockwave-flash" src="https://picasaweb.google.com/s/c/bin/slideshow.swf" width="420" height="267" flashvars="host=picasaweb.google.com&captions=1&hl=fr&feat=flashalbum&RGB=0x000000&feed=https%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2Ffrancois.aeberhard%2Falbumid%2F5582820136320777985%3Falt%3Drss%26kind%3Dphoto%26hl%3Dfr" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
            ?>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">January 2003 - August 2009</p>
        <h1><a href="http://redcms.red-agent.com" target="_blank">RedCMS</a></h1>
        <p class="redagent-links">
            <a href="http://redcms.red-agent.com" target="_blank">website</a><br />
            <a href="https://github.com/fxaeberhard/RedCMS" target="_blank">sources</a>
        </p>
        <p class="redagent-content">
            RedCMS is a lightweight CMS designed with AJAX in mind. It is
            based on Yahoo User Interface (YUI3), PHP5, PDO and Smarty.
        </p>
        <p class="redagent-footer">
            Javascript (YUI 3 Framework), PHP, Smarty, HTML, CSS
        </p>
    </aside>
    <p class="redagent-cl redagent-spacer"></p>

    <!--  DTouch -->
    <p class="redagent-page-img">
        <!--<img class="redagent-image" data-src="images/projects/dtouch_420.jpg" />-->
        <img src="images/projects/dtouch_420.jpg" />
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">August 2009</p>
        <h1>Audio D-Touch</h1>
        <h2>Semester project @Design and Media Laboratory (LDM, EPFL)</h2>
        <p class="redagent-links">
            <a href="http://www.d-touch.org/audio/" target="_blank">project homepage</a>
        </p>
        <p class="redagent-content">Design, prototye and user study on a tangible user interface (TUI) for audio sequencing, dtouch.</p>
        <p class="redagent-footer">C++</p>
    </aside>
    <p class="redagent-cl redagent-spacer"></p>

    <!-- Schlempf -->
    <p class="redagent-page-img">
        <span style="width:420px" id="__ss_4800011">
            <object id="__sse4800011" width="420" height="355"> <param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=schelmpfpresentation-0-2-slideshare-100720194537-phpapp02&rel=0&stripped_title=schelmpf-presentation-4800011&userName=FrancoisXav" /> <param name="allowFullScreen" value="true"/> <param name="allowScriptAccess" value="always"/> <embed name="__sse4800011" src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=schelmpfpresentation-0-2-slideshare-100720194537-phpapp02&rel=0&stripped_title=schelmpf-presentation-4800011&userName=FrancoisXav" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="420" height="355"></embed> </object>
        </span>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">June 2004</p>

        <h1>Schlempf /Java Mobile</h1>
        <p class="redagent-links">
            <a href="http://schlempf.red-agent.com/" target="_blank">website</a>
        </p>
        <p class="redagent-content">Participation Logiquest programming contest sponsored by Sun MicroSystem and Swisscom.Creation of a mobile game, Schlempf, a mix between a tamagochi and an adventure games.</p>
        <p class="redagent-footer">Java 2 Mobile Edition (J2ME)</p>

    </aside>
    <p class="redagent-cl redagent-spacer"></p>

    <!-- YUIMyAdmin -->
    <p class="redagent-page-img">
        <a href="http://yuimyadmin.sourceforge.net/" target="_blank">
            <!--<img class="redagent-image" data-src="images/projects/yuimyadmin.png" />-->
            <img src="images/projects/yuimyadmin.png" />
        </a>
    </p>
    <aside class="redagent-page-text">
        <p class="redagent-date">March 2003</p>
        <h1><a href="http://yuimyadmin.sourceforge.net/" target="_blank">YuiMyAdmin</a></h1>
        <p class="redagent-links">
            <a href="http://yuimyadmin.sourceforge.net/" target="_blank">website</a><br /><a href="http://yuimyadmin.sourceforge.net/yuimyadmin/" target="_blank">online demo</a><br /><a href="https://sourceforge.net/projects/yuimyadmin/files/" target="_blank">sources</a>
        </p>
        <p class="redagent-content">
            YUIMyAdmin is an web front-end to manage databases using the ajax libraries, Yahoo! User Interface (YUI). Written in php and using the ADOdb abstraction layer for the database. It is licensend under GNU Genral Public License V3.0</p>
        <p class="redagent-footer">Javascript (YUI 2 Framework), PHP, HTML, CSS
        </p>
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