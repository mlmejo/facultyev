@extends('layouts.app')

@section('content')
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">FSUU</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav w-100 mb-2 mb-lg-0">
          <div class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
          </div>

          <div class="nav-item text-nowrap ms-lg-auto">
            <form action="{{ route('logout') }}" method="post" id="logout-form">
              @csrf
              @method('DELETE')
              <a class="nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Sign out
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid p-4">
    @yield('main')
  </div>
@endsection
