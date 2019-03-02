export default class ColorAnimation {

  private themes: object;
  private readonly delay = 25000;
  private colorSchemes: string[] = [];
  private currentScheme: string;
  private currentSchemeIndex: number = 0;

  public constructor(themes: object) {
    this.themes = themes;
    this.prepareThemes();
    this.loop = this.loop.bind(this);
    this.loop();
    setInterval(this.loop, this.delay);
  }

  private loop() {
    this.currentScheme = this.colorSchemes[this.currentSchemeIndex];
    ColorAnimation.changeTheme(this.themes[this.currentScheme]);
    this.currentSchemeIndex = (++this.currentSchemeIndex >= this.colorSchemes.length ? 0 : this.currentSchemeIndex);
  }

  private prepareThemes() {
    for (const name in this.themes) {
      this.colorSchemes.push(name);
    }
  }

  public static changeTheme(theme: object) {
    if (!theme) return;
    const html = document.getElementsByTagName('html')[0];
    for (const color in theme) {
      html.style.setProperty(`--${color}`, theme[color]);
    }
    
  }

}
