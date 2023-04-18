@extends('layouts.admin')

@section('main')
  <div class="col-lg-8">
    <div class="mb-2 d-flex justify-content-between align-items-center">
      <h5>Edit Section</h5>
    </div>

    <div class="card mt-3">
      <div class="card-body">
        <h6>Students</h6>

        @if ($section->students->count() > 0)
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th span="col">Student name</th>
                  <th span="col">Email</th>
                  <th span="col">Course</th>
                  <th span="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($section->students as $student)
                  <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->course->name }}</td>
                    <td>
                      <a href="#" role="button" class="action remove-student text-danger text-decoration-none" data-section="{{ $section->id }}" data-student="{{ $student->id }}">
                        Remove
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        <form action="{{ route('sections.students.store', $section) }}" method="post">
          @csrf

          <div class="col-lg-8 mb-3">
            <label for="student_id" class="col-form-label-sm">Student</label>
            <select name="student_id" id="student_id" class="select2 form-select form-select-sm @error('student_id') is-invalid @enderror">
              @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->user->name }}</option>
              @endforeach
            </select>

            @error('student_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </form>
      </div>
    </div>

    <div class="mt-3 card">
      <div class="card-body">
        <h6>Delete Section</h6>
        <p class="text-muted">All resources related to this section will be deleted as well.</p>

        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-resource-modal">
          Delete
        </button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="remove-student-modal" tabindex="-1" aria-labelledby="remove-student-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="remove-student-label">Confirm Removal</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to remove this student?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="confirm-remove-student btn btn-sm btn-danger">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delete-resource-modal" tabindex="-1" aria-labelledby="delete-resource-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="delete-resource-label">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this section?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('sections.destroy', $section) }}"  method="post" class="m-0">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(() => {
      const modal = new bootstrap.Modal("#remove-student-modal");
      var sectionId = null;
      var studentId = null;

      $(".remove-student").on("click", (e) => {
        sectionId = $(e.target).data("section");
        studentId = $(e.target).data("student");

        modal.show();
      });

      $(".confirm-remove-student").on("click", (e) => {
        $.ajax({
          url: `/admin/sections/${sectionId}/students/${studentId}`,
          type: "DELETE",
          success: (data) => {
            window.location.href = data.redirect;
          }
        });
      })
    });
  </script>
@endpush
