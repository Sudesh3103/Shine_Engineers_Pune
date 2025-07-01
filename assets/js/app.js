// =============navigation toggle ========
$(".toggle").click(function() {
    $(".menu").addClass("active");
});

$(".menu-close").click(function() {
    $(".menu").removeClass("active");
});
// FOR NAVBAR FIXED WHEN SCROLL
$(window).on("scroll", function() {
    var scrolling = $(this).scrollTop();
    if (scrolling > 70) {
        $(".main-navigation").addClass("navbar-fixed");
        $(".navigation").addClass("navigation-fixed");
    } else {
        $(".main-navigation").removeClass("navbar-fixed");
        $(".navigation").removeClass("navigation-fixed");
    }
});

// FOR BACK2TOP BUTTON
$(window).on("scroll", function() {
    var scroll = $(this).scrollTop();
    if (scroll > 500) {
        $(".scroll__top").show();
    } else {
        $(".scroll__top").hide();
    }
});
// ======preloader=======
setTimeout(function() {
        document.getElementById("preloader").style.opacity = "0";
        document.getElementById("preloader").style.visibility = "hidden";
    }, 3000)
    // ============product mixitup init===

// ========team slider ==========
var swiper = new Swiper(".team-slider", {

    slidesPerView: 1,
    spaceBetween: 30,
    loop: false,
    autoplay: false,
    speed: 1000,
    breakpoints: {
        580: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        }
    },
});



// ========customer slider ==========
var swiper = new Swiper(".customerSlider", {

    slidesPerView: 1,
    spaceBetween: 30,
    loop: false,
    autoplay: false,
    speed: 1000,
    breakpoints: {
        580: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        }
    },
});

// ========news slider ==========
var swiper = new Swiper(".top-news", {

    slidesPerView: 1,
    spaceBetween: 30,
    loop: false,
    autoplay: false,
    speed: 1000,
    breakpoints: {
        580: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        }
    },
});


// ========banner slider ==========
var swiper = new Swiper(".bannerSlider", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: false,
    speed: 1000,
});


// =======video popup=========
$('.play-video').on('click', function(e) {
    e.preventDefault();
    $('#video-overlay').addClass('open');
    $('#video-overlay').append('<iframe width="996" height="560" src="https://www.youtube.com/embed/yeREIXAKXRQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
});
$('video-overlay, .video-overlay-close').on('click', function(e) {
    e.preventDefault();
    close_video();
});
$(document).keyup(function(e) {
    if (e.kayCode === 27) {
        close_video();
    }
});

function close_video() {
    $('.video-overlay.open').removeClass('open').find('iframe').remove();
};


// =======video popup=========

// FOR FAQ SECTION ACCORDION
$(function($) {
    var panels = $(".faq-ans").hide();
    panels.first().show();

    $(".faq-que").click(function() {
        var $this = $(this);
        panels.slideUp();
        $this.next().slideDown();
    });
});

$(".faq-que").click(function() {
    $(".faq-que i").addClass("icofont-plus");
    $(this.children[1]).removeClass("icofont-plus");
    $(this.children[1]).addClass("icofont-minus");
});

// =======================customer review home 2 ============
var swiper = new Swiper(".productSlider", {
    pagination: {
        el: ".review-pagination",
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: true,
    speed: 1000,
});


// ==========message sent ========
function myFunction() {
    alert("Submit Your Message Please wait for reply!!");
}


// Client Testimonials 

   document.addEventListener('DOMContentLoaded', function() {
  const track = document.getElementById('testimonialTrack');
  const slides = Array.from(track.children);
  const dots = document.querySelectorAll('.testimonial-dot');
  const prevButton = document.querySelector('.prev');
  const nextButton = document.querySelector('.next');
  const testimonialSlider = document.querySelector('.testimonial-slider');
  
  let currentSlide = 0;
  let slideWidth;
  let slideInterval;
  
  // Function to calculate dimensions based on screen size
  const calculateDimensions = () => {
    // Get the container width to make sure slides are responsive
    const containerWidth = testimonialSlider.getBoundingClientRect().width;
    
    // Update slide width based on container
    slideWidth = containerWidth;
    
    // Reset slide positions
    slides.forEach((slide, index) => {
      slide.style.left = slideWidth * index + 'px';
      // Make sure all slides have proper width
      slide.style.width = `${slideWidth}px`;
    });
    
    // Update track position to current slide
    track.style.transform = `translateX(-${slideWidth * currentSlide}px)`;
  };
  
  // Move to target slide
  const moveToSlide = (targetIndex) => {
    if (targetIndex < 0) {
      targetIndex = slides.length - 1;
    } else if (targetIndex >= slides.length) {
      targetIndex = 0;
    }
    
    track.style.transform = `translateX(-${slideWidth * targetIndex}px)`;
    
    // Update active classes
    slides[currentSlide].classList.remove('active');
    slides[targetIndex].classList.add('active');
    
    dots[currentSlide].classList.remove('active');
    dots[targetIndex].classList.add('active');
    
    currentSlide = targetIndex;
  };
  
  // Initialize
  const initSlider = () => {
    calculateDimensions();
    
    // Click on dots
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        moveToSlide(index);
      });
    });
    
    // Click on arrows
    prevButton.addEventListener('click', () => {
      moveToSlide(currentSlide - 1);
    });
    
    nextButton.addEventListener('click', () => {
      moveToSlide(currentSlide + 1);
    });
    
    // Auto slide
    startAutoSlide();
    
    // Pause auto slide on hover
    testimonialSlider.addEventListener('mouseenter', () => {
      clearInterval(slideInterval);
    });
    
    testimonialSlider.addEventListener('mouseleave', () => {
      startAutoSlide();
    });
    
    // Touch support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    testimonialSlider.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    testimonialSlider.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
    }, { passive: true });
    
    const handleSwipe = () => {
      const swipeThreshold = 50; // Minimum distance required for swipe
      if (touchEndX < touchStartX - swipeThreshold) {
        // Swipe left
        moveToSlide(currentSlide + 1);
      } else if (touchEndX > touchStartX + swipeThreshold) {
        // Swipe right
        moveToSlide(currentSlide - 1);
      }
    };
  };
  
  // Auto slide function
  const startAutoSlide = () => {
    clearInterval(slideInterval);
    slideInterval = setInterval(() => {
      moveToSlide(currentSlide + 1);
    }, 5000);
  };
  
  // Initialize slider
  initSlider();
  
  // Update dimensions on window resize
  window.addEventListener('resize', () => {
    // Recalculate dimensions with a small delay to ensure accurate calculations
    clearTimeout(window.resizeTimer);
    window.resizeTimer = setTimeout(() => {
      calculateDimensions();
    }, 250);
  });
});


// Client testimonials 

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap carousel
    var testimonialCarousel = new bootstrap.Carousel(document.getElementById('testimonialCarousel'), {
      interval: 5000,
      wrap: true
    });
    
    // Add metallic shine effect periodically
    setInterval(function() {
      const shine = document.querySelector('.metal-shine');
      shine.style.animation = 'none';
      setTimeout(function() {
        shine.style.animation = 'shine 5s infinite';
      }, 10);
    }, 8000);
  });


  // Gallery Page 

     // Gallery filtering functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const galleryGrid = document.getElementById('galleryGrid');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');
                
                // Show loading spinner
                loadingSpinner.style.display = 'block';
                galleryGrid.style.opacity = '0.5';
                
                setTimeout(() => {
                    // Filter gallery items
                    galleryItems.forEach(item => {
                        const category = item.getAttribute('data-category');
                        
                        if (filter === 'all' || category === filter) {
                            item.style.display = 'block';
                            item.classList.add('fade-in');
                        } else {
                            item.style.display = 'none';
                            item.classList.remove('fade-in');
                        }
                    });
                    
                    // Hide loading spinner
                    loadingSpinner.style.display = 'none';
                    galleryGrid.style.opacity = '1';
                }, 500);
            });
        });

        // Modal functionality
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');

        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                const imageSrc = item.getAttribute('data-image');
                const title = item.getAttribute('data-title');
                const description = item.getAttribute('data-description');

                modalImage.src = imageSrc;
                modalImage.alt = title;
                modalTitle.textContent = title;
                modalDescription.textContent = description;
            });
        });

        // Animate statistics on scroll
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const statNumbers = entry.target.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const originalText = stat.textContent.trim(); // Store original text
                const hasPlus = originalText.includes('+');
                const finalNumber = parseInt(originalText);
                let currentNumber = 0;
                const increment = finalNumber / 50;
                
                const counter = setInterval(() => {
                    currentNumber += increment;
                    if (currentNumber >= finalNumber) {
                        stat.textContent = finalNumber + (hasPlus ? '+' : '');
                        clearInterval(counter);
                    } else {
                        stat.textContent = Math.floor(currentNumber);
                    }
                }, 30);
            });
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

const statsSection = document.querySelector('.stats-section');
if (statsSection) {
    observer.observe(statsSection);
}

        // Smooth scroll behavior for better UX
        document.addEventListener('DOMContentLoaded', () => {
            // Add staggered animation to gallery items
            galleryItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Lazy loading simulation (for demonstration)
        const lazyLoadImages = () => {
            const images = document.querySelectorAll('.gallery-image');
            
            images.forEach(img => {
                if (img.complete && img.naturalHeight !== 0) {
                    img.parentElement.classList.add('loaded');
                } else {
                    img.addEventListener('load', () => {
                        img.parentElement.classList.add('loaded');
                    });
                }
            });
        };

        // Initialize lazy loading
        lazyLoadImages();

        // Add hover sound effect (optional - can be removed)
        galleryItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                // Optional: Add subtle hover effects or sounds
                item.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            });
        });
