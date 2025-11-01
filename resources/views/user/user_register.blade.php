<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - 4notes</title>
    @vite(['resources/css/user_register.css', 'resources/js/user_register.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body
    data-email-exists="{{ session('emailExists') ? 'true' : 'false' }}"
    data-password-short="{{ session('passwordShort') ? 'true' : 'false' }}"
    data-password-mismatch="{{ session('passwordMismatch') ? 'true' : 'false' }}"
>

    <div class="signup-wrapper">
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

            <div class="signup-container">
                <a href="{{ route('user.user_landing') }}" class="back-link">
                    <svg class="back-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back to home
                </a>

                <div class="signup-header">
                    <h1 class="signup-title">Create account</h1>
                    <p class="signup-subtitle">Start your journey with 4notes today</p>
                </div>

                <form id="registerForm" method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="firstName" name="firstName" class="form-input" placeholder=" " required>
                            <label class="form-label" for="firstName">First name</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>

                        <div class="form-group">
                            <input type="text" id="lastName" name="lastName" class="form-input" placeholder=" " required>
                            <label class="form-label" for="lastName">Last name</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                    </div>

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
                            <input type="password" id="password" name="password" class="form-input" placeholder=" " required>
                            <label class="form-label" for="password">Password</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <button type="button" class="toggle-password"
                                onclick="togglePassword('password', this)">Show</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="password-container">
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-input"
                                placeholder=" " required>
                            <label class="form-label" for="confirmPassword">Confirm password</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <button type="button" class="toggle-password"
                                onclick="togglePassword('confirmPassword', this)">Show</button>
                        </div>
                    </div>

                    <div class="terms-agreement">
                        <label class="terms-label">
                            <input type="checkbox" name="terms" class="checkbox" id="termsCheckbox" required>
                            <span class="terms-text">
                                I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#"
                                    class="terms-link">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <button type="submit" class="btn-signup">Create Account</button>
                </form>

                <p class="login-prompt">
                    Already have an account? <a href="{{ route('user.user_login') }}" class="login-link">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <div class="modal fade" id="emailExistsModal" tabindex="-1" aria-labelledby="emailExistsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <h5 id="emailExistsLabel" class="text-danger">Email Already Registered</h5>
                    <p>Please use a different email address.</p>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordShortModal" tabindex="-1" aria-labelledby="passwordShortLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <h5 id="passwordShortLabel" class="text-warning">Weak Password</h5>
                    <p>Password must be at least 6 characters long.</p>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordMismatchModal" tabindex="-1" aria-labelledby="passwordMismatchLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <h5 id="passwordMismatchLabel" class="text-danger">Passwords Don’t Match</h5>
                    <p>Please make sure both passwords are identical.</p>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
