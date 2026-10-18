
<script>
    (() => {
        let theme = 'auto';
        try { theme = localStorage.getItem('theme') || 'auto'; } catch (e) {}
        if (theme !== 'light' && theme !== 'dark') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        document.documentElement.setAttribute('data-bs-theme', theme);
    })();
</script>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/partials/theme-script.blade.php ENDPATH**/ ?>