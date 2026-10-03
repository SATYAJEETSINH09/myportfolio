/**
 * DATA.JS - Structured Mock Data for Satyajeetsinh Dodiya's Portfolio
 * Clean, structured schema prepared for 1:1 Laravel Model / Blade conversion.
 */

window.PORTFOLIO_DATA = {
  profile: {
    name: "Satyajeetsinh Dodiya",
    monogram: "SD.",
    role: "Laravel Backend Developer",
    location: "Ahmedabad, India",
    timezone: "GMT+5:30",
    status: "Available for select opportunities & projects",
    bioShort: "I build scalable APIs, backend systems and production-ready web applications using Laravel, PHP and modern web technologies.",
    email: "satyajeetsinh.dodiya@gmail.com",
    phone: "+91 98765 43210",
    github: "https://github.com/satyajeetsinh-dodiya",
    linkedin: "https://linkedin.com/in/satyajeetsinh-dodiya"
  },

  stats: [
    { value: 1.5, suffix: "+", label: "Years Experience" },
    { value: 10, suffix: "+", label: "Projects Built" },
    { value: 10, suffix: "+", label: "Technologies" },
    { value: 15, suffix: "+", label: "Clients Served" }
  ],

  projects: [
    {
      id: "dare-play",
      slug: "dare-play",
      num: "01",
      title: "Dare Play",
      tagline: "Learning & Activity Platform",
      category: "Education & Activity Tech",
      year: "2025–2026",
      role: "Lead Backend Developer",
      type: "Web + Mobile Backend API",
      featured: true,
      description: "Comprehensive learning and activity management platform with multi-school workflows, activity scheduling, real-time rewards calculation and high-throughput Firebase Cloud Messaging (FCM) notifications.",
      stack: ["Laravel", "PHP 8.2", "MySQL", "REST API", "FCM", "Redis", "Sanctum"],
      metrics: [
        { label: "Schools Managed", val: "12+" },
        { label: "Notification Latency", val: "<120ms" },
        { label: "API Response Time", val: "~45ms" }
      ],
      challenge: "Coordinating concurrent activity submissions from multiple school branches while preventing duplicate reward points and handling bursts of real-time push notifications without blocking HTTP worker threads.",
      solution: "Engineered atomic database transactions with pessimistic locking for point allocation and offloaded push notifications to asynchronous Redis queue workers with batch dispatching.",
      roles: [
        "01 REST API Development & Schema Architecture",
        "02 Multi-tenant Authentication & Authorization (Sanctum)",
        "03 School & Branch Activity Lifecycle Management",
        "04 Real-time Rewards & Points Calculation Engine",
        "05 Asynchronous Firebase Push Notification Queues",
        "06 High-Performance MySQL Database Optimization",
        "07 Administrative Role-Based Access Control (RBAC)",
        "08 API Rate Limiting & Performance Profiling"
      ],
      apiDemo: {
        method: "POST",
        endpoint: "/api/v1/activities/18/complete",
        request: {
          child_id: 24,
          activity_id: 18,
          timestamp: "2026-09-30T10:15:30Z",
          verification_code: "SCH-8892"
        },
        response: {
          success: true,
          status: "completed",
          points_awarded: 20,
          total_child_balance: 340,
          fcm_notification_dispatched: true,
          execution_time: "38ms"
        }
      }
    },
    {
      id: "gomeds247",
      slug: "gomeds247",
      num: "02",
      title: "GoMeds247",
      tagline: "Healthcare & Pharmacy E-Commerce",
      category: "Healthcare & Pharmacy",
      year: "2025",
      role: "Backend Developer",
      type: "REST API & Prescription Verification",
      featured: false,
      description: "On-demand medicine delivery and prescription management platform engineered with secure medical document handling, doctor-pharmacist approval pipelines, and inventory sync.",
      stack: ["Laravel", "PHP", "MySQL", "REST API", "Sanctum", "AWS S3"],
      challenge: "Handling confidential prescription uploads and regulatory compliance across high-volume pharmacy ordering queues.",
      solution: "Implemented encrypted S3 storage buckets with time-limited signed URLs and granular policy gates for pharmacist approval workflows.",
      roles: [
        "01 Prescription Upload & Encryption Engine",
        "02 Pharmacy Partner Inventory Sync API",
        "03 Real-time Order Tracking Webhooks",
        "04 Multi-tier Admin Role Permissions"
      ],
      apiDemo: {
        method: "GET",
        endpoint: "/api/v1/prescriptions/RX-94021/verify",
        request: null,
        response: {
          prescription_id: "RX-94021",
          status: "approved_by_pharmacist",
          medications_approved: 3,
          delivery_slot: "2026-09-30 18:00 - 20:00"
        }
      }
    },
    {
      id: "klean-health",
      slug: "klean-health",
      num: "03",
      title: "Klean Health",
      tagline: "Modern Healthcare Consultation",
      category: "Healthcare Platform",
      year: "2025",
      role: "Backend Developer",
      type: "Telehealth & Booking Backend",
      featured: false,
      description: "Patient-doctor scheduling system with automated slot availability calculation, reminder webhooks, and secure medical history records.",
      stack: ["Laravel", "PHP", "MySQL", "REST API", "Payment Gateways"],
      challenge: "Preventing double-booking of doctor appointment slots during high-traffic clinic hours.",
      solution: "Engineered slot locks utilizing Redis atomic expiration keys alongside database transaction isolation.",
      roles: [
        "01 Doctor Slot Scheduling Algorithm",
        "02 Patient Medical History API",
        "03 SMS/WhatsApp Reminder Dispatcher",
        "04 Razorpay Gateway Integration"
      ],
      apiDemo: {
        method: "POST",
        endpoint: "/api/v1/appointments/book",
        request: {
          doctor_id: 104,
          slot_time: "14:30:00",
          patient_id: 882
        },
        response: {
          booking_id: "APT-5519",
          status: "confirmed",
          receipt_url: "https://pay.example.com/receipt/5519"
        }
      }
    },
    {
      id: "shopsphere",
      slug: "shopsphere",
      num: "04",
      title: "ShopSphere",
      tagline: "Full Stack E-Commerce Platform",
      category: "E-Commerce",
      year: "2025",
      role: "Full Stack Developer",
      type: "Web Application",
      featured: false,
      description: "High-performance full stack e-commerce web platform with cart state synchronization, dual payment gateway routing (Stripe & Razorpay), and automated invoice generation.",
      stack: ["React", "Node.js", "Express", "MongoDB", "Stripe", "Razorpay"],
      challenge: "Handling concurrent cart checkout requests and idempotent payment webhook handling.",
      solution: "Created webhook idempotency ledger and tokenized payment verifications.",
      roles: [
        "01 End-to-end REST API architecture",
        "02 Multi-currency payment gateway routing",
        "03 Inventory reservation timeout worker",
        "04 Dynamic product filter aggregation"
      ],
      apiDemo: {
        method: "POST",
        endpoint: "/api/orders/checkout",
        request: {
          cart_id: "crt_8892",
          payment_method: "stripe",
          currency: "USD"
        },
        response: {
          order_id: "ORD-99120",
          payment_status: "succeeded",
          total: "$189.50"
        }
      }
    },
    {
      id: "personal-portfolio",
      slug: "personal-portfolio",
      num: "05",
      title: "Personal Portfolio",
      tagline: "High-Performance Engineer Brand",
      category: "Portfolio & Brand",
      year: "2026",
      role: "Full Stack Architect",
      type: "Minimalist Engineering Showcase",
      featured: false,
      description: "High-performance, editorial monochrome portfolio engineered with vanilla CSS tokens, zero heavy bloat, responsive case-study systems, and AI assistant interface.",
      stack: ["Laravel", "Blade", "Vanilla CSS", "JavaScript", "MySQL"],
      challenge: "Achieving high aesthetic finish and instant 60fps interaction without bloated JS frameworks.",
      solution: "Crafted pure CSS token architecture, decoupled data structures, and optimized DOM listeners.",
      roles: [
        "01 Editorial typography & design system",
        "02 Zero-dependency micro-interaction engine",
        "03 Accessible theme toggle & state persistence",
        "04 Modular Blade-ready component tree"
      ],
      apiDemo: {
        method: "GET",
        endpoint: "/api/portfolio/stats",
        request: null,
        response: {
          uptime: "99.99%",
          lighthouse_score: 100,
          framework: "Laravel 11 + Blade"
        }
      }
    }
  ],

  expertise: [
    {
      num: "01",
      title: "Backend Development",
      summary: "Laravel systems designed around real business workflows.",
      details: "Developing robust, decoupled MVC and Service-Repository architectures in Laravel. Focusing on domain logic separation, custom middleware, form requests, and robust exception handling."
    },
    {
      num: "02",
      title: "REST API Development",
      summary: "Secure APIs for web, mobile and third-party integrations.",
      details: "Building standardized JSON:API compliant RESTful endpoints with API versioning, automated documentation, rate limiting, and response resource transformers."
    },
    {
      num: "03",
      title: "Authentication & Authorization",
      summary: "JWT, Sanctum, roles and permissions.",
      details: "Implementing multi-guard authentication, token refresh strategies, OAuth providers, and granular Role-Based Access Control (RBAC) with Laravel Gates and Policies."
    },
    {
      num: "04",
      title: "Database Architecture",
      summary: "MySQL schema design, relationships and optimization.",
      details: "Designing normalized schemas, composite indexing strategies, polymorphic relationships, query profiling, and eliminating N+1 query bottlenecks."
    },
    {
      num: "05",
      title: "Admin Systems & Dashboards",
      summary: "Custom dashboards and operational tools.",
      details: "Creating high-efficiency back-office management interfaces, data export pipelines, audit logs, and workflow approval mechanisms."
    },
    {
      num: "06",
      title: "Integrations & Asynchronous Queues",
      summary: "Payments, OTP, notifications and third-party APIs.",
      details: "Integrating Stripe, Razorpay, Twilio, Firebase Cloud Messaging (FCM), and external webhooks with resilient background queue workers."
    }
  ],

  toolkit: [
    { name: "Laravel", category: "Backend", icon: "⚡", desc: "PHP's flagship framework for scalable web APIs & systems." },
    { name: "PHP 8.x", category: "Backend", icon: "🐘", desc: "Modern typed PHP with strict typing, attributes, and JIT." },
    { name: "MySQL", category: "Backend", icon: "🗄️", desc: "Relational database schema design, indexing, and tuning." },
    { name: "REST API", category: "Backend", icon: "🔗", desc: "Standardized, secure, versioned API architectures." },
    { name: "Laravel Sanctum", category: "Backend", icon: "🛡️", desc: "Token authentication system for SPAs & mobile apps." },
    { name: "JWT", category: "Backend", icon: "🔑", desc: "Stateless cross-platform authentication tokens." },

    { name: "JavaScript", category: "Frontend", icon: "📜", desc: "Modern ES6+ for dynamic reactive interfaces." },
    { name: "Livewire", category: "Frontend", icon: "🔌", desc: "Full-stack reactive components without writing JS." },
    { name: "HTML5 / CSS3", category: "Frontend", icon: "🎨", desc: "Semantic markup, CSS custom properties, and flex/grid." },
    { name: "Tailwind CSS", category: "Frontend", icon: "🌊", desc: "Utility-first CSS framework for custom UI layouts." },
    { name: "Bootstrap", category: "Frontend", icon: "🅱️", desc: "Responsive component framework for rapid dashboards." },

    { name: "Git & GitHub", category: "Tools", icon: "🐙", desc: "Version control, feature branching, and PR code reviews." },
    { name: "Postman", category: "Tools", icon: "📮", desc: "API testing, automated collection tests, and mock servers." },
    { name: "Docker", category: "Tools", icon: "🐳", desc: "Containerized reproducible local development environments." },
    { name: "Figma", category: "Tools", icon: "📐", desc: "Design inspection, spacing measurement, and asset extraction." }
  ],

  experience: [
    {
      period: "2025 — PRESENT",
      role: "Backend Developer",
      company: "Binstellar Technologies Pvt. Ltd.",
      stack: "Laravel · PHP · MySQL · REST API",
      current: true,
      points: [
        "Develop high-throughput Laravel REST APIs supporting multi-platform mobile and web client apps.",
        "Build modular admin dashboards with role-based access control and live reporting tools.",
        "Implement secure token-based authentication using Laravel Sanctum.",
        "Integrate external web services including Firebase Cloud Messaging (FCM) and payment gateways.",
        "Design normalized database relationships and resolve performance bottlenecks."
      ]
    },
    {
      period: "2025",
      role: "MERN Stack Intern",
      company: "Binstellar Technologies Pvt. Ltd.",
      stack: "React · Node.js · Express · MongoDB",
      current: false,
      points: [
        "Engineered full stack e-commerce web application (ShopSphere) with responsive UI.",
        "Implemented secure JWT authentication and dual payment gateway integrations (Stripe & Razorpay).",
        "Collaborated with senior engineers on code reviews, Git workflows, and API design standards."
      ]
    }
  ],

  services: [
    {
      num: "01",
      title: "Backend Development",
      desc: "Robust, scalable server-side systems engineered with clean Laravel architectures and maintainable patterns."
    },
    {
      num: "02",
      title: "REST API Development",
      desc: "Clean, well-documented, secure APIs tailored for iOS, Android, Single Page Apps and third-party consumers."
    },
    {
      num: "03",
      title: "Laravel Development",
      desc: "End-to-end web applications utilizing Laravel's modern ecosystem: Sanctum, Livewire, Queues, and Blade."
    },
    {
      num: "04",
      title: "Database Design & Tuning",
      desc: "Normalized MySQL schema architecture, index optimization, query profiling, and performance troubleshooting."
    },
    {
      num: "05",
      title: "Frontend & Admin UI",
      desc: "Clean, responsive frontend interfaces and admin panels crafted with Vanilla CSS, Blade, and Livewire."
    },
    {
      num: "06",
      title: "Maintenance & Support",
      desc: "Legacy code refactoring, PHP version upgrades, API performance auditing, and third-party webhook debugging."
    }
  ],

  articles: [
    {
      id: "scalable-rest-apis",
      category: "Laravel",
      date: "Sep 2026",
      title: "Structuring Scalable REST APIs in Laravel",
      excerpt: "Why fat controllers ruin backend architectures and how dedicated Action and FormRequest classes keep API endpoints testable.",
      content: `### The Problem with Bloated Controllers
In many Laravel projects, developers place validation, authorization, business logic, and response formatting directly inside controller methods. This makes units impossible to test in isolation and creates brittle code.

### The Dedicated Action Pattern
By moving domain logic into single-responsibility Action classes, our controllers become ultra-slim coordinators:

\`\`\`php
public function store(StoreActivityRequest $request, CreateActivityAction $action): JsonResponse
{
    $activity = $action->execute($request->validated());
    return ActivityResource::make($activity)->response()->setStatusCode(201);
}
\`\`\`

### Key Benefits
1. **Testability**: Test individual actions with pure unit tests without bootstrapping HTTP requests.
2. **Reusability**: Invoke the same action from console commands, background queue jobs, or API controllers.
3. **Clarity**: Every endpoint has a single, unambiguous purpose.`
    },
    {
      id: "avoiding-n-plus-1",
      category: "Database",
      date: "Aug 2026",
      title: "Avoiding N+1 Queries in Laravel",
      excerpt: "How eager loading with Eloquent constraints prevents database connection saturation and reduces API response latencies.",
      content: `### Understanding the N+1 Bottleneck
When querying Eloquent models in loops, naive relationship calls trigger 1 base query + N additional queries. For a list of 100 items with 2 relations, that's 201 round-trips to MySQL.

### Solution: Targeted Eager Loading
Always specify relationships using \`with()\` before retrieving collections:

\`\`\`php
// Bad: Triggers 101 queries
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->author->name;
}

// Good: Executes exactly 2 queries
$posts = Post::with('author:id,name')->get();
\`\`\`

### Strict Mode in Development
Enable \`Model::preventLazyLoading(!app()->isProduction())\` in your AppServiceProvider to immediately throw exceptions during local testing whenever lazy loading occurs.`
    },
    {
      id: "sanctum-vs-jwt",
      category: "Authentication",
      date: "Jul 2026",
      title: "Laravel Sanctum vs JWT: Which One Should You Pick?",
      excerpt: "A practical comparison between stateless JSON Web Tokens and Laravel Sanctum's lightweight database-backed tokens for mobile APIs.",
      content: `### When to Choose Sanctum
Laravel Sanctum is the first-party, lightweight token and cookie-based authentication package for Laravel. It stores SHA-256 hashed tokens in MySQL.
- **Immediate Token Revocation**: Revoking a compromised user token takes a single database query.
- **Granular Token Abilities**: Easily restrict token permissions (e.g., \`['read:reports', 'write:orders']\`).
- **Simplicity**: No complex private/public key cryptography or JWT expiration blacklists needed.

### When to Choose Pure JWT
Use stateless JWT (\`tymon/jwt-auth\` or \`firebase/php-jwt\`) when:
1. You have a multi-service microservices architecture where services must verify tokens independently without pinging a central MySQL database.
2. Ultra-high throughput where a single SELECT lookup for token validation is unacceptable.`
    },
    {
      id: "docker-laravel-deploy",
      category: "Deployment",
      date: "Jun 2026",
      title: "Deploying Laravel Applications with Docker",
      excerpt: "Creating minimal, production-ready multi-stage Docker containers with PHP-FPM, Nginx, OPcache, and Supervisor for queue workers.",
      content: `### Multi-Stage Docker Builds for PHP
Using multi-stage Docker builds allows us to compile composer dependencies in a builder stage and copy only production artifacts into the final lean Alpine image.

### Production Essentials
- **OPcache Enabled**: Precompiles PHP bytecode into shared memory.
- **Supervisor Daemon**: Ensures queue workers (\`php artisan queue:work\`) restart automatically if they crash or exceed memory limits.
- **Non-root Execution**: Run PHP-FPM as user \`www-data\` for enterprise container security.`
    },
    {
      id: "maintainable-laravel-apis",
      category: "Backend",
      date: "May 2026",
      title: "Designing Maintainable Laravel APIs",
      excerpt: "Standardizing API response envelopes, error structures, and HTTP status codes across team environments.",
      content: `### Consistent Response Structure
API consumers (iOS, Android, React) need a predictable JSON schema for both successes and errors:

\`\`\`json
{
  "success": true,
  "data": { ... },
  "message": "Resource created successfully",
  "meta": { "timestamp": 1759239841 }
}
\`\`\`

### Unified Exception Handler
Use Laravel's \`bootstrap/app.php\` or custom \`Handler.php\` to intercept all validation, model-not-found, and authentication errors and transform them into standardized JSON contracts.`
    }
  ],

  // Knowledge base for AI Chatbot Assistant
  chatbotKnowledge: [
    {
      keywords: ["hi", "hello", "hey", "who are you", "start"],
      response: "Hi there! 👋 I'm Satyajeetsinh's Portfolio Assistant. I can tell you about his Laravel backend projects, tech stack, professional experience, and availability. What would you like to explore?"
    },
    {
      keywords: ["project", "projects", "work", "dare play", "gomeds247", "klean health", "shopsphere"],
      response: "Satyajeetsinh has built several notable production systems including:\n\n• **Dare Play**: Learning & activity platform with multi-school workflows & FCM notifications.\n• **GoMeds247**: Healthcare & pharmacy platform with prescription verification.\n• **Klean Health**: Doctor scheduling & telehealth booking system.\n• **ShopSphere**: Full stack e-commerce with dual payment gateway routing.\n\nYou can click on any project card to view its interactive case study!"
    },
    {
      keywords: ["tech", "stack", "skills", "technology", "laravel", "php", "mysql"],
      response: "His core backend toolkit includes **Laravel, modern PHP 8+, MySQL, REST API architecture, Laravel Sanctum, and JWT**. On the frontend & tooling side, he works with **JavaScript, Livewire, Tailwind CSS, Docker, Git, and Postman**."
    },
    {
      keywords: ["experience", "company", "binstellar", "background", "career"],
      response: "Satyajeetsinh currently works as a **Backend Developer at Binstellar Technologies Pvt. Ltd.** (2025–Present), developing Laravel REST APIs, admin systems, and database architectures. He previously completed a MERN stack internship building e-commerce platforms."
    },
    {
      keywords: ["available", "hire", "freelance", "job", "opportunity", "contact", "email"],
      response: "Yes! Satyajeetsinh is **available for select backend development projects and full-time opportunities**. You can reach him directly via the contact form on this page or at **satyajeetsinh.dodiya@gmail.com**."
    },
    {
      keywords: ["resume", "cv", "download"],
      response: "You can preview and download Satyajeetsinh's resume using the **'RESUME'** button in the top navigation bar or the hero section!"
    }
  ]
};
