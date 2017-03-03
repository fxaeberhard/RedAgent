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
	
	public class RedNPC extends Player  {
		
		public var msgBuffer:String;
		public var delayTimer:Timer = new Timer(2000, 1);
		
		public function RedNPC():void {
			this.xPos = -157;
			this.yPos = -888;
			this.id = -3;
			this.setName("Robot");
			delayTimer.addEventListener(TimerEvent.TIMER, delayedSayEvent);
			
			
			this.playerVisuals["robotFront"].visible = true;
			this.currentVisual = this.playerVisuals["robotFront"];
			this.playerVisuals["playerBottomLeft"].visible = false;
		}
		override public function chatSay(msg:String):void {
			msgBuffer = msg;
			delayTimer.start();
		}
		public function delayedSayEvent(e:TimerEvent){
			super.chatSay(msgBuffer);
		}
	}
}