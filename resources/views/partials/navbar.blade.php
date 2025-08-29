<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
      <span class="badge bg-white text-primary p-2 rounded-3">AW</span>
      <span class="fw-bold">Archiwiz</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2 me-1"></i>Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard.profile') ? 'active' : '' }}" href="{{ url('/dashboard/profile') }}">
            <i class="bi bi-person me-1"></i>Profile
          </a>
        </li>
      </ul>
      
      @auth
        <div class="d-flex align-items-center">
          <!-- Theme Switcher -->
          <div class="dropdown me-3">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="themeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-circle-half"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
              <li><a class="dropdown-item" href="#" data-theme="light">Light</a></li>
              <li><a class="dropdown-item" href="#" data-theme="dark">Dark</a></li>
              <li><a class="dropdown-item" href="#" data-theme="auto">Auto</a></li>
            </ul>
          </div>
          
          <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name ?? 'User' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li><a class="dropdown-item" href="{{ url('/dashboard/profile') }}">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form id="logoutForm" class="d-inline">
                  @csrf
                  <button class="dropdown-item" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      @else
        <div class="d-flex">
          <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
          <a class="btn btn-light" href="{{ route('signup') }}">Sign up</a>
        </div>
      @endauth
    </div>
  </div>
</nav>
