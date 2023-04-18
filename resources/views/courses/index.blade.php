@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Course List</h5>
      <a href="{{ route('courses.create') }}" class="btn btn-sm btn-primary">Create Course</a>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">Course ID</th>
            <th span="col">Course Name</th>
            <th span="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courses as $course)
            <tr>
              <td>{{ $course->id }}</td>
              <td>{{ $course->name }}</td>
              <td>
                <a href="{{ route('courses.edit', $course) }}" class="action text-decoration-none">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
