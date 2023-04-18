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
            <label for="name" class="col-form-label-sm">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" required />

            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="email" class="col-form-label-sm">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" required />

            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="password" class="col-form-label-sm">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" required />

            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="password_confirmation" class="col-form-label-sm">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" required />
          </div>

          <button type="submit" class="w-100 btn btn-sm btn-primary">Create administrator account</button>
        </div>
      </div>
    </form>
  </main>
@endsection
