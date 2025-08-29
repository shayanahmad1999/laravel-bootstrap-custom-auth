@php($title = $title ?? 'Archiwiz')
<!doctype html>
<html lang="en" data-bs-theme="{{ auth()->check() && isset(auth()->user()->preferences['theme']) ? auth()->user()->preferences['theme'] : 'light' }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    @stack('head')
    @if(auth()->check() && isset(auth()->user()->preferences['primary_color']))
    <style>
      :root {
        --aw-primary: {{ auth()->user()->preferences['primary_color'] }};
        --aw-primary-rgb: {{ sscanf(auth()->user()->preferences['primary_color'], "#%02x%02x%02x")[0] ?? 111 }}, {{ sscanf(auth()->user()->preferences['primary_color'], "#%02x%02x%02x")[1] ?? 66 }}, {{ sscanf(auth()->user()->preferences['primary_color'], "#%02x%02x%02x")[2] ?? 193 }};
      }
    </style>
    @endif
  </head>
  <body class="d-flex flex-column min-vh-100 bg-body-tertiary">
    @include('partials.navbar')
    <main class="flex-grow-1">
      @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.toasts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
  </body>
</html>
