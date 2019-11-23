export const $ = (selector: string): HTMLElement => document.querySelector(selector);
export const $$ = (selector: string): NodeListOf<HTMLElement> => document.querySelectorAll(selector);

export const cssVars = () => (s => Object.assign({},
  ...(Object.values(s).filter(v => v.startsWith('--'))
		.map(v => [v.substring(2), s.getPropertyValue(v).trim()]))
		.map(([key, val]) => ({[key]: val}))))
(document.querySelector('html').style);
