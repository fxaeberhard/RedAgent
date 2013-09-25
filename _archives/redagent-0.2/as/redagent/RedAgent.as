package redagent{
	import com.adobe.serialization.json.JSON;
	import fl.controls.TextInput;
	import flash.display.*;
	import flash.events.*;
	import flash.utils.Timer;
	import it.gotoandplay.smartfoxserver.data.User;
	import it.gotoandplay.smartfoxserver.*;
	import it.gotoandplay.smartfoxserver.data.Room;
	import flash.geom.Rectangle;
	import flash.text.TextField;
	import flash.ui.Keyboard;
	import flash.net.*;
	import fl.transitions.Tween;
	import fl.transitions.easing.*;
	import flash.media.SoundTransform;
	import com.yahoo.util.YUIBridge;

	
	
	public class RedAgent extends Sprite {
		//0 = moving, 1= chatting
		private var mode:int = 0;
		
		public static var config:Object = {
			sfsServerHost: "localhost",
			//sfsServerHost: "62.19.47.1",
			sfsServerPort: 9339,
			sfsZone: "RedAgent",
			webServer: "http://www.red-agent.com/",
			//webServer: "http://localhost/redagent/",
			robotIntro: "Welcome on red-agent.com, the online portfolio of Francois-Xavier Aeberhard.\n"+
						"It seems like you're alone on the site right now, but you can always talk to me!\n"
		}

		private var historyMode:int = 0;
		private var speed:Number = 1.5;
		//FUNCTIONAL VARS
		private var outGoingChatMessage:Array = new Array();
		private var timer:Timer = new Timer(2000);
		private var orderTimer:Timer = new Timer(200);
		
		public var terrain:MovieClip;
		private var ground:CartDrawer = new CartDrawer();
		private var drawGroundTimer:Timer = new Timer(7000);
		
		private var player:Player;
		private var players:Object = new Object();

		var sndVolume = 1;
		
		var chatScroll:TextScrollBar;
		var smartfox:SmartFoxClient;
		public var yuiBridge:YUIBridge;

		public function RedAgent() {
			
			try {
				yuiBridge = new YUIBridge(this.stage);								// Initialize YUI Bridge
				//yuiBridge.addCallbacks ( { addText:addText } );
			} catch (e:Error) {}
			
			this.alpha = 0;
			new Tween(this, "alpha", None.easeIn, 0, 1, 0.3, true);
			
			//Player
			this.player = new PlayingPlayer();
			this.player.isCurrentPlayer = true;
			this.player.app = this;
			this.terrain.addChildAt(player, 1);
			this.players[0] = this.player;
			this.player.x = 370;
			this.player.y = 210;
			
			
			this.players[-1] = this.terrain.cBuild;
			this.players[-2] = this.terrain.pBuild;
			var npc = new RedNPC();
			npc.applyPos();
			this.terrain.addChildAt(npc, 1);
			this.terrain.addChildAt(npc, 1);
			this.players[-3] = npc;
			 
			//VOLUME BUTTON EVENTS
			//volumeButtonOn.visible = false;
			volumeButton.addEventListener(MouseEvent.CLICK, toggleVolume);
			volumeButton.buttonMode = true;
			volumeButtonOn.mouseEnabled = false;

			orderTimer.addEventListener(TimerEvent.TIMER, orderPlayers);
			orderTimer.start();

			//BACKGROUND EVENT LISTENERS
			terrain.addEventListener(MouseEvent.CLICK, this.stageClickEvent);

			//CHAT EVENTLISTENERS
			chatScroll = new TextScrollBar(  chatHistoryContainer.chatHistory, chatHistoryContainer.scrollbar, 497,497);
	
			this.toggleChatHistory();
			
			//Keyboard Events Listener
			this.stage.addEventListener(KeyboardEvent.KEY_DOWN, this.moveEvent);
			this.stage.addEventListener(KeyboardEvent.KEY_UP, this.keyUpHandler);
			//this.Chat.Text.addEventListener(FocusEvent.FOCUS_IN, this.chatFocusEvent);
			//this.Chat.Text.addEventListener(FocusEvent.FOCUS_OUT, this.chatFocusLosEvent);
			//this.Chat.Text.addEventListener (TextEvent.TEXT_INPUT, this.textEvent);

			//this.Chat.Text.setSelection(1,1);
			//this.fm.setFocus(this.Chat.Text); 
			
			this['_border'].visible = false;
		
			//Draw background and set up refresh events
			terrain.addChildAt(this.ground,1);
			drawBackground();
			drawGroundTimer.addEventListener(TimerEvent.TIMER, this.drawGroundTimerEvent);
			drawGroundTimer.start();
			
			
			
			
			//Set up SFS connection
			this.smartfox = new SmartFoxClient();
			this.smartfox.debug = true;
			this.smartfox.blueBoxIpAddress = RedAgent.config.sfsServerHost;
			this.smartfox.addEventListener(SFSEvent.onConnection, this.onConnection);
			this.smartfox.addEventListener(SFSEvent.onLogin, this.onLogin);
			this.smartfox.addEventListener(SFSEvent.onJoinRoom, this.onJoinRoom);
			this.smartfox.addEventListener(SFSEvent.onJoinRoomError, this.onJoinRoomError);
			this.smartfox.addEventListener(SFSEvent.onPublicMessage, this.onPublicMessage);
			this.smartfox.addEventListener(SFSEvent.onConnectionLost, this.onConnectionLost);
			this.smartfox.addEventListener(SFSEvent.onAdminMessage, this.onAdminMessage);
			this.smartfox.addEventListener(SFSEvent.onRoomListUpdate, this.onRoomListUpdate);
			this.smartfox.addEventListener(SFSEvent.onRoomAdded, this.onRoomAdded);
			this.smartfox.addEventListener(SFSEvent.onRoomVariablesUpdate, this.onRoomVariablesUpdate);
			this.smartfox.addEventListener(SFSEvent.onExtensionResponse, this.onExtensionResponse);	
			smartfox.addEventListener(SFSEvent.onUserLeaveRoom, onUserLeaveRoomHandler)
			smartfox.addEventListener(SFSEvent.onUserEnterRoom, onUserEnterRoomHandler);
			smartfox.addEventListener(SFSEvent.onUserVariablesUpdate, onUserVariablesUpdate);
			
			//Connect to the server
			//this.smartfox.connect(RedAgent.config.sfsServerHost, RedAgent.config.sfsServerPort);
		}
		/**
		 * This function is responsible for drawing the terrain
		 */
		var drawGroundCounter = 0;
		function drawGroundTimerEvent(e:TimerEvent) {
			if (this.drawGroundCounter < 2) {
				this.drawGroundTimer.delay = 300;
				this.drawGroundCounter++;
			} else {
				this.drawGroundTimer.delay = 10000;
				this.drawGroundCounter = 0;
			}
			this.drawBackground();
		}
		public function drawBackground() {
			var d:CartDrawer = ground;
			
			d.graphics.clear();
			var i:Number=-17;
			while (i<12){
				d.cartMoveTo(i, i);
				d.cartLineTo(i, -23+i);
				i++;
			}
			i=-0;
			while (i<28){
				d.cartMoveTo(i, -i);
				d.cartLineTo(-i, -i);
				i++;
			}
			
			for (var j:int=0;j<28;j++){
				for (var k:int=0;k<28;k++){
					var pick = Math.random();
					if (pick<0.05) d.graphics.beginFill	(0x580000);
					else if (pick<0.1) d.graphics.beginFill	(0xF1F1F1);
					
					if (pick<0.1){
						var posx= j-17;
						var posy = -k;
						d.cartMoveTo(posx, posy);
						d.cartLineTo(posx+1, posy);
						d.cartLineTo(posx+1, posy+1);
						d.cartLineTo(posx, posy+1);
					}
					d.graphics.endFill();
					
				}
			}
		}	
		
		function onRoomVariablesUpdate(evt:SFSEvent) {
			debug("onRoomVariablesUpdate(): " + this.room.getVariable("isRobotEnabled"));
			this.setRobotEnabled(this.room.getVariable("isRobotEnabled"));
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////SOUND MANAGEMENT///////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		private function toggleVolume(e:MouseEvent):void {
			volumeButtonOn.visible = !volumeButtonOn.visible ;
			if (volumeButtonOn.visible) {
				this.sndVolume = 1;
			} else {
				this.sndVolume=0;
			}
			e.stopPropagation();
		}
		private function stageClickEvent(e:MouseEvent):void {
			this.player.setPos(Utils.xFlaToCart( e.stageX, e.stageY, 0), Utils.yFlaToCart( e.stageX, e.stageY, 0));
			this.player.goto();
		//	if (this.mode==1) {
		//		this.fm.setFocus(this.chatHistoryContainer.Chat.Text);
//			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////COLLISION DETECTION////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////

		private function orderPlayers(e:TimerEvent) {
			var childList:Array = new Array();
			for (var j:* in players) {
				childList.push(players[j]);
			}
			childList.sortOn("y", Array.NUMERIC);
			var i:int = childList.length;
			while (i--) {
				if (childList[i] != terrain.getChildAt(i+2)) {
					terrain.setChildIndex(childList[i], i+2);
				}
			}
			for (i=1; i<3; i++) {
				if (Utils.distance(player.x, player.y, players[-i].x, players[-i].y) <110) {
					players[- i].openBox();
				}
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////CHAT///////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		private function historyButtonEvent(e:MouseEvent):void {
			toggleChatHistory();
			toggleChat();
		}
		private function chatToggleClickEvent(e:MouseEvent) {
			toggleChat();
			toggleChatHistory();
		}
		private function toggleChatHistory():void {
			var myTween:Tween;
			if (historyMode == 0) {
				myTween = new Tween(chatHistoryContainer, "x", Regular.easeIn, 500, 797, 0.7, true);
				historyMode = 1;
			} else {
				myTween = new Tween(chatHistoryContainer, "x", Regular.easeOut, 797, 500,  0.7, true);
				// this.fm.setFocus(this.stage);
				historyMode = 0;
			}
		}
		private function toggleChat() {
		/*	if (mode == 0) {
				var myTween:Tween = new Tween(Chat, "y", Regular.easeIn, 656.1, 629.4, 0.7, true);
				this.fm.setFocus(this.Chat.Text);
				//this.Chat.Text.text="";
				mode = 1;
			} else {
				var myTween:Tween = new Tween(Chat, "y", Regular.easeOut, 629.4, 656.1,  0.7, true);
				// this.fm.setFocus(this.stage);
				mode = 0;
			}*/
		}
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////PLAYER INPUTS//////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		private function moveEvent(e:KeyboardEvent):void {
			if (this.mode == 0) {
				switch (e.keyCode) {
					case Keyboard.RIGHT :
						this.player.yPos -= speed;
						break;
					case Keyboard.LEFT :
						this.player.yPos += speed;
						break;
					case Keyboard.UP :
						this.player.xPos += speed;
						break;
					case Keyboard.DOWN :
						this.player.xPos -= speed;
						break;
				}
				this.player.applyPos();
			}
		}
		private function keyUpHandler(e:KeyboardEvent):void {
			if (this.mode == 0) {
				switch (e.keyCode) {
					case Keyboard.RIGHT :
					case Keyboard.LEFT :
					case Keyboard.UP :
					case Keyboard.DOWN :
						this.moveEvent(e);
						break;
					case Keyboard.ENTER :
						toggleChat();
						// trace("enter");
						//if (KeyboardEvent.KEY_
						//this.Chat.Text.text = "";
						// case "C".charCodeAt(0): 
						break;
					default :
						//this.fm.setFocus(this.Chat.Text);
						//this.fm.setFocus(ti);   
						//this.stage.focus = this.Chat.Text;
						//this.Chat.Text.setSelection(2,2);
						//this.Chat.Text.setFocus()
						//TextInput.alwaysShowSelection = true;
						//this.Chat.Text.appendText(String.fromCharCode(e.charCode));
						//this.fm.setFocus(Chat.Text); 
						break;
				}
				this.player.applyPos();
			} else {
				switch (e.keyCode) {
					case Keyboard.ENTER :
						
					
						this.smartfox.sendPublicMessage(this.chatHistoryContainer.Chat.Text.text);
						
						if (this.room.getVariable("isRobotEnabled")) {
							this.getRobotReply(this.chatHistoryContainer.Chat.Text.text);
						}
						this.chatHistoryContainer.Chat.Text.text = "";
						break;
					default :
						break;
				}
			}
		}
		
		function debug(txt:String) {
			trace(txt);
		}
		////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////SmartFoxServer Event Handlers//////////
		////////////////////////////////////////////////////////////////////////////
		public function onConnection(e:SFSEvent) {
			debug("onConnection()");
			smartfox.login(RedAgent.config.sfsZone, "", "");
		}
		
		function onLogin(e:SFSEvent) {
			debug("onLogin()");
			this.player.setId(this.smartfox.myUserId);
			players[this.smartfox.myUserId] = this.player;
			
			if (e.params.success) {
				debug("Login successful");
			}else debug("Login failed");
		}
		public function onRoomListUpdate(e:SFSEvent) {
			debug("onRoomListUpdate(): ");
			smartfox.autoJoin();
		}
		public function onRoomAdded(e:SFSEvent) {
			debug("onRoomAdded()");
			var room:Room = e.params.room as Room;
			
		}
		var room:Room;
		public function onJoinRoom(e:SFSEvent) {
			this.room = e.params.room as Room;
			debug("onJoinRoom(): "+room);
			
			//room.getUserList();
			this.player.setPos( -60, -500);
			this.player.applyPos();
			
			trace(room.getVariable("isRobotEnabled"));
			if (this.room.getUserCount() == 1) {
				this.players[ -3].chatSay(RedAgent.config.robotIntro);
			}
			
			if (room.getVariable("isRobotEnabled") == undefined) this.setRobotEnabled(true);
			else updateRobot();
			
			for each (var u:User in room.getUserList()) {
				trace("onjoin: "+u.getId());
				if (u.getId() != player.getId()) this.addUser(u);
			}
		}
		public function setRobotEnabled(enabled:Boolean) {
			this.smartfox.setRoomVariables([{ name : "isRobotEnabled",
				val: enabled } ]);
		}
		public function onJoinRoomError(e:SFSEvent) {
			debug("onJoinRoomError()");
		}
		public function onPublicMessage(e:SFSEvent) {
			debug("onPublicMessage()");
			players[e.params.sender.getId()].chatSay(e.params.message);
			
			if (this.room.getVariable("isRobotEnabled")) {
				this.getRobotReply(e.params.message);
			}
		}
		public function onConnectionLost(e:SFSEvent) {
			debug("onConnectionLost");
		}
		public function onAdminMessage(e:SFSEvent) {
			debug("onAdminMessage");
		}
		public function onExtensionResponse(e:SFSEvent) {
			debug("onExtensionResponse():"+e.params.dataObj._cmd);
		}
		function addUser(u:User ) {
			var p:Player = players[u.getId()] = new Player();
			p.setId(u.getId());
			this.terrain.addChildAt(p,1);
			p.setPos(u.getVariable("x"), u.getVariable("y"));
			p.applyPos();	
		}
		function onUserEnterRoomHandler(evt:SFSEvent):void {
			debug("onUserEnterRoomHandler()");
			var u:User = evt.params.user as User;
			this.addUser(u);
			
			var snd:SndEnter= new SndEnter();
			var trans:SoundTransform = new SoundTransform(sndVolume, 0);
			snd.play(0,1,trans);
			snd.play();
			
			if (this.room.getUserCount() == 2) {
				this.setRobotEnabled(false);
			}
		}
		function onUserVariablesUpdate(evt:SFSEvent):void {
			trace("onUserVariablesUpdate()");
			var u:User = evt.params.user as User;
			this.players[u.getId()].setPos(u.getVariable("x"), u.getVariable("y"));
			this.players[u.getId()].goto();
		}
		function onUserLeaveRoomHandler(evt:SFSEvent):void {
			debug("onUserLeaveRoomHandler");
			this.terrain.removeChild(this.players[evt.params.userId]);
			this.players[evt.params.userId] = null;
			delete this.players[evt.params.userId];
		}
		///////////////////////////////////////////////////////////////////
		/////////////////////////////BOT MANAGMENT/////////////////////////
		///////////////////////////////////////////////////////////////////
		
		function updateRobot() {
			
		}
		
		function getRobotReply(text:String) {
			
			var request:URLRequest = new URLRequest(RedAgent.config.webServer + "programo-1.04/programo-webservice");
			var loader:URLLoader = new URLLoader();
			loader.dataFormat = URLLoaderDataFormat.TEXT;
			request.method = URLRequestMethod.POST;
			
			var variables:URLVariables = new URLVariables();
			variables.chat = text;
			variables.action = "checkresponse";
			request.data = variables;
			
			loader.addEventListener(Event.COMPLETE, this.receiveServerState);
			loader.load(request);
		}
		var lastRobotReply:Object;
		private function receiveServerState(e:Event) {
			trace(e.target.data);
			var response:Object = JSON.decode(e.target.data);
			trace(response);
			this.players[ -3].chatSay(response.answer+"\n");
		}
	}
	
}