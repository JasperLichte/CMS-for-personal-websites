import {addProjectsFrames} from  './liveProjectsFrame.js';
import {limitHeight} from './sections.js';

export default () => {
  limitHeight();
  addProjectsFrames();
}
