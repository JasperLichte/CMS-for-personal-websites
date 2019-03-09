import BgCanvasAnimation from "../animations/bg-canvas/BgCanvasAnimation.js";
import ColorAnimation from "../animations/colors/ColorAnimation.js";
import themes from "../animations/colors/themes.js";
import { 
  BG_ANIMATION,
  COLOR_ANIMATION,
  COLOR_ANIMATION_DELAY
} from '../config/env.js';
import { revealFunctionality } from "../funcs/func.js";

export default () => {

  if (BG_ANIMATION) {
    const animation = new BgCanvasAnimation(<HTMLCanvasElement> document.getElementById('bg-canvas'));
    revealFunctionality('bgAnimation', animation);
  }

  if (COLOR_ANIMATION) {
    const animation = new ColorAnimation(themes, COLOR_ANIMATION_DELAY);
    revealFunctionality('themes', animation.getThemes());
    revealFunctionality('changeTheme', ColorAnimation.changeTheme);
  }

}
