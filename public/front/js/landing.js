/**
 * WP-CRM Landing – AOS init + nav scroll state
 */
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 600,
        offset: 50,
        once: true,
        easing: 'ease-out-cubic'
    });

    var nav = document.querySelector('.landing-nav');
    if (nav) {
        function onScroll() {
            if (window.scrollY > 20) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }
});
