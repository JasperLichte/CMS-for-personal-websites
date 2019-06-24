import BgCanvasAnimation from "../animations/bg-canvas/BgCanvasAnimation.js";
import Config from "../config/Config.js";

export default () => {

  if (Config.get('BG_ANIMATION')) {
    const canvas = <HTMLCanvasElement>document.getElementById('bg-canvas')
    canvas && new BgCanvasAnimation(canvas);
  }

}
