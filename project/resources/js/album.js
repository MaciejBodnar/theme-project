/**
 * Album Gallery JavaScript
 * Handles scroll fade effects and lightbox functionality for single album pages
 */

// Make lightbox functions globally accessible
window.openLightbox = function (imageSrc, imageAlt, imageCaption) {
  const lightbox = document.getElementById('lightbox');
  const lightboxImage = document.getElementById('lightbox-image');
  const lightboxCaption = document.getElementById('lightbox-caption');

  lightboxImage.src = imageSrc;
  lightboxImage.alt = imageAlt;
  lightboxCaption.textContent = imageCaption || '';

  lightbox.classList.remove('hidden');
  lightbox.classList.add('flex');
  document.body.style.overflow = 'hidden';
};

window.closeLightbox = function () {
  const lightbox = document.getElementById('lightbox');
  lightbox.classList.add('hidden');
  lightbox.classList.remove('flex');
  document.body.style.overflow = 'auto';
};

document.addEventListener('DOMContentLoaded', function () {
  // Initialize scroll fade effects
  const scrollContainer = document.getElementById('album-scroll');
  const topFade = document.getElementById('top-fade');
  const bottomFade = document.getElementById('bottom-fade');

  if (scrollContainer && topFade && bottomFade) {
    function handleScroll() {
      const scrollTop = scrollContainer.scrollTop;
      const scrollHeight = scrollContainer.scrollHeight;
      const clientHeight = scrollContainer.clientHeight;
      topFade.style.opacity = scrollTop > 10 ? '1' : '0';
      const isAtBottom = scrollTop + clientHeight >= scrollHeight - 10;
      bottomFade.style.opacity = isAtBottom ? '0' : '1';
    }

    scrollContainer.addEventListener('scroll', handleScroll);
    handleScroll();
  }

  // Initialize lightbox event listeners
  const lightbox = document.getElementById('lightbox');
  if (lightbox) {
    // Close lightbox when clicking outside the image
    lightbox.addEventListener('click', function (e) {
      if (e.target === this) {
        window.closeLightbox();
      }
    });
  }

  // Close lightbox with Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      window.closeLightbox();
    }
  });
});
