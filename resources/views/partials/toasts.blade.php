<!-- Toasts container (top-right) -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080">
  <div id="toastSuccess" class="toast align-items-center text-bg-success border-0 rounded-3" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span id="toastSuccessBody">Success!</span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
  <div id="toastError" class="toast align-items-center text-bg-danger border-0 rounded-3 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <span id="toastErrorBody">Something went wrong.</span>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
