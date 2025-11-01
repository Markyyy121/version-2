<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - 4notes</title>
    @vite(['resources/css/user_forgotpassword.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="forgot-wrapper">
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
                <p class="tagline">Don't worry, it happens to the best of us. Let's get you back to your notes.</p>
            </div>

            <div class="illustration">
                <div class="key-illustration">
                    <svg class="key-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="7" cy="7" r="4" />
                        <path d="M10.5 10.5L21 21M17 13l-4 4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <div class="shape-blob blob-1"></div>
            <div class="shape-blob blob-2"></div>

            <div class="forgot-container">

                <div class="forgot-header">
                    <h1 class="forgot-title">Forgot password?</h1>
                    <p class="forgot-subtitle">No problem. Enter your email address and we'll send you a link to reset
                        your password.</p>
                </div>

                <form id="forgotForm" method="POST" action="{{ route('user.sendotp') }}">
                    <div class="info-box">
                        <p>Enter the email address associated with your 4notes account and we'll send you instructions
                            to reset your password.</p>
                    </div>
                    @csrf

                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-input" placeholder=" " required>
                        <label class="form-label" for="email">Email address</label>

                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>

                    <button type="submit" class="btn-reset" id="submitBtn">
                        <span class="btn-text">Send Reset Link</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </form>

                <p class="back-to-login">
                    Remember your password? <a href="{{ route('user.user_login') }}" class="login-link">Back to login</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal -->
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
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');
            const emailInput = document.getElementById('email');
            
            // Disable button and show spinner
            submitBtn.disabled = true;
            btnText.textContent = 'Sending...';
            spinner.classList.remove('d-none');
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                const modal = new bootstrap.Modal(document.getElementById('messageModal'));
                const modalMessage = document.getElementById('modalMessage');
                const modalIcon = document.getElementById('modalIcon');
                const modalOkBtn = document.getElementById('modalOkBtn');
                
                modalMessage.textContent = data.message;
                
                if (data.success) {
                    modalIcon.innerHTML = '<svg width="64" height="64" fill="green" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>';
                    
                    modalOkBtn.onclick = function() {
                        window.location.href = data.redirect;
                    };
                } else {
                    modalIcon.innerHTML = '<svg width="64" height="64" fill="red" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>';
                }
                
                modal.show();
                
                // Re-enable button
                submitBtn.disabled = false;
                btnText.textContent = 'Send Reset Link';
                spinner.classList.add('d-none');
            })
            .catch(error => {
                console.error('Error:', error);
                const modal = new bootstrap.Modal(document.getElementById('messageModal'));
                document.getElementById('modalMessage').textContent = 'An error occurred. Please try again.';
                document.getElementById('modalIcon').innerHTML = '<svg width="64" height="64" fill="red" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>';
                modal.show();

                // Re-enable button
                submitBtn.disabled = false;
                btnText.textContent = 'Send Reset Link';
                spinner.classList.add('d-none');
            });
        });
    </script>

</body>

</html>