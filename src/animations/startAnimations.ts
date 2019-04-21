import BgCanvasAnimation from "../animations/bg-canvas/BgCanvasAnimation.js";
import ColorAnimation from "../animations/colors/ColorAnimation.js";
import Config from "../config/Config.js";

export default () => {

  if (Config.get('BG_ANIMATION')) {
    new BgCanvasAnimation(<HTMLCanvasElement> document.getElementById('bg-canvas'));
  }

}
