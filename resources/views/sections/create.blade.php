@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Create Section</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('sections.store') }}" method="post">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="subject_id" class="col-form-label-sm">Subject Code</label>
            <select name="subject_id" id="subject_id" class="select2 form-select form-select-sm">
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->code }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-lg-8 mb-3">
            <label for="instructor_id" class="col-form-label-sm">Instructor</label>
            <select name="instructor_id" id="instructor_id" class="select2 form-select form-select-sm">
              @foreach ($instructors as $instructor)
                <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
              @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
@endsection
