import Config from "../config/Config.js";

export const listenForColorThemeEvents = () => {
  document.querySelectorAll('#content-section-color-themes .color-theme-button')
  .forEach(button => {
    const themeId: number = parseInt(button.getAttribute('data-theme-id'));
    if (!themeId) return;
    button.addEventListener('click', async () => {
      const apiUrl = Config.get('API_ROOT_DIR');
      const res = await fetch(`${apiUrl}users/theme.php?themeId=${themeId}`);
      const resObj = await res.json();
      if (!resObj.success) return;
      const {theme} = resObj.data;
      const html = document.getElementsByTagName('html')[0];
      html.style.cssText = '';
      for (const varName in theme) {
        html.style.cssText += `--${varName}: ${theme[varName]}`;
      }
    });
  });
}
