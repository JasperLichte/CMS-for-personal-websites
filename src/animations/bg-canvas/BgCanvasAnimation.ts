import Element from "./Element.js";

export default class BgCanvasAnimation {

  protected canvas: HTMLCanvasElement;
  protected ctx: CanvasRenderingContext2D;
  protected height: number;
  protected width: number;
  protected lastRender: number;
  protected timeElapsed: number = 0;
  protected fps: number = 0;
  protected running = true;
  protected elememts: Element[] = [];

  protected constructor(canvas: HTMLCanvasElement) {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');
    
    this.lastRender = (new Date()).getTime();
    this.loop = this.loop.bind(this);
    this.setWidthAndHeight = this.setWidthAndHeight.bind(this);

    this.loop();
  }

  protected loop() {
    this.running && requestAnimationFrame(this.loop);
    this.setTimeElapsed();
    this.clearCanvas();

    this.draw();
  }

  protected draw() {
  }

  protected stop() {
    this.running = false;
  }

  protected start() {
    this.running = true;
    this.loop();
  }

  protected clearCanvas() {
    this.ctx.clearRect(0, 0, this.width, this.height);
  }

  protected setWidthAndHeight() {
    this.width = this.canvas.clientWidth;
    this.height = this.canvas.clientHeight;
    this.canvas.setAttribute('width', '' + this.width);
    this.canvas.setAttribute('height', '' + this.height);
  }

  protected handleResize(): BgCanvasAnimation {
    return this;
  }

  protected setTimeElapsed() {
    const current = (new Date()).getTime();
    this.timeElapsed = current - this.lastRender;
    this.lastRender = current;
    this.fps = ~~(1000 / this.timeElapsed);
  }

  protected getFps() {
    return this.fps;
  }
  
  protected getRandomColor(brightness: number, alpha: number = 1): string {
    const rgb = [Math.random() * 256, Math.random() * 256, Math.random() * 256];
    const mix = [brightness*51, brightness*51, brightness*51]; //51 => 255/5
    const mixedrgb = [rgb[0] + mix[0], rgb[1] + mix[1], rgb[2] + mix[2]].map(function(x){ return Math.round(x/2.0)})
    return `rgba(${mixedrgb.join(",")}, ${alpha})`;
  }

}
