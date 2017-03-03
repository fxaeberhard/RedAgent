package redagent {
	
	import flash.events.MouseEvent;
	import flash.display.DisplayObject;
	import flash.display.MovieClip;
	import flash.text.TextField ;
	import flash.geom.Rectangle;
    import flash.events.Event;
	
	public class TextScrollBar  {
		
		var scroller:MovieClip;
		var scrollerX:Number;
		var scrollerY:Number;
		var scrollerHeight:Number;// = 365;
		var visibleHeight:int;
		var scrollArea:TextField;
		
		public function TextScrollBar(scrollArea:TextField, scroller:MovieClip, scrollerHeight:int, visibleHeight:int) {
			this.scroller = scroller;
			this.scrollerX = scroller.x;
			this.scrollerY = scroller.y;
			this.scrollerHeight = scrollerHeight;
			
			this.scrollArea = scrollArea;
			this.visibleHeight = visibleHeight;
			scroller.addEventListener(MouseEvent.MOUSE_DOWN, containerStartDrag);
			scroller.buttonMode = true;
			scrollArea.addEventListener(Event.SCROLL, this.scrolledEvent);
		}
		private function scrolledEvent(e:Event){
			scroller.y = (scrollArea.scrollV/scrollArea.maxScrollV *scrollerHeight) +scrollerY;
		}
		private function containerStopDrag(e:MouseEvent) {
			scroller.stopDrag();
			RedAgent(scroller.root).removeEventListener(MouseEvent.MOUSE_UP, containerStopDrag);
			RedAgent(scroller.root).removeEventListener(MouseEvent.MOUSE_MOVE, containerMove);
		}
		private function containerStartDrag(e:MouseEvent) {
			scroller.startDrag(true, new Rectangle(scrollerX, scrollerY ,0, scrollerHeight));
			RedAgent(scroller.root).stage.addEventListener(MouseEvent.MOUSE_UP, containerStopDrag);
			RedAgent(scroller.root).stage.addEventListener(MouseEvent.MOUSE_MOVE, containerMove);
		}
		private function containerMove(e:MouseEvent) {
			setPos((scroller.y+scrollerY)/scrollerHeight);
		}
		public function setPos(percentage:Number){
			//trace(percentage);
			scrollArea.scrollV =  Math.round(percentage*scrollArea.maxScrollV);
			scroller.y = (percentage *scrollerHeight) -scrollerY;
		}
		
	}
}