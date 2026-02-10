/**
 * main.js - Universal Portal JS
 * Safe for all pages with Livewire
 */

document.addEventListener("DOMContentLoaded", function () {
    /* ================= Toggle Menu ================= */
    const btnMenu = document.querySelector(".btn-menu");
    const sidebar = document.querySelector(".sidebar");

    function toggleMenu() {
        if (sidebar) sidebar.classList.toggle("active");
    }

    if (btnMenu && sidebar) {
        btnMenu.addEventListener("click", toggleMenu);
    }

    /* ================= Scroll Header ================= */
    const header = document.querySelector("header");

    function toggleScrolled() {
        if (!header) return;
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    }

    if (header) {
        window.addEventListener("scroll", toggleScrolled);
        // Initial check
        toggleScrolled();
    }

    /* ================= Livewire Gallery Slider ================= */
    function initGalleryCarousel() {
        const galleryModal = document.getElementById("gallerySliderModal");
        if (!galleryModal) return;

        const carouselEl = galleryModal.querySelector(".carousel");
        if (carouselEl) {
            // Init Bootstrap carousel
            new bootstrap.Carousel(carouselEl);
        }
    }

    // Jalankan saat Livewire siap
    document.addEventListener("livewire:load", function () {
        initGalleryCarousel();
    });

    // Jalankan ulang saat Livewire update (misal pagination/modal update)
    document.addEventListener("livewire:updated", function () {
        initGalleryCarousel();
    });
});

let scrollTop = document.querySelector(".scroll-top");

function toggleScrollTop() {
    if (scrollTop) {
        window.scrollY > 100
            ? scrollTop.classList.add("active")
            : scrollTop.classList.remove("active");
    }
}
scrollTop.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

window.addEventListener("load", toggleScrollTop);
document.addEventListener("scroll", toggleScrollTop);
