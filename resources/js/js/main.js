/**
 * MAIN.JS - Orchestration, Loader, Scroll Observers, Magnetic CTAs & Dynamic State
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Initial Page Loader Animation
  const loader = document.getElementById('page-loader');
  const loaderBar = document.querySelector('.loader-progress-bar');
  const loaderPercent = document.getElementById('loader-percent');

  const hasVisited = sessionStorage.getItem('sd_has_visited');

  if (loader) {
    if (hasVisited) {
      loader.classList.add('loaded');
    } else {
      let progress = 0;
      const interval = setInterval(() => {
        progress += Math.floor(Math.random() * 20) + 10;
        if (progress >= 100) {
          progress = 100;
          clearInterval(interval);
          if (loaderBar) loaderBar.style.width = '100%';
          if (loaderPercent) loaderPercent.textContent = '100%';
          setTimeout(() => {
            loader.classList.add('loaded');
            sessionStorage.setItem('sd_has_visited', 'true');
          }, 200);
        } else {
          if (loaderBar) loaderBar.style.width = `${progress}%`;
          if (loaderPercent) loaderPercent.textContent = `${progress}%`;
        }
      }, 40);
    }
  }

  // 2. Scroll Reveal Observer System
  const revealElements = document.querySelectorAll('.reveal-on-scroll');
  if (revealElements.length > 0) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          observer.unobserve(entry.target);
        }
      });
    }, {
      root: null,
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));
  }

  // 3. Animated Stats Counter with Underline Reveal
  const statNumbers = document.querySelectorAll('.stat-number');
  const statsSection = document.getElementById('stats-section');
  let statsCounted = false;

  if (statsSection && statNumbers.length > 0) {
    const statsObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !statsCounted) {
          statsCounted = true;
          statsSection.classList.add('revealed');
          statNumbers.forEach(el => {
            const target = parseFloat(el.getAttribute('data-target'));
            const suffix = el.getAttribute('data-suffix') || '';
            const isDecimal = target % 1 !== 0;

            let start = 0;
            const duration = 1400;
            const stepTime = 30;
            const steps = duration / stepTime;
            const increment = target / steps;

            const timer = setInterval(() => {
              start += increment;
              if (start >= target) {
                start = target;
                clearInterval(timer);
                el.textContent = (isDecimal ? start.toFixed(1) : Math.round(start)) + suffix;
              } else {
                el.textContent = (isDecimal ? start.toFixed(1) : Math.round(start)) + suffix;
              }
            }, stepTime);
          });
        }
      });
    }, { threshold: 0.25 });

    statsObserver.observe(statsSection);
  }

  // 4. Subtle Magnetic Effect on Primary CTAs (Desktop Only)
  if (!window.matchMedia('(pointer: coarse)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const magneticBtns = document.querySelectorAll('.btn-primary');
    magneticBtns.forEach(btn => {
      btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        btn.style.transform = `translate(${x * 0.18}px, ${y * 0.18}px)`;
      });

      btn.addEventListener('mouseleave', () => {
        btn.style.transform = 'translate(0px, 0px)';
      });
    });
  }

  // 5. Mobile Menu Navigation
  const mobileToggle = document.getElementById('mobile-nav-toggle');
  const mobileMenu = document.getElementById('mobile-menu-overlay');
  const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('open');
      mobileToggle.innerHTML = isOpen ? '✕' : '☰';
      mobileToggle.setAttribute('aria-expanded', isOpen);
    });

    mobileNavLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        mobileToggle.innerHTML = '☰';
      });
    });
  }

  // 6. Active Navbar Link on Scroll
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');

  window.addEventListener('scroll', () => {
    let current = '';
    const scrollY = window.pageYOffset;

    sections.forEach(section => {
      const sectionHeight = section.offsetHeight;
      const sectionTop = section.offsetTop - 140;
      const sectionId = section.getAttribute('id');

      if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
        current = sectionId;
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  }, { passive: true });

  // 7. Live Time GMT+5:30 in Footer
  function updateLiveTime() {
    const timeEl = document.getElementById('live-time-val');
    if (timeEl) {
      const options = {
        timeZone: 'Asia/Kolkata',
        hour12: true,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      };
      const formatter = new Intl.DateTimeFormat([], options);
      timeEl.textContent = `${formatter.format(new Date())} IST (GMT+5:30)`;
    }
  }
  updateLiveTime();
  setInterval(updateLiveTime, 1000);

  // 8. Back to Top Button
  const backToTopBtn = document.getElementById('back-to-top-btn');
  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // 9. Deep Link Handler
  if (window.location.hash) {
    const hash = window.location.hash.replace('#', '');
    if (hash === 'dare-play' || hash === 'gomeds247' || hash === 'klean-health' || hash === 'shopsphere' || hash === 'personal-portfolio') {
      setTimeout(() => {
        if (window.openCaseStudy) window.openCaseStudy(hash);
      }, 400);
    }
  }
});
