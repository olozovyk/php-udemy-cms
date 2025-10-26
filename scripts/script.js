document.addEventListener("DOMContentLoaded", () => {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav");
    const navItems = document.querySelectorAll(".nav__item");
    const body = document.body;
    let isMenuOpen = false;

    // Add index to nav items for staggered animation
    navItems.forEach((item, index) => {
        item.style.setProperty("--item-index", index);
    });

    // Toggle menu on burger click
    burger?.addEventListener("click", () => {
        isMenuOpen = !isMenuOpen;
        burger.classList.toggle("active");
        nav?.classList.toggle("active");
        body.style.overflow = isMenuOpen ? "hidden" : "";
    });

    // Close menu when clicking outside
    document.addEventListener("click", (e) => {
        const isClickInside = nav?.contains(e.target) || burger?.contains(e.target);

        if (!isClickInside && isMenuOpen) {
            isMenuOpen = false;
            burger?.classList.remove("active");
            nav?.classList.remove("active");
            body.style.overflow = "";
        }
    });

    // Close menu on escape key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && isMenuOpen) {
            isMenuOpen = false;
            burger?.classList.remove("active");
            nav?.classList.remove("active");
            body.style.overflow = "";
        }
    });

    // Handle resize events
    let timeout;
    window.addEventListener("resize", () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            if (window.innerWidth > 768 && isMenuOpen) {
                isMenuOpen = false;
                burger?.classList.remove("active");
                nav?.classList.remove("active");
                body.style.overflow = "";
            }
        }, 100);
    });
});
