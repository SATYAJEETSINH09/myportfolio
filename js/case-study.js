/**
 * CASE-STUDY.JS - Case Study Drawer & Deep-Dive Renderer
 */

(function () {
  const caseStudyModal = document.getElementById('case-study-modal');
  const modalContent = document.getElementById('case-study-content');
  const closeBtn = document.getElementById('close-case-study');

  if (!caseStudyModal || !modalContent) return;

  function renderCaseStudy(slug) {
    const project = window.PORTFOLIO_DATA.projects.find(p => p.slug === slug) || window.PORTFOLIO_DATA.projects[0];
    const nextProjectIndex = (window.PORTFOLIO_DATA.projects.findIndex(p => p.slug === project.slug) + 1) % window.PORTFOLIO_DATA.projects.length;
    const nextProject = window.PORTFOLIO_DATA.projects[nextProjectIndex];

    const rolesHtml = project.roles ? project.roles.map(r => `
      <div class="role-step-item">
        <span class="role-step-title">${r}</span>
      </div>
    `).join('') : '';

    const metricsHtml = project.metrics ? `
      <div class="case-study-meta-grid" style="margin-top:0; margin-bottom:2rem;">
        ${project.metrics.map(m => `
          <div class="case-study-meta-item">
            <div class="label">${m.label}</div>
            <div class="val" style="font-size:1.5rem; color:var(--text-primary); font-family:var(--font-mono);">${m.val}</div>
          </div>
        `).join('')}
      </div>
    ` : '';

    const reqJson = project.apiDemo.request ? JSON.stringify(project.apiDemo.request, null, 2) : '// No request payload required for GET';
    const resJson = JSON.stringify(project.apiDemo.response, null, 2);

    modalContent.innerHTML = `
      <div class="case-study-hero">
        <div class="section-label">01 / CASE STUDY</div>
        <h2 style="font-size:clamp(2.2rem, 5vw, 3.5rem); text-transform:uppercase; margin-bottom:0.5rem;">${project.title}</h2>
        <div style="font-family:var(--font-mono); font-size:1rem; color:var(--text-secondary); margin-bottom:1.5rem;">
          ${project.tagline}
        </div>
        
        <div class="project-tech-pills">
          ${project.stack.map(s => `<span class="tech-pill">${s}</span>`).join('')}
        </div>

        <div class="case-study-meta-grid">
          <div class="case-study-meta-item">
            <div class="label">ROLE</div>
            <div class="val">${project.role}</div>
          </div>
          <div class="case-study-meta-item">
            <div class="label">TIMELINE</div>
            <div class="val">${project.year}</div>
          </div>
          <div class="case-study-meta-item">
            <div class="label">SYSTEM TYPE</div>
            <div class="val">${project.type}</div>
          </div>
          <div class="case-study-meta-item">
            <div class="label">STATUS</div>
            <div class="val" style="color:var(--accent-dot);">● Production Active</div>
          </div>
        </div>
      </div>

      <div class="case-study-body">
        <!-- 1. The Challenge -->
        <div>
          <div class="case-study-section-heading">THE PROBLEM & ARCHITECTURE CHALLENGE</div>
          <p style="font-size:1.15rem; line-height:1.7; color:var(--text-primary); margin-bottom:1.5rem;">
            ${project.challenge}
          </p>
        </div>

        <!-- 2. Verified Performance Metrics -->
        ${project.metrics ? `
          <div>
            <div class="case-study-section-heading">VERIFIED PRODUCTION PERFORMANCE</div>
            ${metricsHtml}
          </div>
        ` : ''}

        <!-- 3. My Engineering Responsibilities -->
        <div>
          <div class="case-study-section-heading">MY CORE RESPONSIBILITIES</div>
          <div class="role-breakdown-grid">
            ${rolesHtml}
          </div>
        </div>

        <!-- 4. System Architecture Diagram -->
        <div>
          <div class="case-study-section-heading">SYSTEM ARCHITECTURE TOPOLOGY</div>
          <div class="arch-diagram">
            <div class="arch-canvas">
              <div class="arch-layer">
                <div class="arch-node">
                  <div class="arch-node-title">Mobile App (Flutter/React Native)</div>
                  <div class="arch-node-desc">Students & Parents Client</div>
                </div>
                <div class="arch-node">
                  <div class="arch-node-title">Web Portal (SPA/Blade)</div>
                  <div class="arch-node-desc">School Staff & Super Admins</div>
                </div>
              </div>

              <div class="arch-connector-down">
                <div class="arch-connector-line"></div>
              </div>

              <div class="arch-layer">
                <div class="arch-node core-hub" style="width:100%;">
                  <div class="arch-node-title" style="font-size:1.05rem;">Laravel REST API Gateway</div>
                  <div class="arch-node-desc">Sanctum Auth · Form Validation · Action Pattern Services · Rate Limiting</div>
                </div>
              </div>

              <div class="arch-connector-down">
                <div class="arch-connector-line"></div>
              </div>

              <div class="arch-layer">
                <div class="arch-node">
                  <div class="arch-node-title">MySQL Database</div>
                  <div class="arch-node-desc">Relational DB with Indexes</div>
                </div>
                <div class="arch-node">
                  <div class="arch-node-title">Redis & Queue Workers</div>
                  <div class="arch-node-desc">Asynchronous FCM Jobs</div>
                </div>
                <div class="arch-node">
                  <div class="arch-node-title">External Gateways</div>
                  <div class="arch-node-desc">Firebase Cloud Messaging</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 5. API Showcase -->
        <div>
          <div class="case-study-section-heading">LIVE API ENDPOINT SPECIFICATION</div>
          <div class="api-showcase-box">
            <div class="api-endpoint-tabs">
              <button class="api-tab-btn active"><span class="api-req-badge api-req-${project.apiDemo.method.toLowerCase()}">${project.apiDemo.method}</span> ${project.apiDemo.endpoint}</button>
            </div>
            <div class="api-showcase-content">
              <div style="font-family:var(--font-mono); font-size:0.75rem; color:#A1A1AA; margin-bottom:0.5rem;">// REQUEST HEADERS & PAYLOAD:</div>
              <pre style="color:#38BDF8; font-size:0.8rem; margin-bottom:1.25rem; overflow-x:auto;">${reqJson}</pre>
              
              <div style="font-family:var(--font-mono); font-size:0.75rem; color:#A1A1AA; margin-bottom:0.5rem;">// HTTP 200 OK RESPONSE:</div>
              <pre style="color:#34D399; font-size:0.8rem; overflow-x:auto;">${resJson}</pre>
            </div>
          </div>
        </div>

        <!-- 6. Challenge -> Solution Grid -->
        <div>
          <div class="case-study-section-heading">CHALLENGE & IMPLEMENTATION MATRIX</div>
          <div class="problem-solution-cards">
            <div class="prob-sol-card">
              <div class="prob-sol-tag challenge">THE CHALLENGE</div>
              <p style="font-size:0.95rem; color:var(--text-primary); font-weight:600;">Concurrency & Duplicate Awards</p>
              <p style="font-size:0.875rem; color:var(--text-secondary); margin-top:0.5rem;">Multiple students submitting completions simultaneously triggered race conditions that could award double point balances.</p>
            </div>
            <div class="prob-sol-card">
              <div class="prob-sol-tag solution">MY SOLUTION</div>
              <p style="font-size:0.95rem; color:var(--text-primary); font-weight:600;">Atomic DB Transactions & DB Locks</p>
              <p style="font-size:0.875rem; color:var(--text-secondary); margin-top:0.5rem;">Implemented database-level unique completion indexes combined with pessimistic locking on point ledger entries.</p>
            </div>
          </div>
        </div>

        <!-- 7. Screenshot Gallery -->
        <div>
          <div class="case-study-section-heading">SYSTEM INTERFACE & SCHEMA ARTIFACTS</div>
          <div class="gallery-grid">
            <div class="gallery-item" onclick="window.openLightbox('${project.title} - Admin Management Dashboard')">
              <svg viewBox="0 0 500 300" style="width:100%; height:220px; background:#18181B;">
                <rect x="20" y="20" width="460" height="260" rx="8" fill="#27272A" />
                <rect x="40" y="40" width="100" height="220" rx="4" fill="#3F3F46" />
                <rect x="160" y="40" width="300" height="40" rx="4" fill="#3F3F46" />
                <rect x="160" y="95" width="140" height="75" rx="4" fill="#52525B" />
                <rect x="320" y="95" width="140" height="75" rx="4" fill="#52525B" />
                <rect x="160" y="185" width="300" height="75" rx="4" fill="#3F3F46" />
                <text x="180" y="65" fill="#E4E4E7" font-family="monospace" font-size="12" font-weight="bold">${project.title.toUpperCase()} BACKEND DASHBOARD</text>
              </svg>
              <div class="gallery-item-caption">Admin Operations & Workflow Management (Click to view)</div>
            </div>
            <div class="gallery-item" onclick="window.openLightbox('${project.title} - REST API Documentation & Logs')">
              <svg viewBox="0 0 500 300" style="width:100%; height:220px; background:#111113;">
                <rect x="20" y="20" width="460" height="260" rx="8" fill="#1C1C20" />
                <circle cx="45" cy="45" r="5" fill="#EF4444" />
                <circle cx="65" cy="45" r="5" fill="#F59E0B" />
                <circle cx="85" cy="45" r="5" fill="#10B981" />
                <text x="45" y="85" fill="#38BDF8" font-family="monospace" font-size="11">> routes/api.php</text>
                <text x="45" y="115" fill="#9CA3AF" font-family="monospace" font-size="11">Route::middleware(['auth:sanctum'])->group(function() {</text>
                <text x="65" y="145" fill="#FBBF24" font-family="monospace" font-size="11">  Route::apiResource('activities', ActivityController::class);</text>
                <text x="65" y="175" fill="#FBBF24" font-family="monospace" font-size="11">  Route::post('activities/{id}/complete', [ActivityController::class, 'complete']);</text>
                <text x="45" y="205" fill="#9CA3AF" font-family="monospace" font-size="11">});</text>
              </svg>
              <div class="gallery-item-caption">API Resource Routing & Schema Structure (Click to view)</div>
            </div>
          </div>
        </div>

        <!-- 8. Next Project Navigation -->
        <div style="border-top:1px solid var(--border-primary); padding-top:2.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
          <div>
            <div style="font-family:var(--font-mono); font-size:0.75rem; color:var(--text-muted); text-transform:uppercase;">NEXT CASE STUDY</div>
            <h3 style="font-size:1.75rem; font-weight:800; text-transform:uppercase;">${nextProject.title}</h3>
          </div>
          <button class="btn btn-primary" onclick="window.openCaseStudy('${nextProject.slug}')">
            VIEW NEXT PROJECT ↗
          </button>
        </div>
      </div>
    `;

    caseStudyModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeCaseStudy() {
    caseStudyModal.classList.remove('active');
    document.body.style.overflow = '';
  }

  window.openCaseStudy = function (slug) {
    renderCaseStudy(slug);
  };

  if (closeBtn) {
    closeBtn.addEventListener('click', closeCaseStudy);
  }

  caseStudyModal.addEventListener('click', (e) => {
    if (e.target === caseStudyModal) {
      closeCaseStudy();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && caseStudyModal.classList.contains('active')) {
      closeCaseStudy();
    }
  });
})();
