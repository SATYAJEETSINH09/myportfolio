/**
 * NOTES-MODAL.JS - Engineering Notes Article Reader Modal
 */

(function () {
  const noteModal = document.getElementById('note-modal');
  const noteContent = document.getElementById('note-modal-content');
  const closeBtn = document.getElementById('close-note-modal');

  if (!noteModal || !noteContent) return;

  function renderArticle(articleId) {
    const article = window.PORTFOLIO_DATA.articles.find(a => a.id === articleId);
    if (!article) return;

    // Simple markdown code block parser
    let formattedContent = article.content
      .replace(/### (.*?)\n/g, '<h3 style="font-family:var(--font-display); font-size:1.35rem; margin-top:2rem; margin-bottom:0.75rem;">$1</h3>')
      .replace(/```php([\s\S]*?)```/g, '<pre style="background:#0F0F11; color:#E4E4E7; padding:1.25rem; border-radius:8px; font-family:var(--font-mono); font-size:0.85rem; overflow-x:auto; margin:1rem 0; border:1px solid #27272A;"><code>$1</code></pre>')
      .replace(/```json([\s\S]*?)```/g, '<pre style="background:#0F0F11; color:#38BDF8; padding:1.25rem; border-radius:8px; font-family:var(--font-mono); font-size:0.85rem; overflow-x:auto; margin:1rem 0; border:1px solid #27272A;"><code>$1</code></pre>')
      .replace(/`([^`]+)`/g, '<code style="background:var(--bg-secondary); border:1px solid var(--border-primary); padding:0.15rem 0.4rem; border-radius:4px; font-family:var(--font-mono); font-size:0.85em;">$1</code>');

    noteContent.innerHTML = `
      <div class="case-study-hero">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
          <span class="note-cat">${article.category}</span>
          <span class="note-date">${article.date}</span>
        </div>
        <h2 style="font-size:clamp(1.75rem, 4vw, 2.75rem); text-transform:uppercase; line-height:1.15; margin-bottom:1rem;">
          ${article.title}
        </h2>
        <p style="font-size:1.1rem; color:var(--text-secondary);">
          ${article.excerpt}
        </p>
      </div>
      <div class="case-study-body" style="padding:2.5rem;">
        <div style="font-size:1.05rem; line-height:1.7; color:var(--text-primary);">
          ${formattedContent}
        </div>
      </div>
    `;

    noteModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeArticle() {
    noteModal.classList.remove('active');
    document.body.style.overflow = '';
  }

  window.openArticle = function (id) {
    renderArticle(id);
  };

  if (closeBtn) {
    closeBtn.addEventListener('click', closeArticle);
  }

  noteModal.addEventListener('click', (e) => {
    if (e.target === noteModal) {
      closeArticle();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && noteModal.classList.contains('active')) {
      closeArticle();
    }
  });
})();
