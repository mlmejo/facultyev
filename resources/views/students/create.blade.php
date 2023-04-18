@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Create Student Account</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('students.store') }}" method="post">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="name" class="col-form-label-sm">Student name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" required />

            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="col-lg-8 mb-3">
            <label for="email" class="col-form-label-sm">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" required />

            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="col-lg-8 mb-3">
            <label for="password" class="col-form-label-sm">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" required />

            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="col-lg-8 mb-3">
            <label for="password_confirmation" class="col-form-label-sm">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" required />
          </div>

          <div class="col-lg-8 mb-3">
            <label for="course_id" class="col-form-label-sm">Course</label>
            <select name="course_id" id="course_id" class="select2 form-select form-select-sm @error('course_id') is-invalid @enderror">
              @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
              @endforeach
            </select>

            @error('course_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
@endsection
