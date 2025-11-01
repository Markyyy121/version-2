<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - 4notes</title>
    @vite(['resources/css/user_login.css', 'resources/js/user_login.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body
    data-success="{{ session('success') ? 'true' : 'false' }}"
    data-has-errors="{{ $errors->any() ? 'true' : 'false' }}"
>
    <div class="login-wrapper">
        <div class="left-panel">
            <div class="floating-notes">
                <div class="floating-note">
                    <div class="note-line"></div>
                    <div class="note-line"></div>
                    <div class="note-line"></div>
                </div>
                <div class="floating-note">
                    <div class="note-line"></div>
                    <div class="note-line"></div>
                    <div class="note-line"></div>
                </div>
                <div class="floating-note">
                    <div class="note-line"></div>
                    <div class="note-line"></div>
                    <div class="note-line"></div>
                </div>
            </div>

            <div class="brand-section">
                <div class="logo-large">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24" fill="white">
                            <path
                                d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z" />
                            <path d="M8 15h8v2H8v-2zm0-4h8v2H8v-2zm0-4h5v2H8V7z" />
                        </svg>
                    </div>
                    4notes
                </div>
                <p class="tagline">Your thoughts deserve a beautiful space. Write freely, think clearly.</p>
            </div>

            <ul class="features-list">
                <li class="feature-item">
                    <span class="feature-icon">✨</span>
                    <span>Elegant distraction-free writing</span>
                </li>
                <li class="feature-item">
                    <span class="feature-icon">🔒</span>
                    <span>End-to-end encrypted & private</span>
                </li>
                <li class="feature-item">
                    <span class="feature-icon">☁️</span>
                    <span>Sync across all your devices</span>
                </li>
            </ul>
        </div>

        <div class="right-panel">
            <div class="shape-blob blob-1"></div>
            <div class="shape-blob blob-2"></div>

            <div class="login-container">
                <a href="{{ route('user.user_landing') }}" class="back-link">
                    <svg class="back-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to home
                </a>

                <div class="login-header">
                    <h1 class="login-title">Welcome back</h1>
                    <p class="login-subtitle">Continue your journey with 4notes</p>
                </div>

                <form id="loginForm" method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-input" placeholder=" " required>
                        <label class="form-label" for="email">Email address</label>
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>

                    <div class="form-group">
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-input" placeholder=" "
                                required>
                            <label class="form-label" for="password">Password</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <button type="button" class="toggle-password" onclick="togglePassword('password', this)">Show</button>
                        </div>
                    </div>

                    <div class="form-footer">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" class="checkbox">
                            <span class="checkbox-label">Remember me</span>
                        </label>
                        <a href="{{ route('user.user_forgotpassword') }}" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-login">Sign In</button>
                </form>

                <p class="signup-prompt">
                    Don't have an account? <a href="{{ route('user.user_register')}}" class="signup-link">Sign up</a>
                </p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#28a745" class="mb-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 10.97l4.993-4.992-1.414-1.414L6.97 8.142 5.45 6.621 4.036 8.036l2.934 2.934z" />
                    </svg>
                    <h5 id="successModalLabel">Registration Successful!</h5>
                    <p>You can now log in with your new account.</p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#dc3545" class="mb-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1 1 0 0 0-1.964 0l-6.857 12A1 1 0 0 0 1.143 15h13.714a1 1 0 0 0 .982-1.434l-6.857-12zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <h5 id="errorModalLabel">Login Failed</h5>
                    <p>{{ $errors->first() }}</p>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
