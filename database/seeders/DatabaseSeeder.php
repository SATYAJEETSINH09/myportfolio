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
    /**
     * Seed the application's database with verified portfolio data.
     */
    public function run(): void
    {
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
                'title' => 'Dare Play',
                'project_number' => '01',
                'tagline' => 'Learning & Activity Management Platform',
                'category' => 'Education & Activity Tech',
                'year' => '2025–2026',
                'role' => 'Lead Backend Developer',
                'project_type' => 'Web + Mobile Backend API',
                'client' => 'Education Enterprise',
                'short_description' => 'Learning and activity management platform with multi-school workflows, activity scheduling, rewards calculation and real-time push notifications.',
                'description' => 'Dare Play is an enterprise-grade learning and activity platform designed for multi-branch schools. It powers student progress tracking, interactive learning activities, automated point rewards ledger, and high-throughput Firebase push notifications.',
                'challenge' => 'Coordinating concurrent activity submissions from multiple school branches while preventing duplicate reward points and handling bursts of real-time push notifications without blocking HTTP worker threads.',
                'solution' => 'Engineered atomic database transactions with pessimistic locking for point allocation and offloaded push notifications to asynchronous Redis queue workers with batch dispatching.',
                'cover_image' => 'projects/dare-play.png',
                'live_url' => 'https://dareplay.example.com',
                'github_url' => 'https://github.com/satyajeetsinh-dodiya/dare-play-backend',
                'featured' => true,
                'status' => 'completed',
                'sort_order' => 1,
                'metrics' => [
                    ['label' => 'Schools Managed', 'val' => '12+'],
                    ['label' => 'Notification Latency', 'val' => '<120ms'],
                    ['label' => 'API Response Time', 'val' => '~38ms'],
                    ['label' => 'Activity Throughput', 'val' => '5,000+/day'],
                ],
                'api_demo' => [
                    'method' => 'POST',
                    'endpoint' => '/api/v1/activities/18/complete',
                    'request' => [
                        'child_id' => 24,
                        'activity_id' => 18,
                        'timestamp' => '2026-09-30T10:15:30Z',
                        'verification_code' => 'SCH-8892',
                    ],
                    'response' => [
                        'success' => true,
                        'status' => 'completed',
                        'points_awarded' => 20,
                        'total_child_balance' => 340,
                        'fcm_notification_dispatched' => true,
                        'execution_time' => '38ms',
                    ],
                ],
            ]
        );

        $darePlayTechnologies = ['Laravel', 'PHP 8.2', 'MySQL', 'REST API', 'FCM', 'Redis', 'Sanctum'];
        foreach ($darePlayTechnologies as $idx => $tech) {
            ProjectTechnology::updateOrCreate(
                ['project_id' => $darePlay->id, 'name' => $tech],
                ['sort_order' => $idx + 1]
            );
        }

        $darePlayFeatures = [
            ['title' => 'REST API Development & Schema Architecture', 'description' => 'Engineered modular REST API endpoints following standardized JSON responses and FormRequest validation.'],
            ['title' => 'Multi-tenant Authentication (Sanctum)', 'description' => 'Implemented token-based authentication and role-based access control for students, parents, and school admins.'],
            ['title' => 'School & Branch Activity Management', 'description' => 'Supported independent branch configuration, learning tiers, and curriculum activity lifecycles.'],
            ['title' => 'Atomic Rewards & Points Calculation', 'description' => 'Built an idempotent ledger for points awarding with pessimistic locking to prevent race conditions.'],
            ['title' => 'Asynchronous Firebase Notification Queues', 'description' => 'Offloaded device push notifications to background Redis queue jobs to maintain sub-50ms API responses.'],
            ['title' => 'Database Index Tuning & N+1 Prevention', 'description' => 'Structured composite indexes and eager loaded relationships across multi-level activity models.'],
        ];
        foreach ($darePlayFeatures as $idx => $feat) {
            ProjectFeature::updateOrCreate(
                ['project_id' => $darePlay->id, 'title' => $feat['title']],
                ['description' => $feat['description'], 'sort_order' => $idx + 1]
            );
        }

        ProjectChallenge::updateOrCreate(
            ['project_id' => $darePlay->id, 'challenge' => 'Concurrency & Duplicate Awards'],
            ['solution' => 'Engineered atomic database transactions with pessimistic locking on point balance rows and unique completion constraints.', 'sort_order' => 1]
        );

        // 2. GoMeds247
        $goMeds = Project::updateOrCreate(
            ['slug' => 'gomeds247'],
            [
                'title' => 'GoMeds247',
                'project_number' => '02',
                'tagline' => 'Healthcare & Pharmacy E-Commerce',
                'category' => 'Healthcare & Pharmacy',
                'year' => '2025',
                'role' => 'Backend Developer',
                'project_type' => 'REST API & Prescription Verification',
                'short_description' => 'On-demand pharmacy ordering system with secure digital prescription approvals, doctor review pipelines, and partner pharmacy inventory synchronization.',
                'description' => 'GoMeds247 is a comprehensive digital pharmacy platform that streamlines prescription upload, pharmacist verification, medication dispensing, and delivery fulfillment.',
                'challenge' => 'Handling confidential prescription document uploads and regulatory compliance across high-volume pharmacy ordering queues.',
                'solution' => 'Implemented encrypted S3 storage buckets with time-limited signed URLs and granular policy gates for pharmacist approval workflows.',
                'cover_image' => 'projects/gomeds247.png',
                'featured' => false,
                'status' => 'completed',
                'sort_order' => 2,
                'api_demo' => [
                    'method' => 'GET',
                    'endpoint' => '/api/v1/prescriptions/RX-94021/verify',
                    'request' => null,
                    'response' => [
                        'prescription_id' => 'RX-94021',
                        'status' => 'approved_by_pharmacist',
                        'medications_approved' => 3,
                        'delivery_slot' => '2026-09-30 18:00 - 20:00',
                    ],
                ],
            ]
        );
        foreach (['Laravel', 'PHP', 'MySQL', 'REST API', 'Sanctum', 'AWS S3'] as $idx => $tech) {
            ProjectTechnology::updateOrCreate(['project_id' => $goMeds->id, 'name' => $tech], ['sort_order' => $idx + 1]);
        }

        // 3. Klean Health
        $kleanHealth = Project::updateOrCreate(
            ['slug' => 'klean-health'],
            [
                'title' => 'Klean Health',
                'project_number' => '03',
                'tagline' => 'Modern Healthcare Consultation',
                'category' => 'Healthcare Platform',
                'year' => '2025',
                'role' => 'Backend Developer',
                'project_type' => 'Telehealth & Booking Backend',
                'short_description' => 'Patient-doctor appointment scheduling engine engineered with concurrency slot locking, medical record storage, and automated notification webhooks.',
                'description' => 'Klean Health connects patients with specialists through automated availability slots, telehealth consultation links, and medical history preservation.',
                'challenge' => 'Preventing double-booking of doctor appointment slots during high-traffic clinic hours.',
                'solution' => 'Engineered slot locks utilizing Redis atomic expiration keys alongside database transaction isolation.',
                'cover_image' => 'projects/klean-health.png',
                'featured' => false,
                'status' => 'completed',
                'sort_order' => 3,
                'api_demo' => [
                    'method' => 'POST',
                    'endpoint' => '/api/v1/appointments/book',
                    'request' => ['doctor_id' => 104, 'slot_time' => '14:30:00', 'patient_id' => 882],
                    'response' => ['booking_id' => 'APT-5519', 'status' => 'confirmed', 'receipt_url' => 'https://pay.example.com/receipt/5519'],
                ],
            ]
        );
        foreach (['Laravel', 'PHP', 'MySQL', 'REST API', 'Razorpay'] as $idx => $tech) {
            ProjectTechnology::updateOrCreate(['project_id' => $kleanHealth->id, 'name' => $tech], ['sort_order' => $idx + 1]);
        }

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
                'period' => '2025 — PRESENT',
                'stack' => 'Laravel · PHP · MySQL · REST API · Sanctum · FCM',
                'is_current' => true,
                'description' => 'Develop and maintain production backend systems, scalable REST APIs, and administrative workflows supporting high-volume web and mobile client applications.',
                'location' => 'Ahmedabad, Gujarat, India',
                'sort_order' => 1,
            ]
        );
        $exp1Points = [
            'REST API Development & Schema Optimization for multi-platform clients.',
            'Authentication & Authorization using Laravel Sanctum and fine-grained RBAC.',
            'Modular back-office admin modules with live reporting and audit logs.',
            'Relational database design, composite indexing, and query tuning.',
            'Third-party integrations with Firebase Cloud Messaging (FCM) and payment gateways.',
            'N+1 query elimination and response time profiling.',
        ];
        foreach ($exp1Points as $idx => $pt) {
            ExperiencePoint::updateOrCreate(['experience_id' => $exp1->id, 'text' => $pt], ['sort_order' => $idx + 1]);
        }

        $exp2 = Experience::updateOrCreate(
            ['company' => 'Binstellar Technologies Pvt. Ltd.', 'position' => 'MERN Stack Intern'],
            [
                'period' => '2025',
                'stack' => 'React · Node.js · Express · MongoDB',
                'is_current' => false,
                'description' => 'Engineered ShopSphere — a full stack e-commerce web platform with responsive user interface, JWT authentication, and dual payment gateway integrations.',
                'location' => 'Ahmedabad, Gujarat, India',
                'sort_order' => 2,
            ]
        );
        $exp2Points = [
            'Built full stack e-commerce web application with cart session persistence.',
            'Implemented secure RESTful endpoints with Express, JWT, and payment webhooks.',
            'Participated in code reviews, database schema iterations, and Git collaboration workflows.',
        ];
        foreach ($exp2Points as $idx => $pt) {
            ExperiencePoint::updateOrCreate(['experience_id' => $exp2->id, 'text' => $pt], ['sort_order' => $idx + 1]);
        }

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
