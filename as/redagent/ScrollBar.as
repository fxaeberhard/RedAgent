package redagent {
	import flash.display.DisplayObject;
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.geom.Rectangle;
	
	import flash.text.TextField ;
	
	public class ScrollBar {
		var scroller:MovieClip;
		var scrollerX:Number;
		var scrollerY:Number;
		var scrollerHeight:Number;// = 365;
		var visibleHeight:int;
		
		
		var scrollArea:DisplayObject;
		
		public function ScrollBar(scrollArea:DisplayObject, scroller:MovieClip, scrollerHeight:int, visibleHeight:int) {
			this.scroller = scroller;
			this.scrollerX = scroller.x;
			this.scrollerY = scroller.y;
			this.scrollerHeight = scrollerHeight;
			
			this.scrollArea = scrollArea;
			this.visibleHeight = visibleHeight;
			scroller.addEventListener(MouseEvent.MOUSE_DOWN, containerStartDrag);
			scroller.buttonMode = true;
		}
		
		private function containerStartDrag(e:MouseEvent) {
			scroller.startDrag(true, new Rectangle(scrollerX, scrollerY ,0, scrollerHeight));
			RedAgent(scroller.root).stage.addEventListener(MouseEvent.MOUSE_UP, containerStopDrag);
			RedAgent(scroller.root).stage.addEventListener(MouseEvent.MOUSE_MOVE, containerMove);
		}
		private function containerStopDrag(e:MouseEvent) {
			scroller.stopDrag();
			RedAgent(scroller.root).removeEventListener(MouseEvent.MOUSE_UP, containerStopDrag);
			RedAgent(scroller.root).removeEventListener(MouseEvent.MOUSE_MOVE, containerMove);
		}
		private function containerMove(e:MouseEvent) {
			setPos((scroller.y-scrollerY)/scrollerHeight);
			//scrollArea.y = -(scroller.y-scrollerY)*(scrollArea.height-visibleHeight)/scrollerHeight ;
		}
		public function setPos(percentage:Number){
			scrollArea.y = -percentage*(scrollArea.height-visibleHeight) ;
			scroller.y = (percentage*scrollerHeight)+scrollerY;
		}
	}
}