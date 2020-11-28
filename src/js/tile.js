/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
var tiles = {
		lightgray: [
			[500, 505], [501, 505], [502, 505], [503, 505], [504, 505], [504, 504], [504, 503], [504, 502], [504, 501], [504, 500], [504, 499], [504, 498], [504, 497], //
			[498, 497], [499, 497], [500, 497], [501, 497], [502, 497], [503, 497], //
			[505, 497], [506, 497], [507, 497], [508, 497], [508, 496], [508, 495], [508, 494], [508, 493], [508, 492], //path
			[483, 483], [483, 482], [484, 482], [484, 483], [487, 481], [487, 482], [487, 483], [487, 484], [488, 481], [488, 482], [488, 483], [488, 484], [489, 481],
			[489, 482], [489, 483], [489, 484], [490, 481], [490, 482], [490, 483], [490, 484] // agent
		],
		// [[6, 9], [7, 10], [7, 11], [8, 12], [8, 13], [9, 14], [9, 15], [10, 16],
		//       [10, 17], [11, 18], [11, 19], [12, 20], [12, 21], [13, 22], [13, 23], [14, 24],
		//       [14, 25], [15, 24], [15, 23], [16, 22], [16, 21], [17, 20], [10, 18], [9, 19], [9, 20],
		//       [8, 21], [8, 22], [7, 23], [7, 24], [6, 25], [6, 26], [5, 27], [5, 28], //
		//       [4, 29], [4, 30], [3, 31], [3, 30], [2, 29], [2, 28], [1, 27], [6, -8], //
		//       [6, -9], [7, -10], [7, -11],
		//       //top guys
		//       [5, -9], [6, -10], [6, -11], [7, -12], [5, -10], [5, -11], [6, -12], [6, -13], [4, -11],
		//        [5, -12], [5, -13], [6, -14], [3, -16], [3, -17], [3, -15], [4, -16]
		//       // head
		//       ],
		red: [
			// [0, -17], [1, -16], [1, -15], [2, -14], [2, -13], [3, -12], [3, -11], [4, -10], [4, -9], [5, -8], [5, -7], [6, -6], [6, -5], [7, -4], [7, -3], [7, -2], [6, -1],
			// [6, 0], [6, -7], [7, -8], [7, -9], [8, -10], [4, -12], [4, -13], [5, -14], [5, -15], [6, -16], [6, -15], [7, -14], [7, -13],
			// [8, -12], [8, -11], [9, -10], [9, -9], [10, -8], [10, -9], [11, -10], [1, -11], [4, -14], [4, -15], [3, -14], [2, -15], [4, -17], [4, -18], [2, -17], [3, -18], // head
			// [500, 483], [501, 484], [501, 485], [502, 486], [502, 487], [503, 488], [503, 489], [504, 490], [504, 491], [505, 492], [505, 493], [506, 494], [506, 495], [507, 496], [507, 497], [507, 498],
			// [506, 499], [506, 500], [506, 493], [507, 492], [507, 491], [508, 490], [504, 488], [504, 487], [505, 486], [505, 485], [506, 484], [506, 485], [507, 486], [507, 487], [508, 488], [508, 489],
			// [509, 490], [509, 491], [510, 492], [510, 491], [511, 490], [501, 489], [504, 486], [504, 485], [503, 486], [502, 485], [504, 483], [504, 482], [502, 483], [503, 482]
			[494, 488], [494, 487], [494, 486], [494, 485], [493, 485], [492, 485], [491, 485], [490, 485], [489, 485], [488, 485], [487, 485], [486, 485], [485, 485], [484, 485], [483, 485], [482, 485], [481, 485], [480, 485], [491, 484], [491, 483], [491, 482], [491, 481], [491, 480], [492, 480], [494, 480], [494, 479], [494, 478], [493, 480], [494, 477], [490, 480], [489, 480], [488, 480], [487, 480], [486, 480], [486, 481], [486, 482], [486, 483], [486, 484], [485, 483], [485, 482], [484, 484], [483, 484], [482, 483], [482, 482], [483, 481], [484, 481]
		]
	},
	tilesMap = {}

// Build tiles map
$.each(tiles, function(i, k) {
	k.forEach(function(o) {
		tilesMap[o[0]] = tilesMap[o[0]] || {}
		tilesMap[o[0]][o[1]] = i
	})
})
var acc = []
Crafty.c('Tile', {
	init: function() {
		this.requires('Actor, TileSprite, Mouse, Tween')
			.areaMap([32, 0, 64, 16, 32, 32, 0, 16])
			.bind('MouseOver', this.hover)
			.bind('MouseOut', this.resetSprite)
			.bind('Click', function(e) {
				// Whenever tile is clicked, move player
				var p = Crafty.iso.px2pos(this.x, this.y)
				console.log("Clicked on:", p.x, p.y - 1)
				Crafty('PlayableCharacter').moveAndNotify(p.x, p.y - 1)
				if (e.ctrlKey) {
					this.__sprite = 'red' // red
					this.resetSprite()
					acc.push([p.x, p.y - 1])
					console.log(JSON.stringify(acc))
				}
			})
	},
	tPosition: function() {
		var p = Crafty.iso.px2pos(this.x, this.y)
		p.y--
			return p
	},
	place: function(x, y, z) {
		// this._pos = { x: x + (screenX || 0) * TILEPERSCREENX, y: y + (screenY || 0) * TILEPERSCREENY }
		// Crafty.isometric.place(this._pos.x, this._pos.y, 0, this)
		// iso.place(x, y, z || 0, this)
		Crafty.iso.place(this, x, y, z || 0)
		return this
	},
	hover: function() {
		if (this.color === 'red')
			// this.sprite(1, 0, 1, 1)
			this.sprite(17, 0, 1, 1)
		else
			// this.sprite(0, 0, 1, 1)
			this.sprite(17, 0, 1, 1)
	},
	randomSprite: function() {
		var r = Math.random(),
			// pos = this._pos
			pos = this.tPosition()
		// this.__sprite = 'red'
		if (tilesMap[pos.x] && tilesMap[pos.x][pos.y]) {
			this.__sprite = tilesMap[pos.x][pos.y]
		} else if (r > 0.12) {
			this.__sprite = 'white' // white
		} else if (r > 0.10) {
			this.__sprite = 'orange' // white
		} else if (r > 0.05) {
			this.__sprite = 'gray' // gray
		} else {
			this.__sprite = 'red' // red
		}
		this.resetSprite()
		return this
	},
	resetSprite: function() {
		var color2sprite = {
			red: [17, 0, 1, 1],
			gray: [17, 2, 1, 1],
			white: [18, 0, 1, 1],
			//lightgray: [1, 2, 1, 1],
			orange: [18, 2, 1, 1]
		}
		if (!this.__sprite) return
		this.sprite.apply(this, color2sprite[this.__sprite])
	}
})
