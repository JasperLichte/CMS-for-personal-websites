import Element from "../Element.js";

export default class WanderingCirclesElement extends Element {

  constructor(
    x: number,
    y: number,
    radius: number,
    initialVelX: number,
    initialVelY: number,
    color: string
  ) {
    super(x, y, radius, initialVelX, initialVelY, color);
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.velX = initialVelX;
    this.velY = initialVelY;
    this.color = color;
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
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
    ctx.fill();
    return this;
  }

}
