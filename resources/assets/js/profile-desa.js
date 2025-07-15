/**
 * Main - Front Pages
 */
'use strict';

(function () {
  const nav = document.querySelector('.layout-navbar');
  const heroAnimation = document.getElementById('hero-animation');
  const animationImg = document.querySelectorAll('.hero-dashboard-img');
  const animationElements = document.querySelectorAll('.hero-elements-img');

  // Hero Animation
  if (heroAnimation) {
    const mediaQueryXL = '1200';
    const width = screen.width;
    if (width >= mediaQueryXL) {
      heroAnimation.addEventListener('mousemove', function (e) {
        animationElements.forEach(layer => {
          layer.style.transform = 'translateZ(1rem)';
        });
        animationImg.forEach(layer => {
          let x = (window.innerWidth - e.pageX * 2) / 100;
          let y = (window.innerHeight - e.pageY * 2) / 100;
          layer.style.transform = `perspective(1200px) rotateX(${y}deg) rotateY(${x}deg) scale3d(1, 1, 1)`;
        });
      });
      nav.addEventListener('mousemove', function (e) {
        animationElements.forEach(layer => {
          layer.style.transform = 'translateZ(1rem)';
        });
        animationImg.forEach(layer => {
          let x = (window.innerWidth - e.pageX * 2) / 100;
          let y = (window.innerHeight - e.pageY * 2) / 100;
          layer.style.transform = `perspective(1200px) rotateX(${y}deg) rotateY(${x}deg) scale3d(1, 1, 1)`;
        });
      });

      heroAnimation.addEventListener('mouseout', function () {
        animationElements.forEach(layer => {
          layer.style.transform = 'translateZ(0)';
        });
        animationImg.forEach(layer => {
          layer.style.transform = 'perspective(1200px) scale(1) rotateX(0) rotateY(0)';
        });
      });
    }
  }

  // Swiper instances for carousels (if any)
  // This part can be added if you have carousels like customer reviews or logos.
  // For now, it's kept minimal as per the current page structure.

})();
