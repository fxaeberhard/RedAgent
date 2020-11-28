/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
/* exported Net */
var Net = (function($) {
	var PRESENCECHANNEL = "presence-redagent",
		// APPKEY = '9d4eb6ada84f3af3c77f',
		APPKEY = '52b7c53f33754e278bd6',
		AUTHENDPOINT = 'php/endpoint.php',
		channel

	var Net = {
		init: function() {
			//Pusher.log = console.log

			// Init pusher
			var pusher = new Pusher(APPKEY, {
				authEndpoint: AUTHENDPOINT,
				cluster: 'eu',
				encrypted: true
			})

			channel = Net.channel = pusher.subscribe(PRESENCECHANNEL)

			// On connection to the channel,
			channel.bind('pusher:subscription_succeeded', function(members) {
				// console.log("Presence channel subscription_succeeded, count: " + members.count)
				var label = $.cookie("chatname") || "Anonymous " + members.count
				Crafty('PlayableCharacter').label(label)
				updateCounter()
				members.each(function(m) { // display all members that are already on the channel
					if (m.id !== members.myID) Game.addPlayer(m)
				})
				Net.sendJump()
			})
			channel.bind('pusher:subscription_error', function(error) {
				console.log('error', error)
			})

			channel.bind('pusher:member_added', function(member) { // When somebody connect,
				// console.log("Member added, count: ", channel.members.count)
				var player = Game.addPlayer(member) // display the newcomer
				player.isNewPlayer = true
				Net.playNotification()
				Net.sendJump() // and send pusher event to update newcomer about current postion
				updateCounter()
			})

			channel.bind('pusher:member_removed', function(member) { // When somebody disconnect
				// console.log("Member removed, count ", channel.members.count)
				var player = Game.getPlayer(member.id)
				// Game.notify(player.label() + " has left.")
				player.destroy()
				updateCounter()
			})

			channel.bind('client-move', function(e) { // When somebody else moves,
				// console.log("Client-move", e)
				Game.getPlayer(e.id).moveTo(e).initialized = true // update it's sprite
			})

			channel.bind('client-jump', function(e) { // Postion update event, so players are at the right position at the beginning
				// console.log("Client-jump", e)
				var p = Game.getPlayer(e.id)
				if (!p.initialized) {
					p.attr({ x: e.x, y: e.y })
						.label(e.name)
						.initialized = true

					Game.loadTilesAround(p.position(), 1)

					p.visible = true
					// p.isNewPlayer && Game.notify(e.name + " has joined.")
					updateCounter()
				}
			})

			channel.bind("client-chat", function(e) { // When a chat message is received through websocket
				Game.say(e.id, e.msg)
				Net.playNotification()
				$('body').addClass('chat-open')
			})

			channel.bind("client-rename", function(e) { // When a player is renamed
				var player = Game.getPlayer(e.id)
				Chat.notify(player.label() + " has changed his name to " + e.name + ".") // display it in the chat
				player.label(e.name)
				updateCounter()
			})

			function updateCounter() {
				var c = channel.members.count
				var names = []
				Crafty('PlayerCharacter').each(function() {
					if (!this.has('PlayableCharacter')) names.push(this.label())
				})

				$('.chat-button').toggleClass('empty', c <= 1).find('.counter').html(c)
				$('.chat .members').html(names.join(', ') + ' and you')
			}
		},

		sendJump: function() {
			var p = Crafty("PlayableCharacter")
			Net.trigger("jump", { x: p.x, y: p.y, name: p.label() }) // Send him a message to tell our actual position
		},

		trigger: function(name, data) {
			if (channel && channel.subscribed)
				channel.trigger("client-" + name, $.extend(data, { id: channel.members.me.id }))
		},

		playNotification: function() {
			// console.log("App.playNotification()")
			// if (!App.windowActive)
			new Audio('assets/sounds/Air Plane Ding.mp3').play()
		}
	}

	return Net
}(jQuery))
