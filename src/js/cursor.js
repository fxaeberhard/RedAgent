/**
 * Cursor component
 */
var cursor
Crafty.c('Cursor', {
	init: function() {
		this.requires('Mouse')
			// .cursor('Pointer')
			.bind("MouseOver", function() {
				// console.log("Cursor.MouseOver)")
				cursor.visible = true
				$('body').addClass('nocursor')
			})
			.bind("MouseMove", function(e) {
				// console.log("Cursor.MouseMove()")
				cursor.x = e.realX - cursor.w / 2
				cursor.y = e.realY - cursor.w / 2
				cursor.animate(this._cursor, -1)
			})
			.bind("MouseOut", function() {
				// console.log("Cursor.MouseOut()")
				cursor.visible = false
				$('body').removeClass('nocursor')
			})

		if (!cursor) {
			cursor = Crafty.e("2D, Canvas, CursorsSprite, SpriteAnimation")
				// .reel('Empty', 1000, 0, 0, 1) // Set up animations
				.reel('Bubble', 1000, 0, 0, 1)
				.reel('Doors', 1000, 1, 0, 1)
				// .reel('Hand', 1000, 0, 3, 16)
				.attr({ x: 100, y: 100, w: 32, h: 32, z: 250000 })

			$('canvas').mouseout(function() {
				// Crafty.bind("MouseOut", function() {
				// console.log("canvas.mouseout()")
				cursor.x = -100000
				cursor.y = -100000
			})
		}
	},
	cursor: function(c) {
		this._cursor = c
		return this
	}
})

Crafty.sprite(32, 'assets/images/cursors.png', {
	CursorsSprite: [0, 0]
})
