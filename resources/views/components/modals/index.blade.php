{{-- Global Application Popups & Modals Bundle --}}
@include('components.modals.case-study-modal')
@include('components.modals.note-modal')
@include('components.modals.resume-modal', ['settings' => $settings ?? []])
@include('components.modals.lightbox-modal')
