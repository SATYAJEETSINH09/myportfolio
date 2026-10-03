/**
 * CURSOR.JS - Custom Fluid Desktop Cursor with Context Labels
 * Ensures dot & ring are perfectly centered and move together smoothly.
 */

(function () {
  // Respect prefers-reduced-motion & touch devices
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || window.matchMedia('(pointer: coarse)').matches) {
    return;
  }

  const dot = document.querySelector('.custom-cursor-dot');
  const ring = document.querySelector('.custom-cursor-ring');
  const label = document.querySelector('.custom-cursor-label');

  if (!dot || !ring) return;

  let mouseX = -100;
  let mouseY = -100;
  let ringX = -100;
  let ringY = -100;
  let isVisible = false;

  window.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;

    if (!isVisible) {
      isVisible = true;
      ringX = mouseX;
      ringY = mouseY;
      dot.style.opacity = '1';
      ring.style.opacity = '1';
    }

    // Perfectly center the dot on cursor
    dot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0) translate(-50%, -50%)`;
  }, { passive: true });

  window.addEventListener('mouseleave', () => {
    isVisible = false;
    dot.style.opacity = '0';
    ring.style.opacity = '0';
  });

  window.addEventListener('mouseenter', () => {
    if (isVisible) {
      dot.style.opacity = '1';
      ring.style.opacity = '1';
    }
  });

  // Smooth fluid loop for outer ring centered perfectly
  function render() {
    if (isVisible) {
      ringX += (mouseX - ringX) * 0.28;
      ringY += (mouseY - ringY) * 0.28;
      ring.style.transform = `translate3d(${ringX}px, ${ringY}px, 0) translate(-50%, -50%)`;
    }
    requestAnimationFrame(render);
  }
  requestAnimationFrame(render);

  // Dynamic hover triggers
  document.addEventListener('mouseover', (e) => {
    const target = e.target.closest('a, button, input, textarea, select, .service-card, .tool-pill-item, .expertise-row, .note-card');
    const projectCard = e.target.closest('[data-cursor-view]');

    if (projectCard) {
      document.body.classList.add('cursor-view');
      if (label) label.textContent = 'VIEW ↗';
    } else if (target) {
      document.body.classList.add('cursor-hover');
    }
  });

  document.addEventListener('mouseout', (e) => {
    const target = e.target.closest('a, button, input, textarea, select, .service-card, .tool-pill-item, .expertise-row, .note-card');
    const projectCard = e.target.closest('[data-cursor-view]');

    if (projectCard) {
      document.body.classList.remove('cursor-view');
    }
    if (target) {
      document.body.classList.remove('cursor-hover');
    }
  });
})();
