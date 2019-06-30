import {addProjectsFrames} from  './sections/liveProjectsFrame.js';
import {limitHeight} from './sections/sections.js';
import {listenForColorThemeEvents} from './sections/colorThemeSection.js';
import {listenForBgAnimationEvents} from './sections/bgAnimationsSection.js';

export default () => {
  limitHeight();
  addProjectsFrames();
  listenForColorThemeEvents();
  listenForBgAnimationEvents();
}
