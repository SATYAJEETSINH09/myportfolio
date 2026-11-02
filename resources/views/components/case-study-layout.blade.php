@props([
    'project',
    'nextProject' => null,
    'prevProject' => null,
    'settings' => [],
])

@php
    // Section 02: Project Overview (2-3 short, engaging paragraphs)
    $overviewParagraphs = match($project->slug) {
        'dare-play', 'dare-play-scheme-backend' => [
            'Dare Play Scheme is a specialized operational and compliance backend designed for childcare centers and Special Educational Needs and Disabilities (SEND) activity providers. It serves facility directors, support workers, team managers, and parents by unifying session bookings, staff allocation, daily care logs, and statutory child safety governance across multiple school and center sites.',
            'Before this system, childcare providers relied on fragmented paper registers, physical medication consent folders, and manual telephone notifications for critical incidents. This manual paradigm led to severe operational liabilities, including accidental overbooking past staff-to-child ratio limits, delayed communication during medical seizures or behavioral incidents, and lack of an auditable paper trail required for regulatory inspections. Dare Play Scheme replaces these workflows with a centralized API-driven system that enforces capacity thresholds, tracks real-time attendances with photographic verification, and automates safeguarding escalation workflows.',
        ],
        'gomeds247', 'gomeds-healthcare-backend' => [
            'GoMeds is an on-demand healthcare and diagnostic logistics platform designed to connect patients with hyperlocal retail pharmacies, accredited pathology laboratories, and field phlebotomists. The system handles prescription digitization, quote solicitation across nearby chemist networks, organ-specific diagnostic test scheduling, and doorstep medicine delivery through a centralized REST API backend.',
            'Prior to the platform, order handling relied on manual counter checks, phone-based quote coordination, and physical prescription drop-offs. This caused dispatch delays, unverified chain of custody during handoffs, and operational bottlenecks during peak hours. The software automates quote distribution across geofenced pharmacy clusters, books home sample collection slots against phlebotomist availability, enforces a two-factor physical verification PIN protocol, and extracts clinical biomarkers from pathology PDFs via automated parsing pipelines.',
        ],
        'klean-health', 'klean-health-backend' => [
            'Klean Health is a specialized backend engine powering cross-platform iOS and Android nutrition applications alongside an administrative clinical dashboard. The platform addresses the challenge of delivering automated dietary guidance at scale by computing individualized metabolic targets, logging dynamic food intake, filtering recipes against strict allergen profiles, and aggregating consolidated grocery shopping lists.',
            'Prior to centralizing this backend, health tracking setups relied on disconnected client-side calculations, disjointed push notifications that ignored user local times, and fragmented in-app billing logic between Google Play and the Apple App Store. Klean Health solves these breakdowns by anchoring all calculations server-side using the Mifflin-St Jeor formula, managing asynchronous StoreKit 2 and Google Play Subscriptions V2 webhooks, and executing timezone-aware queue workers to maintain accurate user entitlements and timely logging reminders.',
        ],
        'shopsphere' => [
            'ShopSphere is a full stack e-commerce web platform featuring dynamic catalog filtering, persistent shopping cart sessions, dual payment gateway routing, and automated invoice processing.',
            'E-commerce checkout drop-offs often occur when payment gateways fail or cart sessions expire across devices. ShopSphere addresses this with persistent cart synchronization, automatic fallback routing between international cards and domestic UPI, and an idempotency ledger preventing duplicate charges.',
        ],
        'personal-portfolio' => [
            'This personal developer portfolio is a production web application built to showcase engineering projects, technical notes, and professional background using Laravel 11, Blade components, and modern CSS design tokens.',
            'Most modern developer portfolios rely on bloated client-side JavaScript frameworks that introduce slow initial load times and excessive bundle sizes. This platform achieves sub-0.4s page loads, instant 60fps responsiveness, and a 100/100 Lighthouse score through pure server-rendered Blade templates and semantic CSS.',
        ],
        default => array_filter([
            $project->short_description,
            $project->description,
        ]),
    };

    // Section 03: Problem & Solution (2-Column Data)
    $problemSolution = match($project->slug) {
        'dare-play', 'dare-play-scheme-backend' => [
            'problem_title' => 'Unsynchronized Safeguarding and Capacity Bottlenecks',
            'problem_text' => 'Managing SEND childcare across multiple facilities created operational blind spots. Paper logs delayed reporting of critical seizure and accident events, while concurrent parent booking requests risked violating strict regulatory staff-to-child ratios without unified tenant boundaries.',
            'solution_title' => 'Scoped Multi-Tenancy and Structured Incident Workflows',
            'solution_text' => 'Implemented a multi-school scoped architecture with custom pipeline middleware and atomic database transactions. The system enforces session capacity limits and booking deadlines at query time while establishing strict relational audit trails for medical consents, daily personal care records, and incident notifications.',
        ],
        'gomeds247', 'gomeds-healthcare-backend' => [
            'problem_title' => 'Unverified Handoffs & Inventory Race Conditions',
            'problem_text' => 'Disjointed communication between independent pharmacies, riders, and patients created fulfillment discrepancies and lost packages. Furthermore, concurrent quote acceptances and simultaneous coupon redemptions produced inventory mismatches and double-spending across distributed vendors.',
            'solution_title' => 'Atomic Transactions & Dual-PIN Chain of Custody',
            'solution_text' => 'Implemented database transaction wrappers with pessimistic row locking and append-only coupon usage ledgers to preserve transactional integrity during checkout. Designed a dual 6-digit cryptographic PIN verification handshake requiring independent authorization at pharmacy dispatch and customer handover before order state transitions commit.',
        ],
        'klean-health', 'klean-health-backend' => [
            'problem_title' => 'Entitlement Drift & Computational Clashes',
            'problem_text' => 'Synchronizing recurring subscriptions across Google Play and Apple App Store introduced race conditions, missing purchase acknowledgements, and delayed access revocations. Concurrently, calculating dynamic macronutrient distributions and enforcing complex allergen exclusions across high-volume meal logs created significant client-side inconsistency and unoptimized database reads.',
            'solution_title' => 'Event-Driven Webhooks & Normalized Logic',
            'solution_text' => 'Built an idempotent webhook ingestion pipeline using Google Cloud Pub/Sub with OIDC JWT verification and Apple StoreKit 2 JWS decoding wrapped in atomic database transactions. Centralized all nutritional logic on the backend with dynamic unit converters (metric/imperial), database-level allergen exclusion queries (whereDoesntHave), and Redis-backed queue workers for asynchronous processing.',
        ],
        'shopsphere' => [
            'problem_title' => 'Checkout Drop-offs & Duplicate Payment Retries',
            'problem_text' => 'Network timeouts during checkout caused customer card retries and duplicate transactions, while cart state was frequently lost when customers switched between mobile browsers and desktop devices.',
            'solution_title' => 'Webhook Idempotency Ledger & Dual Gateway Routing',
            'solution_text' => 'Created a cryptographic webhook idempotency ledger preventing double-charging, integrated dual payment gateway failover between Stripe and Razorpay, and built session-backed cart synchronization.',
        ],
        'personal-portfolio' => [
            'problem_title' => 'Client-Side Bundle Bloat & Framework Overhead',
            'problem_text' => 'Heavy single-page application (SPA) frameworks often impose 500KB+ JavaScript bundle payloads, layout shifting, and poor serverless cold-start performance for simple portfolio showcases.',
            'solution_title' => 'Component-Driven Blade Architecture & Pure CSS Tokens',
            'solution_text' => 'Architected the application with native Laravel 11 Blade components, zero runtime client JS frameworks, pure CSS variables for instant theme toggling, and serverless runtime optimizations on Vercel.',
        ],
        default => [
            'problem_title' => 'Operational Bottlenecks & Data Fragmentation',
            'problem_text' => $project->challenge ?? 'Managing complex data workflows without centralized automation created operational bottlenecks and verification delays.',
            'solution_title' => 'Engineered Software Architecture',
            'solution_text' => $project->solution ?? 'Architected a modular backend system with optimized database indexing, secure authentication, and resilient API contracts.',
        ],
    };

    // Section 04: System Architecture / Workflow Steps (4 Clean Steps)
    $workflowSteps = match($project->slug) {
        'dare-play', 'dare-play-scheme-backend' => [
            ['title' => 'Client Action / Trigger', 'desc' => 'A parent submits a multi-date session booking or a support worker logs an on-site incident report via the mobile or web interface.'],
            ['title' => 'API Gateway & Scope Lock', 'desc' => 'Laravel Sanctum authenticates the bearer token, while ResolveAdminScope middleware locks execution to the active school site.'],
            ['title' => 'Core Logic & Atomicity', 'desc' => 'Backend validates capacity deadlines and guardian associations (ParentChildSelection), performing atomic database transactions.'],
            ['title' => 'Async Broadcast & FCM', 'desc' => 'Events dispatch real-time alerts via Pusher WebSockets and FCM push notifications, while DomPDF generates statutory audit summaries.'],
        ],
        'gomeds247', 'gomeds-healthcare-backend' => [
            ['title' => 'Client Action / Upload', 'desc' => 'Customer uploads prescription, selects medicines, or books lab slots specifying delivery coordinates.'],
            ['title' => 'API Gateway & Geofence', 'desc' => 'Sanctum/JWT validates tokens, sanitizes schemas, and checks geofence polygon operating boundaries.'],
            ['title' => 'Atomic Ledger & Dual-PIN', 'desc' => 'Transaction locks pricing, broadcasts quotes to matching chemists, and generates 6-digit security PINs.'],
            ['title' => 'Async Queues & Gemini AI', 'desc' => 'Queue workers dispatch Pusher socket events, FCM alerts, and extract biomarkers via Gemini API.'],
        ],
        'klean-health', 'klean-health-backend' => [
            ['title' => 'Client Action / Trigger', 'desc' => 'Mobile app dispatches authenticated REST API request (logging a meal, updating biometrics, or IAP receipt).'],
            ['title' => 'API Gateway & Unit Sanitizer', 'desc' => 'Intercepted by JWT auth, EnsureCustomerIsActive middleware, rate limiters, and unit sanitizers (ft/lbs to cm/kg).'],
            ['title' => 'Metabolic Logic & Writes', 'desc' => 'Executes Mifflin-St Jeor BMR/TDEE calculations, recalculates caloric targets, and persists atomic database writes.'],
            ['title' => 'Async Queues & RTDN Webhooks', 'desc' => 'Evaluates user timezones to queue FCM meal reminders, processes Google/Apple RTDN webhooks, and exports PDFs.'],
        ],
        'shopsphere' => [
            ['title' => 'Storefront Cart', 'desc' => 'Customer adds items to cart with cross-device session synchronization.'],
            ['title' => 'Express API Gateway', 'desc' => 'Node.js middleware validates JWT token and checks real-time inventory availability.'],
            ['title' => 'Dual Payment Router', 'desc' => 'Routes transaction to Stripe (international cards) or Razorpay (domestic UPI).'],
            ['title' => 'Idempotent Ledger', 'desc' => 'Idempotency key verification guarantees no double-charging on network retries.'],
        ],
        'personal-portfolio' => [
            ['title' => 'Visitor Request', 'desc' => 'HTTP request hits Vercel edge CDN with sub-0.4s initial serverless execution.'],
            ['title' => 'Laravel Blade Engine', 'desc' => 'Server-renders semantic HTML with zero JavaScript framework dependencies.'],
            ['title' => 'Structured SQLite', 'desc' => 'Decoupled relational storage queries case study metadata, blog posts, and settings.'],
            ['title' => 'Interactive Features', 'desc' => 'Client-side micro-interactions (theme toggle, terminal CLI, Lightbox) run at 60 FPS.'],
        ],
        default => [
            ['title' => 'Client Request', 'desc' => 'Web or mobile client initiates secure request with payload.'],
            ['title' => 'API Validation', 'desc' => 'Middleware validates authentication, permissions, and input fields.'],
            ['title' => 'Database Transaction', 'desc' => 'Relational database executes queries with transaction isolation.'],
            ['title' => 'Response & Queue', 'desc' => 'Standardized JSON returned and background tasks dispatched.'],
        ],
    };

    // Section 06: My Engineering Contributions (4-6 Concise Bullet Points)
    $contributions = match($project->slug) {
        'dare-play', 'dare-play-scheme-backend' => [
            'Designed and implemented 40+ RESTful API endpoints in Laravel 11 supporting both mobile and web clients with consistent JSON response contracts and strict form request validation.',
            'Designed the multi-school relational schema with indexing on foreign keys (school_id, child_id, parent_id, date) to ensure data separation across multi-tenant facilities.',
            'Engineered a 12-tier Role-Based Access Control matrix using spatie/laravel-permission coupled with custom session/token middleware to enforce school boundaries across administrative operations.',
            'Implemented the ParentChildSelection trait to prevent unauthorized access across non-custodial or secondary parents while maintaining child record context across requests.',
            'Integrated Firebase Cloud Messaging (FCM) using google/auth service account credentials, Pusher WebSocket channels for broadcasted events, and Barryvdh DomPDF for statutory report generation.',
            'Integrated Spatie Activitylog to record immutable mutations with school-site context, while using existence validation queries and status transitions to eliminate duplicate bookings and attendance clashes.',
        ],
        'gomeds247', 'gomeds-healthcare-backend' => [
            'Structured and maintained modular API endpoints using Laravel 11, implementing strict request validation, role-based access control (RBAC), and token lifecycle management for customers, vendors, and delivery agents.',
            'Wrapped checkout execution, quote lock-in, and promotional claims within database transactions using pessimistic locks and ledger tables to prevent race conditions during concurrent user requests.',
            'Offloaded blocking I/O tasks—such as Firebase Cloud Messaging (FCM) notifications, Pusher WebSocket broadcasts, and PDF document rendering—to asynchronous Redis-backed queue workers.',
            'Wrote distance calculation queries and address resolution handlers to automatically match order locations to registered vendor operating radii.',
            'Engineered an automated pathology report parser leveraging Gemini 2.5 Flash with strict structured JSON output guarantees, persisting extracted biomarkers to relational schemas and generating consolidated clinical summary PDFs.',
            'Structured relational schemas across orders, quote logs, lab bookings, and telemetry with composite indexing on foreign keys and status flags to maintain predictable query execution times.',
        ],
        'klean-health', 'klean-health-backend' => [
            'Designed and implemented over 40 structured API endpoints in Laravel 12 with strict Form Request validation, custom exception handlers, and JSON throttling for high-traffic mobile consumption.',
            'Built custom middleware (VerifyPubSubJwt) to validate Google Cloud Pub/Sub OIDC bearer tokens against Google public certificates and decoded StoreKit 2 JWS certificate chains, preventing unauthorized webhook execution.',
            'Architected relational schemas across 30+ tables with composite indexes on user_id and log_date, ensuring fast queries for food logs, favorites, and recipe search.',
            'Configured background queue jobs for FCM push dispatching and scheduled command workers that query user records in 500-user chunks to prevent memory bloat during notification broadcasts.',
            'Developed a standalone UnitConverter service handling seamless conversions between imperial and metric systems (height, weight, food measurements) before calculating BMI or storing normalized values in the database.',
            'Enforced database transaction closures (DB::transaction) during subscription updates and receipt verifications to eliminate race conditions between real-time webhooks and manual client sync calls.',
        ],
        'shopsphere' => [
            'Engineered RESTful backend microservices in Node.js and Express with JWT authentication and input validation.',
            'Implemented dual payment gateway routing between Stripe for international credit cards and Razorpay for domestic UPI and netbanking.',
            'Designed a webhook idempotency ledger to prevent duplicate transactions on network timeouts and checkout retries.',
            'Created MongoDB document schemas with compound indexing and aggregation pipelines for real-time product search and catalog filtering.',
            'Built responsive user interfaces and persistent shopping cart synchronization across devices using React and Tailwind CSS.',
        ],
        'personal-portfolio' => [
            'Architected and built the application using Laravel 11 and component-driven Blade templates without heavy frontend JS frameworks.',
            'Engineered semantic CSS design tokens enabling instant light and dark theme switching with zero page flash or style recomputation.',
            'Configured serverless runtime optimizations directing Blade compiled views, cache, and session writes to /tmp for Vercel deployment.',
            'Designed an administrative back-office interface for managing project case studies, engineering blog posts, and contact inquiries.',
            'Optimized asset bundling with Vite and pure CSS transforms, achieving a 100/100 Lighthouse score and sub-0.4s initial render.',
        ],
        default => [
            'Engineered modular REST API endpoints following standardized JSON responses and FormRequest validation.',
            'Implemented authentication and role-based access control with Laravel policies and gates.',
            'Structured relational database schemas with indexing and optimized Eloquent relationships.',
            'Managed asynchronous background queue workers for external integrations and notifications.',
        ],
    };

    // Section 09: Outcome & Engineering Learnings (2-Column Data)
    $outcomeLearnings = match($project->slug) {
        'dare-play', 'dare-play-scheme-backend' => [
            'outcome' => 'Successfully transitioned multi-site childcare operations from manual logbooks to a single auditable platform, eliminating overbooking risks and ensuring compliance with UK safeguarding and child welfare recording standards.',
            'learnings' => 'Designing multi-tenant context resolution at the middleware layer rather than scattering school filters inside individual controllers significantly reduces data leak risks and keeps controller code maintainable and testable.',
        ],
        'gomeds247', 'gomeds-healthcare-backend' => [
            'outcome' => 'Digitized localized pharmacy fulfillment and pathology collection into an integrated logistics network, standardizing pickup verification and eliminating manual quote coordination.',
            'learnings' => 'Designing append-only ledger tables with row-level transaction locks is critical when orchestrating multi-vendor promotions and inventory holdouts under concurrent load. Furthermore, separating external third-party APIs (push alerts, SMS gateways, and LLM extraction) into dedicated worker queues is vital for safeguarding core HTTP latency and throughput.',
        ],
        'klean-health', 'klean-health-backend' => [
            'outcome' => 'Delivered a unified, resilient backend powering mobile applications with automated subscription reconciliation, eliminating manual entitlement discrepancies and ensuring sub-second response times for daily food logging.',
            'learnings' => 'Gained deep experience in verifying cryptographic tokens (Google OIDC and Apple JWS signatures) on incoming webhooks, and reinforced the necessity of database transaction isolation and idempotent job dispatching when managing asynchronous billing state machines.',
        ],
        'shopsphere' => [
            'outcome' => 'Delivered a resilient full stack e-commerce platform with dual payment gateway failover, persistent cart synchronization, and 100% payment idempotency.',
            'learnings' => 'Mastered payment gateway webhook security, transaction idempotency ledgers, MongoDB compound aggregation pipelines, and cross-device cart session management.',
        ],
        'personal-portfolio' => [
            'outcome' => 'Achieved a blazing-fast, 100/100 Lighthouse performance portfolio with sub-0.4s initial render, zero client JS bloat, and seamless light/dark aesthetics.',
            'learnings' => 'Gained practical insights into Laravel serverless optimization for Vercel, advanced CSS custom property architecture, and creating native-like micro-interactions without heavy external libraries.',
        ],
        default => [
            'outcome' => 'Delivered a stable, production-tested software system satisfying business requirements and user needs.',
            'learnings' => 'Refined architectural patterns, database performance optimization, and modular API design principles.',
        ],
    };

    // Check if real cover image exists on disk
    $hasRealCover = !empty($project->cover_image) && (file_exists(public_path($project->cover_image)) || file_exists(storage_path('app/public/' . $project->cover_image)));
    $realCoverUrl = null;
    if ($hasRealCover) {
        $realCoverUrl = file_exists(public_path($project->cover_image)) ? asset($project->cover_image) : asset('storage/' . $project->cover_image);
    }

    // Check if real screenshots exist on disk (excluding any fake SVGs)
    $realScreenshots = $project->images->filter(function($img) {
        if (empty($img->image)) return false;
        if (str_ends_with(strtolower($img->image), '.svg')) return false;
        return file_exists(public_path($img->image)) || file_exists(storage_path('app/public/' . $img->image));
    });

    $sectionIdx = 1;
@endphp

<article class="cs-article">
  <div class="cs-container">

    <!-- Top Breadcrumb & Category -->
    <nav class="cs-breadcrumb-bar" aria-label="Breadcrumb">
      <a href="{{ route('portfolio.home') }}#work" class="cs-back-link">
        ← Back to Projects
      </a>
      <span class="cs-category-badge">{{ $project->category ?? 'CASE STUDY' }}</span>
    </nav>

    <!-- =============================================================
         01. Project Header
         ============================================================= -->
    <header class="cs-header-wrap" id="cs-header">
      <h1 class="cs-project-title">{{ $project->title }}</h1>
      <p class="cs-project-tagline">{{ $project->tagline }}</p>

      <!-- Metadata Strip -->
      <div class="cs-meta-grid">
        <div class="cs-meta-item">
          <div class="label">Role</div>
          <div class="val">{{ $project->role ?? 'Backend Developer' }}</div>
        </div>
        <div class="cs-meta-item">
          <div class="label">Timeline</div>
          <div class="val">{{ $project->year ?? '2025–2026' }}</div>
        </div>
        <div class="cs-meta-item">
          <div class="label">System Type</div>
          <div class="val">{{ $project->project_type ?? 'Web Application' }}</div>
        </div>
        <div class="cs-meta-item">
          <div class="label">Status</div>
          <div class="val cs-status-indicator">● Production Active</div>
        </div>
      </div>



      <!-- Tech Stack Badges -->
      @if($project->technologies->count() > 0)
        <div class="cs-header-tech">
          @foreach($project->technologies as $tech)
            <span class="cs-header-tech-chip">{{ $tech->name }}</span>
          @endforeach
        </div>
      @endif

      <!-- Real Preview Image (Only if real file exists on disk) -->
      @if($hasRealCover)
        <div class="cs-hero-preview">
          <img src="{{ $realCoverUrl }}" alt="{{ $project->title }} Preview" loading="eager" />
        </div>
      @endif
    </header>


    <!-- =============================================================
         02. Project Overview (Fluid Editorial Layout)
         ============================================================= -->
    <section class="cs-section" id="cs-overview">
      <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Project Overview</div>
      <h2 class="cs-section-heading">System Overview & Purpose</h2>
      
      <div class="cs-overview-lead">
        <p>{{ $overviewParagraphs[0] ?? $project->short_description }}</p>
      </div>

      <div class="cs-overview-body">
        @foreach(array_slice($overviewParagraphs, 1) as $paragraph)
          <p>{{ $paragraph }}</p>
        @endforeach
      </div>
    </section>


    <!-- =============================================================
         03. Problem & Solution (2-Column Split Layout)
         ============================================================= -->
    <section class="cs-section" id="cs-problem-solution">
      <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Problem & Solution</div>
      <h2 class="cs-section-heading">The Core Problem & Engineered Solution</h2>

      <div class="cs-prob-sol-grid">
        <div class="cs-prob-sol-col problem">
          <span class="cs-prob-sol-tag">The Operational Challenge</span>
          <h4>{{ $problemSolution['problem_title'] }}</h4>
          <p>{{ $problemSolution['problem_text'] }}</p>
        </div>

        <div class="cs-prob-sol-col solution">
          <span class="cs-prob-sol-tag">The Engineered Solution</span>
          <h4>{{ $problemSolution['solution_title'] }}</h4>
          <p>{{ $problemSolution['solution_text'] }}</p>
        </div>
      </div>
    </section>


    <!-- =============================================================
         04. System Architecture / Workflow
         ============================================================= -->
    <section class="cs-section" id="cs-workflow">
      <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / System Architecture & Workflow</div>
      <h2 class="cs-section-heading">High-Level System Workflow</h2>

      <div class="cs-workflow-wrap">
        <div class="cs-workflow-steps">
          @foreach($workflowSteps as $idx => $step)
            <div class="cs-workflow-card">
              <span class="cs-workflow-step-num">{{ $idx + 1 }}</span>
              <h4 class="cs-workflow-title">{{ $step['title'] }}</h4>
              <p class="cs-workflow-desc">{{ $step['desc'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>


    <!-- =============================================================
         05. Key Features (Clean Minimal Grid)
         ============================================================= -->
    @if($project->features->count() > 0)
      <section class="cs-section" id="cs-features">
        <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Key Features</div>
        <h2 class="cs-section-heading">Implemented System Capabilities</h2>

        <div class="cs-features-grid">
          @foreach($project->features as $idx => $feature)
            <div class="cs-feature-card">
              <div class="cs-feature-card-header">
                <span class="cs-feature-num">0{{ $idx + 1 }}</span>
                <h3 class="cs-feature-title">{{ $feature->title }}</h3>
              </div>
              <p class="cs-feature-desc">{{ $feature->description }}</p>
            </div>
          @endforeach
        </div>
      </section>
    @endif


    <!-- =============================================================
         06. My Contributions (Concise Bullet Points)
         ============================================================= -->
    <section class="cs-section" id="cs-contributions">
      <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Engineering Contributions</div>
      <h2 class="cs-section-heading">What I Developed & Delivered</h2>

      <ul class="cs-contributions-list">
        @foreach($contributions as $item)
          <li class="cs-contribution-item">{{ $item }}</li>
        @endforeach
      </ul>
    </section>


    <!-- =============================================================
         07. Technology Stack (Simple Badges)
         ============================================================= -->
    @if($project->technologies->count() > 0)
      <section class="cs-section" id="cs-technologies">
        <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Technology Stack</div>
        <h2 class="cs-section-heading">Technologies & Tools Used</h2>

        <div class="cs-tech-chips-wrap">
          @foreach($project->technologies as $tech)
            <span class="cs-tech-chip">{{ $tech->name }}</span>
          @endforeach
        </div>
      </section>
    @endif


    <!-- =============================================================
         08. Project Screenshots Gallery (Only if real images exist)
         ============================================================= -->
    @if($realScreenshots->count() > 0)
      <section class="cs-section" id="cs-screenshots">
        <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Interface & Screenshots</div>
        <h2 class="cs-section-heading">System Interface & Screenshots</h2>

        <div class="cs-gallery-grid">
          @foreach($realScreenshots as $img)
            <div 
              class="cs-gallery-card"
              onclick="window.openLightbox('{{ $img->image_url }}', '{{ $project->title }} — {{ $img->caption ?? $img->alt_text }}')"
              data-cursor-view
            >
              <img src="{{ $img->image_url }}" alt="{{ $img->alt_text ?? $project->title }}" loading="lazy" />
              @if(!empty($img->caption))
                <div class="cs-gallery-caption">{{ $img->caption }}</div>
              @endif
            </div>
          @endforeach
        </div>
      </section>
    @endif


    <!-- =============================================================
         09. Outcome & Engineering Learnings
         ============================================================= -->
    <section class="cs-section" id="cs-outcome">
      <div class="cs-section-kicker">{{ sprintf('%02d', $sectionIdx++) }} / Outcome & Learnings</div>
      <h2 class="cs-section-heading">Project Impact & Key Takeaways</h2>

      <div class="cs-outcome-grid">
        <div class="cs-outcome-card">
          <div class="cs-outcome-card-label">Production Impact & Outcome</div>
          <p class="cs-outcome-card-text">{{ $outcomeLearnings['outcome'] }}</p>
        </div>

        <div class="cs-outcome-card">
          <div class="cs-outcome-card-label">Key Engineering Learnings</div>
          <p class="cs-outcome-card-text">{{ $outcomeLearnings['learnings'] }}</p>
        </div>
      </div>
    </section>


    <!-- =============================================================
         10. Project Navigation
         ============================================================= -->
    <nav class="cs-nav-row" id="cs-navigation" aria-label="Case Study Pagination">
      @if($prevProject)
        <a href="{{ route('projects.show', $prevProject) }}" class="cs-nav-btn prev">
          <span class="dir">← Previous Project</span>
          <span class="name">{{ $prevProject->title }}</span>
        </a>
      @else
        <div></div>
      @endif

      <div class="cs-nav-center">
        <a href="{{ route('portfolio.home') }}#work" class="cs-back-link">
          All Projects
        </a>
      </div>

      @if($nextProject)
        <a href="{{ route('projects.show', $nextProject) }}" class="cs-nav-btn next">
          <span class="dir">Next Project →</span>
          <span class="name">{{ $nextProject->title }}</span>
        </a>
      @endif
    </nav>

  </div>
</article>
