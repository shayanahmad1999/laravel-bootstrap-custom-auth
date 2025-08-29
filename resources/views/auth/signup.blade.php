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
                  <i class="bi bi-person-plus text-primary fs-1"></i>
                </div>
              </div>
              <h3 class="text-center fw-bold">Create Account</h3>
              <p class="text-center text-secondary">Join our community today</p>
              <div class="mt-4">
                <div class="d-flex justify-content-center gap-3">
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-person-check text-white"></i>
                    </div>
                    <div class="small">Personal</div>
                  </div>
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-people text-white"></i>
                    </div>
                    <div class="small">Community</div>
                  </div>
                  <div class="text-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-2 mb-2 d-inline-block">
                      <i class="bi bi-stars text-white"></i>
                    </div>
                    <div class="small">Features</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-body p-4 p-md-5">
              <h1 class="h3 mb-2 text-center">Sign up</h1>
              <p class="text-secondary text-center mb-4">Create your account</p>
              <form id="signupForm" class="needs-validation" novalidate>
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label" for="firstName">First name</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-person"></i>
                      </span>
                      <input id="firstName" name="first_name" class="form-control" required>
                    </div>
                    <div class="invalid-feedback">First name is required.</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="lastName">Last name</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-person"></i>
                      </span>
                      <input id="lastName" name="last_name" class="form-control" required>
                    </div>
                    <div class="invalid-feedback">Last name is required.</div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="signupEmail">Email</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                      </span>
                      <input id="signupEmail" name="email" type="email" class="form-control" required placeholder="you@example.com">
                    </div>
                    <div class="invalid-feedback">Valid email is required.</div>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="signupPassword">Password</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-key"></i>
                      </span>
                      <input id="signupPassword" name="password" type="password" class="form-control" minlength="6" required>
                      <button class="btn btn-outline-secondary" type="button" data-toggle="password">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <div class="form-text">Use 6+ characters with a mix of letters and numbers.</div>
                    <div class="invalid-feedback">Please pick a stronger password.</div>
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms" required>
                      <label class="form-check-label" for="terms">
                        I agree to the <a href="#" class="link-primary">Terms</a> and <a href="#" class="link-primary">Privacy Policy</a>.
                      </label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary w-100 mt-4 rounded-3 py-2" type="submit">
                  <i class="bi bi-person-check me-2"></i>Create account
                </button>
              </form>
              <hr class="my-4">
              <p class="mb-0 text-center small">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
