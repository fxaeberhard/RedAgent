/*
 * Red agent
 * http://www.red-agent.com/wallogram
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI.add("redagent-display", function(Y) {

    var Display, LABELSUFFIX = " <em>(me)</em>", TILEWIDTH = 64, SPEED = 4.5,
        ISOCOS = Math.cos(0.46365), ISOSIN = Math.sin(0.46365),
        WIDTH = 800, HEIGHT = 595, MAXX = 1, MINX = -1, MAXY = 0, MINY = -1,
        BORDER = 48;

    Display = Y.Base.create("redagent-display", Y.Widget, [], {
        CONTENT_TEMPLATE: '<div><div id="cr-stage"></div></div>',
        initializer: function() {
            this.players = {};
        },
        renderUI: function() {
            Crafty.init(WIDTH, HEIGHT);                                         // Init crafty
            Crafty.isometric.size(TILEWIDTH);                                   // Init isometric layout
            Crafty.support.canvas && Crafty.canvas.init();                      // Init canvas if available

            var x, y;
            for (x = 12 * (MAXX + 1); x >= MINX * 12; x--) {                    // Init grid
                for (y = MINY * 37; y < (MAXY + 1) * 37; y++) {
                    Crafty.e("Tile").place(x, y).randomSprite();
                }
            }

            var player = this.player = Crafty.e('PlayablePC')                   // Init player
                .attr({x: 390, y: 250, z: 200})
                .label("");

            player._label.css({cursor: "text"});
            $(player._label._element).editable(function(value) {                // Make current player label editable
                player.label(value);
                $.cookie("chatname", value, {expires: 10});
                Y.RedAgent.pusher.trigger("rename", {
                    name: value
                });
                return value;
            }, {
                tooltip: 'Click to edit...',
                width: 80,
                select: true,
                onblur: "submit",
                data: function(value) {
                    return value.replace(LABELSUFFIX, '');
                }
            });

            Crafty.e("House").setTargetPage("projects").place(5.5, 3.2);        // Init houses
            Crafty.e("House").setTargetPage("contact").place(0.5, 21.2);
            Crafty.e("House").setTargetPage("blog").place(16.5, 14.2);

            this.players.bot = Crafty.e("Actor, Character, BotSprite")          // Init bot
                .attr({x: 570, y: 400, z: 200})
                .label("Red agent");

            var snd, counter = 0,
                dancer1 = Crafty.e('GrayCharacter')
                .place(4, 9, -1)
                .animate('PlayerMovingDown', -1),
                dancer2 = Crafty.e('GrayCharacter')
                .place(6, 8, -1)
                .animate('PlayerMovingLeft', -1),
                dancer3 = Crafty.e('GrayCharacter')
                .attr({x: -300, y: 300, z: 200})
                .animate('PlayerMovingDown', -1);                               // Play sound and animation in disco screen
            Y.later(400, this, function() {
                var player = Crafty("PlayablePC");
                if (player.screen.x === -1 && player.screen.y === 0) {
                    var tiles = Crafty("Tile");
                    tiles.each(function(i) {
                        tiles.get(i).randomSprite();
                    });

                    if (!snd) {
                        snd = new Audio('images/Elevator Music.mp3');
                        snd.play();
                    }
                    if (counter % 20) {
                        dancer1.say("Yeah lets dance!");
                    }
                    if (counter % 18) {
                        dancer2.say("Whooo");
                    }
                    counter++;
                } else if (snd) {
                    snd.pause();
                    snd = null;
                }
            }, null, true);
        },
        getPlayer: function(id) {
            return this.players[id];
        },
        addPlayer: function(cfg) {
            Y.log("addPlayer()", "info", "RedAgent.Display");
            return this.players[cfg.id] = Crafty.e('NotPlayablePC')
                .attr({x: -100, y: -100, z: 200});                              // Init player
        },
        say: function(entity, text) {
            this.getPlayer(entity).say(text);
        }
    });
    Y.namespace("RedAgent").Display = Display;

    // Crafty sprites 
    Crafty.sprite(64, 32, "images/sprite-tiles.png", {
        TileSprite: [0, 0, 1, 1]
    });
    Crafty.sprite(64, "images/sprite-player.png", {
        PlayerSprite: [0, 0]
    });
    Crafty.sprite(64, "images/sprite-bot.png", {
        BotSprite: [0, 0]
    });
    Crafty.sprite(128, 128, 'images/sprite-building.png', {
        BuildingSprite: [0, 0]
    });

    // Crafty components
    Crafty.c('Actor', {
        init: function() {
            this.requires('2D ' + Crafty.support.canvas ? "Canvas" : 'DOM');    // Select rendering method
        },
        place: function(x, y, screenX, screenY) {
            Crafty.isometric.place(x + (screenX || 0) * Math.round(WIDTH / TILEWIDTH), y + (screenY || 0) * Math.round(HEIGHT * 2 / TILEWIDTH), 0, this);
            return this;
        }
    });

    Crafty.c("Tile", {
        init: function() {
            this.requires('Actor, TileSprite, Mouse')
                .areaMap([32, 0], [64, 16], [32, 32], [0, 16])
                .bind("MouseOver", this.hover)
                .bind("MouseOut", this.resetSprite)
                .bind("Click", function() {                                     // Whenever tile is clicked
                    var p = Crafty.isometric.px2pos(this.x, this.y);
                    Y.log("clicked on tile:" + p.x + ", " + p.y);
                    Crafty('PlayablePC').moveAndNotify(Math.round(p.x), Math.round(p.y), 0);// Move player
                });
        },
        hover: function() {
            if (this.color === "red")
                this.sprite(1, 0, 1, 1);
            else
                this.sprite(0, 0, 1, 1);
        },
        randomSprite: function() {
            var r = Math.random(),
                pos = (Crafty.isometric.px2pos(this.x, this.y)),
                comp = function(i) {
                    return pos.x !== i[0] || pos.y !== i[1];
                },
                greyTiles = [[6, 9], [7, 10], [7, 11], [8, 12], [8, 13], [9, 14], [9, 15], [10, 16], [10, 17], [11, 18], [11, 19], [12, 20], [12, 21], [13, 22], [13, 23], [14, 24], [14, 25],
                    [15, 24], [15, 23], [16, 22], [16, 21], [17, 20],
                    [10, 18], [9, 19], [9, 20], [8, 21], [8, 22], [7, 23], [7, 24], [6, 25], [6, 26], [5, 27], [5, 28], [4, 29], [4, 30], [3, 31],
                    [3, 30], [2, 29], [2, 28], [1, 27],
                    [6, -8], [6, -9], [7, -10], [7, -11], //                    //top guys
                    [5, -9], [6, -10], [6, -11], [7, -12],
                    [5, -10], [5, -11], [6, -12], [6, -13],
                    [4, -11], [5, -12], [5, -13], [6, -14],
                    [3, -16], [3, -17], [3, -15], [4, -16] //                   // head
                ],
                redTiles = [[0, -17], [1, -16], [1, -15], [2, -14], [2, -13], [3, -12], [3, -11], [4, -10], [4, -9], [5, -8], [5, -7], [6, -6], [6, -5], [7, -4], [7, -3],
                    [7, -2], [6, -1], [6, 0],
                    [6, -7], [7, -8], [7, -9], [8, -10],
                    [4, -12], [4, -13], [5, -14], [5, -15],
                    [6, -16], [6, -15], [7, -14], [7, -13], [8, -12], [8, -11], [9, -10], [9, -9], [10, -8],
                    [10, -9], [11, -10], [1, -11],
                    [4, -14], [4, -15], [3, -14], [2, -15], [4, -17], [4, -18], [2, -17], [3, -18] // head
                ];

            if ($.grep(greyTiles, comp, this).length) {
                this.__sprite = "lightgray";                                    // light gray path
            } else if ($.grep(redTiles, comp, this).length) {
                this.__sprite = "red";                                          // red bot
            } else if (r > 0.10) {
                this.__sprite = "white";                                        // white
            } else if (r > 0.05) {
                this.__sprite = "gray";                                         // gray
            } else {
                this.__sprite = "red";                                          // red
            }
            this.resetSprite();
            return this;
        },
        resetSprite: function() {
            var color2sprite = {
                red: [0, 0, 1, 1], gray: [0, 2, 1, 1],
                white: [1, 0, 1, 1], lightgray: [1, 2, 1, 1]
            };
            this.sprite.apply(this, color2sprite[this.__sprite]);
        }
    });

    Crafty.c("Character", {
        label: function(label) {
            if (Y.Lang.isString(label)) {
                if (!this._label) {
                    this._label = Crafty.e("2D, DOM, Text, Label").attr({x: this.x + 24, y: this.y + 60, z: 400})
                        .css({
                            "text-align": "center", "background-color": "rgba(128, 128, 128, 0.7)",
                            color: "white", "border-radius": "2px",
                            padding: "0.2em 0.5em", "white-space": "nowrap"
                        });
                    this.attach(this._label);
                }
                if (this.has("PlayerCharacter")) {
                    label += LABELSUFFIX;
                }
                this._label.text(label);
            } else {
                return this._label.text().replace(LABELSUFFIX, "");
            }
            return this;
        },
        say: function(text) {
            var that = this,
                textE = Crafty.e("2D, DOM, Text, Dialog")
                .text(text)
                .attr({
                    x: this.x - 125,
                    y: this.y - 20,
                    z: 401,
                    visible: false
                }),
                connector = Crafty.e("2D, DOM").css({
                background: "url(images/dialogConnector.png) 0 0"
            })
                .attr({
                    w: 32,
                    h: 32,
                    z: 402,
                    visible: false
                });

            textE.bind("Draw", function() {
                textE.unbind("Draw");
                Y.later(10, this, function() {                                  // Attach a little later so the font file has enough time to be loaded
                    textE.attr({
                        x: that.x - this._element.offsetWidth / 2 + 14,
                        y: that.y - this._element.offsetHeight - 10
                    }).visible = true;
                    connector.attr({
                        x: that.x + 10,
                        y: that.y - 19
                    }).visible = true;
                });
            });

            this.attach(textE);
            textE.attach(connector);

            Y.later(3500, textE, textE.destroy);                                // Destroy after 3.5 sec
            return textE;
        }
    });

    // Characters (self and others)
    Crafty.c('PlayerCharacter', {
        init: function() {
            this.requires('Character, Actor, Collision, PlayerSprite, SpriteAnimation, Tween')
                .collision([32, 32], [64, 48], [32, 64], [0, 48])               // Set up hit box
                .reel('PlayerMovingDown', 1000, 0, 2, 16)                       // Set up animations
                .reel('PlayerMovingUp', 1000, 0, 3, 16)
                .reel('PlayerMovingRight', 1000, 0, 0, 16)
                .reel('PlayerMovingLeft', 1000, 0, 1, 16)
                .bind('TweenEnd', function() {                                  // Whenever the player
                    this.pauseAnimation();
                    this.moveTo(this.targetMove.x, this.targetMove.y, this.targetMove.z);
                })
                .bind("EnterFrame", function() {
                    var z = 200, that = this;
                    Crafty("House").each(function() {                           // Reorder base on z positionning
                        if (that._y - 55 > this._y) {
                            z = Math.max(this._z + 1, z);
                        }
                    });
                    this.attr("z", z);
                });
        },
        moveTo: function(x, y, z) {
            Y.log("moveTo(" + x + ", " + y + ", " + z + ")", "info", "Player");
            var to, anim,
                targetPx = this.pos2px(x, y, z),
                targetCart = this.px2cart(targetPx),
                currentCart = this.px2cart({x: this.x, y: this.y, z: 0});

            this.targetMove = {x: x, y: y, z: z};                               // Save target

            if (targetCart.x - 2 > currentCart.x) {                             // Select direction
                targetCart.y = currentCart.y;
                anim = 'PlayerMovingRight';
            } else if (targetCart.x + 2 < currentCart.x) {
                targetCart.y = currentCart.y;
                anim = 'PlayerMovingLeft';
            } else if (targetCart.y - 2 > currentCart.y) {
                anim = 'PlayerMovingUp';
            } else if (targetCart.y + 2 < currentCart.y) {
                anim = 'PlayerMovingDown';
            } else {
                return this;                                                    // Player has reach its target, no need to continue
            }

            to = this.cart2px(targetCart);

            var dist = Math.sqrt(Crafty.math.squaredDistance(this.x, this.y, to.x, to.y)),
                time = Math.round((dist / TILEWIDTH) * (100 / SPEED)) + 1;      //+1 because if time = 0, time = infinite

            this.animate(anim, -1);                                             // Start animation
            this.tween(to, time * 20);                                          // Tween to next step

            return this;
        },
        moveAndNotify: function(x, y) {
            this.moveTo(x, y, 0);                                               // Move player and make sure it will open window
            Y.RedAgent.pusher.trigger("move", {
                x: x,
                y: y
            });
            return this;
        },
        pos2px: function(x, y, z) {
            return  {
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

    Crafty.c('PlayablePC', {//                                                  // This is the player-controlled character
        init: function() {
            this.screen = {x: 0, y: 0};
            this.requires('PlayerCharacter')
                .attr({z: 220})
                .onHit('House', function(data) {                                // Respond to this player visiting a house
                    if (!this.windowOpened) {
                        Y.log("onHit");
                        data[0].obj.openPage();
                        this.currentHouse = data[0].obj;
                        this.windowOpened = true;
                    }
                }, function() {
                    Y.log("onHit over");
                    this.windowOpened = false;
                    this.currentHouse.closePage();
                })                                                              // Collisions
                .bind("EnterFrame", function() {
                    var WMB = WIDTH - BORDER, WM2B = WIDTH - 2 * BORDER, //     // Scroll background
                        HMB = HEIGHT - BORDER, HM2B = HEIGHT - 2 * BORDER;

                    if (this.x + 32 > this.screen.x * WM2B + WMB && this.screen.x < MAXX) {
                        Crafty.viewport.pan(WM2B, 0, 1000);
                        this.screen.x++;
                    } else if (this.x + 32 < this.screen.x * WM2B + BORDER && this.screen.x > MINX) {
                        Crafty.viewport.pan(-WM2B, 0, 1000);
                        this.screen.x--;
                    }
                    if (this.y + 62 > this.screen.y * HM2B + HMB && this.screen.y < MAXY) {
                        Crafty.viewport.pan(0, HM2B, 1000);
                        this.screen.y++;
                    } else if (this.y + 62 < this.screen.y * HM2B + BORDER && this.screen.y > MINY) {
                        Crafty.viewport.pan(0, -HM2B, 1000);
                        this.screen.y--;
                    }
                });
        }
    });


    Crafty.c('GrayCharacter', {
        init: function() {
            this.requires('PlayerCharacter')
                .reel('PlayerMovingDown', 1000, 0, 6, 16)                       // Set up animations
                .reel('PlayerMovingUp', 1000, 0, 7, 16)
                .reel('PlayerMovingRight', 1000, 0, 4, 16)
                .reel('PlayerMovingLeft', 1000, 0, 5, 16);
        }
    });

    Crafty.c('NotPlayablePC', {//                                               // This is the player-controlled character
        init: function() {
            this.requires('PlayerCharacter');
        }
    });

    Crafty.c('House', {
        init: function() {
            this.requires('Actor, Mouse, Collision, BuildingSprite, SpriteAnimation')
                .attr({visible: false})
                .collision([22, 109], [65, 132], [108, 109], [65, 85])
                .areaMap([35, 109], [65, 123], [94, 108], [93, 50], [64, 34], [36, 50])
                .bind("Click", function() {
                    var p = Crafty.isometric.px2pos(this.x, this.y + 128);      // Whenever tile is clicked
                    Y.log("Clicked on house " + p.x + " " + p.y);

                    Crafty("PlayablePC").moveAndNotify(Math.round(p.x), Math.round(p.y), 0);// Move player and make sure it will open window
                    Crafty("PlayablePC").windowOpened && this.openPage();       // @hack force open if collision already occured
                })
                .bind("MouseOver", function() {
                    this.animate("Hover");                                      // Start animation
                })
                .bind("MouseOut", function() {
                    this.animate("Out");                                        // Start animation
                });

            Y.later(500, this, function() {
                this.visible = true;
                this.animate("Appear");                                         // Start animation
            });
        },
        setTargetPage: function(page) {
            var row = {contact: 0, projects: 1, blog: 2}[page];
            this.attr("targetPage", page);
            this.reel('Appear', 1000, 0, row, 24)
                .reel('Open', 900, 23, row, 21)
                .reel('Hover', 1000, 45, row, 1)
                .reel('Out', 1000, 22, row, 1);
            return this;
        },
        openPage: function() {
            this.animate("Open");
            this.opened = true;
            Y.later(900, this, function() {
                if (this.opened)
                    Y.RedAgent.controller.showPage(this.attr("targetPage"));
            });
            Y.later(3000, this, this.animate, "Out");
        },
        closePage: function() {
            Y.log("House.closePage();");
            this.opened = false;
            Y.RedAgent.controller.closePage();
        }
    });
});
