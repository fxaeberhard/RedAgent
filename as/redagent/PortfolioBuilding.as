package redagent {
	
	import flash.display.MovieClip;
    import flash.events.*;
	
    import flash.display.Sprite;
	
	public class PortfolioBuilding extends Building {
		
		public function PortfolioBuilding():void {
		}
		
		public function openWeb(e:MouseEvent):void {
			e.stopPropagation();
			RedAgent(root).yuiBridge.sendEvent({type:"showPage", text:'User+Experience'});
		}
		public function openGames(e:MouseEvent):void {         	
			e.stopPropagation();
			RedAgent(root).yuiBridge.sendEvent({type:"showPage", text:'Games'});
		}
		public function openInterface(e:MouseEvent):void {
			e.stopPropagation();
			RedAgent(root).yuiBridge.sendEvent({type:"showPage", text:'Web'});
		}
		
		override function moviePlay(event:Event):void {
			super.moviePlay(event);
			if (this["build"].currentFrame == this["build"].totalFrames) {
				this["build"]["webLink"].addEventListener(MouseEvent.CLICK, this.openWeb);
				this["build"]["webLink"].buttonMode = true;
				this["build"]["gamesLink"].addEventListener(MouseEvent.CLICK, this.openGames);
				this["build"]["gamesLink"].buttonMode = true;
				this["build"]["interfaceLink"].addEventListener(MouseEvent.CLICK, this.openInterface);
				this["build"]["interfaceLink"].buttonMode = true;
			}
		}
	}
}