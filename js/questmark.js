/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */

Crafty.c('Target', {
	init: function() {
		var player = Crafty('PlayableCharacter')
		this._arrow = Crafty.e('2D, Canvas, ArrowSprite')
			.attr({ x: this.x, y: this.y - 24, w: 64, h: 64, z: 23001 })
			.origin("bottom center")
		this.attach(this._arrow)

		this.requires('Delay')
			.delay(function() {
				this._arrow.visible = true
				if (Crafty.viewport.onScreen(this.mbr())) {
					this._arrow.visible = false
					return
				}
				var a = Math.atan2(this._y - player._y, this._x - player._x) * 180 / Math.PI
				this._arrow.rotation = a - 90
				this._arrow.x = Crafty.math.clamp(this.x + this._offset.x, -Crafty.viewport.x - 45, Crafty.viewport._width - Crafty.viewport._x - 20)
				this._arrow.y = Crafty.math.clamp(this.y - 24 + this._offset.y, -Crafty.viewport.y - 80, Crafty.viewport._height - Crafty.viewport._y - 50)
			}, 100, -1)
	},
	remove: function() {
		this._arrow.destroy()
	}
})

Crafty.c('QuestMark', {
	init: function() {
		this._questmark = Crafty.e('2D, Canvas, WarningSprite')
			.attr({ x: this.x, y: this.y - 24, w: 64, h: 64, z: 19999 })

		var p = this.position()
		Game.loadTilesAround(p.x, p.y, 2)

		this.attach(this._questmark)
	},
	remove: function() {
		this._questmark.destroy()
	}
})

Crafty.c('QuestCondition', {
	init: function() {
		this.bind('StateUpdate', this.updateState)
	},
	condition: function(c) {
		this._c = c
		this.updateState()
		return this
	},
	updateState: function() {
		if (this._c && Game.eval(this._c)) {
			if (!this._initialized) {
				this.doinit()
				this._initialized = true
			}
		} else if (this._initialized) {
			this.uninit()
			this._initialized = false
		}
	},
	doinit: function() {
		this.addComponent('Target, QuestMark')
	},
	uninit: function() {
		this.removeComponent('Target')
		this.removeComponent('QuestMark')
	}
})
