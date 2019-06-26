import Config from "../config/Config.js";
import WanderingCircles from "../animations/bg-canvas/wanderingCircles/WanderingCircles.js";

export default () => {

  if (Config.get('BG_ANIMATION')) {
    const canvas = <HTMLCanvasElement>document.getElementById('bg-canvas')
    canvas && new WanderingCircles(canvas);
  }

}
