@extends('layouts.instructor')

@section('main')
  <div class="row">
    @foreach (request()->user()->userable->sections as $section)
    <div class="col-12 col-lg-4">
      <a href="{{ route('sections.ratings.index', $section) }}" class="text-dark text-decoration-none">
        <div class="card shadow">
          <div class="card-body">
            <p class="mb-1">Subject: {{ $section->subject->code }}</p>
            <p class="mb-0">Adviser: {{ $section->instructor->user->name }}</p>
          </div>
        </div>
    </div>
    </a>
    @endforeach
  </div>
@endsection
