@extends('layouts.app')
@section('content')
<header class="py-5 shadow-sm" style="background: linear-gradient(120deg, var(--aw-primary), #8a6cca);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h1 class="display-6 fw-bold mb-2 text-white">Profile & Settings</h1>
        <p class="lead mb-0 text-white">Manage your account information, password, and preferences.</p>
      </div>
      <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <div class="d-flex justify-content-md-end">
          <div class="rounded-circle bg-white bg-opacity-10 p-3 me-3">
            <i class="bi bi-person-circle text-white fs-2"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="container py-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 pb-0">
          <h2 class="h5 mb-0 d-flex align-items-center">
            <i class="bi bi-person me-2 text-primary"></i>Personal Information
          </h2>
        </div>
        <div class="card-body">
          <form class="needs-validation" id="profileForm" novalidate>
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label for="profileFirstName" class="form-label">First name</label>
                <input type="text" id="profileFirstName" name="first_name" class="form-control" required value="{{ explode(' ', auth()->user()->name ?? 'Zeshan')[0] ?? '' }}">
                <div class="invalid-feedback">First name is required.</div>
              </div>
              <div class="col-md-6">
                <label for="profileLastName" class="form-label">Last name</label>
                <input type="text" id="profileLastName" name="last_name" class="form-control" required value="{{ explode(' ', auth()->user()->name ?? 'Faheem')[1] ?? '' }}">
                <div class="invalid-feedback">Last name is required.</div>
              </div>
              <div class="col-md-12">
                <label for="profileEmail" class="form-label">Email</label>
                <input type="email" id="profileEmail" name="email" class="form-control" required value="{{ auth()->user()->email ?? 'zeshan@archiwiz.com' }}">
                <div class="invalid-feedback">Please provide a valid email.</div>
              </div>
              <div class="col-md-12">
                <label for="profileBio" class="form-label">Bio</label>
                <textarea id="profileBio" name="bio" class="form-control" rows="3" placeholder="Tell us a bit about you...">{{ auth()->user()->bio ?? '' }}</textarea>
              </div>
              <div class="col-12">
                <button class="btn btn-primary rounded-3 px-4" type="submit">
                  <i class="bi bi-save me-2"></i>Save changes
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-header bg-white border-0 pt-4 pb-0">
          <h2 class="h5 mb-0 d-flex align-items-center">
            <i class="bi bi-shield-lock me-2 text-primary"></i>Change Password
          </h2>
        </div>
        <div class="card-body">
          <form class="needs-validation" id="passwordForm" novalidate>
            @csrf
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label" for="currentPassword">Current password</label>
                <div class="input-group">
                  <input id="currentPassword" name="current_password" type="password" class="form-control" required>
                  <button class="btn btn-outline-secondary" type="button" data-toggle="password">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
                <div class="invalid-feedback">Current password is required.</div>
              </div>
              <div class="col-md-12">
                <label class="form-label" for="newPassword">New password</label>
                <div class="input-group">
                  <input id="newPassword" name="new_password" type="password" class="form-control" minlength="6" required>
                  <button class="btn btn-outline-secondary" type="button" data-toggle="password">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
                <div class="form-text">Use 6+ characters with a mix of letters and numbers.</div>
                <div class="invalid-feedback">Use at least 6 characters.</div>
              </div>
              <div class="col-md-12">
                <label class="form-label" for="confirmPassword">Confirm new password</label>
                <div class="input-group">
                  <input id="confirmPassword" type="password" class="form-control" minlength="6" required>
                  <button class="btn btn-outline-secondary" type="button" data-toggle="password">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
                <div class="invalid-feedback">Passwords must match.</div>
              </div>
              <div class="col-12">
                <button class="btn btn-outline-primary rounded-3 px-4" type="submit">
                  <i class="bi bi-arrow-repeat me-2"></i>Update password
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4 pb-0">
          <h2 class="h5 mb-0 d-flex align-items-center">
            <i class="bi bi-gear me-2 text-primary"></i>Preferences
          </h2>
        </div>
        <div class="card-body">
          <form id="prefsForm" class="needs-validation" novalidate>
            @csrf
            <div class="mb-4">
              <label class="form-label fw-bold">Notifications</label>
              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="prefEmail" name="pref_email" {{ (data_get(auth()->user()->preferences ?? [], 'email', true)) ? 'checked' : '' }}>
                <label class="form-check-label" for="prefEmail">Email notifications</label>
              </div>
              <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="prefSMS" name="pref_sms" {{ (data_get(auth()->user()->preferences ?? [], 'sms', false)) ? 'checked' : '' }}>
                <label class="form-check-label" for="prefSMS">SMS notifications</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label class="form-label fw-bold">Appearance</label>
              <div class="mb-3">
                <label class="form-label" for="themeSelect">Theme</label>
                <select class="form-select" id="themeSelect" name="theme">
                  @php($theme = data_get(auth()->user()->preferences ?? [], 'theme', 'light'))
                  <option value="light" {{ $theme === 'light' ? 'selected' : '' }}>Light</option>
                  <option value="dark" {{ $theme === 'dark' ? 'selected' : '' }}>Dark</option>
                  <option value="auto" {{ $theme === 'auto' ? 'selected' : '' }}>Auto</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="form-label" for="primaryColor">Primary Color</label>
                <div class="input-group">
                  <input type="color" class="form-control form-control-color" id="primaryColor" name="primary_color" value="{{ data_get(auth()->user()->preferences ?? [], 'primary_color', '#6f42c1') }}" title="Choose your primary color">
                  <button class="btn btn-outline-secondary" type="button" id="resetColor">
                    <i class="bi bi-arrow-counterclockwise"></i>
                  </button>
                </div>
                <div class="form-text">Select a color for the primary theme</div>
              </div>
            </div>
            
            <button class="btn btn-outline-secondary w-100 rounded-3" type="submit">
              <i class="bi bi-save me-2"></i>Save preferences
            </button>
          </form>
        </div>
      </div>
      
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 pb-0">
          <h2 class="h5 mb-0 d-flex align-items-center">
            <i class="bi bi-info-circle me-2 text-primary"></i>Account Information
          </h2>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item px-0 py-3">
              <div class="d-flex justify-content-between">
                <span class="text-secondary">Member since</span>
                <span>{{ auth()->user()->created_at->format('M d, Y') ?? 'Unknown' }}</span>
              </div>
            </li>
            <li class="list-group-item px-0 py-3">
              <div class="d-flex justify-content-between">
                <span class="text-secondary">Last login</span>
                <span>{{ auth()->user()->updated_at->format('M d, Y') ?? 'Unknown' }}</span>
              </div>
            </li>
            <li class="list-group-item px-0 py-3">
              <div class="d-flex justify-content-between">
                <span class="text-secondary">Account status</span>
                <span class="badge bg-success">Active</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
