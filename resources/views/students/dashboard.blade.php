@extends('layouts.student')

@section('main')
  <div class="row">
    @foreach (request()->user()->userable->sections as $section)
      @if (request()->user()->userable->ratings->contains(function (\App\Models\Rating $rating) use ($section) {
          return $rating->section->id === $section->id;
      }))
      @else
        <div class="col-12 col-lg-4">
          <a href="{{ route('sections.ratings.create', $section) }}" class="text-dark text-decoration-none">
            <div class="card shadow">
              <div class="card-body">
                <p class="mb-1">Subject: {{ $section->subject->code }}</p>
                <p class="mb-0">Adviser: {{ $section->instructor->user->name }}</p>
              </div>
            </div>
          </a>
        </div>
      @endif
    @endforeach
  </div>
@endsection
