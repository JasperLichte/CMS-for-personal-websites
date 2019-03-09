export const revealFunctionality = (funcName: string, value: Function|object|[]) => {
  // @ts-ignore
  window.__ = window.__ || {};
  // @ts-ignore
  window.__[funcName] = value;
};
