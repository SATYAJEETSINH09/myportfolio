/**
 * TERMINAL.JS - Interactive Developer Terminals & 3D Tilt
 */

(function () {
  // Hero Terminal Interactive Commands & Copy
  const heroTerminal = document.getElementById('hero-terminal-body');
  const copyHeroBtn = document.getElementById('copy-terminal-btn');

  if (copyHeroBtn && heroTerminal) {
    copyHeroBtn.addEventListener('click', () => {
      const text = heroTerminal.innerText;
      navigator.clipboard.writeText(text).then(() => {
        copyHeroBtn.textContent = 'COPIED!';
        setTimeout(() => {
          copyHeroBtn.textContent = 'COPY';
        }, 1800);
      });
    });
  }

  // Subtle 3D Parallax on Hero Terminal (Max 3-5 degrees)
  const terminalCard = document.querySelector('.hero-terminal-container .terminal-card');
  if (terminalCard && !window.matchMedia('(pointer: coarse)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const container = document.querySelector('.hero-terminal-container');
    container.addEventListener('mousemove', (e) => {
      const rect = container.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      // Controlled subtle tilt (3 to 4.5 degrees max)
      const tiltX = (y / (rect.height / 2)) * -4;
      const tiltY = (x / (rect.width / 2)) * 4;
      terminalCard.style.transform = `perspective(1000px) rotateX(${tiltX.toFixed(2)}deg) rotateY(${tiltY.toFixed(2)}deg) translateY(-4px)`;
    });

    container.addEventListener('mouseleave', () => {
      terminalCard.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)`;
    });
  }
})();
