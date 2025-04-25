document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".diaporama-item");
    const slideContainer = document.querySelector("#slide");
    const prevButton = document.querySelector("#prev");
    const nextButton = document.querySelector("#next");
    let currentIndex = 0;
    const slideCount = slides.length;

    // Set the initial position of the slides
    const updateSlidePosition = () => {
        slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
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

    // Add event listeners for navigation buttons
    nextButton.addEventListener("click", () => {
        nextSlide();
    });

    prevButton.addEventListener("click", () => {
        prevSlide();
    });

    // Auto-slide every 3 seconds
    setInterval(nextSlide, 3000);

    // Initialize the slide position
    updateSlidePosition();
});