document.addEventListener('DOMContentLoaded', function () {
  console.log('DOM loaded, initializing carousels...');

  initializeCarousel('mobile-gallery-carousel', '.carousel-dot');
  initializeCarousel('tiles-carousel', '.tiles-carousel-dot');
  initializeCarousel('testimonials-carousel', '.testimonials-carousel-dot');
  initializeCarousel('certificates-carousel', '.certificates-carousel-dot');
  initializeCarousel('team-carousel', '.team-carousel-dot');
  initializeCarousel('gallery-carousel', '.gallery-carousel-dot');
  initializeCarousel('instagram-carousel', '.instagram-carousel-dot');

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
    let isSwiping = false;

    carousel.addEventListener('touchstart', function (e) {
      startX = e.touches[0].pageX;
      startY = e.touches[0].pageY;
      isSwiping = false;
    });

    carousel.addEventListener('touchmove', function (e) {
      if (!isSwiping) {
        // Calculate the distance moved
        distX = e.touches[0].pageX - startX;
        distY = e.touches[0].pageY - startY;

        // Determine if this is a horizontal swipe or vertical scroll
        if (Math.abs(distX) > Math.abs(distY)) {
          // More horizontal movement - it's a carousel swipe
          isSwiping = true;
        }
      }

      // Only prevent default if it's a horizontal swipe
      if (isSwiping) {
        e.preventDefault();
      }
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

      isSwiping = false;
    });
  }

  // Desktop-only carousel for Certificates (center-only large + correct visual order)
  initCertificatesDesktop();

  function initCertificatesDesktop() {
    const host = document.getElementById('certificates-desktop');
    if (!host) return;

    const mq = window.matchMedia('(min-width: 768px)'); // md+
    const items = Array.from(host.querySelectorAll('.cert-item'));
    const prevBtn = document.getElementById('certificates-prev');
    const nextBtn = document.getElementById('certificates-next');
    const indexDisplay = document.getElementById('certificates-index');

    if (items.length === 0 || !prevBtn || !nextBtn) return;

    // start with the 2nd image centered if possible (1,2,3 -> 2 is big)
    let active = Math.min(1, items.length - 1);

    // size/visibility presets
    const BIG = ['md:h-[694px]', 'md:w-[540px]', 'z-10'];
    const SMALL = ['md:h-[420px]', 'md:w-[256px]', 'self-center', 'z-0'];
    const HIDE = ['hidden'];

    // ordering presets
    const ORD_LEFT = ['order-1'];
    const ORD_CENTER = ['order-2'];
    const ORD_RIGHT = ['order-3'];
    const ORD_OTHER = ['order-4'];

    // anything we might add and later need to remove
    const CLEAN = [
      ...BIG,
      ...SMALL,
      ...HIDE,
      ...ORD_LEFT,
      ...ORD_CENTER,
      ...ORD_RIGHT,
      ...ORD_OTHER,
    ];

    items.forEach((el) =>
      el.classList.add(
        'transition-all',
        'duration-300',
        'ease-in-out',
        'flex-shrink-0'
      )
    );

    const norm = (i) => (i + items.length) % items.length;

    function setClasses(el, add) {
      CLEAN.forEach((c) => el.classList.remove(c));
      add.forEach((c) => el.classList.add(c));
    }

    function paint() {
      if (!mq.matches) return; // let mobile handle itself

      const left = norm(active - 1);
      const right = norm(active + 1);

      items.forEach((el, i) => {
        if (i === active) {
          // CENTER (large)
          setClasses(el, [...BIG, ...ORD_CENTER]);
        } else if (i === left) {
          // LEFT (small)
          setClasses(el, [...SMALL, ...ORD_LEFT]);
        } else if (i === right) {
          // RIGHT (small)
          setClasses(el, [...SMALL, ...ORD_RIGHT]);
        } else {
          // others hidden (and pushed after)
          setClasses(el, [...HIDE, ...ORD_OTHER]);
        }
      });
      if (indexDisplay) {
        indexDisplay.textContent = `${active + 1} / ${items.length}`;
      }
    }

    function prev() {
      active = norm(active - 1);
      paint();
    }
    function next() {
      active = norm(active + 1);
      paint();
    }

    prevBtn.addEventListener('click', prev);
    nextBtn.addEventListener('click', next);

    // keep correct state through breakpoint changes
    mq.addEventListener
      ? mq.addEventListener('change', paint)
      : window.addEventListener('resize', paint);

    paint();
  }
});
