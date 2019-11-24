import Config from "../../config/Config.js";
import { $, cssVars } from "../helper.js";
import { setInputValues } from "./customColorThemeSection.js";

export const changeColorTheme = async (colorThemeId: number) => {
  const apiUrl = Config.get('API_ROOT_DIR');
  const res = await fetch(`${apiUrl}users/theme.php?themeId=${colorThemeId}`);
  const resObj = await res.json();
  if (!resObj.success) return;
  const {theme} = resObj.data;
  const html = document.getElementsByTagName('html')[0];
  html.style.cssText = '';
  for (const varName in theme) {
    html.style.cssText += `--${varName}: ${theme[varName]}`;
  }

  if ($('#content-section-custom-color-theme-editor')) {
    setInputValues(cssVars());
  }
};

export const listenForColorThemeEvents = () => {
  document.querySelectorAll('#content-section-color-themes .color-theme-button')
  .forEach(button => {
    const themeId: number = parseInt(button.getAttribute('data-theme-id'));
    if (!themeId && themeId !== 0) return;
    button.addEventListener('click', async () => {
      button.classList.add('loading');
      await changeColorTheme(themeId);
      button.classList.remove('loading');
    });
  });
};
