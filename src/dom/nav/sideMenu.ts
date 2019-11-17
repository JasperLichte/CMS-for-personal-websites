import { $ } from "../helper.js";

export const listenForNavEvents = () => {
  const sideMenu = $('nav#side-menu');
  const sideMenuToggle = $('button#side-menu-toggle');
  const sideMenuClose = $('nav#side-menu button#side-menu-close');

  sideMenuToggle.addEventListener('click', () => {
    if (sideMenu.classList.contains('visible')) {
      sideMenu.classList.remove('visible');
    } else {
      sideMenu.classList.add('visible');
    }
  });

  sideMenuClose.addEventListener('click', () => sideMenu.classList.remove('visible'));

};
