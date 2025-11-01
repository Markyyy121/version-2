document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;

    const emailExists = body.dataset.emailExists === "true";
    const passwordShort = body.dataset.passwordShort === "true";
    const passwordMismatch = body.dataset.passwordMismatch === "true";

    function showModal(modalId) {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    }

    if (emailExists) showModal("emailExistsModal");
    if (passwordShort) showModal("passwordShortModal");
    if (passwordMismatch) showModal("passwordMismatchModal");

    window.togglePassword = function (id, button) {
        const input = document.getElementById(id);
        if (!input) return;

        const isPassword = input.getAttribute("type") === "password";
        input.setAttribute("type", isPassword ? "text" : "password");
        button.textContent = isPassword ? "Hide" : "Show";
    };
});
