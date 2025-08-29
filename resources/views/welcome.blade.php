@extends('layouts.app')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="row g-0">
          <div class="col-lg-6">
            <div class="card-body p-5 h-100 d-flex flex-column justify-content-center">
              <h1 class="display-5 fw-bold mb-3">Welcome to Archiwiz</h1>
              <p class="lead mb-4">A beautifully crafted Laravel application with Bootstrap and AJAX functionality.</p>
              
              <div class="mb-4">
                <h2 class="h5 fw-bold mb-3">Get Started</h2>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item px-0 py-2 border-0">
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                        <i class="bi bi-book text-primary"></i>
                      </div>
                      <div>
                        <a href="https://laravel.com/docs" target="_blank" class="text-decoration-none">
                          <strong>Documentation</strong>
                        </a>
                        <div class="small text-secondary">Learn about Laravel features</div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item px-0 py-2 border-0">
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                        <i class="bi bi-collection-play text-success"></i>
                      </div>
                      <div>
                        <a href="https://laracasts.com" target="_blank" class="text-decoration-none">
                          <strong>Laracasts</strong>
                        </a>
                        <div class="small text-secondary">Video tutorials for developers</div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              
              <div class="mt-4">
                <a href="{{ route('signup') }}" class="btn btn-primary btn-lg rounded-3 px-4 me-2">
                  <i class="bi bi-person-plus me-2"></i>Get Started
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg rounded-3 px-4">
                  <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center p-5">
            <div class="text-center">
              <div class="mb-4">
                <i class="bi bi-code-slash text-primary fs-1"></i>
              </div>
              <h3 class="fw-bold mb-3">Built with Modern Tools</h3>
              <p class="mb-0">Laravel, Bootstrap 5, AJAX, and more</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
