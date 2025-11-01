document.addEventListener("DOMContentLoaded", function () {

    window.togglePassword = function (id, button) {
        const input = document.getElementById(id);
        if (!input) return;

        const isPassword = input.getAttribute("type") === "password";
        input.setAttribute("type", isPassword ? "text" : "password");
        button.textContent = isPassword ? "Hide" : "Show";
    };

    if (document.body.dataset.success === "true") {
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }

    if (document.body.dataset.hasErrors === "true") {
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    }
});
