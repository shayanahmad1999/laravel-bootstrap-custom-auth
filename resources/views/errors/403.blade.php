{{-- resources/views/errors/403.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>403 | Forbidden</title>
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
            background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364, #0f2027);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
            font-family: 'Segoe UI', sans-serif;
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
            margin-bottom: 0.5rem;
        }

        .icon {
            font-size: 4rem;
            color: #ff7675;
            animation: shake 1.5s infinite;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-6px);
            }

            40%,
            80% {
                transform: translateX(6px);
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
        <div class="icon mb-3"><i class="bi bi-lock-fill"></i></div>
        <h1 class="error-code">403</h1>
        <h2 class="mb-3">Access Forbidden</h2>
        <p class="mb-4">You don’t have permission to view this page.<br>Please check your account or try a different
            section.</p>

        {{-- Callback safely --}}
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-glass px-4">
                <i class="bi bi-speedometer2 me-1"></i> Go to Dashboard
            </a>
        @else
            <a href="{{ route('home') }}" class="btn btn-glass px-4">
                <i class="bi bi-house-door me-1"></i> Back to Home
            </a>
        @endauth
    </div>
</body>

</html>
