/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
Crafty.c('AudioSource', {
	init: function() {
		this.requires('Delay')
	},
	audio: function(min, max, src) {
		var audio, player = Crafty("PlayableCharacter")

		this.delay(adjust, 250, -1)
		// setInterval(adjust.bind(this), 500)

		function adjust() {
			var d = Crafty.math.distance(player._x, player._y, this.x, this.y) / 32
			if (d > max) {
				audio && audio.pause()
			} else {
				if (!audio) {
					audio = new Audio(src);
				}
				audio.play()
				audio.volume = 1 - Crafty.math.clamp((d - min) / (max - min), 0, 1)
			}
		}

		return this
	}
})
