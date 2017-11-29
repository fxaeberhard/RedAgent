/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */

var SPEED = 4.5

Crafty.c('Character', {
	init: function() {
		this.requires('Actor, Tween')
			.attr({ z: 200000 })
			.offset(0, -8)
	},

	label: function(label) {
		if (jQuery.type(label) === 'string') {
			var s = Crafty.viewport._scale
			if (!this._label) {
				this._label = Crafty.e('2D, DOM, Text, Label' + (this.has('PlayableCharacter') ? ', PCLabel' : ''))
					.attr({ x: this.x + 24, y: this.y + 60, z: 4900 })
					.textFont({ size: 0.9 / Crafty.viewport._scale + 'rem' })
					.css({
						'border-radius': 2 / s + 'px',
						padding: 0.2 / s + 'rem ' + (0.5 / s) + 'rem',
					})
				this.attach(this._label)
			}
			this._label.text(label)
		} else {
			return this._label ? this._label.text() : ''
		}
		return this
	},

	say: function(text) {
		var that = this,
			textE = Crafty.e('2D, DOM, Text, Dialog')
			.attr({ x: this.x - 125, y: this.y - 20, w: 270, z: 401, visible: false })
			.textFont({ size: 0.9 / Crafty.viewport._scale + 'rem' })
			.css({ padding: 0.3 / Crafty.viewport._scale + 'rem' }),
			connector = Crafty.e('2D, DOM, Connector')
			.attr({ w: 32, h: 32, z: 402, visible: false })

		textE.text(text)
		textE.bind('Draw', function() {
			textE.unbind('Draw')
			// Attach a little later so the font file has enough time to be loaded
			this.timeout(function() {
				textE.attr({
					x: that.x - this._element.offsetWidth / 2 + 14,
					y: that.y - this._element.offsetHeight - 10
				}).visible = true
				connector.attr({ x: that.x + 10, y: that.y - 19 }).visible = true
			}, 10)
		})

		this.attach(textE)
		textE.attach(connector)

		// Destroy after 3.5 sec
		this.timeout(function() {
			textE.destroy()
		}, 3500)
		return textE
	}
})

/**
 * Characters (self and others)
 */
Crafty.c('PlayerCharacter', {
	init: function() {
		var countdown = 0
		this.requires('Character, PlayerSprite, SpriteAnimation, Movable') //Collision
			//.collision([32, 32, 64, 48, 32, 64, 0, 48]) // Set up hit box
			.offset(0, -8)
			.reel('Down', 1000, 0, 2, 16) // Set up animations
			.reel('Up', 1000, 0, 3, 16)
			.reel('Right', 1000, 0, 0, 16)
			.reel('Left', 1000, 0, 1, 16)
			.bind('EnterFrame', function() {

				if (countdown > 0) {
					countdown--
					return
				}
				countdown = 10

				var z = 200000,
					that = this

				// // Reorder base on z positionning
				Crafty('House').each(function() {
					if (that._y - 55 > this._y) {
						// z = Math.max(this._z + 1, z)
						z = this.z + 1
					}
				})
				this.attr('z', z)
			})
	}
})

/**
 *
 */

Crafty.c('Movable', {
	init: function() {
		this.requires('Tween')
			.bind('TweenEnd', function() { // Whenever the player
				if (this._target)
					this.moveLineStep()
			})
			.bind('MoveLineEnd', this.movePath)
	},

	moveTo: function(target) {
		var current = this.position(),
			data = _.times(200, function(i) {
				return _.times(200, function(j) {
					var e = Game.entitiesMap[current.x - 100 + i][current.y - 100 + j]
					return e ? 0 : 1
				})
			}),
			// data = Game.entitiesMap.map(function(i) {
			// 	return i.map(function(j) { return j ? 0 : 1; })
			// })
			graph = new Graph(data),
			start = graph.grid[100][100],
			end = graph.grid[target.x - current.x + 100][target.y - current.y + 100]
		// start = graph.grid[current.x][current.y],
		// end = graph.grid[target.x][target.y]

		this._path = astar.search(graph, start, end) // result is an array containing the shortest path
		// this._path = astar.search(graphDiagonal, start, end, { heuristic: astar.heuristics.diagonal });

		_.each(this._path, function(t) {
			t.x += current.x - 100
			t.y += current.y - 100
		})
		return this.movePath()
	},

	movePath: function() {
		// console.log("movePath()");
		var t = this._path.shift();
		if (!t)
			return this.pauseAnimation().trigger('MoveEnd')
		else
			return this.selectAnim(t).moveLine(t)
	},

	selectAnim: function(target) {
		// console.log("selectAnim()")
		var anim, current = this.position()

		if (target.x > current.x)
			anim = 'Down'
		else if (target.x < current.x)
			anim = 'Up'
		else if (target.y > current.y)
			anim = 'Right'
		else if (target.y < current.y)
			anim = 'Left'

		if (!this.isPlaying(anim)) this.animate(anim, -1) // Start animation
		return this
	},

	moveLine: function(target) {
		// console.log("moveLine()");
		this._target = target
		return this.moveLineStep()
	},

	moveLineStep: function() {
		// console.log("moveLineStep()", this._target.x, this._target.y);
		var to, current = this.position()

		// Select direction
		if (this._target.x !== current.x) {
			to = { x: current.x - Math.sign(current.x - this._target.x), y: current.y }
		} else if (this._target.y !== current.y) {
			to = { x: current.x, y: current.y - Math.sign(current.y - this._target.y) }
		} else {
			// Player has reach its target, no need to continue
			// return this.pauseAnimation().trigger('MoveLineEnd')
			return this.trigger('MoveLineEnd')
		}

		to = Crafty.iso.pos2px(to.x, to.y)
		to.y -= 8

		var dist = Math.sqrt(Crafty.math.squaredDistance(this.x, this.y, to.x, to.y)),
			time = Math.round((dist / Crafty.iso._tile.width) * (100 / SPEED)) + 1 //+1 because if time = 0, time = infinite

		return this.tween(to, time * 20) // Tween to next step
	},

	// Move player and make sure it will open window
	moveAndNotify: function(x, y, src) {
		this.moveTo({ x: x, y: y })
			.clickedOn = src

		Net.trigger('move', { x: x, y: y })

		return this
	}
})


/**
 * This is the player-controlled character
 */
Crafty.c('PlayableCharacter', {
	init: function() {
		this.screen = { x: 0, y: 0 }
		this.requires('PlayerCharacter')
			.bind('TweenEnd', function() {
				var p = this.position()
				Game.loadTilesAround(p.x, p.y)
			})
			.bind('MoveEnd', function() {
				// If we're heading to a clickable object
				if (this.clickedOn) this.clickedOn.trigger('Interact')
				// @hack
				$('body').removeClass('nocursor')
			})

		// .attr({ z: 220 })
		// .onHit('House', function(data) { // Respond to this player visiting a house
		//   if (!this.windowOpened) {
		//     data[0].obj.openPage()
		//     this.currentHouse = data[0].obj
		//     this.windowOpened = true
		//   }
		// }, function() {
		//   this.windowOpened = false
		//   this.currentHouse.closePage()
		// })
		/* Make viewport pan on edges */
		// .bind('MoveEnd', function() {
		//   // If we're heading to a clickable object
		//   this.clickedOn && this.clickedOn.openPage()
		//   // Scroll background
		//   var WMB = WIDTH - BORDER,
		//     WM2B = WIDTH - 2 * BORDER, //
		//     HMB = HEIGHT - BORDER,
		//     HM2B = HEIGHT - 2 * BORDER
		//   if (this.x + 32 > this.screen.x * WM2B + WMB && this.screen.x < MAXX) {
		//     Crafty.viewport.pan(WM2B, 0, 1000)
		//     this.screen.x++
		//   } else if (this.x + 32 < this.screen.x * WM2B + BORDER && this.screen.x > MINX) {
		//     Crafty.viewport.pan(-WM2B, 0, 1000)
		//     this.screen.x--
		//   } else if (this.y + 62 > this.screen.y * HM2B + HMB && this.screen.y < MAXY) {
		//     Crafty.viewport.pan(0, HM2B, 1000)
		//     this.screen.y++
		//   } else if (this.y + 62 < this.screen.y * HM2B + BORDER && this.screen.y > MINY) {
		//     Crafty.viewport.pan(0, -HM2B, 1000)
		//     this.screen.y--
		//   }
		//   Game.loadTiles(this.screen.x, this.screen.y)
		// })Crafty.viewport.follow(this, 0, 0)
	}
})

Crafty.c('GrayCharacter', {
	init: function() {
		this.requires('Character, PlayerSprite, SpriteAnimation')
			.reel('Down', 1000, 0, 6, 16) // Set up animations
			.reel('Up', 1000, 0, 7, 16)
			.reel('Right', 1000, 0, 4, 16)
			.reel('Left', 1000, 0, 5, 16)
	}
})
