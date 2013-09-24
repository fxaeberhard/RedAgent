package redagent {
	
	import flash.display.MovieClip;
    import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
    import flash.utils.Timer;
    import flash.events.TimerEvent;
	
	
	import fl.transitions.Tween;
	import fl.transitions.easing.*;
	import fl.transitions.TweenEvent;
	import flash.events.MouseEvent;
	import flash.media.SoundTransform;
	
	public class Player extends RedObject  {
		//PARAMETERS
		//chat display length (in ms)
		public var chatDisplayLength:int = 15000;
		
		//VARS
		public var id:int;
		public var xPos:int;
		public var yPos:int;
		public var xTar:int;
		public var yTar:int;
		public var isCurrentPlayer:Boolean = false;
		var moveXTween:Tween;
		var moveYTween:Tween;
		
		public var chatMsgs:Array = new Array();
		public var chatTimer:Timer = new Timer(0, 1);
		
		public var app:RedAgent;
		
		//Display objects
		public var nameLabel:TextField;
		public var nameBackground:MovieClip;
		public var playerVisuals:MovieClip;
		
		//Internals
		private var dirMCNames = ["TopRight", "TopLeft", "BottomLeft", "BottomRight"];
		public var currentVisual:MovieClip;
		
		public function Player():void {
			this.xPos = -60;
			this.yPos = -500;
			this.chatContainer.visible = false;
			this.chatText.mouseEnabled = false;
			this.mouseEnabled = false;
																						
			chatTimer.addEventListener(TimerEvent.TIMER, updateChatEvent);
		
			for each (var v:String in this.dirMCNames) {
				this.playerVisuals["player" + v].visible = false;
				this.playerVisuals["anim" + v].visible = false;
				
			}
			this.playerVisuals["robotFront"].visible = false;
			
			this.currentVisual = this.playerVisuals["playerBottomLeft"];
			this.playerVisuals["playerBottomLeft"].visible = true;
			
			this.setName("Guest");
		}
		
		private function setVisual(mcName:String):void {
			this.currentVisual.visible = false;
			this.currentVisual = this.playerVisuals[mcName]
			this.currentVisual.visible = true;
		}
		
		////////////////////////////////////////////////////METHODS TO HANDLE MOVES
		
		public function setPos(xPos, yPos) {
			this.xPos = Math.round(xPos);
			this.yPos = Math.round(yPos);
		}
		public function applyPos():void {
			this.x = Utils.xCartToFla(xPos, 0, yPos); 
			this.y = Utils.yCartToFla(xPos, 0, yPos); 
		}
		public function goto():void {
			this.moveCal();
		}
		public function moveCal():void {
			var cx = Math.round(Utils.xFlaToCart(super.x, super.y, 0));
			var cy = Math.round(Utils.yFlaToCart(super.x, super.y, 0));
			if (cx != xPos) {
				
				if (cx < xPos) this.setVisual("animTopRight");
				else this.setVisual("animBottomLeft");
				
				moveTween(xPos, cy);
			} else if (cy != yPos) {
				if (cy < yPos) this.setVisual("animTopLeft");
				else this.setVisual("animBottomRight");
				
				moveTween(xPos, yPos);
			} else {
				trace(this.currentVisual.name.replace("player", ""));
				this.setVisual("player" + this.currentVisual.name.replace("anim", ""));
				
			}
		}
		public function moveTween(dx:Number, dy:Number): void {
			if (moveXTween != null && moveXTween.isPlaying){
				moveXTween.stop();
				moveYTween.stop();
			}
			
			var cx = Math.round(Utils.xFlaToCart(this.x, this.y, 0));
			var cy = Math.round(Utils.yFlaToCart(this.x, this.y, 0));
			var dxFla:Number = Utils.xCartToFla(dx, 0, dy);
			var dyFla:Number = Utils.yCartToFla(dx, 0, dy);
			var dur:Number = Utils.distance(cx,cy,dx,dy)/110;
			
			moveXTween = new Tween(this, "x", None.easeIn, this.x, dxFla, dur, true);
			moveYTween = new Tween(this, "y", None.easeIn, this.y, dyFla, dur, true);
			
			moveYTween.addEventListener(TweenEvent.MOTION_FINISH, moveFinishedEvent);
		}
		public function moveFinishedEvent(t: TweenEvent):void  {
			moveCal();
		}
		
		////////////////////////////////////////////////////METHODS TO PROFILE
		public function getId() {
			return this.id;
		}
		public function setId(id:int):void {
			this.id = id;
			this.setName("Guest "+id);
		}
		public function setName(name:String):void {
			this.nameLabel.text = name;
			this.nameBackground.width = this.nameLabel.textWidth + 20;
		}
		public function getName():String {
			return nameLabel.text;
		}
		
		////////////////////////////////////////////////////METHODS TO HANDLE CHAT
		public function updateChatTimer(){
			//we set up the next timer
			if (chatMsgs.length > 0 && !chatTimer.running){
				var ctime:Date = new Date();
				//trace(ctime.getTime() - chatMsgs[0][0] + this.chatDisplayLength);
				chatTimer.delay = chatMsgs[0][0] - ctime.getTime() + this.chatDisplayLength;
				chatTimer.start();
			}
			//we update the chat inner txt
			var chatTxt:String = "";
			for (var i:int= 0; i< chatMsgs.length;i++){
				chatTxt += chatMsgs[i][1];
			}
			chatText.htmlText = chatTxt;
			
			// ALGIN THE TEXT TO THE BOTTOM
			var size:Number =  (chatText.numLines-1)*16.5;
			chatText.y =-48- size;
			chatContainer.chatBack.height=size+1;
			
			
			if (chatMsgs.length == 0) 
				displayChatContainer(false);
		}
		public function displayChatContainer(b:Boolean):void {
			this.chatContainer.visible = b;
			this.chatText.mouseEnabled = b;
			this.mouseEnabled = b;
		}
		public function updateChatEvent(e:TimerEvent):void {
			chatTimer.reset();
			chatMsgs.shift();
			updateChatTimer();
		}
		public function chatSay(msg:String):void {
			var ctime:Date = new Date();
			if (chatMsgs.length == 0) 
				displayChatContainer(true);
			chatMsgs.push(new Array(ctime.getTime(), msg));
			
			//Add the msg to the side bar and play a sound
			if (!this.isCurrentPlayer) {
				RedAgent(root).chatHistoryContainer.chatHistory.htmlText += this.getName()+": <font color=\"#000000\">"+msg+"</font>";
				var snd2:SndChat= new SndChat();
				var trans:SoundTransform = new SoundTransform(RedAgent(root).sndVolume, 0);
				snd2.play(0,1,trans);
			} else {
				RedAgent(root).chatHistoryContainer.chatHistory.htmlText +="<font color=\"#C1C1C1\">"+this.getName()+": "+msg+"</font>";
			}
			RedAgent(root).chatScroll.setPos(1);
			
			//Update the time for the delayed hide of the bubble
			updateChatTimer();
		}
	}
}