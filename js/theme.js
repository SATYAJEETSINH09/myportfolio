/**
 * THEME.JS - Light + Dark Mode Manager
 * Light mode is default (#FFFFFF). Supports system preference & localStorage.
 */

(function () {
  const THEME_KEY = 'sd_portfolio_theme';
  const themeToggleBtns = document.querySelectorAll('.theme-toggle');

  // Initialize Theme
  function getPreferredTheme() {
    const savedTheme = localStorage.getItem(THEME_KEY);
    if (savedTheme) {
      return savedTheme;
    }
    // Default is explicitly light per requirements
    return 'light';
  }

  function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem(THEME_KEY, theme);

    themeToggleBtns.forEach(btn => {
      btn.innerHTML = theme === 'dark' ? '◐' : '☼';
      btn.setAttribute('aria-label', `Switch to ${theme === 'dark' ? 'light' : 'dark'} mode`);
      btn.setAttribute('title', `Switch to ${theme === 'dark' ? 'light' : 'dark'} mode`);
    });
  }

  function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    applyTheme(newTheme);
  }

  // Bind Events
  themeToggleBtns.forEach(btn => {
    btn.addEventListener('click', toggleTheme);
  });

  // Initial load
  const initialTheme = getPreferredTheme();
  applyTheme(initialTheme);

  // Expose global helper if needed
  window.setPortfolioTheme = applyTheme;
})();
