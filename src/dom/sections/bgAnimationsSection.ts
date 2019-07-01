import Config from "../../config/Config.js";


export const changeBgAnimation = async (animationId: number) => {
  const apiUrl = Config.get('API_ROOT_DIR');
  const res = await fetch(`${apiUrl}users/bg-animation.php?animationId=${animationId}`);
  const resObj = await res.json();
  if (!resObj.success) return;
  window.location.reload();
};

export const listenForBgAnimationEvents = () => {
  document.querySelectorAll('#content-section-bg-animations .bg-animation-button')
  .forEach(button => {
    const animationId: number = parseInt(button.getAttribute('data-animation-id'));
    if (!animationId && animationId !== 0) return;
    button.addEventListener('click', () => changeBgAnimation(animationId));
  });
};
