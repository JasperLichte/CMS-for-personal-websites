import RainDrops from "./RainDrops.js";
import BgCanvasAnimation from "../BgCanvasAnimation.js";

export default class Rain extends BgCanvasAnimation {

  private numberOfElements: number;

  constructor(canvas: HTMLCanvasElement) {
    super(canvas);
    
    this.numberOfElements = this.calcNeededElements();
    this.addElements(this.numberOfElements);
  }

  protected draw() {
    for (let i = 0; i < this.elememts.length; i++) {
      this.elememts[i].move(this.width, this.height).draw(this.ctx);
    }
  }

  protected handleResize(): BgCanvasAnimation {
    this.setWidthAndHeight();
    window.addEventListener('resize', () => {
      this.setWidthAndHeight();

      const diff = this.calcNeededElements() - this.numberOfElements;
      if (diff > 0) {
        this.addElements(diff / 2);
      } else if (diff < 0) {
        this.removeElements(Math.abs(diff) / 150);
      }

    });

    return this;
  }

  public addElements(n: number): BgCanvasAnimation {
    n = ~~n;
    for (let i = 0; i < n; i++) {
      const radius = (Math.random() * (5 - 20) + 20);
      this.elememts.push(
        new RainDrops(
          (Math.random() * ((this.width - radius) - radius) + radius),
          (Math.random() * ((this.height - radius) - radius) + radius),
          radius,
          0,
          (Math.random() + 2) * radius / 4,
          this.getRandomColor(5, 0.175)
        )
      );
    }
    this.numberOfElements += n;
    return this;
  }

  public removeElements(n: number): BgCanvasAnimation {
    n = ~~n;
    this.elememts.splice(0, n);
    this.numberOfElements -= n;
    return this;
  }

  private calcNeededElements() {
    return ~~((this.height * this.width) / 40000);
  }

}
