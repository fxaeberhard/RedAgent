package redagent{

	public class Utils {
		//////////////////////////////////////GENERAL MATH
		static function distance(x1:Number, y1:Number, x2:Number, y2:Number):Number {
			return Math.sqrt(Math.pow(x1 - x2,2) + Math.pow(y1 - y2,2));
		}
		////////////////////////////////////ISOMETRIC PERSPECTIV
		var xOrigin:int = 0;
		var yOrigin:int = 400;

		static var isoCos:Number = Math.cos(0.46365);
		static var isoSin:Number = Math.sin(0.46365);

		static function xCartToFla(x, y, z):Number {
			return ((x-z)*isoCos);

		}
		static function yCartToFla(x, y, z):Number {
			return (-(y+(x+z)*isoSin));
		}

		static function xFlaToCart(x, y, z):Number {
			return ((x)/isoCos-(z+y)/isoSin)/2;
		}
		static function yFlaToCart(x, y, z):Number {
			return (-((x)/isoCos+(z+y)/isoSin))/2;

		}
		//////////////////////OBJECT MANAGEMENT
		static function sizeof(o:Object):int {
			var size:int = 0;
			for (var ob:* in o) {
				size++;
			}
			return size;
		}
	}
}