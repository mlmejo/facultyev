@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-4 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Result List</h5>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">Instructor Name</th>
            <th span="col">Subject Code</th>
            <th span="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sections as $section)
            <tr>
              <td>{{ $section->instructor->user->name }}</td>
              <td>{{ $section->subject->code }}</td>
              <td>
                <a href="{{ route('sections.ratings.index', $section) }}" class="action text-decoration-none">View</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
