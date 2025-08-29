{{-- resources/views/auth/verify-email.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Verify Your Email</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, .12);
            --glass-br: 16px;
            --glow: 0 10px 30px rgba(0, 0, 0, .1);
            --brand: #6f7cff;
            --brand-2: #5ee7df;
            --brand-3: #b490ca;
        }

        /* Animated gradient background */
        body {
            min-height: 100vh;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #6f7cff, #b490ca);
            background-size: 400% 400%;
            animation: gradientMove 18s ease infinite;
            display: grid;
            place-items: center;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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

        .verify-card {
            width: min(920px, 92vw);
            border-radius: var(--glass-br);
            background: var(--glass-bg);
            box-shadow: var(--glow), inset 0 1px 0 rgba(255, 255, 255, .1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, .18);
            overflow: hidden;
        }

        /* Header ribbon with subtle sheen */
        .card-header-ribbon {
            position: relative;
            background: linear-gradient(135deg, rgba(255, 255, 255, .2), rgba(255, 255, 255, .05));
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, .15);
        }

        .card-header-ribbon::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(1200px 200px at -5% -30%, rgba(255, 255, 255, .25), transparent 60%);
            opacity: .35;
            pointer-events: none;
            mix-blend-mode: screen;
        }

        /* Pulsing mail icon */
        .pulse {
            position: relative;
            display: inline-grid;
            place-items: center;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brand-2), var(--brand-3));
            color: #0b1437;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .25), inset 0 1px 0 rgba(255, 255, 255, .4);
            animation: floaty 4s ease-in-out infinite;
        }

        .pulse::before,
        .pulse::after {
            content: "";
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, .3);
            animation: pulseRing 2.4s ease-out infinite;
        }

        .pulse::after {
            animation-delay: .9s;
        }

        @keyframes pulseRing {
            0% {
                transform: scale(.8);
                opacity: .65;
            }

            80% {
                transform: scale(1.35);
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes floaty {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-6px)
            }
        }

        /* Steps */
        .step {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 14px;
            padding: 1rem;
            transition: transform .25s ease, background .25s ease, border-color .25s ease;
        }

        .step:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, .10);
            border-color: rgba(255, 255, 255, .26);
        }

        /* Buttons */
        .btn-glass {
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .35);
            background: linear-gradient(135deg, rgba(255, 255, 255, .25), rgba(255, 255, 255, .12));
            color: #0b1437;
            backdrop-filter: blur(6px);
            transition: transform .15s ease, box-shadow .2s ease, background .2s ease;
        }

        .btn-glass:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
            background: linear-gradient(135deg, rgba(255, 255, 255, .32), rgba(255, 255, 255, .16));
            color: #0b1437;
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand), #8a9bff);
            color: #fff;
            border: none;
        }

        .btn-brand:hover {
            filter: brightness(1.05);
        }

        /* Small print */
        .muted {
            color: rgba(255, 255, 255, .85);
        }

        /* Divider */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, .28), rgba(255, 255, 255, 0));
            margin: 1.5rem 0;
        }

        .tiny {
            font-size: .85rem;
            opacity: .9;
        }
    </style>
</head>

<body>
    <div class="verify-card">
        <div class="card-header-ribbon d-flex align-items-center gap-3">
            <div class="pulse">
                <i class="bi bi-envelope-paper-fill fs-3"></i>
            </div>
            <div>
                <h1 class="h4 mb-1 text-white">Verify your email</h1>
                <p class="mb-0 text-white-50 tiny">
                    @php($email = optional(Auth::user())->email)
                    We sent a verification link to <strong>{{ $email }}</strong>. Please check your inbox (and
                    spam).
                </p>
            </div>
        </div>

        <div class="p-4 p-md-5">

            {{-- Success state when a new link is sent --}}
            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>A fresh verification link has been sent to your email address.</div>
                </div>
            @endif

            <div class="row g-4 align-items-stretch">
                <div class="col-12 col-lg-7">
                    <div class="step h-100">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-1-circle-fill me-2"></i>
                            <h2 class="h6 mb-0 text-white">Open the email we sent</h2>
                        </div>
                        <p class="mb-3 muted">Look for the message titled <em>“Verify your email”</em>. If you can’t
                            find it, check Promotions/Spam.</p>

                        <div class="divider"></div>

                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-2-circle-fill me-2"></i>
                            <h2 class="h6 mb-0 text-white">Click the verification button</h2>
                        </div>
                        <p class="mb-0 muted">The link securely verifies your account and brings you back here—no extra
                            steps.</p>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="step h-100 d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-arrow-repeat me-2"></i>
                                <h2 class="h6 mb-0 text-white">Didn’t get the email?</h2>
                            </div>
                            <p class="muted mb-3">You can request another verification link. We’ll throttle excessive
                                requests to keep your account safe.</p>

                            <form id="resend-form" method="POST" action="{{ route('verification.send') }}"
                                class="d-grid gap-2">
                                @csrf
                                <button id="resend-btn" type="submit" class="btn btn-brand">
                                    <span class="btn-text"><i class="bi bi-send me-1"></i> Resend verification
                                        link</span>
                                    <span class="btn-spinner d-none">
                                        <span class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        Sending…
                                    </span>
                                </button>
                            </form>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-glass px-3">
                                    <i class="bi bi-box-arrow-right me-1"></i> Log out
                                </button>
                            </form>
                            <a href="{{ url()->previous() ?? url('/') }}" class="btn btn-glass px-3">
                                <i class="bi bi-house-door me-1"></i> Back to site
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-white-50 tiny mt-4 mb-0">
                Having trouble? Ensure your email is correct in your profile, then try again. If the issue persists,
                contact support.
            </p>
        </div>
    </div>

    {{-- Optional: Bootstrap JS (for alert animations/accessibility) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Disable button + show spinner while resending
        const form = document.getElementById('resend-form');
        const btn = document.getElementById('resend-btn');
        if (form && btn) {
            form.addEventListener('submit', () => {
                btn.disabled = true;
                btn.querySelector('.btn-text').classList.add('d-none');
                btn.querySelector('.btn-spinner').classList.remove('d-none');
            });
        }
    </script>
</body>

</html>
