document.addEventListener("DOMContentLoaded", () => {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav");
    const body = document.body;
    let isMenuOpen = false;
    const BREAKPOINT_TABLET = 768;

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
            if (window.innerWidth > BREAKPOINT_TABLET && isMenuOpen) {
                isMenuOpen = false;
                burger?.classList.remove("active");
                nav?.classList.remove("active");
                body.style.overflow = "";
            }
        }, 100);
    });
});
