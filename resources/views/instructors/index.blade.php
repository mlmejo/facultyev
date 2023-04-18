@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-4 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Instructor List</h5>
      <a href="{{ route('instructors.create') }}" class="btn btn-sm btn-primary">Create Instructor Account</a>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">ID</th>
            <th span="col">Instructor Name</th>
            <th span="col">Email Address</th>
            <th span="col">Program</th>
            <th span="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($instructors as $instructor)
            <tr>
              <td>{{ $instructor->id }}</td>
              <td>{{ $instructor->user->name }}</td>
              <td>{{ $instructor->user->email }}</td>
              <td>{{ $instructor->program->name }}</td>
              <td>
                <a href="{{ route('instructors.edit', $instructor) }}" class="action text-decoration-none">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
