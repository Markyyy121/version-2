<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - 4notes</title>
    @vite(['resources/css/user_newpassword.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="reset-wrapper">
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
                <p class="tagline">Almost there! Create a strong password to secure your account and protect your notes.
                </p>
            </div>

            <div class="illustration">
                <div class="shield-illustration">
                    <svg class="shield-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        <path d="M9 12l2 2 4-4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <div class="shape-blob blob-1"></div>
            <div class="shape-blob blob-2"></div>

            <div class="reset-container">
                <a href="{{ route('user.user_otpcode') }}" class="back-link">
                    <svg class="back-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>

                <div class="reset-header">
                    <h1 class="reset-title">Reset password</h1>
                    <p class="reset-subtitle">Enter a new password for your account. Make sure it's strong and secure.
                    </p>
                </div>

                <form id="resetForm">
                    @csrf
                    <div class="form-group">
                        <div class="password-container">
                            <input type="password" id="newPasswordInput" name="newPassword" class="form-input" placeholder=" " required>
                            <label class="form-label" for="newPassword">New Password</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <button type="button" class="toggle-password" onclick="togglePassword('newPasswordInput', this)">Show</button>
                        </div>
                        <div class="error-message" id="passwordError"></div>
                    </div>

                    <div class="form-group">
                        <div class="password-container">
                            <input type="password" id="confirmPasswordInput" name="confirmPassword" class="form-input" placeholder=" " required>
                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirmPasswordInput', this)">Show</button>
                        </div>
                        <div class="error-message" id="confirmPasswordError"></div>
                    </div>

                    <button type="submit" class="btn-reset">Reset Password</button>
                </form>

                <p class="back-to-login">
                    Remember your password? <a href="{{ route('user.user_login') }}" class="login-link">Back to login</a>
                </p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div id="modalIcon" class="mb-3"></div>
                    <p id="modalMessage" class="mb-0"></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="modalOkBtn">OK</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Hide";
            } else {
                input.type = "password";
                button.textContent = "Show";
            }
        }

        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const newPassword = document.getElementById('newPasswordInput').value;
            const confirmPassword = document.getElementById('confirmPasswordInput').value;

            const modal = new bootstrap.Modal(document.getElementById('messageModal'));
            const modalMessage = document.getElementById('modalMessage');
            const modalIcon = document.getElementById('modalIcon');
            const modalOkBtn = document.getElementById('modalOkBtn');

            if (newPassword.length < 6) {
                modalMessage.textContent = 'Password must be at least 6 characters long.';
                modalIcon.innerHTML = `<svg width="64" height="64" fill="red" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 
                    4.646a.5.5 0 1 0-.708.708L7.293 
                    8l-2.647 2.646a.5.5 0 0 0 
                    .708.708L8 8.707l2.646 2.647a.5.5 
                    0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 
                    0 0 0-.708-.708L8 7.293 5.354 
                    4.646z"/>
                </svg>`;
                modal.show();
                return;
            }

            if (newPassword !== confirmPassword) {
                modalMessage.textContent = 'Passwords do not match. Please try again.';
                modalIcon.innerHTML = `<svg width="64" height="64" fill="red" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 
                    16 0zM5.354 4.646a.5.5 0 1 
                    0-.708.708L7.293 8l-2.647 
                    2.646a.5.5 0 0 0 .708.708L8 
                    8.707l2.646 2.647a.5.5 0 0 0 
                    .708-.708L8.707 8l2.647-2.646a.5.5 
                    0 0 0-.708-.708L8 7.293 5.354 
                    4.646z"/>
                </svg>`;
                modal.show();
                return;
            }

            fetch("{{ route('user.resetpassword') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    newPassword: newPassword,
                    confirmPassword: confirmPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                modalMessage.textContent = data.message || 'An error occurred';
                if (data.success) {
                    modalIcon.innerHTML = `<svg width="64" height="64" fill="green" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 
                        16 0zm-3.97-3.03a.75.75 0 0 
                        0-1.08.022L7.477 9.417 5.384 
                        7.323a.75.75 0 0 0-1.06 
                        1.06L6.97 11.03a.75.75 0 0 
                        0 1.079-.02l3.992-4.99a.75.75 
                        0 0 0-.01-1.05z"/>
                    </svg>`;
                    modalOkBtn.onclick = () => window.location.href = data.redirect;
                } else {
                    modalIcon.innerHTML = `<svg width="64" height="64" fill="red" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 
                        16 0zM5.354 4.646a.5.5 0 1 
                        0-.708.708L7.293 8l-2.647 
                        2.646a.5.5 0 0 0 .708.708L8 
                        8.707l2.646 2.647a.5.5 0 0 0 
                        .708-.708L8.707 8l2.647-2.646a.5.5 
                        0 0 0-.708-.708L8 7.293 5.354 
                        4.646z"/>
                    </svg>`;
                }
                modal.show();
            })
            .catch(() => {
                modalMessage.textContent = 'An error occurred. Please try again.';
                modalIcon.innerHTML = `<svg width="64" height="64" fill="red" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 
                    16 0zM5.354 4.646a.5.5 0 1 
                    0-.708.708L7.293 8l-2.647 
                    2.646a.5.5 0 0 0 .708.708L8 
                    8.707l2.646 2.647a.5.5 0 0 0 
                    .708-.708L8.707 8l2.647-2.646a.5.5 
                    0 0 0-.708-.708L8 7.293 5.354 
                    4.646z"/>
                </svg>`;
                modal.show();
            });
        });
    </script>
</body>
</html>