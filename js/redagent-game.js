/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
jQuery(function($) {

  var TILEWIDTH = 64,
    TILEHEIGHT = TILEWIDTH / 2,
    SPEED = 4.5,
    ISOCOS = Math.cos(0.46365),
    ISOSIN = Math.sin(0.46365),
    WIDTH = 800,
    HEIGHT = 595,
    TILEPERSCREENX = Math.round(WIDTH / TILEWIDTH),
    TILEPERSCREENY = Math.round(HEIGHT / TILEHEIGHT),
    MAXX = 1,
    MINX = -1,
    MAXY = 0,
    MINY = -1,
    BORDER = 48,
    lastName,
    greyTiles = [[6, 9], [7, 10], [7, 11], [8, 12], [8, 13], [9, 14], [9, 15], [10, 16],
          [10, 17], [11, 18], [11, 19], [12, 20], [12, 21], [13, 22], [13, 23], [14, 24],
          [14, 25], [15, 24], [15, 23], [16, 22], [16, 21], [17, 20], [10, 18], [9, 19], [9, 20],
          [8, 21], [8, 22], [7, 23], [7, 24], [6, 25], [6, 26], [5, 27], [5, 28],
          [4, 29], [4, 30], [3, 31], [3, 30], [2, 29], [2, 28], [1, 27], [6, -8],
          [6, -9], [7, -10], [7, -11],
          //top guys          
          [5, -9], [6, -10], [6, -11], [7, -12], [5, -10], [5, -11], [6, -12], [6, -13], [4, -11],
           [5, -12], [5, -13], [6, -14], [3, -16], [3, -17], [3, -15], [4, -16]
          // head       
          ],
    redTiles = [[0, -17], [1, -16], [1, -15], [2, -14], [2, -13], [3, -12], [3, -11],
          [4, -10], [4, -9], [5, -8], [5, -7], [6, -6], [6, -5], [7, -4], [7, -3], [7, -2],
          [6, -1], [6, 0], [6, -7], [7, -8], [7, -9], [8, -10], [4, -12], [4, -13], [5, -14],
          [5, -15], [6, -16], [6, -15], [7, -14], [7, -13], [8, -12], [8, -11], [9, -10],
          [9, -9], [10, -8], [10, -9], [11, -10], [1, -11], [4, -14], [4, -15], [3, -14],
          [2, -15], [4, -17], [4, -18], [2, -17], [3, -18] // head     
         ],
    tilesMap = {},
    initialized = false,
    tileLoaded = [];

  var Game = {
    players: {},
    init: function() {
      if (initialized) return;
      initialized = true;

      Game.initChat();

      Crafty.init(WIDTH, HEIGHT); // Init crafty
      Crafty.isometric.size(TILEWIDTH); // Init isometric layout
      Crafty.domLayer.init();
      Crafty.support.canvas && Crafty.canvasLayer.init(); // Init canvas if available
      Crafty.viewport.clampToEntities = false;

      function updateScale() {
        var ratio = Math.min(1, $(window).width() / WIDTH);
        Crafty.viewport.scale(ratio);
        $('#cr-stage').css({ width: WIDTH * ratio, height: HEIGHT * ratio, 'padding-bottom': 0 });
      }
      updateScale();
      $(window).resize(updateScale);

      // Build tiles map
      greyTiles.forEach(function(o) {
        tilesMap[o[0]] = tilesMap[o[0]] || {};
        tilesMap[o[0]][o[1]] = 'lightgray';
      });
      redTiles.forEach(function(o) {
        tilesMap[o[0]] = tilesMap[o[0]] || {};
        tilesMap[o[0]][o[1]] = 'red';
      });

      // console.profile();
      // Init tiles
      Game.loadTiles(0, 0);

      // Init player
      var player = Crafty.e('PlayablePC')
        .attr({ x: 390, y: 250, z: 200 })
        .label('');
      player._label.css({ cursor: 'text' });

      // Make current player label editable
      $(player._label._element).editable({
        onblur: function(value) {
          player.label(value);
          $.cookie('chatname', value, { expires: 10 });
          $.Net.trigger('rename', { name: value });
          return value;
        }
      });

      // Init houses
      Crafty.e('House').setTargetPage('projects').place(5.5, 3.2).attr('z', 201);
      Crafty.e('House').setTargetPage('contact').place(0.5, 21.2).attr('z', 204);
      Crafty.e('House').setTargetPage('blog').place(16.5, 14.2).attr('z', 206);

      // Init bot
      Game.players.bot = Crafty.e('Actor, Character, BotSprite')
        .attr({ x: 570, y: 400, z: 200 })
        .label('Red agent');

      // Introduction text by the bot
      var firstmsg = 'Welcome on Francois-Xavier\'s portfolio.',
        secmsg = 'It appears there\'s only the two of us on this page at the moment. Feel free to look around and ask me if you have any question.';
      setTimeout(function() {
        Game.say('bot', firstmsg);
      }, 2000);
      setTimeout(function() {
        Game.say('bot', secmsg);
      }, 4000);

      // Init dancers
      var snd, counter = 0,
        dancer1 = Crafty.e('GrayCharacter')
        .place(4, 9, -1)
        .animate('Down', -1),
        dancer2 = Crafty.e('GrayCharacter')
        .place(6, 8, -1)
        .animate('Left', -1),
        dancer3 = Crafty.e('GrayCharacter')
        .attr({ x: -300, y: 300, z: 200 })
        .animate('Down', -1);

      // Play sound and animation in disco screen
      setInterval(function() {
        if (player.screen.x === -1 && player.screen.y === 0) {
          var tiles = Crafty('Tile');
          tiles.each(function(i) {
            tiles.get(i).randomSprite();
          });

          if (!snd) {
            snd = new Audio('images/Elevator Music.mp3');
            snd.play();
          }
          if (counter % 20) {
            dancer1.say('Yeah lets dance!');
          }
          if (counter % 18) {
            dancer2.say('Whooo');
          }
          counter++;
        } else if (snd) {
          snd.pause();
          snd = null;
        }
      }, 400);
    },
    loadTiles: function(screenX, screenY) {
      if (tileLoaded[screenX + '' + screenY]) {
        return;
      }
      tileLoaded[screenX + '' + screenY] = true;
      var minX = screenX * 12,
        maxY = (screenY + 1) * 37;
      for (var x = (screenX + 1) * 12; x >= minX; x--) {
        for (var y = screenY * 37; y < maxY; y++) {
          Crafty.e('Tile').place(x, y).randomSprite();
        }
      }
    },
    getPlayer: function(id) {
      return Game.players[id];
    },
    /**
     * Init player
     */
    addPlayer: function(cfg) {
      return Game.players[cfg.id] = Crafty.e('PlayerCharacter')
        .attr({ x: -100, y: -100, z: 200 });
    },
    say: function(id, msg) {
      var p = Game.getPlayer(id);
      p.say(msg);
      Game.chat(p.label(), msg); // display it in the chat
    },
    initChat: function() {
      //$('.chat-msgs').perfectScrollbar();

      // On 'enter' key in textarea,
      $('.chat textarea').keypress(function(e) {
        if (e.which == 13) {
          e.preventDefault();

          var value = $(this).val();

          // Empty textarea
          $(this).val('');
          if (value === '') {
            return;
          }

          // show msg in chat and in the canvas
          Game.chat('Me', value, 'self');
          Crafty('PlayablePC').say(value);

          // and there are other players in the chat, send websocket event
          if ($.Net.channel && $.Net.channel.members.count > 1) {
            $.Net.trigger('chat', { msg: value });
          } else {
            // Otherwise, player is alone send io request to chatter bot
            $.post('programo/chatbot/conversation_start.php',
              'say=' + encodeURIComponent(value) + '&convo_id=' + convoId + '&bot_id=1&format=json',
              function(r) {
                var response = $.parseJSON(r);
                Game.say('bot', response.botsay);
              });
          }
        }
      });
    },
    chat: function(name, msg, cssclass) {
      this.addParagraph((lastName !== name ? '<span class="name">' + name + '</span>' : '') + msg,
        (lastName !== name ? 'newtalker ' : '') + cssclass);
      lastName = name;
    },
    notify: function(msg) {
      this.addParagraph(msg, 'notification');
    },
    addParagraph: function(msg, cssclass) {
      $('.chat-msgs').append('<div class="chat-msg ' + cssclass + '">' + msg + '</div>')
        .animate({ scrollTop: $('.chat-msgs').prop('scrollHeight') }, 1500)
        //.perfectScrollbar('update');
    },
  };
  $.Game = Game;

  /**
   * Crafty sprites 
   */
  Crafty.sprite(64, 'images/sprite-game.png', {
    PlayerSprite: [0, 0],
    BotSprite: [17, 2],
  });
  Crafty.sprite(64, 32, 'images/sprite-game.png', {
    TileSprite: [17, 0, 1, 1]
  });
  Crafty.sprite(128, 128, 'images/sprite-building.png', {
    BuildingSprite: [0, 0]
  });

  /**
   * Crafty components
   */
  Crafty.c('Actor', {
    init: function() {
      // Select rendering method
      this.requires('2D ' + Crafty.support.canvas ? 'Canvas' : 'DOM');
    },
    place: function(x, y, screenX, screenY) {
      this._pos = { x: x + (screenX || 0) * TILEPERSCREENX, y: y + (screenY || 0) * TILEPERSCREENY }
      Crafty.isometric.place(this._pos.x, this._pos.y, 0, this);
      return this;
    }
  });

  Crafty.c('Tile', {
    init: function() {
      this.requires('Actor, TileSprite, Mouse')
        .areaMap([32, 0, 64, 16, 32, 32, 0, 16])
        .bind('MouseOver', this.hover)
        .bind('MouseOut', this.resetSprite)
        .bind('Click', function() {
          // Whenever tile is clicked, move playe
          var p = Crafty.isometric.px2pos(this.x, this.y);
          Crafty('PlayablePC').moveAndNotify(Math.round(p.x), Math.round(p.y), 0);
        });
    },
    hover: function() {
      if (this.color === 'red')
      // this.sprite(1, 0, 1, 1);
        this.sprite(17, 0, 1, 1);
      else
      // this.sprite(0, 0, 1, 1);
        this.sprite(17, 0, 1, 1);
    },
    randomSprite: function() {
      var r = Math.random(),
        // pos = this._pos;
        pos = Crafty.isometric.px2pos(this.x, this.y);

      if (tilesMap[pos.x] && tilesMap[pos.x][pos.y]) {
        this.__sprite = tilesMap[pos.x][pos.y];
      } else if (r > 0.12) {
        this.__sprite = 'white'; // white
      } else if (r > 0.10) {
        this.__sprite = 'orange'; // white
      } else if (r > 0.05) {
        this.__sprite = 'gray'; // gray
      } else {
        this.__sprite = 'red'; // red
      }
      this.resetSprite();
      return this;
    },
    resetSprite: function() {
      var color2sprite = {
        red: [17, 0, 1, 1],
        gray: [17, 2, 1, 1],
        white: [18, 0, 1, 1],
        //lightgray: [1, 2, 1, 1],
        orange: [18, 2, 1, 1]
      };
      if (!this.__sprite) return;
      this.sprite.apply(this, color2sprite[this.__sprite]);
    }
  });

  Crafty.c('Character', {
    label: function(label) {
      if (jQuery.type(label) === 'string') {
        var s = Crafty.viewport._scale;
        if (!this._label) {
          this._label = Crafty.e('2D, DOM, Text, Label' + (this.has('PlayablePC') ? ', PCLabel' : ''))
            .attr({ x: this.x + 24, y: this.y + 60, z: 400 })
            .textFont({ size: .9 / Crafty.viewport._scale + 'rem' })
            .css({
              'border-radius': 2 / s + 'px',
              padding: .2 / s + 'rem ' + (0.5 / s) + 'rem',
            });
          this.attach(this._label);
        }
        this._label.text(label);
      } else {
        return this._label ? this._label.text() : '';
      }
      return this;
    },
    say: function(text) {
      var that = this,
        textE = Crafty.e('2D, DOM, Text, Dialog')
        .attr({ x: this.x - 125, y: this.y - 20, w: 270, z: 401, visible: false })
        .textFont({ size: .9 / Crafty.viewport._scale + 'rem' })
        .css({ padding: .3 / Crafty.viewport._scale + 'rem' }),
        connector = Crafty.e('2D, DOM, Connector')
        .attr({ w: 32, h: 32, z: 402, visible: false });

      textE.text(text);
      textE.bind('Draw', function() {
        textE.unbind('Draw');
        // Attach a little later so the font file has enough time to be loaded
        this.timeout(function() {
          textE.attr({
            x: that.x - this._element.offsetWidth / 2 + 14,
            y: that.y - this._element.offsetHeight - 10
          }).visible = true;
          connector.attr({ x: that.x + 10, y: that.y - 19 }).visible = true;
        }, 10);
      });

      this.attach(textE);
      textE.attach(connector);

      // Destroy after 3.5 sec
      this.timeout(function() {
        textE.destroy();
      }, 3500);
      return textE;
    }
  });

  /**
   * Characters (self and others)
   */
  Crafty.c('PlayerCharacter', {
    init: function() {
      var countdown = 0;
      this.requires('Character, Actor, PlayerSprite, SpriteAnimation, Tween') //Collision
        //.collision([32, 32, 64, 48, 32, 64, 0, 48]) // Set up hit box
        .reel('Down', 1000, 0, 2, 16) // Set up animations
        .reel('Up', 1000, 0, 3, 16)
        .reel('Right', 1000, 0, 0, 16)
        .reel('Left', 1000, 0, 1, 16)
        .bind('TweenEnd', function() { // Whenever the player
          this.pauseAnimation()
            .moveTo(this.targetMove.x, this.targetMove.y, this.targetMove.z);
        })
        .bind('EnterFrame', function() {

          if (countdown > 0) {
            countdown--;
            return;
          }
          countdown = 10;

          var z = 200,
            that = this;

          // Reorder base on z positionning
          Crafty('House').each(function() {
            if (that._y - 55 > this._y) {
              // z = Math.max(this._z + 1, z);
              z = this.z + 1;
            }
          });
          this.attr('z', z);
        });
    },
    moveTo: function(x, y, z) {
      var to, anim,
        targetPx = this.pos2px(x, y, z),
        targetCart = this.px2cart(targetPx),
        currentCart = this.px2cart({ x: this.x, y: this.y });

      // Save target
      this.targetMove = { x: x, y: y, z: z };

      // Select direction
      if (targetCart.x - 2 > currentCart.x) {
        targetCart.y = currentCart.y;
        anim = 'Right';
      } else if (targetCart.x + 2 < currentCart.x) {
        targetCart.y = currentCart.y;
        anim = 'Left';
      } else if (targetCart.y - 2 > currentCart.y) {
        anim = 'Up';
      } else if (targetCart.y + 2 < currentCart.y) {
        anim = 'Down';
      } else {
        // Player has reach its target, no need to continue
        this.trigger('MoveEnd');
        return this;
      }

      to = this.cart2px(targetCart);

      var dist = Math.sqrt(Crafty.math.squaredDistance(this.x, this.y, to.x, to.y)),
        time = Math.round((dist / TILEWIDTH) * (100 / SPEED)) + 1; //+1 because if time = 0, time = infinite

      this.animate(anim, -1) // Start animation
        .tween(to, time * 20); // Tween to next step

      return this;
    },
    moveAndNotify: function(x, y, src) {
      // Move player and make sure it will open window
      this.moveTo(x, y, 0)
        .clickedOn = src;
      $.Net.trigger('move', { x: x, y: y });
      return this;
    },
    pos2px: function(x, y, z) {
      return {
        x: x * 64 + (y & 1) * (64 / 2),
        y: y * 64 / 4 - 32 - 5
      };
    },
    cart2px: function(v) {
      return {
        x: (v.x - v.y) * ISOCOS,
        y: -(v.z + (v.x + v.y) * ISOSIN)
      };
    },
    px2cart: function(v) {
      return {
        x: Math.round((v.x / ISOCOS - v.y / ISOSIN) / 2),
        y: Math.round(-(v.x / ISOCOS + v.y / ISOSIN) / 2),
        z: 0
      };
    }
  });

  /**
   * This is the player-controlled character
   */
  Crafty.c('PlayablePC', {
    init: function() {
      this.screen = { x: 0, y: 0 };
      this.requires('PlayerCharacter')
        // .attr({ z: 220 })
        // .onHit('House', function(data) { // Respond to this player visiting a house
        //   if (!this.windowOpened) {
        //     data[0].obj.openPage();
        //     this.currentHouse = data[0].obj;
        //     this.windowOpened = true;
        //   }
        // }, function() {
        //   this.windowOpened = false;
        //   this.currentHouse.closePage();
        // })
        .bind('MoveEnd', function() {
          // If we're heading to a clickable object
          this.clickedOn && this.clickedOn.openPage();

          // Scroll background
          var WMB = WIDTH - BORDER,
            WM2B = WIDTH - 2 * BORDER, //     
            HMB = HEIGHT - BORDER,
            HM2B = HEIGHT - 2 * BORDER;

          if (this.x + 32 > this.screen.x * WM2B + WMB && this.screen.x < MAXX) {
            Crafty.viewport.pan(WM2B, 0, 1000);
            this.screen.x++;
          } else if (this.x + 32 < this.screen.x * WM2B + BORDER && this.screen.x > MINX) {
            Crafty.viewport.pan(-WM2B, 0, 1000);
            this.screen.x--;
          } else if (this.y + 62 > this.screen.y * HM2B + HMB && this.screen.y < MAXY) {
            Crafty.viewport.pan(0, HM2B, 1000);
            this.screen.y++;
          } else if (this.y + 62 < this.screen.y * HM2B + BORDER && this.screen.y > MINY) {
            Crafty.viewport.pan(0, -HM2B, 1000);
            this.screen.y--;
          }
          Game.loadTiles(this.screen.x, this.screen.y);
        });
    }
  });

  Crafty.c('GrayCharacter', {
    init: function() {
      this.requires('Character, Actor, PlayerSprite, SpriteAnimation')
        .reel('Down', 1000, 0, 6, 16) // Set up animations
        .reel('Up', 1000, 0, 7, 16)
        .reel('Right', 1000, 0, 4, 16)
        .reel('Left', 1000, 0, 5, 16);
    }
  });

  Crafty.c('House', {
    init: function() {
      this.requires('Actor, Mouse,  BuildingSprite, SpriteAnimation') //Collision,
        .attr({ visible: false })
        //.collision([22, 109, 65, 132, 108, 109, 65, 85])
        .areaMap([35, 109, 65, 123, 94, 108, 93, 50, 64, 34, 36, 50])
        .bind('Click', function() {
          // Whenever tile is clicked, move player and make sure it will open window
          var p = Crafty.isometric.px2pos(this.x, this.y + 128);
          Crafty('PlayablePC').moveAndNotify(Math.round(p.x), Math.round(p.y), this);
        })
        .bind('MouseOver', function() {
          this.animate('Hover'); // Start animation
        })
        .bind('MouseOut', function() {
          this.animate('Out'); // Start animation
        })
        .timeout(function() {
          this.visible = true;
          this.animate('Appear'); // Start animation
        }, 500);
    },
    setTargetPage: function(page) {
      var row = { contact: 0, projects: 1, blog: 2 }[page];
      this.attr('targetPage', page)
        .reel('Appear', 1000, 0, row, 24)
        .reel('Open', 900, 23, row, 21)
        .reel('Close', 900, 44, row, -22)
        .reel('Hover', 1000, 45, row, 1)
        .reel('Out', 1000, 22, row, 1);
      return this;
    },
    openPage: function() {
      this.animate('Open')
        .timeout(function() {
          $.App.showPage(this.attr('targetPage'));
        }, 900)
        .timeout(function() {
          this.animate('Close')
        }, 1000);
    }
  });
});
