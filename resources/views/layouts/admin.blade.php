@extends('layouts.app')

@push('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
  <header class="navbar between navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Administrator</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav w-100">
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
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="pb-3 nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/semesters*') ? 'active' : '' }}" href="{{ route('semesters.index') }}">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Semesters
              </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
              Resource Management
            </h6>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/courses*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                <span data-feather="book" class="align-text-bottom"></span>
                Courses
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/programs*') ? 'active' : '' }}" href="{{ route('programs.index') }}">
                <span data-feather="book" class="align-text-bottom"></span>
                Programs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/subjects*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">
                <span data-feather="book" class="align-text-bottom"></span>
                Subjects
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/sections*') ? 'active' : '' }}" href="{{ route('sections.index') }}">
                <span data-feather="book" class="align-text-bottom"></span>
                Sections
              </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
              Account Management
            </h6>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/instructors*') ? 'active' : '' }}" href="{{ route('instructors.index') }}">
                <span data-feather="user" class="align-text-bottom"></span>
                Instructors
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="user" class="align-text-bottom"></span>
                Staff
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <span data-feather="user" class="align-text-bottom"></span>
                Students
              </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
              Evaluation Management
            </h6>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/questionnaires*') ? 'active' : '' }}" href="{{ route('questionnaires.index') }}">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Forms
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="edit" class="align-text-bottom"></span>
                Results
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="pie-chart" class="align-text-bottom"></span>
                Statistics
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 p-3">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @yield('main')
      </div>
    </div>
  </div>
@endsection
