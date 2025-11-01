<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code - 4notes</title>
    @vite(['resources/css/user_otpcode.css', 'resources/js/user_otpcode.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="verify-wrapper">
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
                <p class="tagline">We've sent a verification code to your email. Check your inbox and enter it below.
                </p>
            </div>

            <div class="illustration">
                <div class="email-illustration">
                    <svg class="email-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="right-panel">
            <div class="shape-blob blob-1"></div>
            <div class="shape-blob blob-2"></div>

            <div class="verify-container">
                <a href="{{ route('user.user_forgotpassword') }}" class="back-link">
                    <svg class="back-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>

                <div class="verify-header">
                    <h1 class="verify-title">Verify your email</h1>
                    <p class="verify-subtitle">
                        Enter the 6-digit code we sent to<br>
                        <span class="verify-email">john.doe@example.com</span>
                    </p>
                </div>

                <div class="info-box">
                    <p>The code will expire in 2 minutes. If you don't see the email, check your spam folder.</p>
                </div>

                <div class="success-message" id="successMessage">
                    <p><strong>Code resent!</strong> Check your email for the new verification code.</p>
                </div>

                <form id="verifyForm" method="POST" action="{{ route('user.verifyotp') }}">
                    @csrf
                    <div class="otp-container">
                        <input type="text" name="otp1" maxlength="1" class="otp-input" id="otp1" required>
                        <input type="text" name="otp2" maxlength="1" class="otp-input" id="otp2" required>
                        <input type="text" name="otp3" maxlength="1" class="otp-input" id="otp3" required>
                        <input type="text" name="otp4" maxlength="1" class="otp-input" id="otp4" required>
                    </div>

                    <button type="submit" class="btn-verify">Verify Code</button>
                </form>

                <div class="resend-section">
                    <p class="resend-text">
                        Didn't receive the code?
                    </p>
                    <a class="resend-link" id="resendLink" onclick="resendCode()">Resend Code</a>
                    <div class="timer" id="timer"></div>
                </div>
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
        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const otpInputs = document.querySelectorAll('.otp-input');
            const otp = Array.from(otpInputs).map(input => input.value).join('');

            fetch("{{ route('user.verifyotp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ otp: otp })
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
                        modal.hide();
                        window.location.href = data.redirect;
                    };
                } else {
                    modalIcon.innerHTML = '<svg width="64" height="64" fill="red" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>';
                    
                    modalOkBtn.onclick = null;
                }
                
                modal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                const modal = new bootstrap.Modal(document.getElementById('messageModal'));
                const modalOkBtn = document.getElementById('modalOkBtn');
                
                document.getElementById('modalMessage').textContent = 'An error occurred. Please try again.';
                document.getElementById('modalIcon').innerHTML = '<svg width="64" height="64" fill="red" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>';
            
                modalOkBtn.onclick = null;
                
                modal.show();
            });
        });
    </script>

</body>

</html>