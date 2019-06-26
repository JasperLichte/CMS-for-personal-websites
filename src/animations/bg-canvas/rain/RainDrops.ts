import Element from "../Element.js";

export default class RainDrops extends Element {

  constructor(
    x: number,
    y: number,
    radius: number,
    initialVelX: number,
    initialVelY: number,
    color: string
  ) {
    super(x, y, radius, initialVelX, initialVelY, color);
  }

  public move(maxX: number, maxY: number) {
    const [isInBounds, axle] = this.isInBounds(maxX, maxY);
    if (!isInBounds && axle === 'y' && this.y > 0) {
      this.y = 10;
      this.velY = this.initialVelY;
    }
    this.y += this.velY;
    return this;
  }

  public draw(ctx: CanvasRenderingContext2D) {
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
    ctx.fill();
    return this;
  }

}
