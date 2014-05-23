/*
 * Red agent
 * http://www.red-agent.com/wallogram
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
YUI.add("redagent-display", function(Y) {

    var Display, TILEWIDTH = 64,
            ANIMATIONSPEED = 8,
            SPEED = 4.5,
            ISOCOS = Math.cos(0.46365),
            ISOSIN = Math.sin(0.46365),
            renderMethod = Crafty.support.canvas ? "Canvas" : 'DOM';            // Select rendering method

    Display = Y.Base.create("redagent-display", Y.Widget, [], {
        CONTENT_TEMPLATE: '<div><div id="cr-stage"></div></div>',
        initializer: function() {
            this.players = {};
        },
        renderUI: function() {
            Crafty.init(800, 595);                                              // Init crafty

            this.iso = Crafty.isometric.size(TILEWIDTH);                        // Init isometric layout

            if (Crafty.support.canvas) {
                Crafty.canvas.init();
            }

            var x, y, tile;
            for (x = 12; x >= 0; x--) {                                         // Init grid
                for (y = 0; y < 37; y++) {
                    tile = Crafty.e("Tile")
                            .attr('z', x + 1 * y + 1)
                            .bind("Click", Y.bind(function(x, y) {              // Whenever tile is clicked
                                Y.log("clicked on tile:" + x, ", " + y);
                                this.player.moveTo(x, y, 0);                    // Move player
                                Y.RedAgent.pusher.channel.trigger("client-move", {
                                    id: Y.RedAgent.pusher.channel.members.me.id,
                                    x: x,
                                    y: y
                                });                                             // Send websocket event
                            }, this, x, y));
                    this.iso.place(x, y, 0, tile);
                }
            }
            this.player = Crafty.e('PlayablePC')
                    .attr({x: 390, y: 250, z: 200});                            // Init player

            this.addLabel(this.player, "You");                                  // Add label to current player

            Crafty.e("House")                                                   // Init houses
                    .attr({
                        x: 384, y: 52, z: 210,
                        targetPage: "Projects"
                    });
            Crafty.e("House")                                                   // Init houses
                    .attr({
                        x: 64, y: 339, z: 220,
                        targetPage: "Contact"
                    });

            this.bot = Crafty.e("Actor, BotSprite")                             // Init bot
                    .attr({x: 650, y: 400, z: 200});
            this.addLabel(this.bot, "Red agent").css({"width": "5.1em"});
        },
        bindUI: function() {
            // Move map on click
            //Crafty.addEvent(this, Crafty.stage.elem, "mousedown", function(e) {
            //    if (e.button > 1)
            //        return;
            //    return;
            //    var base = {x: e.clientX, y: e.clientY};
            //
            //    function scroll(e) {
            //        var dx = base.x - e.clientX,
            //                dy = base.y - e.clientY;
            //        base = {x: e.clientX, y: e.clientY};
            //        Crafty.viewport.x -= dx;
            //        Crafty.viewport.y -= dy;
            //    }
            //
            //    Crafty.addEvent(this, Crafty.stage.elem, "mousemove", scroll);
            //    Crafty.addEvent(this, Crafty.stage.elem, "mouseup", function() {
            //        Crafty.removeEvent(this, Crafty.stage.elem, "mousemove", scroll);
            //    });
            //});
        },
        getPlayer: function(id) {
            return this.players[id];
        },
        addPlayer: function(cfg) {
            Y.log("addPlayer()", "info", "RedAgent.Display");
            var entity = Crafty.e('NotPlayablePC')
                    .attr({x: 400, y: 200, z: 200});                           // Init player
            this.addLabel(entity, "Anonymous");

            this.players[cfg.id] = entity;
            return entity;
        },
        addLabel: function(entity, label) {
            var text = Crafty.e("2D, DOM, Text");
            text.text(label)
                    .attr({x: entity.x + 24, y: entity.y + 60, z: 400})
                    .css({"text-align": "center", "background-color": "rgba(128, 128, 128, 0.7)",
                        "color": "white", "border-radius": "2px", "line-height": "1.3em",
                        "padding": "0.2em 0.5em"
                    });
            entity.attach(text);
            return text;
        },
        say: function(entity, text) {
            if (entity === "You") {
                entity = this.player;
            } else if (entity === "Red agent") {
                entity = this.bot;
            } else {
                entity = this.getPlayer(entity);
            }

            var textE = Crafty.e("2D, DOM, Text")
                    .text(text)
                    .attr({
                        x: entity.x - 125,
                        y: entity.y - 20,
                        z: 401,
                        visible: false
                    })
                    .css({"background-color": "white", "color": "#580000",
                        "border": "1px solid #580000", "line-height": "1.1em",
                        "font-size": "0.9em", "padding": "0.4em",
                        "width": "12em", visibility: "hidden"  //"max-width": "20em"
                    }),
                    connector = Crafty.e("2D, DOM").css({
                background: "url(images/dialogConnector.png) 0 0",
                width: "32px",
                height: "32px",
                visibility: "hidden"
            }).attr({
                z: 402,
                visible: false
            });

            textE.bind("Draw", function() {
                this.unbind("Draw");
                Y.later(10, this, function() { // Attach a little later so the font file has enough time to be loaded
                    this.attr({
                        x: entity.x - (this._element.offsetWidth / 2) + 14,
                        y: entity.y - this._element.offsetHeight - 10
                    });
                    connector.attr({
                        x: entity.x + 10,
                        y: entity.y - 19
                    });
                    this.visible = true;
                    connector.visible = true;
                });
            });

            entity.attach(textE);
            textE.attach(connector);

            Y.later(3500, textE, textE.destroy);                                // Destroy after 3.5 sec
            return textE;
        }
    });
    Y.namespace("RedAgent").Display = Display;

    // Crafty sprites 
    Crafty.sprite(64, 32, "images/sprite-tiles.png", {// Sprites
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
            this.requires('2D, ' + renderMethod);
        }
    });
    Crafty.c("Tile", {
        init: function() {
            var r = Math.random();
            if (r > 0.15) {
                this.color = "white";
            } else if (r > 0.04) {
                this.color = "gray";
            } else {
                this.color = "red";
            }
            this.requires('Actor, TileSprite, Mouse')
                    .areaMap([32, 0], [64, 16], [32, 32], [0, 16])
                    .bind("MouseOver", this.hover)
                    .bind("MouseOut", this.normal);

            this.normal();
        },
        hover: function() {
            if (this.color === "red")
                this.sprite(1, 0, 1, 1);
            else
                this.sprite(0, 0, 1, 1);
        },
        normal: function() {
            if (this.color === "white")
                this.sprite(1, 0, 1, 1);
            else if (this.color === "red")
                this.sprite(0, 0, 1, 1);
            else
                this.sprite(0, 2, 1, 1);
        }
    });
    Crafty.c('PlayerCharacter', {// Main characters (self and others)
        init: function() {
            this.requires('Actor, Collision, PlayerSprite, SpriteAnimation, Tween')
                    .collision([32, 32], [64, 48], [32, 64], [0, 48])            // Set up hit box
                    .animate('PlayerMovingDown', 0, 2, 16)                      // Set up animations
                    .animate('PlayerMovingUp', 0, 3, 16)
                    .animate('PlayerMovingRight', 0, 0, 16)
                    .animate('PlayerMovingLeft', 0, 1, 16);

            this.bind('TweenEnd', function(e) {                                 // Whenever the player
                this.stop();
                this.moveTo(this.targetMove.x, this.targetMove.y, this.targetMove.z);
            });
        },
        at: function(x, y, z) {
            Y.log("Player.at(" + x + ", " + y + ")");
            var pos = this.pos2px(x, y, z);
            this.attr({x: pos.x + Crafty.viewport._x, y: pos.x + Crafty.viewport._y}).z += z;
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
            to = {
                x: to.x + Crafty.viewport._x,
                y: to.y + Crafty.viewport._y
            };
            var dist = Math.sqrt(Crafty.math.squaredDistance(this.x, this.y, to.x, to.y)),
                    time = Math.round(((dist / TILEWIDTH) * (100 / SPEED))) + 1; //+1 because if time = 0, time = infinite

            this.animate(anim, ANIMATIONSPEED, -1);                             // Start animation
            this.tween(to, time);                                               // Tween to next step
            //this.attr(to);

            return this;
        },
        pos2px: function(x, y, z) {
            return  {
                x: x * 64 + (y & 1) * (64 / 2),
                y: (y * 64 / 4) - 32 - 5
            };
        },
        cart2px: function(v) {
            return {
                x: ((v.x - v.y) * ISOCOS),
                y: (-(v.z + (v.x + v.y) * ISOSIN))
            };
        },
        px2cart: function(v) {
            return {
                x: Math.round(((v.x) / ISOCOS - (v.y) / ISOSIN) / 2),
                y: Math.round((-((v.x) / ISOCOS + (v.y) / ISOSIN)) / 2),
                z: 0
            };
        }
    });

    Crafty.c('PlayablePC', {// This is the player-controlled character
        init: function() {
            this.requires('PlayerCharacter'/*+ " SolidHitBox"*/)
                    .onHit('House', this.visitHouse, function() {
                        Y.log("onHit over");
                        this.windowOpened = false;
                    })                                                          // Collisions
                    .bind("EnterFrame", function() {
                        var z = 200, that = this;
                        Crafty("House").each(function(i, h, h) {
                            if (that._y - 55 > this._y) {
                                z = Math.max(this._z + 1, z);
                            }
                        });
                        this.attr("z", z);
                    });
        },
        visitHouse: function(data) {                                            // Respond to this player visiting a village
            var pageSelector = data[0].obj.attr("targetPage");
            if (!this.windowOpened) {
                Y.log("onHit");
                data[0].obj.animate(pageSelector + "Open", ANIMATIONSPEED, 0);
                this.windowOpened = true;
                Y.later(900, this, function() {
                    Y.RedAgent.controller.showPage(null, pageSelector);
                });

                Y.later(3000, this, function() {
                    data[0].obj.animate(pageSelector + "Out", ANIMATIONSPEED, 0);
                });
            }
        }
    });
    Crafty.c('NotPlayablePC', {// This is the player-controlled character
        init: function() {
            this.requires('PlayerCharacter');
        }
    });
    Crafty.c('House', {
        init: function() {
            this.requires('Actor, Mouse, Collision, SpriteAnimation, BuildingSprite' /*+ " SolidHitBox"*/)
                    .attr({visible: false})
                    .animate('Contact', 0, 0, 22)
                    .animate('ContactOpen', 23, 0, 44)
                    .animate('ContactHover', 45, 0, 45)
                    .animate('ContactOut', 22, 0, 22)
                    .animate('Projects', 0, 1, 22)
                    .animate('ProjectsOpen', 23, 1, 44)
                    .animate('ProjectsHover', 45, 1, 45)
                    .animate('ProjectsOut', 22, 1, 22)
                    .collision([22, 109], [65, 132], [108, 109], [65, 85])
                    .areaMap([35, 109], [65, 123], [94, 108], [93, 50], [64, 34], [36, 50])
                    .bind("Click", function() {                                 // Whenever tile is clicked
                        Y.log("Clicked on house:" + x, ", " + y);
                        var x, y;
                        if (this.attr("targetPage") === "Projects") {
                            x = 6;
                            y = 11;
                        } else {
                            x = 1;
                            y = 29;
                        }
                        Crafty("PlayablePC").moveTo(x, y, 0);                    // Move player
                        Y.RedAgent.pusher.channel.trigger("client-move", {
                            id: Y.RedAgent.pusher.channel.members.me.id,
                            x: x,
                            y: y
                        });                                             // Send websocket event
                    })
                    .bind("MouseOver", function() {
                        this.animate(this.attr("targetPage") + "Hover", ANIMATIONSPEED, 0);           // Start animation

                    })
                    .bind("MouseOut", function() {
                        this.animate(this.attr("targetPage") + "Out", ANIMATIONSPEED, 0);           // Start animation
                    });

            Y.later(500, this, function() {
                this.visible = true;
                this.animate(this.attr("targetPage"), ANIMATIONSPEED, 0);           // Start animation
            });
        }
    });
});
