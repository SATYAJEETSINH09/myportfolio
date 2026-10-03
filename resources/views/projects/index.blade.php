@extends('layouts.portfolio')

@section('title', 'Selected Works — ' . ($settings['site_name'] ?? 'Satyajeetsinh Dodiya'))
@section('meta_description', 'Production Laravel APIs, database architectures, and web application case studies by Satyajeetsinh Dodiya.')

@section('content')
  <section class="section" style="padding-top:8.5rem;">
    <div class="container">
      <div class="section-label reveal-on-scroll">PORTFOLIO ARCHIVE</div>
      <div class="projects-header reveal-on-scroll">
        <div>
          <h1 class="section-title">ALL PROJECTS.</h1>
        </div>
        <p class="section-subtitle">
          Comprehensive catalog of production web applications, backend APIs, and microservices engineered with Laravel, PHP, and modern technologies.
        </p>
      </div>

      <div class="projects-editorial-grid" style="margin-top:3.5rem;">
        @foreach($projects as $project)
          <x-project-card :project="$project" :isFeatured="$project->featured" />
        @endforeach
      </div>

      <div style="margin-top:4rem; display:flex; justify-content:center;">
        {{ $projects->links() }}
      </div>
    </div>
  </section>
@endsection
