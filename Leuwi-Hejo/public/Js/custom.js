
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form[data-role-form]');

    forms.forEach(form => {
        const resetBtn = form.querySelector('.btn-reset');
        const submitBtn = form.querySelector('.btn-submit');
        const original = [...form.querySelectorAll('input[type="checkbox"]')].map(cb => cb.checked);

        // Reset button
        resetBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            form.querySelectorAll('input[type="checkbox"]').forEach((cb, i) => {
                cb.checked = original[i];
            });
        });

        // Submit with loading animation
        form.addEventListener('submit', function () {
            submitBtn.classList.add('btn-loading');
        });
    });

    // Tooltip init (Bootstrap 5)
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
