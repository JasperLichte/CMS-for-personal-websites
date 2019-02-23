export default class Block {

  public x: number;
  public y: number;
  private width: number = 50;
  private height: number = 50;
  private readonly COLOR = 'green';

  constructor(x: number, y: number) {
    this.x = x;
    this.y = y;
  }

  public move() {
    this.x += 0.5;
    this.y += 0.5;
    return this;
  }

  public draw(ctx: CanvasRenderingContext2D) {
    ctx.fillStyle = this.COLOR;
    ctx.fillRect(this.x, this.y, this.width, this.height);
    return this;
  }

}
