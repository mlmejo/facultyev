@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-4 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Program List</h5>

      <div class="d-flex align-items-center">
        <a href="{{ route('programs.create') }}" class="me-2 btn btn-sm btn-primary">Create Program</a>
        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#import-modal">
          Import CSV
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">ID</th>
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

  <div class="modal fade" id="import-modal" tabindex="-1" aria-labelledby="import-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="import-modal-label">Import CSV</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('programs.import') }}" method="post" id="upload-form" enctype="multipart/form-data">
            @csrf
            <label for="document" class="col-form-label-sm">CSV Document</label>
            <input type="file" name="document" id="document" class="form-control form-control-sm" required />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-primary" form="upload-form">Upload</button>
        </div>
      </div>
    </div>
  </div>
@endsection
