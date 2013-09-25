YUI.add("redagent-display", function(Y) {

    var Display, GRIDWIDTH = 10,
            TILEWIDTH = 64,
            ANIMATIONSPEED = 8,
            SPEED = 3,
            ISOCOS = Math.cos(0.46365),
            ISOSIN = Math.sin(0.46365);

    Display = Y.Base.create("redagent-display", Y.Widget, [], {
        CONTENT_TEMPLATE: '<div><div id="cr-stage"></div></div>',
        initializer: function() {
            this.players = {};
        },
        renderUI: function() {
            this.initCrafty();                                                  // Init crafty, sprites & components
            var x, y, tile;
            for (x = 12; x >= 0; x--) {                                         // Init grid
                for (y = 0; y < 37; y++) {
                    tile = Crafty.e("Tile")
                            .attr('z', x + 1 * y + 1)
                            .bind("Click", Y.bind(function(x, y) {              // Whenever tile is clicked
                        Y.log("clicked on tile:" + x, ", " + y);

                        //var pos = this.px2pos(e.realX, e.realY);
                        this.player.moveTo(x, y, 0);                            // Move player
                        Y.RedAgent.pusher.channel.trigger("client-move", {// Send websocket event
                            id: Y.RedAgent.pusher.channel.members.me.id,
                            x: x,
                            y: y
                        });
                    }, this, x, y));
                    this.iso.place(x, y, 0, tile);
                }
            }
            this.player = Crafty.e('PlayablePC')
                    .attr({x: 390, y: 250, z: 200});                            // Init player

            Crafty.e("House")                                                   // Init houses
                    .animate("Projects", ANIMATIONSPEED, 0)                     // Start animation
                    .attr({
                x: 390, y: 50, z: 200,
                targetPage: "Projects"
            });
            Crafty.e("House")                                                   // Init houses
                    .animate("Contact", ANIMATIONSPEED, 0)                     // Start animation
                    .attr({
                x: 110, y: 350, z: 200,
                targetPage: "Contact"
            })

            Crafty.e("Actor, BotSprite")                              // Init bot
                    .attr({x: 650, y: 400, z: 200});
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
            this.players[cfg.id] = entity;
            return entity;
        },
        initCrafty: function() {

            Crafty.init(800, 595);                                              // Init crafty
            //Crafty.init(GRIDSIZE * this.gridW, GRIDSIZE * this.gridH);

            this.iso = Crafty.isometric.size(TILEWIDTH);                        // Init isometric layout

            var renderMethod = 'DOM';                                           // Select rendering method
            if (Crafty.support.canvas) {
                Crafty.canvas.init();
                renderMethod = 'Canvas';
            }

            Crafty.sprite(64, 32, "images/sprite-tiles.png", {// Sprites
                TileSprite: [0, 0, 1, 1]
            });
            Crafty.sprite(64, "images/sprite-player.png", {
                PlayerSprite: [0, 0]
            });
            Crafty.sprite(64, "images/sprite-bot.png", {
                BotSprite: [0, 0]
            });
            Crafty.sprite(64, 128, 'images/sprite-building.png', {
                BuildingSprite: [0, 0]
            });

            Crafty.c('Actor', {// Components
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
                            .areaMap([32, 0], [64, 16], [64, 48], [32, 64], [0, 48], [0, 16])
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
                            //.fourway(4)
                            //.stopOnSolids()
                            .animate('PlayerMovingDown', 0, 2, 16)              // Set up animations
                            .animate('PlayerMovingUp', 0, 3, 16)
                            .animate('PlayerMovingRight', 0, 0, 16)
                            .animate('PlayerMovingLeft', 0, 1, 16);

                    this.bind('TweenEnd', function(e) {                         // Whenever the player
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

                    this.targetMove = {x: x, y: y, z: z};                       // Save target

                    if (targetCart.x - 2 > currentCart.x) {                     // Select direction
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
                        return this;                                            // Player has reach its target, no need to continue
                    }

                    to = this.cart2px(targetCart);
                    to = {
                        x: to.x + Crafty.viewport._x,
                        y: to.y + Crafty.viewport._y
                    };
                    var dist = Math.sqrt(Crafty.math.squaredDistance(this.x, this.y, to.x, to.y)),
                            time = Math.round(((dist / TILEWIDTH) * (100 / SPEED))) + 1; //+1 because if time = 0, time = infinite

                    this.animate(anim, ANIMATIONSPEED, -1);                     // Start animation
                    this.tween(to, time);                                       // Tween to next step
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
//                        x: ((v.x) / ISOCOS - (v.z + v.y) / ISOSIN) / 2,
//                        y: (-((v.x) / ISOCOS + (v.z + v.y) / ISOSIN)) / 2,
                        x: Math.round(((v.x) / ISOCOS - (v.y) / ISOSIN) / 2),
                        y: Math.round((-((v.x) / ISOCOS + (v.y) / ISOSIN)) / 2),
                        z: 0
                    };
                }
            });

            Crafty.c('PlayablePC', {// This is the player-controlled character
                init: function() {
                    this.requires('PlayerCharacter')
                            .onHit('House', this.visitHouse);                   // Collisions
                },
                visitHouse: function(data) {                                    // Respond to this player visiting a village
                    var pageSelector = data[0].obj.attr("targetPage");
                    if (!this.windowOpened) {
                        Y.RedAgent.controller.showPage(null, pageSelector);
                        this.windowOpened = true;
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
                    this.requires('Actor, SpriteAnimation, BuildingSprite')
                            .animate('Contact', 0, 0, 22)
                            .animate('Projects', 0, 1, 22);
                }
            });
        }
    });
    Y.namespace("RedAgent").Display = Display;

});
