document.addEventListener('DOMContentLoaded', function () {
  console.log('DOM loaded, initializing carousels...');

  initializeCarousel('mobile-gallery-carousel', '.carousel-dot');
  initializeCarousel('tiles-carousel', '.tiles-carousel-dot');
  initializeCarousel('testimonials-carousel', '.testimonials-carousel-dot');
  initializeCarousel('certificates-carousel', '.certificates-carousel-dot');
  initializeCarousel('team-carousel', '.team-carousel-dot');
  initializeCarousel('gallery-carousel', '.gallery-carousel-dot');

  function initializeCarousel(carouselId, dotSelector) {
    const carousel = document.getElementById(carouselId);
    const dots = document.querySelectorAll(dotSelector);

    console.log(`Initializing ${carouselId}:`, carousel);
    console.log(`Dots found for ${carouselId}:`, dots.length);

    if (!carousel || dots.length === 0) {
      console.log(`Carousel ${carouselId} or dots not found - skipping`);
      return;
    }

    let currentSlide = 0;
    const totalSlides = dots.length;
    const slides = carousel.children[0]
      ? carousel.children[0].children
      : carousel.children;

    console.log(`Total slides for ${carouselId}:`, slides.length);

    function updateCarousel() {
      const translateX = -currentSlide * 100;
      console.log(
        `Moving ${carouselId} to slide:`,
        currentSlide,
        'translateX:',
        translateX + '%'
      );

      const targetElement =
        carouselId === 'testimonials-carousel'
          ? carousel.children[0]
          : carousel;

      if (targetElement) {
        targetElement.style.transform = `translateX(${translateX}%)`;
        targetElement.style.webkitTransform = `translateX(${translateX}%)`;
        targetElement.style.msTransform = `translateX(${translateX}%)`;
      }
      dots.forEach((dot, index) => {
        if (index === currentSlide) {
          dot.classList.remove('bg-white/30');
          dot.classList.add('bg-[#d1b07a]');
          console.log(`Activated dot ${index} for ${carouselId}`);
        } else {
          dot.classList.remove('bg-[#d1b07a]');
          dot.classList.add('bg-white/30');
        }
      });
    }

    function goToSlide(slideIndex) {
      console.log(`Going to slide ${slideIndex} in ${carouselId}`);
      currentSlide = slideIndex;
      updateCarousel();
    }

    function prevSlide() {
      currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1;
      updateCarousel();
    }

    function nextSlide() {
      currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0;
      updateCarousel();
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        console.log(`Dot ${index} clicked for ${carouselId}`);
        goToSlide(index);
      });
    });

    updateCarousel();

    let startX = 0;
    let startY = 0;
    let distX = 0;
    let distY = 0;
    let threshold = 100;
    let restraint = 100;

    carousel.addEventListener('touchstart', function (e) {
      startX = e.touches[0].pageX;
      startY = e.touches[0].pageY;
    });

    carousel.addEventListener('touchmove', function (e) {
      e.preventDefault();
    });

    carousel.addEventListener('touchend', function (e) {
      distX = e.changedTouches[0].pageX - startX;
      distY = e.changedTouches[0].pageY - startY;

      if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint) {
        if (distX > 0) {
          prevSlide();
        } else {
          nextSlide();
        }
      }
    });
  }
});
