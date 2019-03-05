import BgCanvasAnimation from "../animations/bg-canvas/BgCanvasAnimation.js";
import ColorAnimation from "../animations/colors/ColorAnimation.js";
import themes from "../animations/colors/themes.js";
import { BG_ANIMATION, COLOR_ANIMATION } from '../config/env.js';

export default () => {
  if (BG_ANIMATION) {
    new BgCanvasAnimation(
      <HTMLCanvasElement> document.getElementById('bg-canvas')
    );
  }

  if (COLOR_ANIMATION) {
    new ColorAnimation(themes);
  }
}