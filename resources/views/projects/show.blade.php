@extends('layouts.portfolio')

@section('title', $project->title . ' — Case Study · ' . ($settings['site_name'] ?? 'Satyajeetsinh Dodiya'))
@section('meta_description', $project->short_description ?? $project->description)

@section('content')
  <x-case-study-layout 
      :project="$project" 
      :nextProject="$nextProject" 
      :prevProject="$prevProject" 
      :settings="$settings" 
  />
@endsection
