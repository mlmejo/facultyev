@extends('layouts.app')

@push('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
  <main class="form w-100 m-auto">
    <img src="{{ asset('img/urios.webp') }}" class="mb-4" alt="School Logo" width="72" height="72" />

    <form action="" method="post">
      @csrf

      <div class="card">
        <div class="card-body">
          <div class="mb-3 text-start">
            <label for="email" class="col-form-label-sm">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" />
          </div>

          <div class="mb-3 text-start">
            <label for="password" class="col-form-label-sm">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-sm">
          </div>

          <button type="submit" class="w-100 btn btn-sm btn-primary">Sign in</button>
        </div>
      </div>
    </form>
  </main>
@endsection
