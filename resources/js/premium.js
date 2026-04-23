import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import { initHero3D } from './premium/hero3d';

gsap.registerPlugin(ScrollTrigger);

function prefersReducedMotion() {
  return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function initSectionMotions() {
  if (prefersReducedMotion()) return;

  gsap.utils.toArray('[data-reveal]').forEach((el) => {
    gsap.fromTo(
      el,
      { y: 18, opacity: 0 },
      {
        y: 0,
        opacity: 1,
        duration: 0.7,
        ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 84%', once: true },
      }
    );
  });

  gsap.utils.toArray('[data-float]').forEach((el) => {
    gsap.to(el, {
      y: -10,
      duration: 2.6,
      ease: 'sine.inOut',
      yoyo: true,
      repeat: -1,
    });
  });
}

window.addEventListener('DOMContentLoaded', () => {
  initHero3D();
  initSectionMotions();
});

