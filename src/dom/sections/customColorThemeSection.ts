import { $ } from "../helper.js";
import Config from "../../config/Config.js";

export const listenForCustomColorThemeEvents = () => {
  const section: HTMLElement = $('#content-section-custom-color-theme-editor');
  if (!section) {
    return;
  }

  listenForValueChangeEvents(section);
  listenForSaveEvent(section);
}

const listenForValueChangeEvents = (section: HTMLElement) => {
  const changeCssVal = (name: string, val: string) => $('html').style.setProperty(`--${name}`, val);

  section.querySelectorAll('input').forEach(inp => {
    inp.addEventListener('input', () => {
      const saveBtn: HTMLButtonElement = section.querySelector('#save-custom-theme-btn');
      saveBtn && saveBtn.removeAttribute('disabled');

      changeCssVal(inp.name, inp.value);
    });
  });
}

const listenForSaveEvent = (section: HTMLElement) => {
  const btn: HTMLButtonElement = section.querySelector('#save-custom-theme-btn');
  if (!btn) {
    return;
  }

  btn.addEventListener('click', async () => {
    if (btn.disabled) return;

    const res = await fetch(
      `${Config.get('API_ROOT_DIR')}users/custom_theme.php`,
      {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({values: getInputValues(section)})
      }
    );
  });
}

const getInputValues = (section: HTMLElement) => {
  const vals = {};
  section.querySelectorAll('input[type=text]').forEach((inp: HTMLInputElement) => {
    vals[inp.name] = inp.value;
  });

  return vals;
}

export const setInputValues = (values: {}) => {
  const section = $('#content-section-custom-color-theme-editor');

  for (const key in values) {
    const inp: HTMLInputElement = section.querySelector(`input[name=${key}]`);
    if (inp) {
      inp.value = values[key];
    }
  }
}
