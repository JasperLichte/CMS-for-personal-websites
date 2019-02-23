// @ts-ignore
const conf: object = window.__CONF || {};
// @ts-ignore
const data: string = window.__DATA || '{}';

export const APP_NAME: string = conf['APP_NAME'];
export const PRODUCTION: boolean = !!conf['PRODUCTION'];
export const REPO_URL: string = conf['REPO_URL'];
export const VERSION: string = conf['VERSION'];

export const INITIAL_DATA: object = JSON.parse(data);
