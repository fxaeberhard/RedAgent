package redagent{

	import flash.display.Sprite;
	
	public class CartDrawer extends Sprite {
		
		public function CartDrawer(){
			
			this.graphics.lineStyle(.25, 0x580000, 1);

		}
		
		public function cartMoveTo(x, z):void {
			this.graphics.moveTo(Utils.xCartToFla(x*40,0,z*40), Utils.yCartToFla(x*40,0,z*40));
		}
		public function cartLineTo(x, z):void{
			this.graphics.lineStyle(0.5, 0x580000, 1, true);
			this.graphics.lineTo(Utils.xCartToFla(x*40,0,z*40), Utils.yCartToFla(x*40,0,z*40));
		}
		public function drawSquare(x, z):void{
			this.graphics.lineTo(Utils.xCartToFla(x*40,0,z*40), Utils.yCartToFla(x*40,0,z*40));
		}
	}
}