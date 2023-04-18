@extends('layouts.admin')

@section('main')
  @if ($currentSemester === null)
      <div class="alert alert-danger">
        WARNING: There is no current semester set.
      </div>
  @else
    <div class="col-lg-8">
      <div class="mb-2 d-flex justify-content-between align-items-center">
        <div class="d-flex flex-column">
          <h5 class="mb-0">Questionnaire</h5>
        </div>

        <a href="{{ route('questionnaires.create') }}" class="btn btn-sm btn-primary">Import CSV</a>
      </div>

      <p class="text-muted">
        Current semester: {{ \Carbon\Carbon::parse($currentSemester->start_date)->format("F Y") }} - {{ \Carbon\Carbon::parse($currentSemester->end_date)->format("F Y") }}
      </p>

      @if ($questionnaire)
        <div class="table-responsive">
          <table class="mt-4 table table-bordered">
            @foreach ($questionnaire->categories as $category)
              <tr>
                <th class="text-bg-primary">{{ $category->name }}</th>
              </tr>
              @foreach ($category->questions as $question)
                <tr>
                  <td>{{ $question->content }}</td>
                </tr>
              @endforeach
            @endforeach
          </table>
        </div>
      @endif
    </div>
  @endif
@endsection
