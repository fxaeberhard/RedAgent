/*
 * Red agent
 * http://www.red-agent.com/wallogram
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI.add("redagent-display", function(Y) {

    var Display, TILEWIDTH = 64,
        SPEED = 4.5,
        ISOCOS = Math.cos(0.46365), ISOSIN = Math.sin(0.46365),
        WIDTH = 800, HEIGHT = 595, BORDER = 50;

    Display = Y.Base.create("redagent-display", Y.Widget, [], {
        CONTENT_TEMPLATE: '<div><div id="cr-stage"></div></div>',
        initializer: function() {
            this.players = {};
        },
        renderUI: function() {
            Crafty.init(WIDTH, HEIGHT);                                         // Init crafty
            Crafty.isometric.size(TILEWIDTH);                                   // Init isometric layout
            Crafty.support.canvas && Crafty.canvas.init();                      // Init canvas if available

            var x, y, tile;
            for (x = 22; x >= 0; x--) {                                         // Init grid
                for (y = 0; y < 37; y++) {
                    tile = Crafty.e("Tile").attr('z', x + 1 * y + 1);
                    Crafty.isometric.place(x, y, 0, tile);
                    tile.randomSprite();
                }
            }

            this.player = Crafty.e('PlayablePC')
                .attr({x: 390, y: 250, z: 200})
                .label("");                                                     // Init player

            var that = this;
            this.player._label.css({cursor: "text"});
            $(this.player._label._element).editable(function(value) {           // Make current player label editable
                that.player.label(value + " <em>(me)</em>");
                $.cookie("chatname", value, {expires: 10});
                Y.RedAgent.pusher.trigger("rename", {
                    name: value
                });
                return value;
            }, {
                indicator: 'Saving...',
                tooltip: 'Click to edit...',
                width: 80,
                select: true,
                onblur: "submit",
                data: function(value) {
                    return value.replace(" <em>(me)</em>", '');
                }
            });

            var h = Crafty.e("House").setTargetPage("projects").attr({z: 210}); // Init houses
            Crafty.isometric.place(5.5, 3.2, 0, h);
            h = Crafty.e("House").setTargetPage("contact").attr({z: 220});
            Crafty.isometric.place(0.5, 21.2, 0, h);
            h = Crafty.e("House").setTargetPage("blog").attr({z: 220});
            Crafty.isometric.place(16.5, 14.2, 0, h);

            this.bot = Crafty.e("Actor, Character, BotSprite")                  // Init bot
                .attr({x: 570, y: 400, z: 200})
                .label("Red agent");
        },
        getPlayer: function(id) {
            if (id === "You") {
                return this.player;
            } else if (id === "Red agent") {
                return this.bot;
            } else {
                return this.players[id];
            }
        },
        addPlayer: function(cfg) {
            Y.log("addPlayer()", "info", "RedAgent.Display");
            var entity = Crafty.e('NotPlayablePC')
                .attr({x: -100, y: -100, z: 200});                              // Init player

            this.players[cfg.id] = entity;
            return entity;
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
                pos = JSON.stringify(Crafty.isometric.px2pos(this.x, this.y)),
                path = [{x: 6, y: 9}, {x: 7, y: 10}, {x: 7, y: 11}, {x: 8, y: 12}, {x: 8, y: 13}, {x: 9, y: 14}, {x: 9, y: 15}, {x: 10, y: 16}, {x: 10, y: 17}, {x: 11, y: 18}, {x: 11, y: 19}, {x: 12, y: 20}, {x: 12, y: 21}, {x: 13, y: 22}, {x: 13, y: 23}, {x: 14, y: 24}, {x: 14, y: 25},
                    {x: 15, y: 24}, {x: 15, y: 23}, {x: 16, y: 22}, {x: 16, y: 21}, {x: 17, y: 20},
                    {x: 10, y: 18}, {x: 9, y: 19}, {x: 9, y: 20}, {x: 8, y: 21}, {x: 8, y: 22}, {x: 7, y: 23}, {x: 7, y: 24}, {x: 6, y: 25}, {x: 6, y: 26}, {x: 5, y: 27}, {x: 5, y: 28}, {x: 4, y: 29}, {x: 4, y: 30}, {x: 3, y: 31},
                    {x: 3, y: 30}, {x: 2, y: 29}, {x: 2, y: 28}, {x: 1, y: 27}];

            if ($.grep(path, function(i) {
                return pos !== JSON.stringify(i);
            }, this).length) {
                this.__sprite = [1, 2, 1, 1];                                   // light gray path
            } else if (r > 0.10) {
                this.__sprite = [1, 0, 1, 1];                                   // white
            } else if (r > 0.05) {
                this.__sprite = [0, 2, 1, 1];                                   // gray
            } else {
                this.__sprite = [0, 0, 1, 1];                                   // red
            }
            this.resetSprite();
            return this;
        },
        resetSprite: function() {
            this.sprite.apply(this, this.__sprite);
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
                this._label.text(label);
            } else {
                return this._label.text().replace(" <em>(me)</em>", "");
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
            }).attr({
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
        at: function(x, y, z) {
            Y.log("Player.at(" + x + ", " + y + ")");
            var pos = this.pos2px(x, y, z);
            this.attr({x: pos.x, y: pos.x}).z += z;
            return this;
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
                .onHit('House', function(data) {                                // Respond to this player visiting a house
                    if (!this.windowOpened) {
                        Y.log("onHit");
                        data[0].obj.openTargetPage();
                        this.windowOpened = true;
                    }
                }, function() {
                    Y.log("onHit over");
                    this.windowOpened = false;
                })                                                              // Collisions
                .bind("EnterFrame", function() {
                    var WMB = WIDTH - BORDER, WM2B = WIDTH - 2 * BORDER, //     // Scroll background
                        MAXX = 1, MINX = 0;
                    if (this.x + 32 > this.screen.x * WM2B + WMB && this.screen.x < MAXX) {
                        Crafty.viewport.pan(WM2B, 0, 1000);
                        this.screen.x++;
                    } else if (this.x + 32 < this.screen.x * WM2B + BORDER && this.screen.x > MINX) {
                        Crafty.viewport.pan(-WM2B, 0, 1000);
                        this.screen.x--;
                    }
                });
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
                    Crafty("PlayablePC").windowOpened && this.openTargetPage(); // @hack force open if collision already occured
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
            var rows = {contact: 0, projects: 1, blog: 2},
            row = rows[page];
            this.attr("targetPage", page);
            this.reel('Appear', 1000, 0, row, 24)
                .reel('Open', 900, 23, row, 21)
                .reel('Hover', 1000, 45, row, 1)
                .reel('Out', 1000, 22, row, 1);
            return this;
        },
        openTargetPage: function() {
            this.animate("Open");
            Y.later(900, Y.RedAgent.controller, Y.RedAgent.controller.showPage, this.attr("targetPage"));
            Y.later(3000, this, this.animate, "Out");
        }
    });
});
