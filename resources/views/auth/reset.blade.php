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
                  <i class="bi bi-key-fill text-primary fs-1"></i>
                </div>
              </div>
              <h3 class="text-center fw-bold">Reset Password</h3>
              <p class="text-center text-secondary">Create a new password</p>
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
                      <i class="bi bi-lock text-white"></i>
                    </div>
                    <div class="small">Encrypted</div>
                  </div>
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-check-circle text-white"></i>
                    </div>
                    <div class="small">Verified</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-body p-4 p-md-5">
              <h1 class="h3 mb-2 text-center">Set New Password</h1>
              <p class="text-secondary text-center mb-4">Create a new password for your account</p>
              <form id="resetForm" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
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
                <div class="mb-3">
                  <label class="form-label" for="password">New Password</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-key"></i>
                    </span>
                    <input id="password" name="password" type="password" class="form-control" minlength="6" required>
                    <button class="btn btn-outline-secondary" type="button" data-toggle="password">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                  <div class="form-text">Use 6+ characters with a mix of letters and numbers.</div>
                  <div class="invalid-feedback">Please pick a stronger password.</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="password_confirmation">Confirm Password</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-key"></i>
                    </span>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" minlength="6" required>
                    <button class="btn btn-outline-secondary" type="button" data-toggle="password">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                  <div class="invalid-feedback">Passwords must match.</div>
                </div>
                <button class="btn btn-primary w-100 rounded-3 py-2" type="submit">
                  <i class="bi bi-arrow-repeat me-2"></i>Reset Password
                </button>
              </form>
              <hr class="my-4">
              <p class="mb-0 text-center small">
                <a href="{{ route('login') }}">Back to login</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
