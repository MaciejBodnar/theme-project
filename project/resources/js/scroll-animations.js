document.addEventListener('DOMContentLoaded', function () {
  console.log('Initializing scroll animations...');

  // Configuration for different animation types
  const animationConfig = {
    fadeIn: {
      initial: { opacity: 0, transform: 'translateY(50px)' },
      animate: { opacity: 1, transform: 'translateY(0px)' },
      transition: 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
    },
    slideInLeft: {
      initial: { opacity: 0, transform: 'translateX(-100px)' },
      animate: { opacity: 1, transform: 'translateX(0px)' },
      transition: 'all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
    },
    slideInRight: {
      initial: { opacity: 0, transform: 'translateX(100px)' },
      animate: { opacity: 1, transform: 'translateX(0px)' },
      transition: 'all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
    },
    scaleIn: {
      initial: { opacity: 0, transform: 'scale(0.8)' },
      animate: { opacity: 1, transform: 'scale(1)' },
      transition: 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)',
    },
    slideUp: {
      initial: { opacity: 0, transform: 'translateY(80px)' },
      animate: { opacity: 1, transform: 'translateY(0px)' },
      transition: 'all 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
    },
  };

  // Apply initial styles to prevent flash
  function applyInitialStyles() {
    const animatedElements = document.querySelectorAll('[data-animate]');

    animatedElements.forEach((element) => {
      const animationType = element.getAttribute('data-animate');
      const config = animationConfig[animationType];

      if (config) {
        element.style.opacity = config.initial.opacity;
        element.style.transform = config.initial.transform;
        element.style.transition = config.transition;
      }
    });
  }

  // Animate element when it comes into view
  function animateElement(element) {
    const animationType = element.getAttribute('data-animate');
    const delay = element.getAttribute('data-delay') || 0;
    const config = animationConfig[animationType];

    if (config) {
      setTimeout(() => {
        element.style.opacity = config.animate.opacity;
        element.style.transform = config.animate.transform;
        element.classList.add('animated');
      }, parseInt(delay));
    }
  }

  // Intersection Observer callback
  function handleIntersection(entries, observer) {
    entries.forEach((entry) => {
      if (entry.isIntersecting && entry.intersectionRatio > 0.1) {
        console.log('Animating element:', entry.target);
        animateElement(entry.target);

        // Stop observing this element after animation
        observer.unobserve(entry.target);
      }
    });
  }

  // Initialize Intersection Observer
  function initScrollAnimations() {
    const observerOptions = {
      threshold: [0.1, 0.3, 0.5],
      rootMargin: '-50px 0px -50px 0px',
    };

    const observer = new IntersectionObserver(
      handleIntersection,
      observerOptions
    );

    // Observe all elements with data-animate attribute
    const animatedElements = document.querySelectorAll('[data-animate]');

    animatedElements.forEach((element) => {
      observer.observe(element);
    });

    console.log(
      `Observing ${animatedElements.length} elements for scroll animations`
    );
  }

  // Add parallax effect to background elements
  function initParallax() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');

    if (parallaxElements.length === 0) return;

    function updateParallax() {
      const scrolled = window.pageYOffset;

      parallaxElements.forEach((element) => {
        const rate = scrolled * (element.getAttribute('data-parallax') || 0.5);
        element.style.transform = `translateY(${rate}px)`;
      });
    }

    // Throttle scroll events for better performance
    let ticking = false;
    function handleScroll() {
      if (!ticking) {
        requestAnimationFrame(() => {
          updateParallax();
          ticking = false;
        });
        ticking = true;
      }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
  }

  // Add stagger animation for grid items
  function initStaggerAnimations() {
    const staggerContainers = document.querySelectorAll('[data-stagger]');

    staggerContainers.forEach((container) => {
      const children = container.children;
      const delay = parseInt(container.getAttribute('data-stagger')) || 100;

      Array.from(children).forEach((child, index) => {
        if (!child.hasAttribute('data-animate')) {
          child.setAttribute('data-animate', 'fadeIn');
        }
        child.setAttribute('data-delay', index * delay);
      });
    });
  }

  // Add smooth scrolling behavior for anchor links
  function initSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach((link) => {
      link.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#') return;

        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start',
          });
        }
      });
    });
  }

  // Add scroll progress indicator
  function initScrollProgress() {
    const progressBar = document.createElement('div');
    progressBar.className = 'scroll-progress';
    progressBar.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      width: 0%;
      height: 3px;
      background: linear-gradient(90deg, #d1b07a, #f4e4c1);
      z-index: 9999;
      transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);

    function updateProgress() {
      const winScroll =
        document.body.scrollTop || document.documentElement.scrollTop;
      const height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
      const scrolled = (winScroll / height) * 100;
      progressBar.style.width = scrolled + '%';
    }

    window.addEventListener('scroll', updateProgress, { passive: true });
  }

  // Initialize all scroll features
  function init() {
    applyInitialStyles();
    initStaggerAnimations();
    initScrollAnimations();
    initParallax();
    initSmoothScrolling();
    initScrollProgress();

    console.log('Scroll animations initialized successfully!');
  }

  // Start initialization
  init();
});
