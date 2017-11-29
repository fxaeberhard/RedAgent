/**
 *
 */
Crafty.c('Dialog', {

	init: function() {
		this.requires('Mouse, Interactable, Cursor')
			.cursor('Bubble')
			.bind('Interact', this.render)
	},

	dialog: function(cfg) {
		this.cfg = cfg
	},

	currentLine: function() {
		return this.cfg[this._current]
	},

	render: function() {
		// console.log("Dialog.render()")

		$('body').addClass('dialog-open')
			.append('<div class="dialog"><a href="/" class="nav-link close"><svg><use xlink:href="assets/images/sprite.svg#back"></use></svg></a><div><div></div></div></div>')
		$('.menu').removeClass('open')

		$('.dialog').on('click', '.choices:not(.answered) a', this.onChoice.bind(this))
			.on('click', '.close', function(e) {
				e.preventDefault()
				e.stopPropagation()
				this.closeDialog()
			}.bind(this))

		this.renderLine('start')
	},

	renderLine: function(id) {
		this._current = id
		var cfg = this.currentLine(),
			choices = ''

		if (cfg.branches) {
			return _.find(cfg.branches, function(s, c) {
				if (c === "else" || Game.eval(c)) {
					this.renderLine(s)
					return true
				}
			}.bind(this))

		} else if (cfg.next) {
			this.timeout(function() {
				this.renderLine(cfg.next)
			}, 1000)

		} else if (cfg.choices) {
			choices = '<div class="choices"><div class="bubble bubble-right"><i></i>' + cfg.choices.map(function(c) {
				if (!c.condition || Game.eval(c.condition))
					return '<div><a href="#" class="link">' + c.text + '</a></div>'
			}).join('') + '</div><i class="portrait"></i></div></div>'
		}

		$('.dialog > div > div').append('<div class="line"><div class="text"><i class="portrait"></i>' +
			'<div class="bubble">' + cfg.text + '<i></i></div></div>' + choices + "</div>")

		setTimeout(function() {
			$('.dialog').animate({
				scrollTop: $('.dialog')[0].scrollHeight
			}, 1000, 'swing')
		}, 10)
	},

	closeDialog: function() {
		$('.dialog').remove()
		$('body').removeClass('dialog-open')
	},

	onChoice: function(e) {
		console.log("Dialog.onChoice()")
		var target = $(e.target),
			choice = this.currentLine().choices[target.parent().index() - 1]

		if (choice.script) {
			Game.eval(choice.script, true)
		}
		if (choice.next) {
			target.addClass('selected').parent().parent().addClass('answered')
			this.renderLine(choice.next)
		} else {
			this.closeDialog()
		}
	}
})
