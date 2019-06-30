export const addProjectsFrames = () => {
  document.querySelectorAll('#content-section-live-projects .live-project-wrapper')
  .forEach(wrapper => {
    const frameUrl: string = wrapper.getAttribute('data-frame-url');
    const frame: HTMLIFrameElement = document.createElement('iframe');
    frame.classList.add('preload');
    frame.setAttribute('src', frameUrl);
    frame.setAttribute('width', '100%');
    frame.setAttribute('height', '100%');
    frame.onload = () => {
      wrapper.setAttribute('style', 'background-color: #ccc;');
      frame.classList.remove('preload');
      const spinner: HTMLElement = wrapper.querySelector('.loading-spinner');
      spinner && spinner.remove();
    };
    wrapper.appendChild(frame);
  });
}
