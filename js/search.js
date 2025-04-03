/**
 * Nairobi Pulse - Search and Filter Functionality
 * Author: Nairobi Pulse Team
 * Version: 1.0
 */

document.addEventListener('DOMContentLoaded', function() {
  'use strict';
  
  // Variables
  const searchInput = document.getElementById('search-input');
  const searchButton = document.getElementById('search-button');
  const resetButton = document.getElementById('reset-filters');
  const clearButton = document.getElementById('clear-filters');
  const noResults = document.getElementById('no-results');
  
  // Get the container based on the page
  let container, items, filterElements;
  
  if (document.getElementById('restaurants-container')) {
    container = document.getElementById('restaurants-container');
    items = document.querySelectorAll('#restaurants-container .venue-item');
    filterElements = {
      cuisine: document.getElementById('cuisine-filter'),
      location: document.getElementById('location-filter'),
      price: document.getElementById('price-filter')
    };
  } else if (document.getElementById('venues-container')) {
    container = document.getElementById('venues-container');
    items = document.querySelectorAll('#venues-container .venue-item');
    filterElements = {
      type: document.getElementById('type-filter'),
      location: document.getElementById('location-filter'),
      music: document.getElementById('music-filter'),
      rating: document.getElementById('rating-filter')
    };
  } else if (document.getElementById('matatus-container')) {
    container = document.getElementById('matatus-container');
    items = document.querySelectorAll('#matatus-container .venue-item');
    filterElements = {
      route: document.getElementById('route-filter'),
      art: document.getElementById('art-filter'),
      year: document.getElementById('year-filter')
    };
  }
  
  // If we're not on a listing page, exit
  if (!container) return;
  
  // Variables to track current filters
  let currentFilters = {};
  let searchTerm = '';
  
  // Function to apply filters
  function applyFilters() {
    let visibleCount = 0;
    
    items.forEach(item => {
      let shouldShow = true;
      
      // Check against each filter
      for (const [key, value] of Object.entries(currentFilters)) {
        if (value && item.dataset[key] !== value) {
          shouldShow = false;
          break;
        }
      }
      
      // Check against search term
      if (shouldShow && searchTerm) {
        const title = item.querySelector('.card-title').textContent.toLowerCase();
        const description = item.querySelector('.venue-description').textContent.toLowerCase();
        
        if (!title.includes(searchTerm) && !description.includes(searchTerm)) {
          shouldShow = false;
        }
      }
      
      // Special case for year filter if it's "older"
      if (shouldShow && currentFilters.year === 'older') {
        const year = parseInt(item.dataset.year);
        if (year >= 2020) {
          shouldShow = false;
        }
      }
      
      // Special case for rating filter
      if (shouldShow && currentFilters.rating) {
        const rating = parseInt(item.dataset.rating);
        const minRating = parseInt(currentFilters.rating);
        if (rating < minRating) {
          shouldShow = false;
        }
      }
      
      // Toggle visibility
      if (shouldShow) {
        item.style.display = '';
        visibleCount++;
      } else {
        item.style.display = 'none';
      }
    });
    
    // Show or hide "no results" message
    if (visibleCount === 0) {
      noResults.classList.remove('d-none');
    } else {
      noResults.classList.add('d-none');
    }
    
    return visibleCount;
  }
  
  // Add event listeners to filter elements
  for (const [key, element] of Object.entries(filterElements)) {
    if (element) {
      element.addEventListener('change', function() {
        currentFilters[key] = this.value;
        applyFilters();
      });
    }
  }
  
  // Search functionality
  if (searchButton) {
    searchButton.addEventListener('click', function() {
      if (searchInput) {
        searchTerm = searchInput.value.trim().toLowerCase();
        applyFilters();
      }
    });
  }
  
  // Search on Enter key
  if (searchInput) {
    searchInput.addEventListener('keyup', function(e) {
      if (e.key === 'Enter') {
        searchTerm = this.value.trim().toLowerCase();
        applyFilters();
      }
    });
  }
  
  // Reset filters
  if (resetButton) {
    resetButton.addEventListener('click', function() {
      // Reset all filter elements
      for (const element of Object.values(filterElements)) {
        if (element) {
          element.value = '';
        }
      }
      
      // Clear search input
      if (searchInput) {
        searchInput.value = '';
      }
      
      // Reset filter variables
      currentFilters = {};
      searchTerm = '';
      
      // Apply filters (which now shows all)
      applyFilters();
    });
  }
  
  // Clear filters button in no results message
  if (clearButton) {
    clearButton.addEventListener('click', function() {
      // Reset all filter elements
      for (const element of Object.values(filterElements)) {
        if (element) {
          element.value = '';
        }
      }
      
      // Clear search input
      if (searchInput) {
        searchInput.value = '';
      }
      
      // Reset filter variables
      currentFilters = {};
      searchTerm = '';
      
      // Apply filters (which now shows all)
      applyFilters();
    });
  }
  
  // Initialize any pre-selected filters
  for (const [key, element] of Object.entries(filterElements)) {
    if (element && element.value) {
      currentFilters[key] = element.value;
    }
  }
  
  // Initial filter application
  applyFilters();
  
  // Add animation to items when they appear
  const animateItems = () => {
    items.forEach((item, index) => {
      if (item.style.display !== 'none') {
        // Stagger the animations
        setTimeout(() => {
          item.style.opacity = '0';
          item.style.transform = 'translateY(20px)';
          item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
          
          // Need to force a reflow
          void item.offsetWidth;
          
          item.style.opacity = '1';
          item.style.transform = 'translateY(0)';
        }, index * 50);
      }
    });
  };
  
  // Call animation on page load
  animateItems();
});
