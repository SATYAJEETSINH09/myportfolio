@extends('layouts.portfolio')

@section('title', ($settings['site_name'] ?? 'Satyajeetsinh Dodiya') . ' — ' . ($settings['role'] ?? 'Laravel Backend Developer'))

@section('content')
  {{-- Hero Section with Developer Terminal and Ticker --}}
  <x-hero :settings="$settings" />

  {{-- Proof / Statistics Counter --}}
  <x-stats />

  {{-- 01 / About Section --}}
  <x-about :settings="$settings" />

  {{-- 02 / Selected Projects Showcase --}}
  <x-project-grid :featuredProject="$featuredProject" :projects="$projects" />

  {{-- 03 / Backend Expertise --}}
  <x-expertise />

  {{-- 04 / Technical Toolkit --}}
  <x-toolkit :skills="$skills" />

  {{-- 05 / Career Experience Timeline --}}
  <x-experience :experiences="$experiences" />

  {{-- 06 / Services Invert Cards --}}
  <x-services :services="$services" />

  {{-- 07 / Engineering Notes (Blog) --}}
  <x-blog-card :blogPosts="$blogPosts" />

  {{-- 08 / Contact Section --}}
  <x-contact :settings="$settings" />
@endsection
