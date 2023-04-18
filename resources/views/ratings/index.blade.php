@extends('layouts.instructor')

@section('main')
  <div class="col-lg-5">
    <h6>Evaluation Results</h6>
    <h6>Subject: {{ $section->subject->code }}</h6>

    <ul class="mt-3 list-group">
      @foreach ($section->students as $student)
        <li class="list-group-item d-flex justify-content-between">
          {{ $student->user->name }}
          <a href="{{ route('students.ratings.index', [$student, 'section_id' => $section->id]) }}" class="action text-decoration-none">View</a>
        </li>
      @endforeach
    </ul>
  </div>
@endsection
