/*
 * Red agent
 * http://red-agent.com/
 *
 * Copyright (c) Francois-Xavier Aeberhard <fx@red-agent.com>
 * Licensed under the MIT License
 */
jQuery(function($) {
  var PRESENCECHANNEL = "presence-redagent",
    // APPKEY = '9d4eb6ada84f3af3c77f',
    APPKEY = '52b7c53f33754e278bd6',
    AUTHENDPOINT = 'php/endpoint.php',
    channel, Game = $.Game;

  var Net = {
    init: function() {
      //Pusher.log = console.log;

      // Init pusher 
      var pusher = new Pusher(APPKEY, {
        authEndpoint: AUTHENDPOINT,
        cluster: 'eu',
        encrypted: true
      });
      channel = Net.channel = pusher.subscribe(PRESENCECHANNEL);

      // On connection to the channel,
      channel.bind('pusher:subscription_succeeded', function(members) {
        // console.log("Presence channel subscription_succeeded, count: " + members.count);
        var label = $.cookie("chatname") || "Anonymous " + members.count;
        Crafty('PlayablePC').label(label);
        members.each(function(m) { // display all members that are already on the channel
          m.id !== members.myID && Game.addPlayer(m);
        });
        Net.sendJump();
      });
      channel.bind('pusher:subscription_error', function(error) {
        console.log('error', error);
      })

      channel.bind('pusher:member_added', function(member) { // When somebody connect,
        // console.log("Member added, count: ", channel.members.count);
        var player = Game.addPlayer(member); // display the newcomer
        player.isNewPlayer = true;
        Net.playNotification();
        Net.sendJump(); // and send pusher event to update newcomer about current postion
      });

      channel.bind('pusher:member_removed', function(member) { // When somebody disconnect
        // console.log("Member removed, count ", channel.members.count);
        var player = Game.getPlayer(member.id);
        Game.notify(player.label() + " has left.");
        player.destroy();
      });

      channel.bind('client-move', function(e) { // When somebody else moves,
        // console.log("Client-move", e);
        Game.getPlayer(e.id).moveTo(e.x, e.y).initialized = true; // update it's sprite
      });

      channel.bind('client-jump', function(e) { // Postion update event, so players are at the right position at the beginning
        // console.log("Client-jump", e);
        var p = Game.getPlayer(e.id);
        if (!p.initialized) {
          p.attr({ x: e.x, y: e.y })
            .label(e.name)
            .initialized = true;
          p.visible = true;
          p.isNewPlayer && Game.notify(e.name + " has joined.");
        }
      });

      channel.bind("client-chat", function(e) { // When a chat message is received through websocket
        Game.say(e.id, e.msg);
        Net.playNotification();
      });

      channel.bind("client-rename", function(e) { // When a player is renamed
        var player = Game.getPlayer(e.id);
        Game.notify(player.label() + " has changed his name to " + e.name + "."); // display it in the chat
        player.label(e.name);
      });
    },
    sendJump: function() {
      var p = Crafty("PlayablePC");
      Net.trigger("jump", { // Send him a message to tell our actual position
        x: p.x,
        y: p.y,
        name: p.label()
      });
    },
    trigger: function(name, data) {
      channel && channel.trigger("client-" + name, $.extend(data, { id: channel.members.me.id }));
    },
    playNotification: function() {
      // console.log("App.playNotification()");
      !$.App.windowActive && new Audio('images/Air Plane Ding.mp3').play();
    }
  };

  $.Net = Net;

});
