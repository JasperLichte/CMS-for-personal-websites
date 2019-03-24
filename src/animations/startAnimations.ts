import BgCanvasAnimation from "../animations/bg-canvas/BgCanvasAnimation.js";
import ColorAnimation from "../animations/colors/ColorAnimation.js";
import themes from "../animations/colors/themes.js";
import Config from "../config/Config.js";

export default () => {

  if (Config.get('BG_ANIMATION')) {
    new BgCanvasAnimation(<HTMLCanvasElement> document.getElementById('bg-canvas'));
  }

  if (Config.get('COLOR_ANIMATION')) {
    new ColorAnimation(themes, Config.get('COLOR_ANIMATION_DELAY'));
  }

}
