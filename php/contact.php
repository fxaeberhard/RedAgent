<?php require_once 'app.php'; ?>

<a href="/" class="nav-link close"><svg><use xlink:href="assets/images/sprite.svg#back"></use></svg></a>

<!-- Navbar -->
<main id="contact">

  <article class="firstRow">

    <div class="pic">
      <img src="assets/images/profile-picture-2.png" alt="François-Xavier Aeberhard" class="img-fluid" />
    </div>
    <div class="coord">
      <h1>François-Xavier Aeberhard</h1>
      <h2>Level 110 Full Stack Engineer</h2>
      <div class="links link-effect">
        <a href="mailto:fx@red-agent.com"><svg><use xlink:href="assets/images/sprite.svg#mail"></use></svg>fx@red-agent.com</a>
        <a href="tel:41754213454"><svg><use xlink:href="assets/images/sprite.svg#phone"></use></svg>+41 75 421 34 54</a>
        <!-- <a href="skype:francois.xavier.aeberhard?add"><svg><use xlink:href="assets/images/sprite.svg#skype"></use></svg>francois.xavier.aeberhard</a> -->
      </div>
      <div class="online">
        <a class="icon" data-toggle="tooltip" title="LinkedIn" href="http://www.linkedin.com/in/francoisxavieraeberhard" target="_blank">
          <svg><use xlink:href="assets/images/sprite.svg#linkedin"></use></svg>
        </a>
        <a class="icon" data-toggle="tooltip" title="GitHub" href="https://github.com/fxaeberhard/" target="_blank">
          <svg><use xlink:href="assets/images/sprite.svg#github"></use></svg>
        </a>
        <a class="icon" data-toggle="tooltip" title="Deviant Art" href="http://fxaeberhard.deviantart.com/gallery/" target="_blank">
          <svg><use xlink:href="assets/images/sprite.svg#deviantart1"></use></svg>
        </a>

        <!-- <a href="https://plus.google.com/[YOUR PERSONAL G+ PROFILE NUMBER]" rel="me">Me on Google+</a> -->
      </div>

      <!--<a href="http://www.google.com/recaptcha/mailhide/d?k=01tfH_sHi9mCGP6o51PKWzKw==&amp;c=HdWYxKOD7Q96Lcvn1x9vqwD4cNY6Q_wSLuuO2okBISA=" onclick="window.open('http://www.google.com/recaptcha/mailhide/d?k\07501tfH_sHi9mCGP6o51PKWzKw\75\75\46c\75HdWYxKOD7Q96Lcvn1x9vqwD4cNY6Q_wSLuuO2okBISA\075', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;" title="Reveal this e-mail address">f...@red-agent.com</a>-->

    </div>
  </article>

  <article class="secrow">
    <div>
      <h3>Skills</h3>
      <div>
        <div>
          <div>
            <svg><use xlink:href="assets/images/sprite.svg#html"></use></svg>
            <strong>Web</strong>
          </div>
        </div>
        <div>
          <div data-width="100">Angular, React, Backbone, Vue.js, d3, Scss, Less, Bootstrap</div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <svg><use xlink:href="assets/images/sprite.svg#server"></use></svg>
            <strong>Server</strong>
          </div>
        </div>
        <div>
          <div data-width="95">Java EE, Node, Go, Ruby on Rails, Php, Pyhon, RabbitMQ, Docker</div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <svg><use xlink:href="assets/images/sprite.svg#pad"></use></svg>
            <strong>Client</strong>
          </div>
        </div>
        <div>
          <div data-width="90">C, C++, Wii, PS3, UDK, Unity</div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <svg><use xlink:href="assets/images/sprite.svg#cg"></use></svg>
            <strong>CG</strong>
          </div>
        </div>
        <div>
          <div data-width="60">WebGL, OpenGL, Direct3D</div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <svg><use xlink:href="assets/images/sprite.svg#db"></use></svg>
            <strong>DB</strong>
          </div>
        </div>
        <div>
          <div data-width="80">Mongo, MySQL, PostgreSQL, Neo4j</div>
        </div>
      </div>
    </div>
    <div class="message">

      <h3>Competencies</h3>
      <div class="competencies">
        <div>Software Engineering</div>
        <div>Management</div>
        <div>User Experience</div>
      </div>

      <h3>Get in touch</h3>
      <form class="indent" action="javascript:;" id="contactForm">
        <!-- <input class="form-control" type="mail" placeholder="Your mail" required> -->
        <textarea class="form-control" placeholder="Your message" rows="3" required></textarea>
        <button>
          <svg><use xlink:href="assets/images/sprite.svg#send"></use></svg> Send
          <div class="done">
            <strong>Thanks!</strong>
            <br /> I'll get back to you soon.
          </div>
        </button>
      </form>

      <!--<a href="https://plus.google.com/photos/111847855812041849491/albums" target="_blank"">Pictures</a><br/>-->
      <!--<a href="skype:francois.xavier.aeberhard?add">Skype</a>-->
      <!--<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>-->
      <!--<a href="http://www.delicious.com/FiiX" target="_blank">delicious</a><br/>-->

    </div>
  </article>

  <?php footer('contact'); ?>

</main>
