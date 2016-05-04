/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
jQuery(function($) {
  var BODY = 'body',
    CLICK = 'click',
    Game = $.Game,
    Net = $.Net,
    loc = window.location.pathname;

  var App = {
    windowActive: true,
    navBarHeight: 55,
    /**
     * 
     */
    init: function() {
      if (!currentPage)
        App.game();

      // Show hide current page
      $('.game').toggleView(!currentPage).css('visibility', 'visible');
      $('.page').toggleView(currentPage);
      $('.loader').fadeOut();

      //App.hideableNav();
      App.smoothScroll();
      App.history();
      App.search();
      App.photoswipe();
      App.initPage();

      // Youtube video lazy load
      $(BODY).on(CLICK, '[data-youtube-id]', function(e) {
        e.preventDefault();
        $(this).html('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="http://www.youtube.com/embed/' + $(this).data('youtube-id') + '?autoplay=1&rel=0&controls=1&autohide=1&color2=580000&showinfo=0&modestbranding=1&rel=0" allowfullscreen></iframe></div>');
      });

      // Slick slider links 
      $(BODY).on(CLICK, '[data-slick-open]', function(e) {
        e.preventDefault();
        $(this).closest('article').find('[data-gallery]').get($(this).data('index') || 0).click();
      });

      // Init all tooltips
      $(BODY).tooltip({
        selector: '[data-toggle="tooltip"]',
        placement: 'bottom',
        html: true
      });

      // Keep track if window is focused or not
      $(window).blur(function() {
        App.windowActive = false;
      });
      $(window).focus(function() {
        App.windowActive = true;
      });

      // Contact form
      $(BODY).on('submit', '#contactForm', function() {
        // Call send mail method
        $.post('php/sendMail.php', 'from=' + encodeURIComponent($(this).find('input').val()) + '&msg=' + encodeURIComponent($(this).find('textarea').val()));

        $(this).addClass("sent").find('input, textarea').val('');
        setTimeout($(this).removeClass.bind($(this), 'sent'), 5000);
      });

      WebFont.load({
        custom: {
          families: ['Din', 'Open Sans'],
          urls: ['css/font.css']
        }
      });
    },
    gameInitalized: false,
    game: function() {
      if (!App.gameInitalized) {
        Game.init();
        Net.init();
        App.gameInitalized = true;
      }
    },
    /**
     * Scrollspy
     */
    scrollspy: function() {
      // Animate articles when they get visible
      $('article').one('scrollSpy:enter', function() {
        $(this).addClass('visible')
          // Initialize sliders
          .find('.slick').slick({
            autoplay: true,
            lazyLoad: 'ondemand',
            // fade: true, dots: true, autoplaySpeed: 3000, arrows: false, adaptiveHeight: true, vertical: true, slidesToShow: 1, speed: 300, dots: true, cssEase: 'linear',
          });

        // Load lazy loaded images
        $(this).find('[data-lazy-src]').each(function() {
          $(this).attr('src', $(this).data('lazy-src')).removeAttr('data-lazy-src');
        });
        $(this).find('[data-lazy-srcset]').each(function() {
          $(this).attr('srcset', $(this).data('lazy-srcset')).removeAttr('data-lazy-srcset');
        });
      });

      $('article').on('scrollSpy:enter scrollSpy:exit', function(e) {
        $(this).toggleClass('in-view', e.type === 'scrollSpy:enter');
        updateMenu();
      });

      function updateMenu() {
        $('.in-view').each(function() {
          var t = $(BODY).find('[href="#' + $(this).attr('id') + '"]');
          if (t.get(0)) {
            $('nav .active').removeClass('active');
            t.addClass('active');
            return false;
          }
        });
      }

      $('article').scrollSpy({ offsetTop: App.navBarHeight });

      // Bootstrap version
      /* highlight the top nav as scrolling occurs */
      // $(BODY).scrollspy({
      //   //target: '#nav',
      //   offset: App.navBarHeight
      // });
    },
    /**
     * Search field
     */
    search: function() {
      $(BODY).on('change keyup paste click', 'nav input', function(e) {
        var val = $(this).val().toLowerCase();
        $('main article').each(function() {
          $(this).setSlide($(this).text().toLowerCase().indexOf(val) === -1);
        });
      });
    },
    /**
     * Init history handling
     */
    history: function() {
      $(window).bind('popstate pushstate', function(e) {
        if (loc === window.location.pathname)
          return;
        loc = window.location.pathname;

        // Show sub page
        if (window.location.href.indexOf('.html') > 0) {
          var page = window.location.href.split('/').pop().replace('.html', '');

          !Crafty.isPaused() && Crafty.pause();
          // if (!Crafty.isPaused()) { setTimeout(function() { Crafty.pause(); }, 1000); }

          $('.loader').fadeIn();
          $('.game').fadeOut();

          // Fetch page content from server
          $.get(page + '.php', function(r) {
            $('.page').html(r).fadeIn();
            $('.loader').fadeOut();
            App.initPage();
          });
        } else {
          // Back to main page
          $('.page').fadeOut();
          $('.game').fadeIn();
          App.game();
          Crafty.isPaused() && Crafty.pause();
        }
      });

      $(BODY).on(CLICK, '.nav-link.close, footer a', function(e) {
        e.preventDefault();
        App.showPage($(this).attr('href').replace('.html', '').replace('/', ''));
      });
    },
    /**
     * Show a page ( Update browser history )
     */
    showPage: function(title) {
      history.pushState({}, title.capitalizeFirstLetter() || 'Red Agent', title ? title.toLowerCase() + '.html' : '/');
      $(window).trigger('pushstate');
    },
    /**
     * This is done every time a page is loaded dynamically
     */
    initPage: function() {
      // Scrollspy
      App.scrollspy();

      // Append text content for search
      $('[data-toggle="tooltip"]').each(function() {
        $(this).append('<div class="sr-only">' + $(this).attr('title') + '</div>');
      });

      // Contact page scrolls
      $('[data-width]').each(function() {
        setTimeout(function() {
          $(this).css('width', $(this).data('width') + '%');
        }.bind(this), 500);
      });

      // if ($('.page-blog textarea').length) { // Init TinyMCE on blog.html page
      //   this.initTinyMCE();
      // }
    },
    /**
     * Smooth scroll on anchor link
     */
    smoothScroll: function() {
      $(BODY).on(CLICK, 'a[href*="#"]:not([href="#"])', function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            // return false;
          }
        }
      });
    },
    /**
     * Hide Header on on scroll down
     */
    hideableNav: function() {
      var didScroll, lastScrollTop = 0,
        delta = 5;

      $(window).scroll(function(event) {
        didScroll = true;
      });

      setInterval(function() {
        if (didScroll) {
          hasScrolled();
          didScroll = false;
        }
      }, 250);

      function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
          return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > App.navBarHeight) {
          // Scroll Down
          $(BODY).removeClass('nav-down').addClass('nav-up');
        } else if (st + $(window).height() < $(document).height()) {
          // Scroll Up
          $(BODY).removeClass('nav-up').addClass('nav-down');

        }
        lastScrollTop = st;
      }
    },
    /**
     *
     */
    getPath: function() {
      var loc = window.location.pathname;
      return loc.substring(0, loc.lastIndexOf('/') + 1);
    },
    /**
     *
     */
    photoswipe: function() {
      function getItems(gallery) {
        return $(':not(.slick-cloned) > [data-gallery="' + gallery + '"]').map(function() {
          var size = $(this).data('size').split('x');
          return { src: $(this).attr('href'), w: size[0], h: size[1] };
        });
      }

      $(BODY).on(CLICK, '[data-gallery]', function() {
        event.preventDefault();

        var init = $.proxy(function() {
          // Initialize PhotoSwipe
          new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, getItems($(this).data('gallery')), {
            index: $(this).data('index'),
            // bgOpacity: 0.7,
            showHideOpacity: true,
            history: false,
            getThumbBoundsFn: function(index) {
              var p = this.offset();
              return { x: p.left, y: p.top, w: this.find('img').width(), h: this.find('img').height() };
            }.bind($(this))
          }).init();
        }, this);

        if (!window.PhotoSwipe) {
          $.when(
              $.ajax({ url: 'bower_components/photoswipe/dist/photoswipe.min.js', dataType: "script", cache: true }),
              $.ajax({ url: 'bower_components/photoswipe/dist/photoswipe-ui-default.min.js', dataType: "script", cache: true }))
            .then(init);
        } else init();
      });
    },
    /**
     *
     */
    // initTinyMCE: function() {
    //   requirejs(['tinyMCE'], function(tinyMCE) {
    //     tinyMCE.init({
    //       selector: '.page-blog textarea',
    //       plugins: 'autolink link image code media table contextmenu save emoticons  autoresize',
    //       toolbar: 'bold italic link image emoticons code styleselect save',
    //       image_advtab: true,
    //       statusbar: false,
    //       menubar: false,
    //       save_enablewhendirty: true,
    //       toolbar_items_size: 'small',
    //       forced_root_block: false, // Prevent enter from creating p elements
    //       autoresize_min_height: 45,
    //       autoresize_bottom_margin: 0,
    //       save_onsavecallback: function(editor) {
    //         Y.io('page-blog.php', {
    //           method: 'POST',
    //           data: {
    //             op: 'comment',
    //             file: Y.one(editor.contentAreaContainer).ancestor('.blog-post').getAttribute('data-post'),
    //             comment: editor.getContent()
    //           },
    //           on: {
    //             success: function(tId, e) {
    //               Y.one(editor.contentAreaContainer).ancestor('.blog-post').one('div').setHTML(e.responseText);
    //               editor.setContent('');
    //             }
    //           }
    //         });
    //       },
    //       setup: function(editor) {
    //         var placeholder = $('<label>' + editor.getElement().getAttribute('placeholder') + '</label>')
    //           .css({
    //             position: 'absolute',
    //             top: '2px',
    //             left: 0,
    //             color: 'lightgray',
    //             padding: '0.5%',
    //             width: '99%',
    //             overflow: 'hidden'
    //           })
    //           .click(function() {
    //             $(this).hide();
    //             editor.focus();
    //           });

    //         editor.on('init', function(evt) {
    //           var editor = evt.target,
    //             toolbar = $(editor.editorContainer).find('>.mce-container-body >.mce-toolbar-grp'),
    //             editorNode = $(editor.editorContainer).find('>.mce-container-body >.mce-edit-area');
    //           toolbar.detach().insertAfter(editorNode); // switch the order of the elements

    //           $(editor.contentAreaContainer).css('position', 'relative')
    //             .append(placeholder);

    //           $(this.contentAreaContainer.parentElement).find('div.mce-toolbar-grp').hide();
    //         });
    //         editor.on('focus', function() {
    //           $(this.contentAreaContainer.parentElement).find('div.mce-toolbar-grp').show();
    //           placeholder.hide();
    //         });
    //         editor.on('blur', function() {
    //           if (this.getContent() === '') {
    //             $(this.contentAreaContainer.parentElement).find('div.mce-toolbar-grp').hide();
    //             placeholder.show();
    //           } else {
    //             placeholder.hide();
    //           }
    //         });
    //       }
    //     });
    //   });
    // }
  };

  $.App = App;

  String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
  };

  $.fn.extend({
    toggleView: function(doShow, a, b) {
      if (doShow) {
        return this.show(a, b);
      } else {
        return this.hide(a, b);
      }
    },
    setSlide: function(doShow) {
      if (doShow) {
        this.slideUp();
      } else {
        this.slideDown();
      }
    },
    editable: function(options) {
      //hide $el, show $texterea (mark with a class - just in case)
      this.attr('title', 'Click to edit')
        .click(function(e) {
          e.stopImmediatePropagation();
          var $el = $(this),
            form = $('<form><input></form'),
            input = form.find('input').val($el.html());

          $el.empty().addClass('editing').append(form);
          input.focus().select();
          //on blur write everything back
          form.one('submit', function(e) {
            e.preventDefault();
            var text = input.val();
            form.remove();
            $el.removeClass('editing');
            options.onblur(text);
            // $(this).parent().html(options.onblur(text));
          });
          input.click(function(e) {
            e.stopImmediatePropagation();
          });
          input.blur(function(e) {
            form.submit();
          });
        });
      return this;
    }
  });

  $(window).load(App.init);
});
