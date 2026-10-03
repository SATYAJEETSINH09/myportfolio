<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', ($settings['site_name'] ?? 'Satyajeetsinh Dodiya') . ' — ' . ($settings['role'] ?? 'Laravel Backend Developer'))</title>
  <meta name="description" content="@yield('meta_description', $settings['bio'] ?? 'Portfolio of Satyajeetsinh Dodiya — Laravel Backend Developer specializing in scalable REST APIs, database architecture, authentication, and high-performance server systems.')">
  <meta name="keywords" content="Satyajeetsinh Dodiya, Laravel Developer, Backend Developer, PHP, MySQL, REST API, Web Developer India">
  <meta name="author" content="{{ $settings['site_name'] ?? 'Satyajeetsinh Dodiya' }}">
  <meta name="robots" content="index, follow">

  <!-- Open Graph / Social Meta -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="@yield('title', ($settings['site_name'] ?? 'Satyajeetsinh Dodiya') . ' — ' . ($settings['role'] ?? 'Laravel Backend Developer'))">
  <meta property="og:description" content="@yield('meta_description', $settings['bio'] ?? 'I build scalable APIs, backend systems and production-ready web applications using Laravel, PHP and modern web technologies.')">
  <meta property="og:url" content="{{ url()->current() }}">
  <link rel="canonical" href="{{ url()->current() }}">

  <!-- Google Fonts: Syne (Display), Plus Jakarta Sans (Body), JetBrains Mono (Technical) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@700;800;900&display=swap" rel="stylesheet">

  <!-- CSS Design Tokens & Stylesheets -->
  <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sections.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

  @stack('styles')
</head>
<body>

  <!-- Custom Cursor Elements (Desktop Only) -->
  @include('components.custom-cursor')

  <!-- Page Initial Loader -->
  @include('components.page-loader')

  <!-- Toast Notification Container -->
  <div id="toast-container" class="toast-container" aria-live="polite"></div>

  <!-- Sticky / Floating Navigation Bar -->
  @include('components.navbar')

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Minimal Editorial Footer -->
  @include('components.footer')

  <!-- Floating AI Portfolio Assistant (SD ✦) -->
  @include('components.chat-assistant')

  <!-- Global Popups & Modals (Blade Components) -->
  @include('components.modals.case-study-modal')
  @include('components.modals.note-modal')
  @include('components.modals.resume-modal', ['settings' => $settings ?? []])
  @include('components.modals.lightbox-modal')

  <!-- JavaScript Modules -->
  <script src="{{ asset('js/data.js') }}"></script>
  <script src="{{ asset('js/theme.js') }}"></script>
  <script src="{{ asset('js/cursor.js') }}"></script>
  <script src="{{ asset('js/terminal.js') }}"></script>
  <script src="{{ asset('js/case-study.js') }}"></script>
  <script src="{{ asset('js/notes-modal.js') }}"></script>
  <script src="{{ asset('js/chatbot.js') }}"></script>
  <script src="{{ asset('js/contact.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

  @stack('scripts')
</body>
</html>
