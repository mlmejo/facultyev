@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Edit Student Account</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('students.update', $student) }}" method="post">
          @csrf
          @method('PATCH')

          <div class="col-lg-8 mb-3">
            <label for="name" class="col-form-label-sm">Student name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ $student->user->name }}" required />

            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="col-lg-8 mb-3">
            <label for="email" class="col-form-label-sm">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ $student->user->email }}" required />

            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="col-lg-8 mb-3">
            <label for="course_id" class="col-form-label-sm">Course</label>
            <select name="course_id" id="course_id" class="select2 form-select form-select-sm @error('course_id') is-invalid @enderror">
              @foreach ($courses as $course)
                @if ($student->course === $course)
                  <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                @else
                  <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endif
              @endforeach
            </select>

            @error('course_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </form>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-body">
        <h6>Delete Account</h6>
        <p class="text-muted">All resources related to this account will be deleted as well.</p>

        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-resource-modal">
          Delete
        </button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delete-resource-modal" tabindex="-1" aria-labelledby="delete-resource-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="delete-resource-label">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete <strong>"{{ $student->user->name }}"</strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('students.destroy', $student) }}" method="post" class="m-0">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
