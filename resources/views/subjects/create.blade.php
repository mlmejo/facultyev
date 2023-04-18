@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Create Subject</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('subjects.store') }}" method="post">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="code" class="col-form-label-sm">Subject code</label>
            <input type="text" name="code" id="code" class="form-control form-control-sm" required />
          </div>

          <div class="col-lg-8 mb-3">
            <label for="description" class="col-form-label-sm">Descriptive title</label>
            <input type="text" name="description" id="description" class="form-control form-control-sm" required />
          </div>

          <div class="col-lg-8 mb-3">
            <label for="units" class="col-form-label-sm">Units</label>
            <input type="number" name="units" id="units" class="form-control form-control-sm" required />
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
@endsection
