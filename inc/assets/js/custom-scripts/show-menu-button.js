jQuery(document).ready(function ($) {
  const button = document.getElementById('menu-button');
  const initialPosition = button.offsetTop;
  let lastScrollTop = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY;

    if (currentScroll > initialPosition) {
      button.classList.add('fixed-menu-button');
    } else {
      button.classList.remove('fixed-menu-button');
    }

    if (currentScroll < lastScrollTop) {
      button.classList.remove('fixed-button');
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
  });
});
