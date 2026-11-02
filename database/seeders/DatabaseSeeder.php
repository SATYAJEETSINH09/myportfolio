<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Experience;
use App\Models\ExperiencePoint;
use App\Models\NavigationItem;
use App\Models\Project;
use App\Models\ProjectChallenge;
use App\Models\ProjectFeature;
use App\Models\ProjectImage;
use App\Models\ProjectTechnology;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Seed Admin User
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@satyajeet.dev'],
            [
                'name' => 'Satyajeetsinh Dodiya',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 1. Seed Site Settings
        $settings = [
            'site_name' => 'Satyajeetsinh Dodiya',
            'short_name' => 'SD.',
            'role' => 'Laravel Backend Developer',
            'email' => 'satyajeetsinh.dodiya@gmail.com',
            'phone' => '+91 98765 43210',
            'location' => 'Ahmedabad, Gujarat, India',
            'working_hours' => '09:30 — 19:30 IST · Mon — Sat',
            'timezone' => 'GMT+5:30',
            'bio' => 'I build scalable APIs, backend systems and production-ready web applications using Laravel, PHP and modern web technologies.',
            'availability_status' => 'Available for select projects',
            'resume_file' => 'resume/Satyajeetsinh_Dodiya_Resume.pdf',
            'github_url' => 'https://github.com/satyajeetsinh-dodiya',
            'linkedin_url' => 'https://linkedin.com/in/satyajeetsinh-dodiya',
            'twitter_url' => 'https://twitter.com/satyajeetsinh',
            'copyright_text' => '© 2026 Satyajeetsinh Dodiya. All rights reserved.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Seed Navigation Items
        $navItems = [
            ['label' => 'Work', 'url' => '#work', 'sort_order' => 1],
            ['label' => 'About', 'url' => '#about', 'sort_order' => 2],
            ['label' => 'Expertise', 'url' => '#expertise', 'sort_order' => 3],
            ['label' => 'Toolkit', 'url' => '#toolkit', 'sort_order' => 4],
            ['label' => 'Experience', 'url' => '#experience', 'sort_order' => 5],
            ['label' => 'Services', 'url' => '#services', 'sort_order' => 6],
            ['label' => 'Notes', 'url' => '#notes', 'sort_order' => 7],
            ['label' => 'Contact', 'url' => '#contact', 'sort_order' => 8],
        ];

        foreach ($navItems as $item) {
            NavigationItem::updateOrCreate(['label' => $item['label']], $item);
        }

        // 3. Seed Projects
        $darePlay = Project::updateOrCreate(
            ['slug' => 'dare-play'],
            [
                'title' => 'Dare Play Scheme — Childcare & SEND Operations Platform',
                'project_number' => '01',
                'tagline' => 'Multi-tenant childcare and statutory safeguarding operations platform',
                'category' => 'HealthTech / EdTech / Childcare Compliance',
                'year' => '2025–2026',
                'role' => 'Lead Backend Developer',
                'project_type' => 'Web Admin Portal + Mobile Backend REST API',
                'client' => 'Childcare & SEND Providers',
                'short_description' => 'Multi-tenant childcare and statutory safeguarding operations platform unifying session bookings, staff allocation, daily care logs, and child safety governance.',
                'description' => 'Dare Play Scheme is a specialized operational and compliance backend designed for childcare centers and Special Educational Needs and Disabilities (SEND) activity providers. It serves facility directors, support workers, team managers, and parents by unifying session bookings, staff allocation, daily care logs, and statutory child safety governance across multiple school and center sites.',
                'challenge' => 'Managing SEND childcare across multiple facilities created operational blind spots. Paper logs delayed reporting of critical seizure and accident events, while concurrent parent booking requests risked violating strict regulatory staff-to-child ratios without unified tenant boundaries.',
                'solution' => 'Implemented a multi-school scoped architecture with custom pipeline middleware and atomic database transactions. The system enforces session capacity limits and booking deadlines at query time while establishing strict relational audit trails for medical consents, daily personal care records, and incident notifications.',
                'cover_image' => 'projects/dare-play.png',
                'live_url' => 'https://dareplay.example.com',
                'github_url' => 'https://github.com/satyajeetsinh-dodiya/dare-play-backend',
                'featured' => true,
                'status' => 'completed',
                'sort_order' => 1,
            ]
        );

        $darePlay->technologies()->delete();
        $darePlayTechnologies = ['PHP 8.2', 'Laravel 11', 'Blade', 'Tailwind CSS', 'MySQL 8.0', 'Redis', 'Sanctum', 'Pusher', 'FCM HTTP v1', 'DomPDF', 'Yajra DataTables'];
        foreach ($darePlayTechnologies as $idx => $tech) {
            ProjectTechnology::create([
                'project_id' => $darePlay->id,
                'name' => $tech,
                'sort_order' => $idx + 1,
            ]);
        }

        $darePlay->features()->delete();
        $darePlayFeatures = [
            [
                'title' => 'Multi-Tenant Site Scoping',
                'description' => 'Dynamic scope middleware (ResolveAdminScope) isolates data per school facility for localized staff while granting super administrators global cross-facility switching and analytics.',
            ],
            [
                'title' => 'Capacity-Controlled Session Booking Engine',
                'description' => 'Handles single and recurring date reservations, enforcing activity deadlines, student limits, and parent-child authorization checks prior to booking confirmation.',
            ],
            [
                'title' => 'Biometric & Photographic Attendance Tracking',
                'description' => 'Supports punch-in, break slot allocation, and punch-out transitions for children, staff, and authorized guardians with mandatory selfie photo capture and timestamp validation.',
            ],
            [
                'title' => 'Statutory SEND & Safeguarding Reporting',
                'description' => 'Dedicated compliance modules for tracking epilepsy seizure timelines, pre-existing injuries, behavioral patterns, and personal care routines with threaded manager follow-ups.',
            ],
            [
                'title' => 'Medication & Consent Management',
                'description' => 'Digital lifecycle management for medication permissions and emergency medical administration with dual-verification tracking and electronic parent sign-offs.',
            ],
            [
                'title' => 'Real-Time Notification Pipeline',
                'description' => 'Multi-channel alerting mechanism using Pusher WebSockets for instant in-app dashboard badges and Google FCM HTTP v1 for critical mobile push notifications to field staff.',
            ],
        ];
        foreach ($darePlayFeatures as $idx => $feat) {
            ProjectFeature::create([
                'project_id' => $darePlay->id,
                'title' => $feat['title'],
                'description' => $feat['description'],
                'sort_order' => $idx + 1,
            ]);
        }

        $darePlay->challenges()->delete();
        ProjectChallenge::create([
            'project_id' => $darePlay->id,
            'challenge' => 'Unsynchronized Safeguarding and Capacity Bottlenecks',
            'solution' => 'Implemented a multi-school scoped architecture with custom pipeline middleware and atomic database transactions. The system enforces session capacity limits and booking deadlines at query time while establishing strict relational audit trails for medical consents, daily personal care records, and incident notifications.',
            'sort_order' => 1,
        ]);

        // 2. GoMeds247
        $goMeds = Project::updateOrCreate(
            ['slug' => 'gomeds247'],
            [
                'title' => 'GoMeds — Hyperlocal Healthcare & Diagnostics Platform',
                'project_number' => '02',
                'tagline' => 'Hyperlocal pharmacy fulfillment, diagnostic dispatch, and verified delivery orchestration.',
                'category' => 'Healthcare Tech & Logistics',
                'year' => '2025–2026',
                'role' => 'Lead Backend Developer',
                'project_type' => 'Web + Mobile Backend API & Logistics Engine',
                'short_description' => 'Hyperlocal pharmacy fulfillment, diagnostic dispatch, and verified delivery orchestration platform connecting patients with retail pharmacies, labs, and phlebotomists.',
                'description' => 'GoMeds is an on-demand healthcare and diagnostic logistics platform designed to connect patients with hyperlocal retail pharmacies, accredited pathology laboratories, and field phlebotomists. The system handles prescription digitization, quote solicitation across nearby chemist networks, organ-specific diagnostic test scheduling, and doorstep medicine delivery through a centralized REST API backend.',
                'challenge' => 'Disjointed communication between independent pharmacies, riders, and patients created fulfillment discrepancies and lost packages. Furthermore, concurrent quote acceptances and simultaneous coupon redemptions produced inventory mismatches and double-spending across distributed vendors.',
                'solution' => 'Implemented database transaction wrappers with pessimistic row locking and append-only coupon usage ledgers to preserve transactional integrity during checkout. Designed a dual 6-digit cryptographic PIN verification handshake requiring independent authorization at pharmacy dispatch and customer handover before order state transitions commit.',
                'cover_image' => 'projects/gomeds247.png',
                'featured' => false,
                'status' => 'completed',
                'sort_order' => 2,
            ]
        );

        $goMeds->technologies()->delete();
        $goMedsTechnologies = ['PHP 8.2', 'Laravel 11', 'Livewire 3', 'MySQL 8.0', 'Redis', 'Sanctum', 'JWT Auth', 'Pusher', 'FCM', 'Twilio SMS', 'DomPDF', 'Google Gemini API'];
        foreach ($goMedsTechnologies as $idx => $tech) {
            ProjectTechnology::create([
                'project_id' => $goMeds->id,
                'name' => $tech,
                'sort_order' => $idx + 1,
            ]);
        }

        $goMeds->features()->delete();
        $goMedsFeatures = [
            [
                'title' => 'Dynamic Pharmacy Quote Aggregator',
                'description' => 'Broadcasts uploaded prescriptions and medicine carts to geofenced retail chemists, allowing customers to review itemized pricing and select between branded and generic (Jan Aushadhi) options.',
            ],
            [
                'title' => 'Dual-PIN Delivery Handshake',
                'description' => 'Generates unique, cryptographically seeded 6-digit PINs for order dispatch at the pharmacy counter and customer delivery confirmation to prevent misplacement.',
            ],
            [
                'title' => 'Slot-Based Diagnostic Lab Engine',
                'description' => 'Organizes lab tests by biological category and anatomy, managing capacity-constrained time slots for phlebotomist home visits and sample tracking.',
            ],
            [
                'title' => 'Automated Biomarker Extraction Pipeline',
                'description' => 'Ingests unstructured diagnostic PDF reports and high-resolution images via multimodal Gemini API integrations, outputting structured JSON biomarkers and trend reports.',
            ],
            [
                'title' => 'Field Telemetry & Route Step Progression',
                'description' => 'Ingests live geographic coordinates from delivery personnel to track delivery legs, update transit milestones, and compute operational turnaround metrics.',
            ],
            [
                'title' => 'Scored Coupon & Promotion Ledger',
                'description' => 'Enforces vendor-scoped, category-specific, and customer-usage-capped discount rules backed by an atomic validation ledger to prevent concurrent abuse.',
            ],
        ];
        foreach ($goMedsFeatures as $idx => $feat) {
            ProjectFeature::create([
                'project_id' => $goMeds->id,
                'title' => $feat['title'],
                'description' => $feat['description'],
                'sort_order' => $idx + 1,
            ]);
        }

        $goMeds->challenges()->delete();
        ProjectChallenge::create([
            'project_id' => $goMeds->id,
            'challenge' => 'Unverified Handoffs & Inventory Race Conditions',
            'solution' => 'Implemented database transaction wrappers with pessimistic row locking and append-only coupon usage ledgers to preserve transactional integrity during checkout. Designed a dual 6-digit cryptographic PIN verification handshake requiring independent authorization at pharmacy dispatch and customer handover before order state transitions commit.',
            'sort_order' => 1,
        ]);

        // 3. Klean Health
        $kleanHealth = Project::updateOrCreate(
            ['slug' => 'klean-health'],
            [
                'title' => 'Klean Health — Nutrition & Dietetics API Engine',
                'project_number' => '03',
                'tagline' => 'Scalable nutrition tracking, cross-platform subscription sync, and dietary management.',
                'category' => 'Healthcare Tech / Digital Wellness',
                'year' => '2025–2026',
                'role' => 'Lead Backend Developer',
                'project_type' => 'Mobile Backend REST API & Admin Management Core',
                'short_description' => 'Specialized backend engine powering cross-platform iOS and Android nutrition applications alongside an administrative clinical dashboard.',
                'description' => 'Klean Health is a specialized backend engine powering cross-platform iOS and Android nutrition applications alongside an administrative clinical dashboard. The platform addresses the challenge of delivering automated dietary guidance at scale by computing individualized metabolic targets, logging dynamic food intake, filtering recipes against strict allergen profiles, and aggregating consolidated grocery shopping lists.',
                'challenge' => 'Synchronizing recurring subscriptions across Google Play and Apple App Store introduced race conditions, missing purchase acknowledgements, and delayed access revocations. Concurrently, calculating dynamic macronutrient distributions and enforcing complex allergen exclusions across high-volume meal logs created significant client-side inconsistency and unoptimized database reads.',
                'solution' => 'Built an idempotent webhook ingestion pipeline using Google Cloud Pub/Sub with OIDC JWT verification and Apple StoreKit 2 JWS decoding wrapped in atomic database transactions. Centralized all nutritional logic on the backend with dynamic unit converters (metric/imperial), database-level allergen exclusion queries (whereDoesntHave), and Redis-backed queue workers for asynchronous processing.',
                'cover_image' => 'projects/klean-health.png',
                'featured' => false,
                'status' => 'completed',
                'sort_order' => 3,
            ]
        );

        $kleanHealth->technologies()->delete();
        $kleanHealthTechnologies = ['PHP 8.2+', 'Laravel 12', 'Livewire 3', 'MySQL', 'Redis', 'Tymon JWT-Auth', 'Google Play API', 'Apple StoreKit 2', 'Firebase Cloud Messaging (FCM)', 'Google Cloud Pub/Sub', 'Barryvdh DomPDF'];
        foreach ($kleanHealthTechnologies as $idx => $tech) {
            ProjectTechnology::create([
                'project_id' => $kleanHealth->id,
                'name' => $tech,
                'sort_order' => $idx + 1,
            ]);
        }

        $kleanHealth->features()->delete();
        $kleanHealthFeatures = [
            [
                'title' => 'Dual In-App Purchase Lifecycle Engine',
                'description' => 'Unified billing pipeline supporting Google Play Subscriptions V2 and Apple StoreKit 2 JWS transactions, handling automated acknowledgements, trial periods, proration phases, and grace periods without entitlement loss.',
            ],
            [
                'title' => 'Automated Metabolic & Macro Calculations',
                'description' => 'Dynamic computation of Basal Metabolic Rate (BMR) and Total Daily Energy Expenditure (TDEE) based on gender, age, activity level, and biometrics, translating target calories into customizable macronutrient splits (carbs, protein, fats).',
            ],
            [
                'title' => 'Database-Level Allergen Filtering',
                'description' => 'High-efficiency recipe search and meal category exploration that automatically excludes recipes containing customer-flagged allergens using database query constraints.',
            ],
            [
                'title' => 'Timezone-Aware Meal Reminder Scheduler',
                'description' => 'Cron-driven artisan command executing every minute that processes user batches (500 records per chunk) to send FCM push reminders aligned with each user\'s local breakfast, lunch, snack, and dinner times.',
            ],
            [
                'title' => 'Dynamic Grocery Aggregation & PDF Export',
                'description' => 'Automated consolidation of recipe ingredients across single days or custom date ranges into categorized shopping lists, paired with server-side PDF generation for nutrition history reports.',
            ],
            [
                'title' => 'Multi-Device Session & Token Security',
                'description' => 'Stateless JWT authentication supporting Google and Apple OAuth identity tokens, coupled with trusted-device fingerprint tracking and single/bulk remote session revocation.',
            ],
        ];
        foreach ($kleanHealthFeatures as $idx => $feat) {
            ProjectFeature::create([
                'project_id' => $kleanHealth->id,
                'title' => $feat['title'],
                'description' => $feat['description'],
                'sort_order' => $idx + 1,
            ]);
        }

        $kleanHealth->challenges()->delete();
        ProjectChallenge::create([
            'project_id' => $kleanHealth->id,
            'challenge' => 'Entitlement Drift & Computational Clashes',
            'solution' => 'Built an idempotent webhook ingestion pipeline using Google Cloud Pub/Sub with OIDC JWT verification and Apple StoreKit 2 JWS decoding wrapped in atomic database transactions. Centralized all nutritional logic on the backend with dynamic unit converters (metric/imperial), database-level allergen exclusion queries (whereDoesntHave), and Redis-backed queue workers for asynchronous processing.',
            'sort_order' => 1,
        ]);

        // 4. ShopSphere
        $shopSphere = Project::updateOrCreate(
            ['slug' => 'shopsphere'],
            [
                'title' => 'ShopSphere',
                'project_number' => '04',
                'tagline' => 'Full Stack E-Commerce Platform',
                'category' => 'E-Commerce',
                'year' => '2025',
                'role' => 'Full Stack Developer',
                'project_type' => 'Web Application',
                'short_description' => 'High-performance online storefront with cart session synchronization, dual payment gateway routing (Stripe & Razorpay), and automated invoice generation.',
                'description' => 'ShopSphere is a modern e-commerce storefront with dynamic cart state management, checkout idempotency ledgers, and multi-currency support.',
                'challenge' => 'Handling concurrent cart checkout requests and idempotent payment webhook handling.',
                'solution' => 'Created webhook idempotency ledger and tokenized payment verifications.',
                'cover_image' => 'projects/shopsphere.png',
                'featured' => false,
                'status' => 'completed',
                'sort_order' => 4,
                'api_demo' => [
                    'method' => 'POST',
                    'endpoint' => '/api/orders/checkout',
                    'request' => ['cart_id' => 'crt_8892', 'payment_method' => 'stripe', 'currency' => 'USD'],
                    'response' => ['order_id' => 'ORD-99120', 'payment_status' => 'succeeded', 'total' => '$189.50'],
                ],
            ]
        );
        foreach (['React', 'Node.js', 'Express', 'MongoDB', 'Stripe', 'Razorpay'] as $idx => $tech) {
            ProjectTechnology::updateOrCreate(['project_id' => $shopSphere->id, 'name' => $tech], ['sort_order' => $idx + 1]);
        }

        // 5. Personal Portfolio
        $portfolioProject = Project::updateOrCreate(
            ['slug' => 'personal-portfolio'],
            [
                'title' => 'Personal Portfolio',
                'project_number' => '05',
                'tagline' => 'Minimalist Engineering Showcase',
                'category' => 'Portfolio & Brand',
                'year' => '2026',
                'role' => 'Full Stack Architect',
                'project_type' => 'Production Web Application',
                'short_description' => 'Clean editorial monochrome architecture, featuring dynamic interactive terminals, light/dark design tokens, responsive case-study systems, and AI assistant.',
                'description' => 'Production Laravel 11 application with component-driven Blade architecture, pure CSS tokens, database-driven projects and articles, and accessible UI.',
                'challenge' => 'Achieving high aesthetic finish and instant 60fps interaction without bloated JS frameworks.',
                'solution' => 'Crafted pure CSS token architecture, decoupled data structures, and optimized DOM listeners.',
                'cover_image' => 'projects/portfolio.png',
                'featured' => false,
                'status' => 'completed',
                'sort_order' => 5,
                'api_demo' => [
                    'method' => 'GET',
                    'endpoint' => '/api/portfolio/stats',
                    'request' => null,
                    'response' => ['uptime' => '99.99%', 'lighthouse_score' => 100, 'framework' => 'Laravel 11 + Blade'],
                ],
            ]
        );
        foreach (['Laravel', 'Blade', 'Vanilla CSS', 'JavaScript', 'MySQL'] as $idx => $tech) {
            ProjectTechnology::updateOrCreate(['project_id' => $portfolioProject->id, 'name' => $tech], ['sort_order' => $idx + 1]);
        }

        // 4. Seed Experiences
        $exp1 = Experience::updateOrCreate(
            ['company' => 'Binstellar Technologies Pvt. Ltd.', 'position' => 'Backend Developer'],
            [
                'period' => 'March 2025 — Present',
                'stack' => 'Laravel · PHP · MySQL · REST API · JWT · Postman',
                'is_current' => true,
                'description' => 'Built and maintained production RESTful APIs in Laravel powering live education and healthcare platforms, securing multi-user access and tuning database performance.',
                'location' => 'India',
                'sort_order' => 1,
            ]
        );
        $exp1->points()->delete();
        $exp1Points = [
            'Built and maintained RESTful APIs in Laravel powering live education and healthcare platforms',
            'Implemented JWT-based authentication and role-based authorization to secure multi-user access',
            'Designed and developed scalable admin panel modules for data management and reporting',
            'Optimized MySQL queries and database indexing, improving API response times',
            'Tested and validated API endpoints using Postman prior to frontend integration',
            'Collaborated with frontend engineers and cross-functional teams on API integration, following Laravel and Git best practices',
        ];
        foreach ($exp1Points as $idx => $pt) {
            ExperiencePoint::create(['experience_id' => $exp1->id, 'text' => $pt, 'sort_order' => $idx + 1]);
        }

        // Delete any existing MERN Stack Intern experience
        Experience::where('position', 'like', '%Intern%')->delete();

        // 5. Seed Skills
        $skillsData = [
            ['category' => 'Backend', 'name' => 'Laravel', 'icon' => '⚡', 'badge' => 'FRAMEWORK', 'description' => "PHP's flagship framework for scalable web APIs & server systems.", 'sort_order' => 1],
            ['category' => 'Backend', 'name' => 'PHP 8.x', 'icon' => '🐘', 'badge' => 'LANGUAGE', 'description' => 'Modern typed PHP with strict typing, attributes, and JIT.', 'sort_order' => 2],
            ['category' => 'Backend', 'name' => 'MySQL', 'icon' => '🗄️', 'badge' => 'DATABASE', 'description' => 'Relational database schema design, indexing, and tuning.', 'sort_order' => 3],
            ['category' => 'Backend', 'name' => 'REST API', 'icon' => '🔗', 'badge' => 'ARCHITECTURE', 'description' => 'Standardized JSON:API architectures and rate limiting.', 'sort_order' => 4],
            ['category' => 'Backend', 'name' => 'Laravel Sanctum', 'icon' => '🛡️', 'badge' => 'AUTH', 'description' => 'Token authentication for SPAs, mobile apps, and APIs.', 'sort_order' => 5],
            ['category' => 'Backend', 'name' => 'JWT', 'icon' => '🔑', 'badge' => 'AUTH', 'description' => 'Stateless cross-platform authentication tokens.', 'sort_order' => 6],

            ['category' => 'Frontend', 'name' => 'JavaScript (ES6+)', 'icon' => '📜', 'badge' => 'CORE JS', 'description' => 'Async/await, DOM event systems, and reactive interfaces.', 'sort_order' => 7],
            ['category' => 'Frontend', 'name' => 'Livewire', 'icon' => '🔌', 'badge' => 'REACTIVE', 'description' => 'Full-stack dynamic frontend components without leaving Laravel.', 'sort_order' => 8],
            ['category' => 'Frontend', 'name' => 'HTML5 / CSS3', 'icon' => '🎨', 'badge' => 'DESIGN TOKENS', 'description' => 'Semantic markup, custom properties, and responsive layouts.', 'sort_order' => 9],
            ['category' => 'Frontend', 'name' => 'Tailwind CSS', 'icon' => '🌊', 'badge' => 'UTILITY', 'description' => 'Utility-first styling for modern responsive interfaces.', 'sort_order' => 10],
            ['category' => 'Frontend', 'name' => 'Bootstrap', 'icon' => '🅱️', 'badge' => 'ADMIN UI', 'description' => 'Responsive component framework for rapid dashboards.', 'sort_order' => 11],

            ['category' => 'Tools', 'name' => 'Git & GitHub', 'icon' => '🐙', 'badge' => 'VCS', 'description' => 'Version control, feature branching, and pull request reviews.', 'sort_order' => 12],
            ['category' => 'Tools', 'name' => 'Postman', 'icon' => '📮', 'badge' => 'API TESTING', 'description' => 'API testing suites, automated collection runs, and schemas.', 'sort_order' => 13],
            ['category' => 'Tools', 'name' => 'Docker', 'icon' => '🐳', 'badge' => 'CONTAINERS', 'description' => 'Containerized reproducible local development environments.', 'sort_order' => 14],
            ['category' => 'Tools', 'name' => 'Figma', 'icon' => '📐', 'badge' => 'INSPECTION', 'description' => 'Design inspection, spacing measurement, and asset extraction.', 'sort_order' => 15],
        ];
        foreach ($skillsData as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 6. Seed Services
        $servicesData = [
            ['number' => '01', 'title' => 'Backend Development', 'description' => 'Scalable, decoupled server-side systems engineered with clean Laravel architectures, service patterns, and unit tests.', 'sort_order' => 1],
            ['number' => '02', 'title' => 'REST API Development', 'description' => 'Clean, documented, versioned APIs tailored for mobile apps (Flutter/React Native), SPAs, and third-party consumers.', 'sort_order' => 2],
            ['number' => '03', 'title' => 'Laravel Development', 'description' => "Complete web applications leveraging Laravel's modern ecosystem: Sanctum, Livewire, Blade, Queues, and Jobs.", 'sort_order' => 3],
            ['number' => '04', 'title' => 'Database Design & Tuning', 'description' => 'Normalized MySQL schema architecture, index optimization, query profiling, and eliminating slow queries.', 'sort_order' => 4],
            ['number' => '05', 'title' => 'Frontend & Admin UI', 'description' => 'Responsive user interfaces and admin dashboards crafted with modern CSS, Blade templates, and Livewire.', 'sort_order' => 5],
            ['number' => '06', 'title' => 'Maintenance & Support', 'description' => 'Legacy code refactoring, PHP version upgrades, API performance auditing, and third-party webhook debugging.', 'sort_order' => 6],
        ];
        foreach ($servicesData as $srv) {
            Service::updateOrCreate(['number' => $srv['number']], $srv);
        }

        // 7. Seed Blog Articles (Engineering Notes)
        $postsData = [
            [
                'title' => 'Structuring Scalable REST APIs in Laravel',
                'slug' => 'scalable-rest-apis',
                'category' => 'Laravel',
                'excerpt' => 'Why fat controllers ruin backend architectures and how dedicated Action and FormRequest classes keep API endpoints testable.',
                'content' => "### The Problem with Bloated Controllers\nIn many Laravel projects, developers place validation, authorization, business logic, and response formatting directly inside controller methods. This makes units impossible to test in isolation and creates brittle code.\n\n### The Dedicated Action Pattern\nBy moving domain logic into single-responsibility Action classes, our controllers become ultra-slim coordinators:\n\n```php\npublic function store(StoreActivityRequest \$request, CreateActivityAction \$action): JsonResponse\n{\n    \$activity = \$action->execute(\$request->validated());\n    return ActivityResource::make(\$activity)->response()->setStatusCode(201);\n}\n```\n\n### Key Benefits\n1. **Testability**: Test individual actions with pure unit tests without bootstrapping HTTP requests.\n2. **Reusability**: Invoke the same action from console commands, background queue jobs, or API controllers.\n3. **Clarity**: Every endpoint has a single, unambiguous purpose.",
                'author' => 'Satyajeetsinh Dodiya',
                'status' => 'published',
                'published_at' => '2026-09-01 10:00:00',
            ],
            [
                'title' => 'Avoiding N+1 Queries in Laravel',
                'slug' => 'avoiding-n-plus-1',
                'category' => 'Database',
                'excerpt' => 'How eager loading with Eloquent constraints prevents database connection saturation and reduces API response latencies.',
                'content' => "### Understanding the N+1 Bottleneck\nWhen querying Eloquent models in loops, naive relationship calls trigger 1 base query + N additional queries. For a list of 100 items with 2 relations, that's 201 round-trips to MySQL.\n\n### Solution: Targeted Eager Loading\nAlways specify relationships using `with()` before retrieving collections:\n\n```php\n// Bad: Triggers 101 queries\n\$posts = Post::all();\nforeach (\$posts as \$post) {\n    echo \$post->author->name;\n}\n\n// Good: Executes exactly 2 queries\n\$posts = Post::with('author:id,name')->get();\n```\n\n### Strict Mode in Development\nEnable `Model::preventLazyLoading(!app()->isProduction())` in your AppServiceProvider to immediately throw exceptions during local testing whenever lazy loading occurs.",
                'author' => 'Satyajeetsinh Dodiya',
                'status' => 'published',
                'published_at' => '2026-08-15 11:30:00',
            ],
            [
                'title' => 'Laravel Sanctum vs JWT',
                'slug' => 'sanctum-vs-jwt',
                'category' => 'Authentication',
                'excerpt' => "A practical comparison between stateless JSON Web Tokens and Laravel Sanctum's lightweight database-backed tokens.",
                'content' => "### When to Choose Sanctum\nLaravel Sanctum is the first-party, lightweight token and cookie-based authentication package for Laravel. It stores SHA-256 hashed tokens in MySQL.\n- **Immediate Token Revocation**: Revoking a compromised user token takes a single database query.\n- **Granular Token Abilities**: Easily restrict token permissions (e.g., `['read:reports', 'write:orders']`).\n- **Simplicity**: No complex private/public key cryptography or JWT expiration blacklists needed.\n\n### When to Choose Pure JWT\nUse stateless JWT (`tymon/jwt-auth` or `firebase/php-jwt`) when you have a multi-service microservices architecture where services must verify tokens independently without pinging a central MySQL database.",
                'author' => 'Satyajeetsinh Dodiya',
                'status' => 'published',
                'published_at' => '2026-07-20 09:15:00',
            ],
            [
                'title' => 'Deploying Laravel Applications with Docker',
                'slug' => 'docker-laravel-deploy',
                'category' => 'Deployment',
                'excerpt' => 'Creating minimal, production-ready multi-stage Docker containers with PHP-FPM, Nginx, OPcache, and Supervisor.',
                'content' => "### Multi-Stage Docker Builds for PHP\nUsing multi-stage Docker builds allows us to compile composer dependencies in a builder stage and copy only production artifacts into the final lean Alpine image.\n\n### Production Essentials\n- **OPcache Enabled**: Precompiles PHP bytecode into shared memory.\n- **Supervisor Daemon**: Ensures queue workers (`php artisan queue:work`) restart automatically if they crash or exceed memory limits.\n- **Non-root Execution**: Run PHP-FPM as user `www-data` for enterprise container security.",
                'author' => 'Satyajeetsinh Dodiya',
                'status' => 'published',
                'published_at' => '2026-06-10 14:00:00',
            ],
            [
                'title' => 'Designing Maintainable Laravel APIs',
                'slug' => 'maintainable-laravel-apis',
                'category' => 'Backend',
                'excerpt' => 'Standardizing API response envelopes, error structures, and HTTP status codes across mobile and web teams.',
                'content' => "### Consistent Response Structure\nAPI consumers (iOS, Android, React) need a predictable JSON schema for both successes and errors:\n\n```json\n{\n  \"success\": true,\n  \"data\": { ... },\n  \"message\": \"Resource created successfully\",\n  \"meta\": { \"timestamp\": 1759239841 }\n}\n```\n\n### Unified Exception Handler\nUse Laravel's `bootstrap/app.php` or custom `Handler.php` to intercept all validation, model-not-found, and authentication errors and transform them into standardized JSON contracts.",
                'author' => 'Satyajeetsinh Dodiya',
                'status' => 'published',
                'published_at' => '2026-05-05 16:45:00',
            ],
        ];

        foreach ($postsData as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
