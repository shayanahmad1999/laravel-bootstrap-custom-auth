{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap + Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #6f7cff, #b490ca);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            text-align: center;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .error-container {
            max-width: 600px;
            padding: 3rem 2rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
            animation: fadeInUp .8s ease;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 6rem;
            font-weight: 700;
            letter-spacing: -2px;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .icon {
            font-size: 4rem;
            color: #ffdf5e;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .btn-glass {
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .35);
            background: linear-gradient(135deg, rgba(255, 255, 255, .25), rgba(255, 255, 255, .12));
            color: #fff;
            backdrop-filter: blur(6px);
            transition: all .25s ease;
        }

        .btn-glass:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="icon mb-3"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <h1 class="error-code">404</h1>
        <h2 class="mb-3">Oops! Page Not Found</h2>
        <p class="mb-4">
            The page you’re looking for doesn’t exist or was moved.<br>
            Let’s get you back on track.
        </p>
        <a href="{{ route('home') }}" class="btn btn-glass px-4">
            <i class="bi bi-house-door me-1"></i> Back to Home
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
