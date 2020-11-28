/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */

var Chat = (function($) {

	var lastName

	var Chat = {
		init: function() {
			$('.chat-msgs > div').perfectScrollbar()

			// On 'enter' key in textarea,
			$('.chat textarea').keypress(function(e) {
				if (e.which === 13) {
					e.preventDefault()

					var value = $(this).val()

					// Empty textarea
					$(this).val('')
					if (value === '') {
						return
					}

					// show msg in chat and in the canvas
					Chat.chat('You', value, 'self')
					Crafty('PlayableCharacter').say(value)

					// and there are other players in the chat, send websocket event
					// if (Net.channel && Net.channel.members.count > 1) {
					Net.trigger('chat', { msg: value })
					// } else {
					// 	// Otherwise, player is alone send io request to chatter bot
					// 	$.post('programo/chatbot/conversation_start.php',
					// 		'say=' + encodeURIComponent(value) + '&convo_id=' + convoId + '&bot_id=1&format=json',
					// 		function(r) {
					// 			var response = $.parseJSON(r)
					// 			Game.say('bot', response.botsay)
					// 		})
					// }
				}
			})

			$('.chat-button, .chat .close-button').click(function() {
				$('body').toggleClass("chat-open")
			})
		},
		chat: function(name, msg, cssclass) {
			this.addParagraph((lastName !== name ? '<span class="name">' + name + '</span>' : '') + msg,
				(lastName !== name ? 'newtalker ' : '') + cssclass)
			lastName = name
		},
		notify: function(msg) {
			this.addParagraph(msg, 'notification')
		},
		addParagraph: function(msg, cssclass) {
			$('.chat-msgs > div').append('<div class="chat-msg ' + cssclass + '">' + msg + '</div>')
				.animate({ scrollTop: $('.chat-msgs>div').prop('scrollHeight') }, 1500)
				.perfectScrollbar('update')
		}
	}

	Chat.init()

	return Chat
}(jQuery));
