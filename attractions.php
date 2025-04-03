<?php
  include 'includes/header.php';
  include 'includes/db.php';
  
  // Get all attractions
  $allAttractions = getAttractions();
  
  // Get current page from URL parameter
  $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
  
  // Get paginated attractions data
  $paginatedData = getPaginatedData($allAttractions, $currentPage, 6);
  $attractions = $paginatedData['data'];
  $pagination = $paginatedData['pagination'];
  
  // Get unique categories for filter
  $categories = [];
  foreach ($allAttractions as $attraction) {
    if (!in_array($attraction['category'], $categories)) {
      $categories[] = $attraction['category'];
    }
  }
  sort($categories);
?>

<br>
<br>
<br>
<main>
  <!-- Hero Section -->
  <section class="category-hero-section py-5" style="background-image: url('https://source.unsplash.com/1600x900/?nairobi,attraction');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center text-white">
          <h1 class="display-4 fw-bold">Nairobi Attractions</h1>
          <div class="separator my-3"></div>
          <p class="lead">Discover the best places to visit and things to do in Kenya's vibrant capital</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Filter Section -->
  <section class="filter-section py-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-3">Filter Attractions</h5>
              <form id="filter-form" class="row g-3">
                <div class="col-md-4">
                  <select class="form-select" id="category-filter">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                      <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="fun-filter">
                    <option value="">Any Fun Factor</option>
                    <option value="5">★★★★★ (Extremely Fun)</option>
                    <option value="4">★★★★☆ (Very Fun)</option>
                    <option value="3">★★★☆☆ (Fun)</option>
                    <option value="2">★★☆☆☆ (Somewhat Fun)</option>
                    <option value="1">★☆☆☆☆ (Mild Fun)</option>
                  </select>
                </div>
                
                <div class="col-md-4">
                  <select class="form-select" id="price-filter">
                    <option value="">Any Price Range</option>
                    <option value="Free">Free</option>
                    <option value="$">$ (Budget)</option>
                    <option value="$$">$$ (Moderate)</option>
                    <option value="$$$">$$$ (Expensive)</option>
                  </select>
                </div>
                
                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search by name or description...">
                    <button class="btn btn-primary" type="button" id="search-button">
                      <i class="fas fa-search"></i> Search
                    </button>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <button type="button" class="btn btn-outline-secondary w-100" id="reset-filters">
                    <i class="fas fa-undo"></i> Reset Filters
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Attractions Listing Section -->
  <section class="listings-section py-5">
    <div class="container">
      <div class="row g-4" id="attractions-container">
        <?php foreach ($attractions as $attraction): ?>
          <div class="col-md-4 venue-item" 
               data-category="<?php echo $attraction['category']; ?>" 
               data-fun="<?php echo $attraction['fun_factor']; ?>" 
               data-price="<?php echo $attraction['price_range']; ?>">
            <div class="card venue-card h-100">
              <!-- Attraction Image Gallery Slider -->
              <div class="swiper attraction-gallery-slider">
                <div class="swiper-wrapper">
                  <!-- Main image slide -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('<?php echo $attraction['image_url']; ?>')"></div>
                  </div>
                  <!-- Additional image slides -->
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/attractions/<?php echo strtolower(str_replace(' ', '-', $attraction['name'])); ?>-view.jpg')"></div>
                  </div>
                  <div class="swiper-slide">
                    <div class="card-img-top venue-image" style="background-image: url('assets/images/attractions/<?php echo strtolower(str_replace(' ', '-', $attraction['name'])); ?>-activity.jpg')"></div>
                  </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title mb-0"><?php echo $attraction['name']; ?></h5>
                  <span class="badge bg-primary"><?php echo $attraction['category']; ?></span>
                </div>
                <p class="card-text small text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $attraction['location']; ?></p>
                <div class="mb-2">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $attraction['rating']): ?>
                      <i class="fas fa-star text-warning"></i>
                    <?php else: ?>
                      <i class="far fa-star text-warning"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <span class="small text-muted ms-1">(<?php echo $attraction['reviews']; ?> reviews)</span>
                </div>
                <p class="card-text small venue-description"><?php echo $attraction['description']; ?></p>
                <div class="mt-3">
                  <?php if (!empty($attraction['highlights'])): ?>
                    <p class="card-text small mb-1"><strong>Highlights:</strong></p>
                    <div class="mb-2">
                      <?php foreach ($attraction['highlights'] as $highlight): ?>
                        <span class="badge bg-light text-dark me-1 mb-1"><?php echo $highlight; ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  
                  <div class="mt-2">
                    <p class="card-text mb-0">
                      <span class="text-success">Fun Factor: 
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $attraction['fun_factor']): ?>
                            <i class="fas fa-smile text-success"></i>
                          <?php else: ?>
                            <i class="far fa-smile text-muted"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                  <span class="text-muted small"><i class="fas fa-clock me-1"></i> <?php echo $attraction['hours']; ?></span>
                  <span class="text-success small"><?php echo $attraction['price_range']; ?></span>
                </div>
                <!-- Map Button -->
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary w-100 view-map" 
                          data-lat="<?php echo $attraction['coordinates']['lat']; ?>" 
                          data-lng="<?php echo $attraction['coordinates']['lng']; ?>"
                          data-name="<?php echo $attraction['name']; ?>">
                    <i class="fas fa-map-marker-alt"></i> View on Map
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
      <!-- Empty Results Message -->
      <div id="no-results" class="col-12 text-center py-5 d-none">
        <div class="no-results-container">
          <i class="fas fa-landmark fa-3x mb-3 text-muted"></i>
          <h3>No attractions found</h3>
          <p>Try adjusting your filters or search criteria</p>
          <button class="btn btn-primary" id="clear-filters">Clear Filters</button>
        </div>
      </div>
      
      <!-- Pagination -->
      <?php if ($pagination['totalPages'] > 1): ?>
      <div class="row mt-4">
        <div class="col-12">
          <nav aria-label="Attractions pagination">
            <ul class="pagination justify-content-center">
              <?php if ($pagination['hasPrevPage']): ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?php echo $pagination['currentPage'] - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
              <?php else: ?>
                <li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
              <?php endif; ?>
              
              <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?php echo ($i == $pagination['currentPage']) ? 'active' : ''; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
              
              <?php if ($pagination['hasNextPage']): ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?php echo $pagination['currentPage'] + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              <?php else: ?>
                <li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
  
  <!-- Map Modal -->
  <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mapModalLabel">Location Map</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="map" style="height: 400px;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="#" id="get-directions" class="btn btn-primary" target="_blank">Get Directions</a>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Google Maps JavaScript -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDefaultKeyForExamplePurposes&callback=initMap" async defer></script>

<script>
  // Map initialization function
  let map;
  let marker;
  
  function initMap() {
    // Default center (Nairobi)
    const nairobi = { lat: -1.286389, lng: 36.817223 };
    
    // Initialize the map
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: nairobi,
    });
    
    // Initialize a marker but don't place it yet
    marker = new google.maps.Marker({
      map: map,
      animation: google.maps.Animation.DROP,
    });
    
    // Set up event listeners for map buttons
    document.querySelectorAll('.view-map').forEach(button => {
      button.addEventListener('click', function() {
        const lat = parseFloat(this.getAttribute('data-lat'));
        const lng = parseFloat(this.getAttribute('data-lng'));
        const name = this.getAttribute('data-name');
        
        showLocationOnMap(lat, lng, name);
      });
    });
  }
  
  function showLocationOnMap(lat, lng, name) {
    const position = { lat, lng };
    
    // Update map center and marker
    map.setCenter(position);
    marker.setPosition(position);
    marker.setTitle(name);
    
    // Update modal title and directions link
    document.getElementById('mapModalLabel').textContent = name + ' - Location Map';
    document.getElementById('get-directions').href = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&destination_place_id=${name}`;
    
    // Show the modal
    const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
    mapModal.show();
  }
  
  // For search and filter functionality
  document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const categoryFilter = document.getElementById('category-filter');
    const funFilter = document.getElementById('fun-filter');
    const priceFilter = document.getElementById('price-filter');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const resetFiltersButton = document.getElementById('reset-filters');
    const clearFiltersButton = document.getElementById('clear-filters');
    const attractionsContainer = document.getElementById('attractions-container');
    const noResults = document.getElementById('no-results');
    
    // Apply filters function
    function applyFilters() {
      const selectedCategory = categoryFilter.value;
      const selectedFun = funFilter.value;
      const selectedPrice = priceFilter.value;
      const searchText = searchInput.value.toLowerCase();
      
      // Get all attraction items
      const attractions = attractionsContainer.querySelectorAll('.venue-item');
      
      // Counter for visible items
      let visibleCount = 0;
      
      // Loop through each attraction
      attractions.forEach(attraction => {
        const category = attraction.dataset.category;
        const fun = attraction.dataset.fun;
        const price = attraction.dataset.price;
        const text = attraction.textContent.toLowerCase();
        
        // Check if the attraction matches all criteria
        const matchesCategory = !selectedCategory || category === selectedCategory;
        const matchesFun = !selectedFun || fun >= selectedFun;
        const matchesPrice = !selectedPrice || price.includes(selectedPrice);
        const matchesSearch = !searchText || text.includes(searchText);
        
        // Show or hide based on the filters
        if (matchesCategory && matchesFun && matchesPrice && matchesSearch) {
          attraction.style.display = 'block';
          visibleCount++;
        } else {
          attraction.style.display = 'none';
        }
      });
      
      // Show or hide no results message
      if (visibleCount === 0) {
        noResults.classList.remove('d-none');
      } else {
        noResults.classList.add('d-none');
      }
    }
    
    // Reset filters function
    function resetFilters() {
      categoryFilter.value = '';
      funFilter.value = '';
      priceFilter.value = '';
      searchInput.value = '';
      
      applyFilters();
    }
    
    // Event listeners
    categoryFilter.addEventListener('change', applyFilters);
    funFilter.addEventListener('change', applyFilters);
    priceFilter.addEventListener('change', applyFilters);
    searchButton.addEventListener('click', applyFilters);
    searchInput.addEventListener('keyup', function(e) {
      if (e.key === 'Enter') {
        applyFilters();
      }
    });
    resetFiltersButton.addEventListener('click', resetFilters);
    clearFiltersButton.addEventListener('click', resetFilters);
  });
</script>

<script src="js/search.js"></script>

<?php include 'includes/footer.php'; ?>