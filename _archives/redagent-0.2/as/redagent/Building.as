package redagent{

	import flash.display.MovieClip;
	
    import flash.utils.Timer;
    import flash.events.TimerEvent;
	import flash.events.*; 
	
	
	import fl.transitions.Tween;
	import fl.transitions.easing.*;
	import fl.transitions.TweenEvent;

	public class Building extends RedObject {

		//0: closing or closed
		//1: opening or opened
		var state:int;
		
		var boxOpenTimer:Timer = new Timer(200, 1);
		var moveTween:Tween;

		public function Building():void {
			boxOpenTimer.addEventListener(TimerEvent.TIMER, close);
			state=0;
			this.useHandCursor = true;
			this.buttonMode = true;
		}
		public function openBox():void {
			if (state == 0 && this["build"]) {
				this["build"].addEventListener(Event.ENTER_FRAME, moviePlay);
				this.state=1;
				this["build"].nextFrame();
			}
			boxOpenTimer.reset()
			boxOpenTimer.start()
		}
		public function close(e:TimerEvent):void {
			this.state=0;
			this["build"].prevFrame();
			this["build"].addEventListener(Event.ENTER_FRAME, moviePlay);
		}
		function moviePlay(event:Event):void {
			if (this["build"].currentFrame == 1 || this["build"].currentFrame == this["build"].totalFrames) {
				this["build"].removeEventListener(Event.ENTER_FRAME, moviePlay);
			} else if (this.state == 1){
				this["build"].nextFrame();
			} else {
				this["build"].prevFrame();
			}
		}
	}
}