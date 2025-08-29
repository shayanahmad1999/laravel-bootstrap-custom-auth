// CSRF
function csrfToken() { const el = document.querySelector('meta[name="csrf-token"]'); return el ? el.getAttribute('content') : ''; }

function showToast(type = 'success', message = '') {
  const id = type === 'success' ? 'toastSuccess' : 'toastError';
  const bodyId = type === 'success' ? 'toastSuccessBody' : 'toastErrorBody';
  const el = document.getElementById(id);
  if (!el) return;
  if (message) {
    const body = document.getElementById(bodyId);
    if (body) body.textContent = message;
  }
  const t = new bootstrap.Toast(el, { delay: 3500 });
  t.show();
}

function clearFieldErrors(form) {
  form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
  form.querySelectorAll('.invalid-feedback.server').forEach(el => el.remove());
}

function applyFieldErrors(form, errors) {
  Object.entries(errors || {}).forEach(([name, msgs]) => {
    const field = form.querySelector(`[name="${name}"]`);
    if (field) {
      field.classList.add('is-invalid');
      const fb = document.createElement('div');
      fb.className = 'invalid-feedback server';
      fb.textContent = Array.isArray(msgs) ? msgs[0] : String(msgs);
      const group = field.closest('.input-group');
      (group || field).insertAdjacentElement('afterend', fb);
    }
  });
}

// Show loading state on form submit
function showLoading(form) {
  const submitBtn = form.querySelector('button[type="submit"]');
  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
  }
}

// Hide loading state
function hideLoading(form) {
  const submitBtn = form.querySelector('button[type="submit"]');
  if (submitBtn) {
    submitBtn.disabled = false;
    submitBtn.innerHTML = submitBtn.dataset.originalText || submitBtn.textContent;
  }
}

async function postJSON(url, form) {
  const data = new FormData(form);
  const res = await fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' }, body: data });
  let json = {}; try { json = await res.json(); } catch (_) {}
  if (res.ok && json.ok) return json;
  if (res.status === 422 && json.errors) throw { type: 'validation', errors: json.errors, message: json.message || 'Validation error.' };
  throw { type: 'server', message: json.message || `Error ${res.status}` };
}

// Theme switcher functionality
function initThemeSwitcher() {
  // Set initial theme based on system preference or user preference
  const theme = document.documentElement.getAttribute('data-bs-theme');
  const themeDropdownItems = document.querySelectorAll('[data-theme]');
  
  themeDropdownItems.forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      const selectedTheme = this.getAttribute('data-theme');
      
      // Update theme
      document.documentElement.setAttribute('data-bs-theme', selectedTheme);
      
      // Save preference if user is logged in
      if (document.getElementById('prefsForm') || document.querySelector('[name="theme"]')) {
        // If we're on the profile page, update the select dropdown
        const themeSelect = document.getElementById('themeSelect');
        if (themeSelect) {
          themeSelect.value = selectedTheme;
        }
        
        // Save preference via AJAX
        fetch('/ajax/preferences', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken(),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            theme: selectedTheme,
            pref_email: document.getElementById('prefEmail')?.checked ?? true,
            pref_sms: document.getElementById('prefSMS')?.checked ?? false,
            primary_color: document.getElementById('primaryColor')?.value ?? '#6f42c1'
          })
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            showToast('success', 'Theme preference saved.');
          } else {
            showToast('error', 'Failed to save theme preference.');
          }
        })
        .catch(() => {
          showToast('error', 'Failed to save theme preference.');
        });
      }
    });
  });
}

// Update CSS variables with user's primary color
function updatePrimaryColor(color) {
  const root = document.documentElement;
  root.style.setProperty('--aw-primary', color);
  
  // Convert hex to RGB for rgba usage
  const hex = color.replace('#', '');
  const r = parseInt(hex.substring(0, 2), 16);
  const g = parseInt(hex.substring(2, 4), 16);
  const b = parseInt(hex.substring(4, 6), 16);
  root.style.setProperty('--aw-primary-rgb', `${r}, ${g}, ${b}`);
}

// Initialize primary color from user preferences
function initPrimaryColor() {
  // Get the primary color input
  const primaryColorInput = document.getElementById('primaryColor');
  if (primaryColorInput) {
    // Set initial color
    updatePrimaryColor(primaryColorInput.value);
    
    // Listen for changes
    primaryColorInput.addEventListener('input', function() {
      updatePrimaryColor(this.value);
    });
    
    // Also listen for changes on the preferences form
    const prefsForm = document.getElementById('prefsForm');
    if (prefsForm) {
      prefsForm.addEventListener('submit', function(e) {
        updatePrimaryColor(primaryColorInput.value);
      });
    }
  }
  
  // Reset color button
  const resetColorBtn = document.getElementById('resetColor');
  if (resetColorBtn && primaryColorInput) {
    resetColorBtn.addEventListener('click', function() {
      // Reset to default color
      const defaultColor = '#6f42c1';
      primaryColorInput.value = defaultColor;
      updatePrimaryColor(defaultColor);
      
      // If we're on the preferences form, update the UI immediately
      const prefsForm = document.getElementById('prefsForm');
      if (prefsForm) {
        // Trigger input event to update any listeners
        primaryColorInput.dispatchEvent(new Event('input'));
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Initialize theme switcher
  initThemeSwitcher();
  
  // Initialize primary color
  initPrimaryColor();
  
  // Attach generic handler
  document.querySelectorAll('.needs-validation').forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearFieldErrors(form);
      
      // Store original button text
      const submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn && !submitBtn.dataset.originalText) {
        submitBtn.dataset.originalText = submitBtn.innerHTML;
      }
      
      // Show loading state
      showLoading(form);

      const newPw = form.querySelector('#newPassword');
      const confirm = form.querySelector('#confirmPassword');
      if (newPw && confirm) confirm.setCustomValidity(newPw.value !== confirm.value ? 'Passwords must match' : '');

      if (!form.checkValidity()) { 
        form.classList.add('was-validated'); 
        showToast('error', 'Please fix the highlighted fields.'); 
        hideLoading(form);
        return; 
      }

      const map = {
        'loginForm': '/ajax/login',
        'signupForm': '/ajax/register',
        'forgotForm': '/ajax/forgot-password',
        'resetForm': '/ajax/reset-password',
        'profileForm': '/ajax/profile',
        'passwordForm': '/ajax/password',
        'prefsForm': '/ajax/preferences',
      };
      const url = map[form.id];
      if (!url) {
        hideLoading(form);
        return;
      }

      try {
        const res = await postJSON(url, form);
        showToast('success', res.message || 'Success!');
        if (form.id === 'loginForm' || form.id === 'signupForm') setTimeout(() => window.location.href = '/dashboard', 600);
        if (form.id === 'passwordForm') form.reset();
        if (form.id === 'prefsForm') {
          // Update theme in navbar dropdown if changed
          const themeSelect = document.getElementById('themeSelect');
          if (themeSelect) {
            const selectedTheme = themeSelect.value;
            document.documentElement.setAttribute('data-bs-theme', selectedTheme);
          }
          
          // Update primary color
          const primaryColor = document.getElementById('primaryColor')?.value;
          if (primaryColor) {
            updatePrimaryColor(primaryColor);
          }
        }
      } catch (err) {
        if (err.type === 'validation') { 
          applyFieldErrors(form, err.errors); 
          form.classList.add('was-validated'); 
          showToast('error', 'Please review the highlighted fields.'); 
        }
        else { 
          showToast('error', err.message || 'Something went wrong.'); 
        }
      } finally {
        // Hide loading state
        hideLoading(form);
      }
    });
  });

  // Toggle password visibility
  document.querySelectorAll('[data-toggle="password"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.previousElementSibling;
      if (!input) return;
      input.type = input.type === 'password' ? 'text' : 'password';
      btn.innerHTML = input.type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
    });
  });

  // Logout AJAX
  const logoutForm = document.getElementById('logoutForm');
  if (logoutForm) {
    logoutForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      try {
        const res = await fetch('/ajax/logout', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' } });
        if (res.ok) { 
          showToast('success', 'Logged out.'); 
          setTimeout(() => window.location.href = '/login', 500); 
        }
      } catch (_) { 
        showToast('error', 'Logout failed.'); 
      }
    });
  }
});