export default class Element {

  protected x: number;
  protected y: number;
  protected velX = 0.5;
  protected velY = 0.5;
  protected initialVelX = 0.5;
  protected initialVelY = 0.5;
  protected radius: number;
  protected color: string;

  protected constructor(
    x: number,
    y: number,
    radius: number,
    initialVelX: number,
    initialVelY: number,
    color: string
  ) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.velX = this.initialVelX = initialVelX;
    this.velY = this.initialVelY = initialVelY;
    this.color = color;
  }

  protected isInBounds(maxX: number, maxY: number): any[] {
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
    return this;
  }

  public draw(ctx: CanvasRenderingContext2D) {
    return this;
  }

}
