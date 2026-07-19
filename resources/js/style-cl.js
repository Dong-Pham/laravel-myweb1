// =======================================
// Client Script
// =======================================

document.addEventListener("DOMContentLoaded", () => {
    console.log("🚀 Client Script Loaded");

    initBackToTop();
    initActiveNavbar();
    initConfirmDelete();
    initAutoCloseAlert();
    initProductCardEffect();
});

// =======================================
// Back To Top
// =======================================
function initBackToTop() {

    const button = document.getElementById("backToTop");

    if (!button) return;

    window.addEventListener("scroll", () => {
        button.classList.toggle("d-none", window.scrollY < 300);
    });

    button.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

}

// =======================================
// Active Navbar
// =======================================
function initActiveNavbar() {

    const currentUrl = window.location.pathname;

    document.querySelectorAll(".navbar .nav-link").forEach(link => {

        const href = link.getAttribute("href");

        if (href === currentUrl) {
            link.classList.add("active");
        }

    });

}

// =======================================
// Confirm Delete
// =======================================
function initConfirmDelete() {

    document.querySelectorAll(".btn-delete").forEach(button => {

        button.addEventListener("click", (e) => {

            if (!confirm("Bạn có chắc chắn muốn xóa dữ liệu này?")) {
                e.preventDefault();
            }

        });

    });

}

// =======================================
// Auto Close Alert
// =======================================
function initAutoCloseAlert() {

    const alerts = document.querySelectorAll(".alert");

    alerts.forEach(alert => {

        setTimeout(() => {

            alert.classList.add("fade");

            setTimeout(() => {
                alert.remove();
            }, 400);

        }, 3000);

    });

}

// =======================================
// Product Card Animation
// =======================================
function initProductCardEffect() {

    document.querySelectorAll(".product-card").forEach(card => {

        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-10px)";
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
        });

    });

}