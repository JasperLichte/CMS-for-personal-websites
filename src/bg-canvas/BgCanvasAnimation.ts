import Block from "./Block.js";

export default class BgCanvasAnimation {

  private canvas: HTMLCanvasElement;
  private ctx: CanvasRenderingContext2D;
  private height: number;
  private width: number;
  private lastRender: number;
  private timeElapsed: number = 0;
  private fps: number = 0;
  private blocks: Block[] = [];

  private readonly BG_COLOR = 'darkcyan';

  constructor(canvas: HTMLCanvasElement) {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');
    
    this.lastRender = (new Date()).getTime();

    this.handleResize();

    //this.blocks.push(new Block(this.width / 2, this.height / 2));

    this.loop = this.loop.bind(this);
    this.loop();
  }

  private loop() {
    requestAnimationFrame(this.loop);
    ////////////////////
    this.setTimeElapsed();
    this.clearCanvas();

    for (let i = 0; i < this.blocks.length; i++) {
      this.blocks[i].move().draw(this.ctx);
    }
      
  }

  private clearCanvas() {
    this.ctx.fillStyle = this.BG_COLOR;
    this.ctx.fillRect(0, 0, this.width, this.height);
  }

  private setWidthAndHeight() {
    this.width = this.canvas.clientWidth;
    this.height = this.canvas.clientHeight;
  }

  private handleResize() {
    this.setWidthAndHeight();
    this.canvas.setAttribute('width', '' + this.width);
    this.canvas.setAttribute('height', '' + this.height);
    this.canvas.addEventListener('resize', this.setWidthAndHeight);
  }

  private setTimeElapsed() {
    const current = (new Date()).getTime();
    this.timeElapsed = current - this.lastRender;
    this.lastRender = current;
    this.fps = ~~(1000 / this.timeElapsed);
  }

}
