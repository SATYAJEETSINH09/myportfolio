<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // 2. Navigation Items Table
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->string('target')->default('_self');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('parent_id')->nullable()->constrained('navigation_items')->nullOnDelete();
            $table->timestamps();
        });

        // 3. Projects Table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('project_number')->nullable();
            $table->string('tagline')->nullable();
            $table->string('category');
            $table->string('year')->nullable();
            $table->string('role')->nullable();
            $table->string('project_type')->nullable();
            $table->string('client')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('challenge')->nullable();
            $table->longText('solution')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->json('metrics')->nullable();
            $table->json('api_demo')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('completed');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 4. Project Features Table
        Schema::create('project_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 5. Project Technologies Table
        Schema::create('project_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 6. Project Images Table
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('image');
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 7. Project Challenges / Solutions Table
        Schema::create('project_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->text('challenge');
            $table->text('solution');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 8. Blog Posts Table
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('cover_image')->nullable();
            $table->string('author')->default('Satyajeetsinh Dodiya');
            $table->string('status')->default('published');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 9. Experiences Table
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('position');
            $table->string('period');
            $table->string('stack')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 10. Experience Points Table
        Schema::create('experience_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->text('text');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 11. Skills Table
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Backend, Frontend, Tools
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('badge')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 12. Services Table
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 13. Contact Messages Table
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('project_type');
            $table->string('budget')->nullable();
            $table->text('message');
            $table->string('status')->default('unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('services');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('experience_points');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('project_challenges');
        Schema::dropIfExists('project_images');
        Schema::dropIfExists('project_technologies');
        Schema::dropIfExists('project_features');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('navigation_items');
        Schema::dropIfExists('settings');
    }
};
