@extends('layouts.app')
@section('content')
<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="row g-0 auth-form-split">
          <div class="col-md-6 d-flex bg-primary bg-opacity-10">
            <div class="p-5 d-flex flex-column justify-content-center w-100">
              <div class="text-center mb-4">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block">
                  <i class="bi bi-shield-lock text-primary fs-1"></i>
                </div>
              </div>
              <h3 class="text-center fw-bold">Welcome Back</h3>
              <p class="text-center text-secondary">Sign in to access your dashboard</p>
              <div class="mt-4">
                <div class="d-flex justify-content-center gap-3">
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-shield-check text-white"></i>
                    </div>
                    <div class="small">Secure</div>
                  </div>
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-lightning text-white"></i>
                    </div>
                    <div class="small">Fast</div>
                  </div>
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-phone text-white"></i>
                    </div>
                    <div class="small">Responsive</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-body p-4 p-md-5">
              <h1 class="h3 mb-2 text-center">Log in</h1>
              <p class="text-secondary text-center mb-4">Enter your credentials</p>
              <form id="loginForm" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                  </div>
                  <div class="invalid-feedback">Please enter a valid email.</div>
                </div>
                <div class="mb-2">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-key"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required minlength="6">
                    <button class="btn btn-outline-secondary" type="button" data-toggle="password" aria-label="toggle password">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                  <div class="invalid-feedback">Password must be at least 6 characters.</div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                  </div>
                  <a href="{{ route('password.request') }}" class="link-primary small">Forgot password?</a>
                </div>
                <button class="btn btn-primary w-100 rounded-3 py-2" type="submit">
                  <i class="bi bi-box-arrow-in-right me-2"></i>Log in
                </button>
              </form>
              <hr class="my-4">
              <p class="mb-0 text-center small">No account? <a href="{{ route('signup') }}">Create one</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
