<script>
    // Function to handle scroll event
    function handleScroll() {
        const header = document.querySelector('header');
        if (window.scrollY > 0) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    // Listen for scroll events
    window.addEventListener('scroll', handleScroll);

    // Initial check to set header state based on current scroll position
    handleScroll();
</script>
