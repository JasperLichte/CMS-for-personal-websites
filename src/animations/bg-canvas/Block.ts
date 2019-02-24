export default class Element {

  private x: number;
  private y: number;
  private velX = 0.5;
  private velY = 0.5;
  private radius: number;
  private readonly COLOR = 'green';

  constructor(
    x: number,
    y: number,
    radius: number,
    initialVelX: number,
    initialVelY: number,
  ) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.velX = initialVelX;
    this.velY = initialVelY;
  }

  private isInBounds(maxX: number, maxY: number): any[] {
    if (this.x - this.radius < 0) {
      return [false, 'x'];
    }
    if (this.y - this.radius  < 0) {
      return [false, 'y'];
    }
    if (this.x + this.radius > maxX) {
      return [false, 'x'];
    }
    if (this.y + this.radius > maxY) {
      return [false, 'y'];
    }
    return [true, ''];
  }

  public move(maxX: number, maxY: number) {
    const [isInBounds, axle] = this.isInBounds(maxX, maxY);
    if (!isInBounds) {
      if (axle === 'x') {
        this.velX *= -1;
      } else {
        this.velY *= -1;
      }
    }
    this.x += this.velX;
    this.y += this.velY;
    return this;
  }

  public draw(ctx: CanvasRenderingContext2D) {
    ctx.strokeStyle = this.COLOR;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
    ctx.stroke();
    return this;
  }

}
