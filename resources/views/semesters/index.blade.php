@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Semester List</h5>
      <a href="{{ route('semesters.create') }}" class="btn btn-sm btn-primary">Create Semester</a>
    </div>

    <div class="table-responsive">
      <table class="dataTable table table-bordered table-striped">
        <thead>
          <tr>
            <th span="col">Semester ID</th>
            <th span="col">Start Date</th>
            <th span="col">End Date</th>
            <th span="col">Current</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($semesters as $semester)
            <tr>
              <td>{{ $semester->id }}</td>
              <td>{{ $semester->start_date }}</td>
              <td>{{ $semester->end_date }}</td>
              <td>
                @if ($semester->current)
                  <div class="form-check form-switch">
                    <input class="switch form-check-input" type="checkbox" role="switch" data-semester="{{ $semester->id }}" checked />
                  </div>
                @else
                  <div class="form-check form-switch">
                    <input class="switch form-check-input" type="checkbox" role="switch" data-semester="{{ $semester->id }}" />
                  </div>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(() => {
      $(".switch").on("change", (e) => {
        const semesterId = ($(e.target).data("semester"));

        $.post(`/admin/semesters/${semesterId}/c`, () => {
          window.location.reload(true);
        });
      });
    });
  </script>
@endpush
