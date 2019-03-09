// @ts-ignore
const conf: string = window.__CONF || '{}';
// @ts-ignore
const data: string = window.__DATA || '{}';

let serverConfig = {};
let initialData = {};
try {
  serverConfig = JSON.parse(conf);
  initialData = JSON.parse(data);
} catch(e) {}

const int = (inp: any) => parseInt(inp);
const float = (inp: any) => parseFloat(inp);
const string = (inp: any) => '' + inp;
const bool = (inp: any) => !!inp;

export const APP_NAME: string               = string(serverConfig['APP_NAME']);
export const PRODUCTION: boolean            = bool(serverConfig['PRODUCTION']);
export const REPO_URL: string               = string(serverConfig['REPO_URL']);
export const VERSION: string                = string(serverConfig['VERSION']);
export const BG_ANIMATION: boolean          = bool(serverConfig['BG_ANIMATION']);
export const COLOR_ANIMATION: boolean       = bool(serverConfig['COLOR_ANIMATION']);
export const COLOR_ANIMATION_DELAY: number  = int(serverConfig['COLOR_ANIMATION_DELAY']);

export const INITIAL_DATA: object = initialData;
