@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Create Semester</h5>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="{{ route('semesters.store') }}" method="post">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="start_date" class="col-form-label-sm">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" required />

          @error('start_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
          </div>

          <div class="col-lg-8 mb-3">
            <label for="end_date" class="col-form-label-sm">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" required />

            @error('end_date')
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
