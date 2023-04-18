@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Program List</h5>
      <a href="{{ route('programs.create') }}" class="btn btn-sm btn-primary">Create Program</a>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">Program ID</th>
            <th span="col">Program Name</th>
            <th span="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($programs as $program)
            <tr>
              <td>{{ $program->id }}</td>
              <td>{{ $program->name }}</td>
              <td>
                <a href="{{ route('programs.edit', $program) }}" class="action text-decoration-none">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
