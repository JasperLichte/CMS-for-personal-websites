import {addProjectsFrames} from  './liveProjectsFrame.js';
import {limitHeight} from './sections.js';
import {listenForColorThemeEvents} from './colorThemeSection.js';

export default () => {
  limitHeight();
  addProjectsFrames();
  listenForColorThemeEvents();
}
