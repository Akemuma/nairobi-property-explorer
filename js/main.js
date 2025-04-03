/**
 * Nairobi Pulse - Main JavaScript
 * Author: Nairobi Pulse Team
 * Version: 1.0
 */

document.addEventListener('DOMContentLoaded', function() {
  'use strict';
  
  // Preloader
  const preloader = document.getElementById('preloader');
  
  window.addEventListener('load', function() {
    preloader.style.opacity = '0';
    setTimeout(function() {
      preloader.style.display = 'none';
    }, 500);
  });
  
  // Smart Navbar with Auto Hide
  const header = document.querySelector('.header');
  let lastScrollTop = 0;
  let scrollThreshold = 100; // Minimum scroll before hiding nav
  
  window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
    // Add scrolled style when not at the top
    if (currentScroll > 50) {
      header.classList.add('nav-scrolled');
    } else {
      header.classList.remove('nav-scrolled');
      header.classList.remove('nav-smart-hide'); // Always show nav at the top
    }
    
    // Auto-hide navigation logic
    if (currentScroll > scrollThreshold) {
      // Scrolling down - hide the navbar
      if (currentScroll > lastScrollTop) {
        header.classList.add('nav-smart-hide');
      } 
      // Scrolling up - show the navbar
      else {
        header.classList.remove('nav-smart-hide');
      }
    }
    
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
  });
  
  // Handle dropdown menus
  const dropdownToggle = document.querySelector('.dropdown-toggle');
  const dropdownMenu = document.querySelector('.dropdown-menu');
  
  // On mobile, handle click events for dropdown toggle
  if (window.innerWidth < 992) {
    dropdownToggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      // Toggle the dropdown menu
      if (dropdownMenu.style.display === 'block') {
        dropdownMenu.style.display = 'none';
      } else {
        dropdownMenu.style.display = 'block';
      }
    });
    
    // Close the dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.dropdown')) {
        dropdownMenu.style.display = 'none';
      }
    });
  }
  
  // Initialize Bootstrap tooltips
  const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  tooltips.forEach(tooltip => {
    new bootstrap.Tooltip(tooltip);
  });
  
  // Initialize Bootstrap popovers
  const popovers = document.querySelectorAll('[data-bs-toggle="popover"]');
  popovers.forEach(popover => {
    new bootstrap.Popover(popover);
  });
  
  // Smooth scrolling for internal links
  document.querySelectorAll('a.nav-link[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 70,
          behavior: 'smooth'
        });
      }
    });
  });
  
  // Back to top button
  const backToTopButton = document.createElement('button');
  backToTopButton.id = 'back-to-top';
  backToTopButton.innerHTML = '<i class="fas fa-arrow-up"></i>';
  backToTopButton.classList.add('btn', 'btn-primary', 'back-to-top');
  backToTopButton.style.position = 'fixed';
  backToTopButton.style.bottom = '20px';
  backToTopButton.style.right = '20px';
  backToTopButton.style.display = 'none';
  backToTopButton.style.width = '45px';
  backToTopButton.style.height = '45px';
  backToTopButton.style.borderRadius = '50%';
  backToTopButton.style.zIndex = '99';
  document.body.appendChild(backToTopButton);
  
  backToTopButton.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
  
  window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
      backToTopButton.style.display = 'block';
    } else {
      backToTopButton.style.display = 'none';
    }
  });
  
  // Newsletter subscription
  const newsletterForms = document.querySelectorAll('.footer-subscribe, form:has(#email)');
  
  newsletterForms.forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get the email input
      const emailInput = this.querySelector('input[type="email"]');
      
      if (emailInput && emailInput.value) {
        // Show success message
        const successMessage = document.createElement('div');
        successMessage.classList.add('alert', 'alert-success', 'mt-3');
        successMessage.textContent = 'Thank you for subscribing to our newsletter!';
        
        // Insert message after the form
        this.parentNode.insertBefore(successMessage, this.nextSibling);
        
        // Reset form
        this.reset();
        
        // Remove the message after 5 seconds
        setTimeout(() => {
          successMessage.remove();
        }, 5000);
      }
    });
  });
  
  // Image lazy loading
  const venueImages = document.querySelectorAll('.venue-image');
  
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        const src = img.style.backgroundImage;
        
        // If image is already loaded, skip
        if (src.includes('data:image')) return;
        
        // Apply a fade-in effect
        img.style.opacity = '0';
        
        // Simulate image loading
        setTimeout(() => {
          img.style.transition = 'opacity 0.5s ease';
          img.style.opacity = '1';
        }, 100);
        
        observer.unobserve(img);
      }
    });
  });
  
  venueImages.forEach(image => {
    imageObserver.observe(image);
  });
  
  // Initialize Swiper sliders
  if (document.querySelector('.swiper-container')) {
    new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 40,
        },
      }
    });
  }
  
  // Matatu Image Gallery Slider
  if (document.querySelector('.matatu-gallery-slider')) {
    new Swiper('.matatu-gallery-slider', {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    });
  }
  
  // Restaurant Image Gallery Slider
  if (document.querySelectorAll('.restaurant-gallery-slider').length > 0) {
    document.querySelectorAll('.restaurant-gallery-slider').forEach(slider => {
      new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }
      });
    });
  }
  
  // Nightlife Image Gallery Slider
  if (document.querySelectorAll('.nightlife-gallery-slider').length > 0) {
    document.querySelectorAll('.nightlife-gallery-slider').forEach(slider => {
      new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }
      });
    });
  }
  
  // Attraction Image Gallery Slider
  if (document.querySelectorAll('.attraction-gallery-slider').length > 0) {
    document.querySelectorAll('.attraction-gallery-slider').forEach(slider => {
      new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }
      });
    });
  }
  
  // Event Image Gallery Slider
  if (document.querySelectorAll('.event-gallery-slider').length > 0) {
    document.querySelectorAll('.event-gallery-slider').forEach(slider => {
      new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }
      });
    });
  }
  
  // Add hover animations to cards
  const animateCards = document.querySelectorAll('.animate-on-hover');
  
  animateCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      card.classList.add('animate__animated', 'animate__pulse');
    });
    
    card.addEventListener('mouseleave', function() {
      card.classList.remove('animate__animated', 'animate__pulse');
    });
  });
  
  // Add scroll reveal animations
  const scrollElements = document.querySelectorAll('.scroll-reveal');
  
  scrollElements.forEach((el, index) => {
    el.dataset.aos = 'fade-up';
    el.dataset.aosDelay = index * 100;
    el.dataset.aosDuration = '800';
  });
  
  // Add social media share functionality
  document.querySelectorAll('.share-link').forEach(shareLink => {
    shareLink.addEventListener('click', function(e) {
      e.preventDefault();
      
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent(document.title);
      let shareUrl = '';
      
      const platform = this.dataset.platform;
      
      switch(platform) {
        case 'facebook':
          shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
          break;
        case 'twitter':
          shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
          break;
        case 'whatsapp':
          shareUrl = `https://wa.me/?text=${title}%20${url}`;
          break;
        default:
          return;
      }
      
      window.open(shareUrl, '_blank', 'width=600,height=400');
    });
  });
});
