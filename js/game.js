/**
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
/* exported Game */
var Game = (function($) {
	var tilesMap = [],
		objectsMap = [],
		entitiesMap = [],
		state = {
			quests: Crafty.quests,
		}

	var Game = {
		players: {},
		entitiesMap: entitiesMap,
		init: function() {

			// Init crafty
			Crafty.init()
			document.body.style.overflow = "auto" //@hack
			Crafty.iso = iso = Crafty.diamondIso.init(64, 32, 700, 700)
			Crafty.viewport.clampToEntities = false

			for (var x = 0; x < iso._map.width; x++) {
				// tilesMap[x] = _.times(iso._map.height, _.constant(null))
				// objectsMap[x] = _.times(iso._map.height, _.constant(null))
				tilesMap[x] = _.fill(Array(iso._map.height), null)
				objectsMap[x] = _.fill(Array(iso._map.height), null)
				entitiesMap[x] = _.fill(Array(iso._map.height), null)
			}


			// Init player
			var player = Crafty.e('PlayableCharacter')
				.placeAt(500, 500)
				.label('')

			// player.animate('Up', -1)

			// Crafty.viewport.centerOn(player, 0, 0)
			Crafty.viewport.follow(player, 0, 0)
			// setTimeout(function() {
			// Crafty.viewport.followEdge(player, 0, 0, 100, 100)
			// })
			// player._label.css({ cursor: 'text' })

			// Make current player label editable
			$(player._label._element).editable({
				onblur: function(value) {
					player.label(value)
					$.cookie('chatname', value, { expires: 10 })
					Net.trigger('rename', { name: value })
					return value
				}
			})

			Crafty.objects.forEach(function(o) {
				var x = o.pos[0],
					y = o.pos[1]
				objectsMap[x][y] = o.init
				if (o.boot) o.boot()
			})

			// Init tiles
			Game.loadTilesAround(500, 500, 6, 0.8)
			// Game.loadTiles(0, 0)

			// function updateScale() {
			// 	var ratio = Math.min(1, $(window).width() / WIDTH)
			// 	Crafty.viewport.scale(ratio)
			// 	$('#cr-stage').css({ width: WIDTH * ratio, height: HEIGHT * ratio, 'padding-bottom': 0 })
			// }
			// updateScale()
			// $(window).resize(updateScale)

			// Introduction text by the bot
			// var firstmsg = 'Welcome on Francois-Xavier\'s portfolio.',
			// 	secmsg = 'It appears there\'s only the two of us on this page at the moment. Feel free to look around and ask me if you have any question.'
			// setTimeout(function() {
			// 	Game.say('bot', firstmsg)
			// }, 2000)
			// setTimeout(function() {
			// 	Game.say('bot', secmsg)
			// }, 4000)
		},
		loadTilesAround: function load(x, y, radius, delay) {
			if (x instanceof Object) return Game.loadTilesAround(x.x, x.y, y, radius)

			radius = radius || 6
			var c = 0
			for (var i = x - radius; i < x + radius + 1; i++) {
				for (var j = y - radius; j < y + radius + 1; j++) {
					// if (!iso.getTile(i, j, 0)) {
					if (!tilesMap[i][j]) {
						tilesMap[i][j] = true
						setTimeout(Game.loadTile.bind(null, i, j), c * (delay || 30))
						c++
					}
				}
			}
		},
		loadTile: function(x, y) {
			Crafty.e('Tile')
				.place(x, y)
				.randomSprite()
				.attr({ alpha: 0 })
				.tween({ alpha: 1.0 }, 300)

			var o = objectsMap[x][y]
			if (o) o()

			var e = entitiesMap[x][y]
			if (e) {
				e.visible = true
				if (e.tween)
					e.attr({ alpha: 0 })
					.tween({ alpha: 1.0 }, 300)
			}
		},
		getPlayer: function(id) {
			return Game.players[id]
		},
		eval: function(code, emitEvent) {
			var ret
			with(state) { // jshint ignore:line
				ret = eval(code) // jshint ignore:line
			}
			if (emitEvent) Crafty.trigger('StateUpdate', state)
			console.log("code ", code, ret)
			return ret
		},
		/**
		 * Init player
		 */
		addPlayer: function(cfg) {
			var p = Crafty.e('PlayerCharacter').attr({ x: -100, y: -100, z: 200 })
			Game.players[cfg.id] = p
			return p
		},
		say: function(id, msg) {
			var p = Game.getPlayer(id)
			p.say(msg)
			Chat.chat(p.label(), msg) // display it in the chat
		}
	}

	/**
	 * Sprites
	 */
	Crafty.sprite(64, 'assets/images/sprite-game.png', {
		PlayerSprite: [0, 0],
		BotSprite: [17, 2],
		WarningSprite: [18, 2],
		ArrowSprite: [18, 3]
	})
	Crafty.sprite(32, 'assets/images/sprite-game.png', {
		CursorSprite: [0, 0]
	})
	Crafty.sprite(64, 32, 'assets/images/sprite-game.png', {
		TileSprite: [17, 0, 1, 1]
	})
	Crafty.sprite(128, 128, 'assets/images/sprite-building.png', {
		BuildingSprite: [0, 0]
	})

	/**
	 * Sounds
	 */


	/**
	 * Crafty components
	 */
	Crafty.c('Actor', {
		init: function() {
			// Select rendering method
			this.requires('2D ' + Crafty.support.canvas ? 'Canvas' : 'DOM')
			this._offset = { x: 0, y: 0 }
			// this.z = 20000
		},
		placeAt: function(x, y) {
			var pos = Crafty.iso.pos2px(x, y)
			this.x = pos.x + this._offset.x
			this.y = pos.y + this._offset.y
			this.z = 20000
			if (!this.has("PlayableCharacter")) {
				entitiesMap[x][y] = this
				this.visible = tilesMap[x][y]
			}
			return this
		},
		position: function() {
			var p = Crafty.iso.px2pos(this.x - this._offset.x, this.y - this._offset.y)
			p.x++
				return p
		},
		offset: function(x, y) {
			this._offset = { x: x, y: y }
			return this
		}
	})

	Crafty.c('Interactable', {
		init: function() {
			this.requires('Mouse')
				.bind('Click', function() {
					// Whenever object is clicked, move player (PlayableCharacter handles triggering of event)
					var p = this.position()
					console.log("Click on p:", p)
					Crafty('PlayableCharacter').moveAndNotify(p.x + 1, p.y, this)
				})
		}
	})

	Game.state = state

	return Game
}(jQuery))
