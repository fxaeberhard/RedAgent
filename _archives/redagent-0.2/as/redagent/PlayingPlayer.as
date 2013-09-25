package redagent {
	/**
	 * ...
	 * @author Francois-X Aeberhard
	 */
	public class PlayingPlayer extends Player {
		
		override public function setPos(xPos, yPos) {
			super.setPos(xPos, yPos);
			var v:Object = new Object();
			v.x = xPos;
			v.y = yPos;
			this.app.smartfox.setUserVariables(v);
		}
	}
}