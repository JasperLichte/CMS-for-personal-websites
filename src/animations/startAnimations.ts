import BgCanvasAnimation from "../animations/bg-canvas/BgCanvasAnimation.js";
import ColorAnimation from "../animations/colors/ColorAnimation.js";
import themes from "../animations/colors/themes.js";
import { 
  BG_ANIMATION,
  COLOR_ANIMATION,
  COLOR_ANIMATION_DELAY
} from '../config/env.js';

export default () => {

  if (BG_ANIMATION) {
    new BgCanvasAnimation(
      <HTMLCanvasElement> document.getElementById('bg-canvas')
    );
  }

  if (COLOR_ANIMATION) {
    //@ts-ignore
    window.__ = window.__ || {};
    //@ts-ignore
    window.__.animations = window.__.animations || {};
    //@ts-ignore
    window.__.animations.color = {
      animation: new ColorAnimation(themes, COLOR_ANIMATION_DELAY),
      _changeTheme: ColorAnimation.changeTheme,
    };
    //@ts-ignore
    window.__.animations.color.changeTheme = theme => {
      //@ts-ignore
      return window.__.animations.color._changeTheme(window.__.animations.color.animation.getTheme(theme));
    };
  }

}