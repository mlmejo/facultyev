@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Create Program</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('questionnaires.store') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="document" class="col-form-label-sm">CSV Document</label>
            <input type="file" name="document" id="document" class="form-control form-control-sm" required />
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
@endsection
