@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Create Program</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('programs.store') }}" method="post">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="name" class="col-form-label-sm">Program name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" required />
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
@endsection
