@extends('layouts.app')
@section('content')
<header class="py-5 shadow-sm" style="background: linear-gradient(120deg, var(--aw-primary), #8a6cca);">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h1 class="display-6 fw-bold mb-2 text-white">Hello, {{ auth()->user()->name ?? 'Guest' }} 👋</h1>
        <p class="lead mb-0 text-white">Here's a quick overview of your workspace.</p>
      </div>
      <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <div class="d-flex justify-content-md-end">
          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dateRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              Last 7 days
            </button>
            <ul class="dropdown-menu" aria-labelledby="dateRangeDropdown">
              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">Yesterday</a></li>
              <li><a class="dropdown-item" href="#">Last 7 days</a></li>
              <li><a class="dropdown-item" href="#">Last 30 days</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="container py-5">
  <div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary small">Projects</div>
              <div class="fs-2 fw-bold">12</div>
            </div>
            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
              <i class="bi bi-folder text-primary fs-4"></i>
            </div>
          </div>
          <div class="mt-3">
            <div class="d-flex align-items-center text-success">
              <i class="bi bi-arrow-up me-1"></i>
              <span class="small">+2 from last week</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary small">Tasks</div>
              <div class="fs-2 fw-bold">38</div>
            </div>
            <div class="rounded-circle bg-success bg-opacity-10 p-3">
              <i class="bi bi-check-circle text-success fs-4"></i>
            </div>
          </div>
          <div class="mt-3">
            <div class="d-flex align-items-center text-success">
              <i class="bi bi-arrow-up me-1"></i>
              <span class="small">+7 from last week</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary small">Messages</div>
              <div class="fs-2 fw-bold">5</div>
            </div>
            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
              <i class="bi bi-chat-dots text-warning fs-4"></i>
            </div>
          </div>
          <div class="mt-3">
            <div class="d-flex align-items-center text-warning">
              <i class="bi bi-exclamation-circle me-1"></i>
              <span class="small">New messages</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary small">Storage</div>
              <div class="fs-2 fw-bold">72%</div>
            </div>
            <div class="rounded-circle bg-info bg-opacity-10 p-3">
              <i class="bi bi-hdd text-info fs-4"></i>
            </div>
          </div>
          <div class="mt-3">
            <div class="progress" style="height: 6px;">
              <div class="progress-bar bg-info" role="progressbar" style="width: 72%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
          <h2 class="h5 mb-0">Recent Activity</h2>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item px-0 py-3">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                    <i class="bi bi-file-earmark-text text-primary"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h3 class="h6 mb-1">Project Alpha documentation updated</h3>
                  <p class="text-secondary small mb-1">You updated the project documentation</p>
                  <small class="text-muted">2 hours ago</small>
                </div>
              </div>
            </li>
            <li class="list-group-item px-0 py-3">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <div class="rounded-circle bg-success bg-opacity-10 p-2">
                    <i class="bi bi-check-circle text-success"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h3 class="h6 mb-1">Task completed</h3>
                  <p class="text-secondary small mb-1">You completed the "Setup database schema" task</p>
                  <small class="text-muted">5 hours ago</small>
                </div>
              </div>
            </li>
            <li class="list-group-item px-0 py-3">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                    <i class="bi bi-chat-dots text-warning"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h3 class="h6 mb-1">New comment</h3>
                  <p class="text-secondary small mb-1">John Doe commented on your project</p>
                  <small class="text-muted">Yesterday</small>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3">
          <h2 class="h5 mb-0">Quick Actions</h2>
        </div>
        <div class="card-body">
          <div class="d-grid gap-2">
            <button class="btn btn-outline-primary rounded-3" type="button">
              <i class="bi bi-plus-circle me-2"></i>Create Project
            </button>
            <button class="btn btn-outline-secondary rounded-3" type="button">
              <i class="bi bi-person-plus me-2"></i>Add Team Member
            </button>
            <button class="btn btn-outline-success rounded-3" type="button">
              <i class="bi bi-calendar-plus me-2"></i>Schedule Meeting
            </button>
          </div>
        </div>
      </div>
      
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
          <h2 class="h5 mb-0">Upcoming Deadlines</h2>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item px-0 py-3">
              <div class="d-flex justify-content-between">
                <div>
                  <h3 class="h6 mb-1">Project Beta Launch</h3>
                  <small class="text-muted">Marketing team</small>
                </div>
                <span class="badge bg-danger">Tomorrow</span>
              </div>
            </li>
            <li class="list-group-item px-0 py-3">
              <div class="d-flex justify-content-between">
                <div>
                  <h3 class="h6 mb-1">Quarterly Report</h3>
                  <small class="text-muted">Finance department</small>
                </div>
                <span class="badge bg-warning text-dark">3 days</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
