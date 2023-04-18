@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Student List</h5>
      <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">Create Student Account</a>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">Student ID</th>
            <th span="col">Student Name</th>
            <th span="col">Email Address</th>
            <th span="col">Course</th>
            <th span="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($students as $student)
            <tr>
              <td>{{ $student->id }}</td>
              <td>{{ $student->user->name }}</td>
              <td>{{ $student->user->email }}</td>
              <td>{{ $student->course->name }}</td>
              <td>
                <a href="{{ route('students.edit', $student) }}" class="action text-decoration-none">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
