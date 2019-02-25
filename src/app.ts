import BgCanvasAnimation from "./animations/bg-canvas/BgCanvasAnimation.js";
import ColorAnimation from "./animations/colors/ColorAnimation.js";
import themes from "./animations/colors/themes.js";

new BgCanvasAnimation(<HTMLCanvasElement>document.getElementById('bg-canvas'));

new ColorAnimation(themes);
