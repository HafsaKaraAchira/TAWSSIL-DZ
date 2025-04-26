document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".diaporama-item");
    const slideContainer = document.querySelector("#slide");
    const dots = document.querySelectorAll(".diaporama-dot");
    const prevButton = document.querySelector("#prev");
    const nextButton = document.querySelector("#next");
    const diaporama = document.querySelector(".diaporama");
    let currentIndex = 0;
    const slideCount = slides.length;
    let autoSlideInterval;

    // Set the initial position of the slides
    const updateSlidePosition = () => {
        slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
        updateActiveDot(); // Update the active dot when the slide changes
    };

    // Move to the next slide
    const nextSlide = () => {
        currentIndex = (currentIndex + 1) % slideCount; // Loop back to the first slide
        updateSlidePosition();
    };

    // Move to the previous slide
    const prevSlide = () => {
        currentIndex = (currentIndex - 1 + slideCount) % slideCount; // Loop back to the last slide
        updateSlidePosition();
    };

    // Update the active dot
    const updateActiveDot = () => {
        dots.forEach((dot, index) => {
            dot.classList.toggle("active", index === currentIndex);
        });
    };

    // Add event listeners for dots
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            currentIndex = index; // Set the current index to the clicked dot's index
            updateSlidePosition();
        });
    });

    // Add event listeners for navigation buttons
    nextButton.addEventListener("click", () => {
        nextSlide();
    });

    prevButton.addEventListener("click", () => {
        prevSlide();
    });

    // Auto-slide every 3 seconds
    const startAutoSlide = () => {
        autoSlideInterval = setInterval(nextSlide, 3000);
    };

    const stopAutoSlide = () => {
        clearInterval(autoSlideInterval);
    };

    // Pause auto-slide on hover
    diaporama.addEventListener("mouseenter", stopAutoSlide);

    // Resume auto-slide immediately after hover
    diaporama.addEventListener("mouseleave", () => {
        nextSlide(); // Move to the next slide immediately
        startAutoSlide(); // Restart the interval
    });

    // Initialize the slide position and active dot
    updateSlidePosition();
    startAutoSlide();
});