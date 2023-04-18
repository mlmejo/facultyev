@extends('layouts.student')

@section('main')
  <h6>Adviser: {{ $section->instructor->user->name }}</h6>
  <h6>Subject: {{ $section->subject->code }}</h6>

  <button type="submit" class="mt-3 px-3 btn btn-sm btn-primary" form="rating-form">Submit</button>

  <div class="table-responsive">
    <form action="{{ route('sections.ratings.store', $section) }}" method="post" id="rating-form">
      @csrf

      <table class="mt-4 table table-bordered">
        <thead>
          <tr class="text-bg-primary">
            <td></td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
          </tr>
        </thead>
        <tbody>
        @foreach ($questionnaire->categories as $category)
          <tr>
            <th colspan="6" class="text-bg-primary">{{ $category->name }}</th>
          </tr>
          @foreach ($category->questions as $question)
            <tr>
              <td>{{ $question->content }}</td>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $question->id }}" value="1" />
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $question->id }}" value="2" />
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $question->id }}" value="3" />
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $question->id }}" value="4" />
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="{{ $question->id }}" value="5" />
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
        @endforeach
      </table>
    </form>
  </div>
@endsection
