@extends('layouts.app')

@section('content')
  <div class="container-fluid p-3">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex flex-column">
        <h6>Adviser: {{ $section->instructor->user->name }}</h6>
        <h6>Subject: {{ $section->subject->code }}</h6>
      </div>
    </div>

    <div class="table-responsive">
      <table class="mt-4 table table-bordered">
        <thead>
          <tr class="text-bg-primary">
            <td></td>
            <td>Rating</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($questionnaire->categories as $category)
            <tr>
              <th colspan="2" class="text-bg-primary">{{ $category->name }}</th>
            </tr>
          @foreach ($category->questions as $question)
            <tr>
              <td>{{ $question->content }}</td>
              <td class="text-center">
                {{ $student->ratings()->where('question_id', $question->id)->first()->value }}
              </td>
            </tr>
          @endforeach
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
@endsection
