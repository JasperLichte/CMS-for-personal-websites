import {addProjectsFrames} from  './sections/liveProjectsFrame.js';
import {limitHeight} from './sections/sections.js';
import {listenForColorThemeEvents} from './sections/colorThemeSection.js';
import {listenForCustomColorThemeEvents} from './sections/customColorThemeSection.js';
import {listenForBgAnimationEvents} from './sections/bgAnimationsSection.js';
import { listenForNavEvents } from './nav/sideMenu.js';

export default () => {
  listenForNavEvents();

  // sections
  limitHeight();
  addProjectsFrames();
  listenForColorThemeEvents();
  listenForCustomColorThemeEvents();
  listenForBgAnimationEvents();
}
