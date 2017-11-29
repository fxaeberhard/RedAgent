(function($) {
	String.prototype.capitalizeFirstLetter = function() { // jshint ignore:line
		return this.charAt(0).toUpperCase() + this.slice(1)
	}

	$.fn.extend({
		toggleView: function(doShow, a, b) {
			if (doShow) {
				return this.show(a, b)
			} else {
				return this.hide(a, b)
			}
		},
		setSlide: function(doShow) {
			if (doShow) {
				this.slideUp()
			} else {
				this.slideDown()
			}
		},
		editable: function(options) {
			//hide $el, show $texterea (mark with a class - just in case)
			this.attr('title', 'Click to edit')
				.click(function(e) {
					e.stopImmediatePropagation()
					var $el = $(this),
						form = $('<form><input></form'),
						input = form.find('input').val($el.html())

					$el.empty().addClass('editing').append(form)
					input.focus().select()
					//on blur write everything back
					form.one('submit', function(e) {
						e.preventDefault()
						var text = input.val()
						form.remove()
						$el.removeClass('editing')
						options.onblur(text)
						// $(this).parent().html(options.onblur(text))
					})
					input.click(function(e) {
						e.stopImmediatePropagation()
					})
					input.blur(function() {
						form.submit()
					})
				})
			return this
		}
	})
}(jQuery))
