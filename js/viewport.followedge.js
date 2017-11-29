Crafty.viewport.followEdge = (function() {
	var oldTarget, offx, offy, edx, edy

	function change() {
		var scale = Crafty.viewport._scale
		// if (this.x > -Crafty.viewport.x + Crafty.viewport.width / 2 + edx - 10) {
		Crafty.viewport.scroll('_x', -(this.x + (this.w / 2) - (Crafty.viewport.width / 2 / scale) - offx * scale) + edx)
		Crafty.viewport.scroll('_y', -(this.y + (this.h / 2) - (Crafty.viewport.height / 2 / scale) - offy * scale))
		Crafty.viewport._clamp()
		// }
	}

	function stopFollow() {
		if (oldTarget) {
			oldTarget.unbind('Move', change)
			oldTarget.unbind('ViewportScale', change)
			oldTarget.unbind('ViewportResize', change)
		}
	}

	Crafty._preBind("StopCamera", stopFollow)

	return function(target, offsetx, offsety, edgex, edgey) {
		if (!target || !target.has('2D'))
			return
		Crafty.trigger("StopCamera")

		oldTarget = target
		offx = (typeof offsetx !== 'undefined') ? offsetx : 0
		offy = (typeof offsety !== 'undefined') ? offsety : 0
		edy = (typeof edgex !== 'undefined') ? edgex : 0
		edx = (typeof edgey !== 'undefined') ? edgey : 0

		target.bind('Move', change)
		target.bind('ViewportScale', change)
		target.bind('ViewportResize', change)
		change.call(target)
	}
})()
