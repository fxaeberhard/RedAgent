/**
 *
 */
Crafty.c('House', {
	init: function() {
		this.requires('Actor, Mouse, Cursor, BuildingSprite, SpriteAnimation, Interactable') //Collision,
			.attr({ visible: false })
			.offset(-32, -61)
			.cursor('Doors')
			//.collision([22, 109, 65, 132, 108, 109, 65, 85])
			.areaMap([35, 109, 65, 123, 94, 108, 93, 50, 64, 34, 36, 50])
			.bind('Interact', this.openPage)
			.bind('MouseOver', function() {
				this.animate('Hover') // Start animation
			})
			.bind('MouseOut', function() {
				this.animate('Out') // Start animation
			})
			.timeout(function() {
				this.visible = true
				this.animate('Appear') // Start animation
			}, 500)
	},
	targetPage: function(page) {
		var row = ['Contact', 'Projects', 'Blog'].indexOf(page)
		this.attr('targetPage', page)
			.reel('Appear', 1000, 0, row, 24)
			.reel('Open', 900, 23, row, 21)
			.reel('Close', 900, 44, row, -22)
			.reel('Hover', 1000, 45, row, 1)
			.reel('Out', 1000, 22, row, 1)
		return this
	},
	openPage: function() {
		this.animate('Open')
			.timeout(function() {
				App.showPage(this.attr('targetPage'))
			}, 900)
			.timeout(function() {
				this.animate('Close')
			}, 1000)
	}
})
