package redagent {
	import flash.display.MovieClip;
    import flash.events.*;
	
    import flash.display.Sprite;
	import com.yahoo.util.YUIBridge;
	
	public class ContactBuilding extends Building {
		
		//public function ContactBuilding():void { }
		
		public function openCV(e:MouseEvent):void {
			e.stopPropagation();
			
			RedAgent(root).yuiBridge.sendEvent({type:"showPage", text:'Resume'});
		}		
		public function openCtct(e:MouseEvent):void {
			e.stopPropagation();
			
			RedAgent(root).yuiBridge.sendEvent({type:"showPage", text:'Contact'});
		}
		override function moviePlay(event:Event):void {
			super.moviePlay(event);
			if (this["build"].currentFrame == this["build"].totalFrames) {
				this["build"]["resumeLink"].addEventListener(MouseEvent.CLICK, this.openCV);
				this["build"]["resumeLink"].buttonMode = true;
				this["build"]["contactLink"].addEventListener(MouseEvent.CLICK, this.openCtct);
				this["build"]["contactLink"].buttonMode = true;
			}
		}
	}
}