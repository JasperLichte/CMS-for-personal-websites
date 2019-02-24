import Element from "./Block.js";

export default class BgCanvasAnimation {

  private canvas: HTMLCanvasElement;
  private ctx: CanvasRenderingContext2D;
  private height: number;
  private width: number;
  private lastRender: number;
  private timeElapsed: number = 0;
  private fps: number = 0;
  private elememts: Element[] = [];

  constructor(canvas: HTMLCanvasElement) {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');
    
    this.lastRender = (new Date()).getTime();
    this.loop = this.loop.bind(this);
    this.setWidthAndHeight = this.setWidthAndHeight.bind(this);

    this
      .handleResize()
      .addElements(150)
      .loop();
  }

  private loop() {
    requestAnimationFrame(this.loop);
    ////////////////////
    this.setTimeElapsed();
    this.clearCanvas();

    for (let i = 0; i < this.elememts.length; i++) {
      this.elememts[i].move(this.width, this.height).draw(this.ctx);
    }
      
  }

  private clearCanvas() {
    this.ctx.clearRect(0, 0, this.width, this.height);
  }

  private setWidthAndHeight() {
    this.width = this.canvas.clientWidth;
    this.height = this.canvas.clientHeight;
    this.canvas.setAttribute('width', '' + this.width);
    this.canvas.setAttribute('height', '' + this.height);
  }

  private handleResize(): BgCanvasAnimation {
    this.setWidthAndHeight();
    window.addEventListener('resize', this.setWidthAndHeight);

    return this;
  }

  private setTimeElapsed() {
    const current = (new Date()).getTime();
    this.timeElapsed = current - this.lastRender;
    this.lastRender = current;
    this.fps = ~~(1000 / this.timeElapsed);
  }

  private getFps() {
    return this.fps;
  }

  private addElements(n: number): BgCanvasAnimation {
    for (let i = 0; i < n; i++) {
      const radius = (Math.random() * (100 - 10) + 10);
      this.elememts.push(
        new Element(
          (Math.random() * ((this.width - radius) - radius) + radius),
          (Math.random() * ((this.height - radius) - radius) + radius),
          radius,
          (Math.random() * (2) -1),
          (Math.random() * (2) -1),
        )
      );
    }
    return this;
  }

}
