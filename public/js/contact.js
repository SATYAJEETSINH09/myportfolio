/**
 * CONTACT.JS - Form Validation, Toast Feedback & Resume Handler
 */

(function () {
  const form = document.getElementById('contact-form');
  const toastContainer = document.getElementById('toast-container');

  function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-item';
    toast.innerHTML = `
      <span style="color:var(--accent-dot); font-size:1.1rem;">✓</span>
      <span>${message}</span>
    `;
    toastContainer.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100%)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }

  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('contact-name').value.trim();
      const email = document.getElementById('contact-email').value.trim();
      const message = document.getElementById('contact-message').value.trim();

      if (!name || !email || !message) {
        alert('Please fill out all required fields.');
        return;
      }

      // Simulated Frontend success (Ready for future Laravel backend POST)
      showToast(`Thank you, ${name}! Your message has been received.`);
      form.reset();
    });
  }

  // Resume Page Handler
  const openResumeBtns = document.querySelectorAll('.open-resume-trigger');
  openResumeBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = '/resume';
    });
  });

  // Image Lightbox Handler
  const lightbox = document.getElementById('image-lightbox');
  const lightboxCaption = document.getElementById('lightbox-caption');
  const closeLightbox = document.getElementById('close-lightbox');

  window.openLightbox = function (captionText) {
    if (lightbox) {
      if (lightboxCaption) lightboxCaption.textContent = captionText;
      lightbox.classList.add('active');
    }
  };

  if (closeLightbox && lightbox) {
    closeLightbox.addEventListener('click', () => {
      lightbox.classList.remove('active');
    });

    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) {
        lightbox.classList.remove('active');
      }
    });
  }
})();
