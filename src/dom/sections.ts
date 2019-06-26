export const limitHeight = (height: number = 600) => {
  document.querySelectorAll('#main-wrapper section.content-section')
  .forEach(section => {
    const contentWrapper = section.querySelector('.content-wrapper');
    if (
      !contentWrapper
      || height >= contentWrapper.getBoundingClientRect().height
    ) return;

    contentWrapper.classList.add('elapsed');
    contentWrapper.setAttribute('style', `height: ${height}px`);
    contentWrapper.scrollTop = 0;
  });  
}
