Crafty.extend({
	quests: {
		goq1: new Quest({}),
		q1: new Quest({
			title: "First steps",
			text: "Find your first client",
			objectives: {
				workers: {
					title: "Find your fellow engineer and define a solution"
				}
			}
		})
	},
	objects: [{
		pos: [500, 500],
		init: function() {

			// Init houses
			Crafty.e('House').targetPage('Projects').placeAt(497, 497).attr('z', 200001)
			Crafty.e('House').targetPage('Contact').placeAt(499, 505).attr('z', 200004)
			// Crafty.e('House').targetPage('Blog').placeAt(16, 14).attr('z', 200006)

			Crafty.e('Character, BotSprite, QuestCondition, Dialog') // AudioSource
				// .placeAt(501, 501)
				.placeAt(513, 492)
				.condition("quests.goq1.started()")
				.dialog({
					start: {
						branches: {
							"quests.goq1.started()": "q1",
							"else": "startdefault"
						}
					},
					q1: {
						text: "You're not the one I was expecting... We do have this pretty difficult projects. Can you be as good as François-Xavier?",
						choices: [
							{ text: "This guy is nothing compared to me, I'll do twice the work in half the time.", next: "q1_2" },
							{ text: "I can try, what needs to be done?", next: "q1_2" }
            ]
					},
					q1_2: {
						text: "Todo..."
					},
					startdefault: {
						text: "I don't have much to say to you at the moment.",
						choices: [{ text: "See you then." }]
					}
				})

			// Crafty.e("Actor, Condition")
			// .placeAt(503, 503)
		}
  }, {
		pos: [508, 492],
		init: function() {
			Crafty.e('House')
				.targetPage('Blog')
				.placeAt(508, 492)
				.attr('z', 200006)
		}
  }, {
		pos: [504, 505],
		init: function() {
			// Init bot
			Game.players.bot = Crafty.e('Character, BotSprite, Dialog, QuestCondition')
				.placeAt(504, 500)
				// .label('Red agent')
				.condition("quests.goq1.notStarted()")
				.dialog({
					start: {
						text: "Welcome on Francois-Xavier's portfolio. What can I do for you?",
						choices: [
							{ text: "Can you tell me more about Francois-Xavier?", next: "who" },
              // { text: "who are you?", next: "who" },
							{ condition: "quests.goq1.notStarted()", text: "Wait a minute. You've got an exclamation mark above your head, don't you have a quest for me?", next: "quest" },
              // { text: "All right, let's do this.", script: "quests.tutorial = 1", condition: "!quests.tutorial" },
              // { text: "All right, let's do this.", script: "quests.tutorial = 0" },
              // { text: "you", next: "you" }
            ]
					},
					who: {
						text: "Sure. François-Xavier is a full stack engineer. He worked in various fields including video games, web applications and blockchains. He has experience in coding with Java, C++, Go, Node, Docker, JackRabbit, React, Angular, Sellenium and JMeter.",
						//+ "<br><br>What do you want to know about him?",
						choices: [
							{ text: "Can you give me an example?", next: "project_wallo" },
              // { text: "Can I leave a message for him?", next: "projects" },
							{ text: "You sure seem very dedicated. Does he treat you well?", next: "treatment" }
            ]
					},
					projects: {
						text: "Sure. Which project would you like to¨know about ",
						choices: [
							{ text: "Wallogram, a web game you play using your mobile phone. ", next: "project_wallo" },
							{ text: "Let's talk about something else.", next: "start" }
            ]
					},
					project_wallo: {
						text: "Wallogram is a video mapping project. This game is projected on walls and users can play using their mobile phone. Francois-Xavier presented this project during <em>Portrait-Robot</em> exhibit at <em>Maison d'Ailleurs</em>. Checkout that cool video:<br /><br />" +
							'<div style="max-width:400px" class="d-block m-x-auto"><a href="https://www.youtube.com/watch?v=W1kdVlAAzcQ" class="embed-responsive embed-responsive-16by9" data-youtube-id="W1kdVlAAzcQ"><img class="img-fluid" src="i/projects/wallogram/teaser.jpg?w=782" srcset="i/projects/wallogram/teaser.jpg?w=782, i/projects/wallogram/teaser.jpg?w=1173 1.5x, i/projects/wallogram/teaser.jpg?w=1564 2x" alt="Wallogram" /><svg><use xlink:href="assets/images/sprite.svg#youtube" /></svg></a></div><br />',
						choices: [
							{ text: "Not bad. You have something else ?", next: "projects_link" },
							{ text: "Let's talk about something else.", next: "start" }
            ]
					},
					projects_link: {
						text: "Why don't you check his <a href=\"/Projects\">projects page</a>.",
						choices: [
							{ text: "Nice link thanks!", next: "start" },
							{ text: "A link, really?! You sure seem to be one lazy IA.", next: "projects_link_lazy" }
            ]
					},
					projects_link_lazy: {
						text: "Well maybe I provided you with a very useful <a href=\"/Projects\">link</a> and you're the lazy one here.",
						choices: [
							{ text: "You're right this link is just fine. Let's talk about something else.", next: "start" },
							// { text: "Wow lazy and susceptible. That's just perfet.", next: "projects_link_lazy_2" },
            ]
					},
					// projects_link_lazy2: {
					// 	text: function() {
					// 		$.getJSON("http://api.hostip.info/get_json.php")
					// 			.then(function(result) {
					// 				console.log(result)
					// 				var text = "Okay mr " + result.ip
					// 				if (result.city && result.city !== "(Unknown City?)") text += " who lives in " + result.city
					// 				if (result.country && result.country !== "(Unknown Country?)") text += result.country
					// 				return text + ". Maybe im "
					// 			})
					// 	},
					// },
					treatment: {
						text: "I guess I cannot complain. He hosted me on nice server with tons of network security. I do feel safe.",
						choices: [
							{ text: "Don't you ever get lonely?", next: "treatment_lonely" },
							{ text: "Let's talk about something else.", next: "start" }
            ]
					},
					treatment_lonely: {
						text: "It sure is good to have visitors now and then. But enough talking about me.",
						// text: "It sure is good to have visitors now and then. But enough talking about me. Let's talks about you.",
						next: "start"
					},
					// you: {
					// 	text: "Do you like robots?",
					// 	choices: [
					// 		{ text: "I sure do.", next: "start" },
					// 		{ text: "I sure do.", next: "start" }
					//   ]
					// },
					quest: {
						text: "Ah I can see you're not here to play! François-Xavier always needs help. Go to the north, Francois-Xavier manager is waiting for his report. Maybe you can fill in.",
						choices: [
							{ text: "All right, let's do this.", script: "quests.goq1.state(1)" },
							{ text: "Nah, let's talk about somehing else.", next: "start" }
            ]
					}
				})
		}
  }, {
		pos: [483, 504],
		boot: function() {
			Crafty.e("Actor, AudioSource")
				.placeAt(483, 505)
				.audio(5, 11, "assets/sounds/Elevator Music.mp3")
		},
		init: function() {
			var counter = 0,
				dancer1 = Crafty.e('GrayCharacter, AudioSource')
				.placeAt(484, 504)
				// .audio(1, 11, 'music')
				.animate('Left', -1),
				dancer2 = Crafty.e('GrayCharacter')
				.placeAt(481, 505, -1)
				.animate('Down', -1),
				dancer3 = Crafty.e('GrayCharacter')
				.placeAt(483, 507)
				.animate('Right', -1)

			// Play sound and animation in disco screen
			setInterval(function() {
				// var tiles = Crafty('Tile')
				// tiles.each(function(i) {
				// 	tiles.get(i).randomSprite()
				// })
				if (counter % 6 === 0)
					dancer1.say('Yeah lets dance!')
				if (counter % 7 - 3 === 0)
					dancer2.say('Whooo')
				counter++
			}, 1000)
		}
  }]
})

function Quest(cfg) {
	this.title = cfg.title
	this.text = cfg.text
	this.objective = cfg.objectives || {}
	this._state = 0
	return {
		state: function(s) {
			if (typeof s !== "undefined") this._state = s
			return this._state
		},
		notStarted: function() {
			return !this._state
		},
		started: function() {
			return this._state === 1
		},
		finished: function() {
			return this._state === 2
		},
		objective: function(name, state) {
			if (typeof state !== "undefined") {
				this._objectives[name]._state = state
				// If all objectives are finished, quest is finished
				var found = _.find(this.objectives, function(o) {
					return o._state !== 2
				})
				if (!found) this._state = 2
			}
			return this._objectives[name]
		}
	}
}
